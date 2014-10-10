<?php
/**
*
* @package Upload Style
* @copyright (c) 2014 John Peskens (http://ForumHulp.com)
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace forumhulp\uploadstyle\migrations;

class install_uploadstyle extends \phpbb\db\migration\migration
{
	public function effectively_installed()
	{
		return isset($this->config['uploadstyle_version']) && version_compare($this->config['uploadstyle_version'], '3.1.0.RC5', '>=');
	}

	static public function depends_on()
	{
		return array('\phpbb\db\migration\data\v310\dev');
	}

	public function update_data()
	{
		return array(
			array('config.add', array('uploadstyle_version', '3.1.0.RC5')),
			array('module.add', array(
				'acp', 'ACP_STYLE_MANAGEMENT', array(
					'module_basename'	=> '\forumhulp\uploadstyle\acp\uploadstyle_module',
					'auth'				=> 'ext_forumhulp/uploadstyle && acl_a_styles',
					'modes'				=> array('main'),
				),
			)),
		);
	}
}
