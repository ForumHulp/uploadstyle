<?php
/**
*
* @package Upload Style
* @copyright (c) 2014 John Peskens (http://ForumHulp.com)
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace forumhulp\uploadstyle\acp;

class uploadstyle_info
{
	function module()
	{
		return array(
			'filename'    => 'forumhulp\uploadstyle\acp\uploadstyle_module',
			'title'        => 'ACP_STYLE_EXT_TITLE',
			'version'    => '1.0.0',
			'modes'        => array(
				'main'		=> array(
					'title'	=> 'ACP_STYLE_EXT_TITLE',
					'auth'	=> 'ext_forumhulp/uploadstyle && acl_a_styles',
					'cat'	=> array('ACP_STYLE_MANAGEMENT')
				),
			),
		);
	}

	function install()
	{
	}

	function uninstall()
	{
	}
}
