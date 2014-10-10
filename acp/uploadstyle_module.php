<?php
/**
*
* @package Upload Style
* @copyright (c) 2014 John Peskens (http://ForumHulp.com)
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace forumhulp\uploadstyle\acp;

class uploadstyle_module
{
	public $u_action;
	public $main_link;
	public $back_link;
	var $ext_dir = '';
	var $error = '';

	protected $db;
	protected $user;
	protected $template;
	protected $request;
	protected $cache;
	protected $auth;
	protected $phpbb_root_path;
	protected $php_ext;
	protected $styles_path_absolute = 'styles';

	function main($id, $mode)
	{
		global $db, $config, $user, $phpbb_root_path, $phpEx, $cache, $template, $request, $phpbb_extension_manager, $phpbb_container;

		$this->db = $db;
		$this->user = $user;
		$this->template = $template;
		$this->request = $request;
		$this->cache = $cache;
		$this->config = $config;
		$this->phpbb_root_path = $phpbb_root_path;
		$this->php_ext = $phpEx;

		$this->user->add_lang_ext('forumhulp/uploadstyle', 'upload');
		$this->page_title = $this->user->lang['ACP_UPLOAD_STYLE_TITLE'];
		$this->tpl_name = 'acp_upload';
		
		$this->default_style = $this->config['default_style'];
		$this->styles_path = $this->phpbb_root_path . $this->styles_path_absolute . '/';
		$this->ext_dir = $this->phpbb_root_path . 'ext';

		$action = $this->request->variable('action', '');

		// if 'i' is a number - continue displaying a number
		$mode = $this->request->variable('mode', $mode);
		$id = $this->request->variable('i', $id);
		$this->main_link = $this->phpbb_root_path . 'adm/index.php?i=' . $id . '&amp;sid=' .$this->user->session_id . '&amp;mode=' . $mode;
		$this->back_link = ($this->request->is_ajax()) ? adm_back_link($this->u_action) : '';

		include($this->phpbb_root_path . 'ext/forumhulp/uploadstyle/vendor/filetree/filetree.' . $this->php_ext);
		$file = $this->request->variable('file', '');
		if ($file != '')
		{
			\filetree::get_file($file);
		}

		switch ($action)
		{
			case 'details':
				$this->user->add_lang(array('install', 'acp/extensions', 'migrator'));
				$ext_name = 'forumhulp/uploadstyle';
				$md_manager = new \phpbb\extension\metadata_manager($ext_name, $this->config, $phpbb_extension_manager, $this->template, $this->user, $this->phpbb_root_path);
				try
				{
					$this->metadata = $md_manager->get_metadata('all');
				}
				catch(\phpbb\extension\exception $e)
				{
					trigger_error($e, E_USER_WARNING);
				}

				$md_manager->output_template_data();

				try
				{
					$updates_available = $this->version_check($md_manager, $this->request->variable('versioncheck_force', false));

					$this->template->assign_vars(array(
						'S_UP_TO_DATE'		=> empty($updates_available),
						'S_VERSIONCHECK'	=> true,
						'UP_TO_DATE_MSG'	=> $this->user->lang(empty($updates_available) ? 'UP_TO_DATE' : 'NOT_UP_TO_DATE', $md_manager->get_metadata('display-name')),
					));

					foreach ($updates_available as $branch => $version_data)
					{
						$this->template->assign_block_vars('updates_available', $version_data);
					}
				}
				catch (\RuntimeException $e)
				{
					$this->template->assign_vars(array(
						'S_VERSIONCHECK_STATUS'			=> $e->getCode(),
						'VERSIONCHECK_FAIL_REASON'		=> ($e->getMessage() !== $this->user->lang('VERSIONCHECK_FAIL')) ? $e->getMessage() : '',
					));
				}

				$this->template->assign_vars(array(
					'U_BACK'				=> $this->u_action . '&amp;action=list',
				));

				$this->tpl_name = 'acp_ext_details';
				break;

			case 'upload':
				if (($this->request->variable('local_upload', '')) != '')
				{
					$action = 'upload_local';
				}
				else if (strpos($this->request->variable('remote_upload', ''), 'http://') !== false || strpos($this->request->variable('remote_upload', ''), 'https://') !== false)
				{
					$action = 'upload_remote';
				}

			case 'upload_remote':
				if (!is_writable($this->ext_dir))
				{
					$this->trigger_error($this->user->lang('EXT_NOT_WRITABLE'));
				}
				else if (!$this->upload_ext($action))
				{
					$this->trigger_error($this->user->lang('EXT_UPLOAD_ERROR'));
				}
				$this->list_available_styles($phpbb_extension_manager);
				$this->template->assign_vars(array(
					'U_ACTION'			=> $this->u_action,
					'U_UPLOAD'			=> $this->main_link . '&amp;action=upload',
					'U_UPLOAD_REMOTE'	=> $this->main_link . '&amp;action=upload_remote',
					'S_FORM_ENCTYPE'	=> ' enctype="multipart/form-data"',
				));
				break;

			case 'delete':
				$ext_name = $this->request->variable('ext_name', '');
				$zip_name = $this->request->variable('zip_name', '');
				if ($ext_name != '')
				{
					if (confirm_box(true))
					{
						$dir = substr($ext_name, 0, strpos($ext_name, '/'));
						$extensions = sizeof(array_filter(glob($this->phpbb_root_path . 'styles/' . $dir . '/*'), 'is_dir'));
						$dir = ($extensions == 1) ? $dir : $ext_name;
						$this->rrmdir($this->phpbb_root_path . 'styles/' . $dir);
						if($this->request->is_ajax())
						{
							trigger_error($this->user->lang('STYLE_DELETE_SUCCESS'));
						}
						else
						{
							redirect($this->phpbb_root_path . 'adm/index.php?i=' . $id . '&amp;sid=' . $this->user->session_id . '&amp;mode=' . $mode);
						}
					} else {
						confirm_box(false, $this->user->lang('STYLE_DELETE_CONFIRM', $ext_name), build_hidden_fields(array(
							'i'			=> $id,
							'mode'		=> $mode,
							'action'	=> $action,
						)));
					}
				}
				else if ($zip_name != '')
				{
					if (confirm_box(true))
					{
						$this->rrmdir($this->phpbb_root_path . 'ext/' . $zip_name);
						if($this->request->is_ajax())
						{
							trigger_error($this->user->lang('STYLE_ZIP_DELETE_SUCCESS'));
						}
						else
						{
							redirect($this->phpbb_root_path . 'adm/index.php?i=' . $id . '&amp;sid=' .$this->user->session_id . '&amp;mode=' . $mode);
						}
					} else {
						confirm_box(false, $this->user->lang('STYLE_ZIP_DELETE_CONFIRM', $zip_name), build_hidden_fields(array(
							'i'			=> $id,
							'mode'		=> $mode,
							'action'	=> $action,
						)));
					}
				}
				break;

			default:
				$this->listzip();
				$this->list_available_styles();
				$this->template->assign_vars(array(
					'U_ACTION'			=> $this->u_action,
					'U_UPLOAD'			=> $this->main_link . '&amp;action=upload',
					'U_UPLOAD_REMOTE'	=> $this->main_link . '&amp;action=upload_remote',
					'S_FORM_ENCTYPE'	=> ' enctype="multipart/form-data"',
				));
				break;
		}
	}

	function listzip()
	{
		global $phpbb_container;
		$zip_aray = array();
		$ffs = scandir($this->phpbb_root_path . 'ext/');
		foreach($ffs as $ff)
		{
			if ($ff != '.' && $ff != '..')
			{
				if (strpos($ff,'.zip') && in_array($ff, array('Orange_BBEs-Orange_BBEs.zip', 'prosilver_se.zip', 'style-PBTech-master.zip')))
				{
					$zip_aray[] = array(
						'META_DISPLAY_NAME'	=> $ff,
						'U_UPLOAD'			=> $this->main_link . '&amp;action=upload&amp;local_upload=' . urlencode($ff),
						'U_DELETE'			=> $this->main_link . '&amp;action=delete&amp;zip_name=' . urlencode($ff)
					);
				}
			}
		}

		$pagination = $phpbb_container->get('pagination');
		$start		= $this->request->variable('start', 0);
		$zip_count = sizeof($zip_aray);
		$per_page = 5;
		$base_url = $this->u_action;
		$pagination->generate_template_pagination($base_url, 'pagination', 'start', $zip_count, $per_page, $start);

		uasort($zip_aray, array($this, 'sort_extension_meta_data_table'));
		for($i = $start; $i < $zip_count && $i < $start + $per_page; $i++)
		{
			$this->template->assign_block_vars('zip', $zip_aray[$i]);
		}
	}

	function get_style_path($dir)
	{
		global $style_path;
		$ffs = scandir($dir);
		$style_path = false;
		foreach($ffs as $ff)
		{
			if ($ff != '.' && $ff != '..')
			{
				if ($ff == 'style.cfg')
				{
					$style_path = $dir . '/' . $ff;
					break;
				}
				if(is_dir($dir.'/'.$ff))
				{
					$this->get_style_path($dir . '/' . $ff);
				}
			}
		}
		return $style_path;
	}

	/**
	* Read style configuration file
	*
	* @param string $dir style directory
	* @return array|bool Style data, false on error
	*/
	function read_style_cfg($dir)
	{
		static $required = array('name', 'phpbb_version', 'copyright');
		$cfg = @parse_cfg_file($dir);

		// Check if it is a valid file
		foreach ($required as $key)
		{
			if (!isset($cfg[$key]))
			{
				return false;
			}
		}

		// Check data
		if (!isset($cfg['parent']) || !is_string($cfg['parent']) || $cfg['parent'] == $cfg['name'])
		{
			$cfg['parent'] = '';
		}
		if (!isset($cfg['template_bitfield']))
		{
//			$cfg['template_bitfield'] = $this->default_bitfield();
		}

		return $cfg;
	}

	/**
	* Generates default bitfield
	*
	* This bitfield decides which bbcodes are defined in a template.
	*
	* @return string Bitfield
	*/
	function default_bitfield()
	{
		static $value;
		if (isset($value))
		{
			return $value;
		}

		// Hardcoded template bitfield to add for new templates
		$bitfield = new bitfield();
		$bitfield->set(0);
		$bitfield->set(1);
		$bitfield->set(2);
		$bitfield->set(3);
		$bitfield->set(4);
		$bitfield->set(8);
		$bitfield->set(9);
		$bitfield->set(11);
		$bitfield->set(12);
		$value = $bitfield->get_base64();
		return $value;
	}

	// Function to remove folders and files
	function rrmdir($dir)
	{
		if (is_dir($dir))
		{
			$files = scandir($dir);
			foreach ($files as $file)
			{
				if ($file != '.' && $file != '..')
				{
					$this->rrmdir($dir . '/' . $file);
				}
			}
			rmdir($dir);
		}
		else if (file_exists($dir))
		{
			unlink($dir);
		}
	}

	// Function to Copy folders and files
	function rcopy($src, $dst)
	{
		if (file_exists($dst))
		{
			$this->rrmdir($dst);
		}
		if (is_dir($src))
		{
			mkdir($dst, 0775, true);
			$files = scandir($src);
			foreach($files as $file)
			{
				if ($file != '.' && $file != '..')
				{
					$this->rcopy($src . '/' . $file, $dst . '/' . $file);
				}
			}
		} else if (file_exists($src))
		{
			copy($src, $dst);
		}
	}


	/**
	* Show item in styles list
	*
	* @param array $style style row
	* @param int $level style inheritance level
	*/
	protected function list_style(&$style, $level)
	{
		// Mark row as shown
		if (!empty($style['_shown']))
		{
			return;
		}

		$style['_shown'] = true;

		// Generate template variables
		$actions = array();
		$row = array(
			// Style data
			'STYLE_ID'			=> $style['style_id'],
			'STYLE_NAME'		=> htmlspecialchars($style['style_name']),
			'STYLE_PATH'		=> htmlspecialchars($style['style_path']),
			'STYLE_COPYRIGHT'	=> strip_tags($style['style_copyright']),
			'STYLE_ACTIVE'		=> $style['style_active'],

			// Additional data
			'DEFAULT'			=> ($style['style_id'] && $style['style_id'] == $this->default_style),
			'LEVEL'				=> $level,
			'PADDING'			=> (4 + 16 * $level),
			'STYLE_VERSION'		=> $style['style_version'],
			'PHPBB_VERSION'		=> $style['phpbb_version'],

			// Comment to show below style
			'COMMENT'		=> (isset($style['_note'])) ? $style['_note'] : '',
		);

		// Status specific data
		if (!$style['style_id'])
		{
			$actions[] = array(
				'U_ACTION'	=> '/adm/index.php?i=acp_styles&sid=' . $this->user->data['session_id'] . '&mode=install&action=install&hash=' . generate_link_hash('install') . '&dir=' . $style['style_name'],
				'L_ACTION'	=> $this->user->lang['STYLE_INSTALL'],
			);
		}
		if (!$style['style_active'])
		{
			$actions[] = array(
				'U_ACTION'	=> $this->main_link . '&amp;action=delete&amp;ext_name=' . urlencode($style['style_name']),
				'L_ACTION'	=> $this->user->lang['STYLE_DELETE'],
			);
		}

		// Assign template variables
		$this->template->assign_block_vars('styles_list', $row);
		foreach($actions as $action)
		{
			$this->template->assign_block_vars('styles_list.actions', $action);
		}
	}

	/**
	* Show available styles tree
	*
	* @param array $styles Styles list, passed as reference
	* @param string $name Name of parent style
	* @param int $level Styles tree level
	*/
	protected function show_available_child_styles(&$styles, $name, $level)
	{
		foreach ($styles as &$style)
		{
			if (empty($style['_shown']) && $style['_inherit_name'] == $name)
			{
				$this->list_style($style, $level);
				$this->show_available_child_styles($styles, $style['style_name'], $level + 1);
			}
		}
	}
	
	/**
	* Lists all the available styles and dumps to the template
	*
	* @return null
	*/
	public function list_available_styles()
	{
		$sql = 'SELECT * FROM ' . STYLES_TABLE;
		$result = $this->db->sql_query($sql);
		$installed = $this->db->sql_fetchrowset($result);
		$this->db->sql_freeresult($result);

		$installed_names = array();
		foreach ($installed as $style)
		{
			$installed_names[$style['style_name']] = array(
				'path'		=> $style['style_path'],
				'id'		=> $style['style_id'],
				'active'	=> $style['style_active'],
				'parent'	=> $style['style_parent_id'],
				'tree'		=> (strlen($style['style_parent_tree']) ? $style['style_parent_tree'] . '/' : '') . $style['style_path'],
			);
		}

		// Get list of directories
		$dirs = $styles = array();
		$dp = @opendir($this->phpbb_root_path . 'styles/');
		if ($dp)
		{
			while (($file = readdir($dp)) !== false)
			{
				$dir = $this->styles_path . $file;
				if ($file[0] == '.' || !is_dir($dir))
				{
					continue;
				}

				if (file_exists("{$dir}/style.cfg"))
				{
					$dirs[] = $file;
				}
			}
			closedir($dp);
		}
		
		// Find styles that can be installed
		foreach ($dirs as $dir)
		{
			$cfg = $this->read_style_cfg($this->styles_path . $dir . '/style.cfg');
			if ($cfg === false)
			{
				// Invalid style.cfg
				continue;
			}

			// Style should be available for installation
			$parent = $cfg['parent'];
			$style = array(
				'style_id'			=> (isset($installed_names[$cfg['name']])) ? $installed_names[$cfg['name']]['id'] : 0,
				'style_name'		=> $cfg['name'],
				'style_copyright'	=> $cfg['copyright'],
				'style_active'		=> (isset($installed_names[$cfg['name']])) ? $installed_names[$cfg['name']]['active'] : 0,
				'style_path'		=> $dir,
				'style_parent_id'	=> 0,
				'style_parent_tree'	=> '',
				'phpbb_version'		=> $cfg['phpbb_version'],
				'style_version'		=> $cfg['style_version'],
				// Extra values for styles list
				// All extra variable start with _ so they won't be confused with data that can be added to styles table
				'_inherit_name'			=> $parent,
				'_available'			=> true,
				'_note'					=> '',
			);

			// Check style inheritance
			if ($parent != '')
			{
				if (isset($installed_names[$parent]))
				{
					// Parent style is installed
					$installed = $installed_names[$parent];
					$style['style_parent_id'] = $installed['id'];
					$style['style_parent_tree'] = $installed['tree'];
				}
				else
				{
					// Parent style is not installed yet
					$style['_available'] = false;
					$style['_note'] = sprintf($this->user->lang['REQUIRES_STYLE'], htmlspecialchars($parent));
				}
			}
			$styles[] = $style;
		}

		usort($styles, array($this, 'sort_styles'));

		// Show styles
		foreach ($styles as &$style)
		{
			// Check if style has a parent style in styles list
			$has_parent = false;
			if ($style['_inherit_name'] != '')
			{
				foreach ($styles as $parent_style)
				{
					if ($parent_style['style_name'] == $style['_inherit_name'] && empty($parent_style['_shown']))
					{
						// Show parent style first
						$has_parent = true;
					}
				}
			}
			if (!$has_parent)
			{
				$this->list_style($style, 0);
				$this->show_available_child_styles($styles, $style['style_name'], 1);
			}
		}

		// Show styles that do not have parent style in styles list
		foreach ($styles as $style)
		{
			if (empty($style['_shown']))
			{
				$this->list_style($style, 0);
			}
		}

/*
		foreach ($styles as $style)
		{
			$template->assign_block_vars('disabled', array(
				'META_DISPLAY_NAME'	=> $style['style_name'],
				'META_VERSION'		=> $style['style_copyright'],
				'PARENT'			=> ($style['style_parent_id']) ? true : false,
				'STYLE_VERSION'		=> $style['style_version'],
				'PHPBB_VERSION'		=> $style['phpbb_version'],
				'INSTALLED'			=> $style['style_active'],
				'DEFAULT'			=> ($style['style_id'] == $config['default_style']) ? true : false,
				'NOTE'				=> $style['_note'],
				'U_DELETE'			=> (!$style['style_active']) ? $this->main_link . '&amp;action=delete&amp;ext_name=' . urlencode($style['style_name']) : '',
				'U_INSTALL'			=> (!$style['style_active'] && isset($installed_names[$style['_inherit_name']])) ? '/adm/index.php?i=acp_styles&sid=' . $user->data['session_id'] . '&mode=install&action=install&hash=' . generate_link_hash('install') . '&dir=' . $style['style_name'] : ''
			));	
		}
*/	}

	/**
	* Sort styles
	*/
	public function sort_styles($style1, $style2)
	{
		if ($style1['style_active'] != $style2['style_active'])
		{
			return ($style1['style_active']) ? -1 : 1;
		}
		if (isset($style1['_available']) && $style1['_available'] != $style2['_available'])
		{
			return ($style1['_available']) ? -1 : 1;
		}
		return strcasecmp(isset($style1['style_name']) ? $style1['style_name'] : $style1['name'], isset($style2['style_name']) ? $style2['style_name'] : $style2['name']);
	}

	/**
	* Sort helper for the table containing the metadata about the extensions.
	*/
	function sort_extension_meta_data_table($val1, $val2)
	{
		return strnatcasecmp($val1['META_DISPLAY_NAME'], $val2['META_DISPLAY_NAME']);
	}

	protected function trigger_error($error, $type)
	{
		global $action;
		$action = '';
		$this->template->assign_vars(array(
			'UPLOAD_ERROR'			=> $error,
		));
		return true;
	}

	/**
	* Check the version and return the available updates.
	*
	* @param \phpbb\extension\metadata_manager $md_manager The metadata manager for the version to check.
	* @param bool $force_update Ignores cached data. Defaults to false.
	* @param bool $force_cache Force the use of the cache. Override $force_update.
	* @return string
	* @throws RuntimeException
	*/
	protected function version_check(\phpbb\extension\metadata_manager $md_manager, $force_update = false, $force_cache = false)
	{
		$meta = $md_manager->get_metadata('all');

		if (!isset($meta['extra']['version-check']))
		{
			throw new \RuntimeException($this->user->lang('NO_VERSIONCHECK'), 1);
		}

		$version_check = $meta['extra']['version-check'];

		$version_helper = new \phpbb\version_helper($this->cache, $this->config, $this->user);
		$version_helper->set_current_version($meta['version']);
		$version_helper->set_file_location($version_check['host'], $version_check['directory'], $version_check['filename']);
		$version_helper->force_stability($this->config['extension_force_unstable'] ? 'unstable' : null);

		return $updates = $version_helper->get_suggested_updates($force_update, $force_cache);
	}

	/**
	 *
	 * @package automod
	 * @copyright (c) 2008 phpBB Group
	 * @license http://opensource.org/licenses/gpl-2.0.php GNU Public License
	 *
	 */
	function upload_ext($action)
	{
		$this->listzip();
		$this->user->add_lang('posting');  // For error messages
		include($this->phpbb_root_path . 'includes/functions_upload.' . $this->php_ext);
		$upload = new \fileupload();
		$upload->set_allowed_extensions(array('zip'));	// Only allow ZIP files

		if (!is_writable($this->ext_dir))
		{
			$this->trigger_error($this->user->lang['EXT_NOT_WRITABLE'] . $this->back_link, E_USER_WARNING);
			return false;
		}

		$upload_dir = $this->ext_dir;

		// Make sure the ext/ directory exists and if it doesn't, create it
		if (!is_dir($this->ext_dir))
		{
			$this->recursive_mkdir($this->ext_dir);
		}

		// Proceed with the upload
		if ($action == 'upload')
		{
			$file = $upload->form_upload('extupload');
		}
		else if ($action == 'upload_remote')
		{
			$file = $upload->remote_upload($this->request->variable('remote_upload', ''));
		}

		if($action != 'upload_local')
		{
			if (empty($file->filename))
			{
				$this->trigger_error((sizeof($file->error) ? implode('<br />', $file->error) : $this->user->lang['NO_UPLOAD_FILE']) . $this->back_link, E_USER_WARNING);
				return false;
			}
			else if ($file->init_error || sizeof($file->error))
			{
				$file->remove();
				$this->trigger_error((sizeof($file->error) ? implode('<br />', $file->error) : $this->user->lang['EXT_UPLOAD_INIT_FAIL']) . $this->back_link, E_USER_WARNING);
				return false;
			}

			$file->clean_filename('real');
			$file->move_file(str_replace($this->phpbb_root_path, '', $upload_dir), true, true);

			if (sizeof($file->error))
			{
				$file->remove();
				$this->trigger_error(implode('<br />', $file->error) . $this->back_link, E_USER_WARNING);
				return false;
			}
			$dest_file = $file->destination_file;
		}
		else
		{
			$dest_file = $this->phpbb_root_path . 'ext/' . $this->request->variable('local_upload', '');
		}

		include($this->phpbb_root_path . 'includes/functions_compress.' . $this->php_ext);

		$zip = new \ZipArchive;
		$res = $zip->open($dest_file);
		if ($res !== true)
		{
			$this->trigger_error($this->user->lang['ziperror'][$res] . $this->back_link, E_USER_WARNING);
			return false;
		}
		$zip->extractTo($this->phpbb_root_path . 'ext/tmp');
		$zip->close();

		$style_path = $this->get_style_path($this->phpbb_root_path . 'ext/tmp');

		if (!$style_path)
		{
			$this->trigger_error($this->user->lang['ACP_UPLOAD_STYLE_ERROR_COMP'] . $this->back_link, E_USER_WARNING);
			return false;
		}
		$style_cfg = $this->read_style_cfg($style_path);
		$destination = str_replace(' ', '_', $style_cfg['name']);
		if ($style_cfg['phpbb_version'] != $this->config['version'])
		{
			$this->trigger_error($this->user->lang['ACP_UPLOAD_STYLE_ERROR_DEST'] . $this->back_link, E_USER_WARNING);
			return false;
		}
		$display_name = $style_cfg['name'];
		if (!isset($style_cfg['name']))
		{
			$this->rrmdir($this->phpbb_root_path . 'ext/tmp');
			if($action != 'upload_local')
			{
				$file->remove();
			}
			$this->trigger_error($this->user->lang['NOT_AN_STYLE'] . $this->back_link, E_USER_WARNING);
			return false;
		}
		$source = substr($style_path, 0, -10);
		/* Delete the previous version of style files - we're able to update them. */
		if (is_dir($this->phpbb_root_path . 'styles/' . $destination))
		{
			$this->rrmdir($this->phpbb_root_path . 'styles/' . $destination);
		}
		$this->rcopy($source, $this->phpbb_root_path . 'styles/' . $destination);
		$this->rrmdir($this->phpbb_root_path . 'ext/tmp');

		$this->template->assign_block_vars('authors', array(
			'AUTHOR'	=> $style_cfg['copyright'],
		));

		$string = @file_get_contents($this->phpbb_root_path . 'styles/' . $destination . '/style.cfg');
		if ($string !== false)
		{
			$readme = highlight_string($string, true);
		} else {
			$readme = false;
		}

		$this->template->assign_vars(array(
			'S_UPLOADED'		=> $display_name,
			'FILETREE'			=> \filetree::php_file_tree($this->phpbb_root_path . 'styles/' . $destination, $display_name, $this->main_link),
			'S_ACTION'			=> $this->phpbb_root_path . 'adm/index.php?i=acp_extensions&amp;sid=' .$this->user->session_id . '&amp;mode=main&amp;action=enable_pre&amp;ext_name=' . urlencode($destination),
			'S_ACTION_BACK'		=> $this->main_link,
			'U_ACTION'			=> $this->u_action,
			'README_MARKDOWN'	=> $readme,
			'FILENAME'			=> ($string !== false) ? 'style.cfg' : '',
			'CONTENT'			=> ($string !== false) ?  highlight_string($string, true): ''
		));

		// Remove the uploaded archive file
		if (($this->request->variable('keepext', false)) == false && $action != 'upload_local')
		{
			$file->remove();
		}
		return true;
	}

	/**
	 * @author Michal Nazarewicz (from the php manual)
	 * Creates all non-existant directories in a path
	 * @param $path - path to create
	 * @param $mode - CHMOD the new dir to these permissions
	 * @return bool
	 */
	function recursive_mkdir($path, $mode = false)
	{
		if (!$mode)
		{
			$mode = octdec($this->config['am_dir_perms']);
		}

		$dirs = explode('/', $path);
		$count = sizeof($dirs);
		$path = '.';
		for ($i = 0; $i < $count; $i++)
		{
			$path .= '/' . $dirs[$i];

			if (!is_dir($path))
			{
				@mkdir($path, $mode);
				@chmod($path, $mode);

				if (!is_dir($path))
				{
					return false;
				}
			}
		}
		return true;
	}
}
