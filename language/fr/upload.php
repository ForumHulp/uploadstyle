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
	'ACP_UPLOAD_STYLE_TITLE'				=> 'Transfert de Style',
	'ACP_UPLOAD_STYLE_TITLE_EXPLAIN'		=> 'Le transfert de styles vous permet de transférer des fichiers de style zip ou de supprimer des dossiers de styles du serveur.<br />Grâce à cette extension vous pouvez installer/mettre à jour/supprimer des styles sans utiliser le FTP. Si le style transféré existe déjà, il sera mis à jour par les fichiers transférés.',
	'UPLOAD'							=> 'Transférer',
	'BROWSE'							=> 'Parcourir…',
	'STYLE_UPLOAD'					=> 'Transférer le Style',
	'STYLE_UPLOAD_EXPLAIN'			=> 'Voici l’endroit où vous pouvez transférer une archive de style zippée qui contienne les fichiers nécessaire à l’installation depuis votre ordinateur personnel ou un serveur distant. «&nbsp;Transfert de Style&nbsp;» tentera de dézipper le fichier et le préparer pour l’installation.<br />Choisissez un fichier ou tapez un lien dans le champ ci-dessous.<br />N.B.&nbsp;: Certains serveurs (par exemple, github.com) ne supportent pas les transferts distants.',
	'STYLE_UPLOAD_INIT_FAIL'			=> 'Il y a eu une erreur à l’initialisation du processus de transfert de style.',
	'STYLE_NOT_WRITABLE'				=> 'Le dossier ext/ n’est pas inscriptible. C’est nécessaire pour que «&nbsp;Transfert de Style&nbsp;» fonctionne correctement. Veuillez corriger vos permissions ou paramètres et ré-essayez.',
	'STYLE_UPLOAD_ERROR'				=> 'Le style n’a pas été transféré. Veuillez vérifier que vous transférez le bon fichier zip de style et ré-essayez.',
	'EXT_UPLOAD_ERROR'					=> 'Le style n’a pas été transféré. Veuillez vérifier que vous transférez le bon fichier zip de style et ré-essayez.',
	'NO_UPLOAD_FILE'					=> 'Aucun fichier spécifié ou il y a eu une erreur durant le processus de transfert.',
	'NOT_AN_STYLE'						=> 'Le fichier zip transféré n’est pas un style phpBB. Le fichier n’a pas été sauvé sur le serveur.',

	'STYLE_UPLOADED'					=> 'Le style «&nbsp;%s&nbsp;» a été transféré avec succès.',
	'STYLE_AVAILABLE'					=> 'Styles disponibles',
	'STYLE_INVALID_LIST'				=> 'Liste de styles',
	'STYLE_UPLOADED_ENABLE'				=> 'Activer le style transféré',
	'ACP_UPLOAD_STYLE_UNPACK'			=> 'Décompresser le style',
	'ACP_UPLOAD_STYLE_CONT'				=> 'Contenu de l’archive&nbsp;: %s',

	'STYLE_INSTALL'						=> 'Installer',
	'STYLE_DELETE'						=> 'Supprimer',
	'STYLE_DELETE_INSTALL'				=> 'Installer / Supprimer',
	'STYLE_DELETE_CONFIRM'				=> 'Êtes-vous sûr(e) de vouloir supprimer le style «&nbsp;%s&nbsp;»&nbsp;?',
	'STYLE_DELETE_SUCCESS'				=> 'Le style a été supprimé avec succès.',

	'STYLE_ZIP_DELETE'					=> 'Supprimer le fichier zip',
	'STYLE_ZIP_DELETE_CONFIRM'			=> 'Êtes-vous sûr(e) de vouloir supprimer le fichier zip «&nbsp;%s&nbsp;»&nbsp;?',
	'STYLE_ZIP_DELETE_SUCCESS'			=> 'Le zip de style a été supprimé avec succès.',

	'ACP_UPLOAD_STYLE_ERROR_DEST'		=> 'Pas de dossier de destination dans le fichier zip transféré ou la version de phpBB est incorrecte. Le fichier n’a pas été sauvé sur le serveur.',
	'ACP_UPLOAD_STYLE_ERROR_COMP'		=> 'style.cfg introuvable dans le fichier zip transféré. Le fichier n’a pas été sauvé sur le serveur.',

	'UPLOAD_STYLE_DEVELOPERS'			=> 'Développeurs',

	'SHOW_FILETREE'						=> '<< Afficher l’arborescence >>',
	'HIDE_FILETREE'						=> '>> Masquer l’arborescence <<',

	'ziperror'		=> array(
		'10'		=> 'Le fichier existe déjà.',
		'21'		=> 'Archive zip incohérente.',
		'18'		=> 'Argument invalide.',
		'14'		=> 'Échec d’allocation de mémoire.',
		'9'			=> 'Aucun fichier.',
		'19'		=> 'Ce n’est pas une archive zip.',
		'11'		=> 'Impossible d’ouvrir le fichier.',
		'5'			=> 'Erreur de lecture.',
		'4'			=> 'Erreur de recherche.'
	),

	'REQUIRES_STYLE'					=> 'Ce style requiert que le style `%s` soit installé.',
	'STYLE_UPLOAD_SAVE_ZIP'				=> 'Sauver le fichier zip transféré',
	'ZIP_UPLOADED'						=> 'Archives zip de styles transférées',
	'STYLE_ENABLE'						=> 'Activer',
	'STYLE_UPLOADED'					=> 'transféré',
	'STYLE_UPLOAD_BACK'					=> '« Retour au transfert de tyle',
	'STYLE_NAME'						=> 'Nom du style',
	'COPYRIGHT'							=> 'Copyright',
	'STYLE_VERSION'						=> 'Version du style',
	'PHPBB_VERSION'						=> 'Version de phpBB',
	'INSTALLED'							=> 'Installé'
));
