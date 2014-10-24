<?php
/**
*
* @package Upload Style
* @copyright (c) 2014 John Peskens (http://ForumHulp.com)
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

$lang = array_merge($lang, array(
	'ACP_UPLOAD_STYLE_TITLE'				=> 'Upload Style',
	'ACP_UPLOAD_STYLE_TITLE_EXPLAIN'		=> 'Upload Styles enables you to upload styles\' zip files or delete styles\' folders from the server.<br />With this extension you can install/update/delete styles without using FTP. If the uploaded style already exists, it will be updated with the uploaded files.',
	'UPLOAD'							=> 'Upload',
	'BROWSE'							=> 'Browse...',
	'STYLE_UPLOAD'					=> 'Upload Style',
	'STYLE_UPLOAD_EXPLAIN'			=> 'Here you can upload a zipped style package containing the necessary files to perform installation from your local computer or a remote server. “Upload Style” will then attempt to unzip the file and have it ready for installation.<br />Choose a file or type a link in the fields below.<br />NOTE: Some servers (for example, github.com) don\'t support remote uploads.',
	'STYLE_UPLOAD_INIT_FAIL'			=> 'There was an error when initialising the style upload process.',
	'STYLE_NOT_WRITABLE'				=> 'The ext/ directory is not writable. This is required for “Upload Style” to work properly. Please adjust your permissions or settings and try again.',
	'STYLE_UPLOAD_ERROR'				=> 'The style wasn\'t uploaded. Please confirm that you upload the true style zip file and try again.',
	'EXT_UPLOAD_ERROR'					=> 'The style wasn\'t uploaded. Please confirm that you upload the true style zip file and try again.',
	'NO_UPLOAD_FILE'					=> 'No file specified or there was an error during the upload process.',
	'NOT_AN_STYLE'						=> 'The uploaded zip file is not a phpBB style. The file was not saved on the server.',

	'STYLE_UPLOADED'					=> 'Style “%s” was uploaded successfully.',
	'STYLE_AVAILABLE'					=> 'Available styles',
	'STYLE_INVALID_LIST'				=> 'Style list',
	'STYLE_UPLOADED_ENABLE'				=> 'Enable the uploaded style',
	'ACP_UPLOAD_STYLE_UNPACK'			=> 'Unpack style',
	'ACP_UPLOAD_STYLE_CONT'				=> 'Content of package: %s',

	'STYLE_INSTALL'						=> 'Install',
	'STYLE_DELETE'						=> 'Delete',
	'STYLE_DELETE_INSTALL'				=> 'Install / Delete',
	'STYLE_DELETE_CONFIRM'				=> 'Are you sure that you want to delete the “%s” style?',
	'STYLE_DELETE_SUCCESS'				=> 'Style was deleted successfully.',

	'STYLE_ZIP_DELETE'					=> 'Delete zip file',
	'STYLE_ZIP_DELETE_CONFIRM'			=> 'Are you sure that you want to delete the zip file “%s”?',
	'STYLE_ZIP_DELETE_SUCCESS'			=> 'Style\'s zip file was deleted successfully.',

	'ACP_UPLOAD_STYLE_ERROR_DEST'		=> 'No destination folder in the uploaded zip file or phpBB version not correct. The file was not saved on the server.',
	'ACP_UPLOAD_STYLE_ERROR_COMP'		=> 'style.cfg wasn\'t found in the uploaded zip file. The file was not saved on the server.',

	'UPLOAD_STYLE_DEVELOPERS'			=> 'Developers',

	'SHOW_FILETREE'						=> '<< Show file tree >>',
	'HIDE_FILETREE'						=> '>> Hide file tree <<',

	'ziperror'		=> array(
		'10'		=> 'File already exists.',
		'21'		=> 'Zip archive inconsistent.',
		'18'		=> 'Invalid argument.',
		'14'		=> 'Malloc failure.',
		'9'			=> 'No such file.',
		'19'		=> 'Not a zip archive.',
		'11'		=> 'Can\'t open file.',
		'5'			=> 'Read error.',
		'4'			=> 'Seek error.'
	),

	'REQUIRES_STYLE'					=> 'This style requires the style `%s` to be installed.',
	'STYLE_UPLOAD_SAVE_ZIP'				=> 'Save uploaded zip file',
	'ZIP_UPLOADED'						=> 'Uploaded zip packages of styles',
	'STYLE_ENABLE'						=> 'Enable',
	'STYLE_UPLOADED'					=> 'uploaded',
	'STYLE_UPLOAD_BACK'					=> '« Back to Upload Styles',
	'STYLE_NAME'						=> 'Style name',
	'COPYRIGHT'							=> 'Copyright',
	'STYLE_VERSION'						=> 'Style version',
	'PHPBB_VERSION'						=> 'phpBB version',
	'INSTALLED'							=> 'Installed'
));
