<?php
/**
*
* @package Upload Style
* @copyright (c) 2014 John Peskens (http://ForumHulp.com) / Estonian translation by phpBBeesti.com 05/2015
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
	'ACP_UPLOAD_STYLE_TITLE'				=> 'Laadi üles stiil',
	'ACP_UPLOAD_STYLE_TITLE_EXPLAIN'		=> 'Laadi üles stiile lubab sul üleslaadida stiilide zip faile või kustutada stiilide kaustasi oma serverist.<br />Käesoleva laiendusega sa saad paigaldada/uuendada/kustutada stiile ilma, et peaksid kasutama FTP programmi. Juhul, kui üleslaaditud stiil juba eksisteerib, siis seda uuendatakse üleslaaditud failidega.',
	'UPLOAD'							=> 'Laadi üles',
	'BROWSE'							=> 'Sirvi...',
	'STYLE_UPLOAD'					=> 'Laadi üles stiil',
	'STYLE_UPLOAD_EXPLAIN'			=> 'Siin saad sa üleslaadida stiilide zip faile kas kohalikust arvutist või siis kusagilt väliselt leheküljelt. “Laadi üles stiile” proovib selle ise lahti pakida, ning seadistada valmis paigaldamiseks.<br />Vali fail või kirjuta lingi aadress alla väljale.<br />MÄRKUS: Mõningad serverid (näiteks, github.com) ei toeta väliseid üleslaadimisi.',
	'STYLE_UPLOAD_INIT_FAIL'			=> 'There was an error when initialising the style upload process.',
	'STYLE_NOT_WRITABLE'				=> 'Kaust ext/ ei ole kirjutatav. See on nõutud, et “Laadi üles stiile” saaks korralikult töötada. Palun seadista õigused, ning proovi uuesti.',
	'STYLE_UPLOAD_ERROR'				=> 'Stiili ei laaditud üles. Palun vaata üle, et laadisid üles õige stiili zip faili ja proovi uuesti.',
	'EXT_UPLOAD_ERROR'					=> 'Stiili ei laaditud üles. Palun vaata üle, et laadisid üles õige stiili zip faili ja proovi uuesti.',
	'NO_UPLOAD_FILE'					=> 'Ühtegi faili ei leitud või tekkis viga üleslaadimise käigus.',
	'NOT_AN_STYLE'						=> 'Üleslaaditud zip fail ei ole phpBB stiil. Faili ei salvestatud serverisse.',

	'STYLE_UPLOADED'					=> 'Stiil “%s” laaditi edukalt üles.',
	'STYLE_AVAILABLE'					=> 'Saadaval stiilid',
	'STYLE_INVALID_LIST'				=> 'Stiilide nimekiri',
	'STYLE_UPLOADED_ENABLE'				=> 'Luba üleslaaditud stiil',
	'ACP_UPLOAD_STYLE_UNPACK'			=> 'Paki lahti stiil',
	'ACP_UPLOAD_STYLE_CONT'				=> 'Paki sisu: %s',

	'STYLE_INSTALL'						=> 'Paigalda',
	'STYLE_DELETE'						=> 'Kustuta',
	'STYLE_DELETE_INSTALL'				=> 'Paigalda / Kustuta',
	'STYLE_DELETE_CONFIRM'				=> 'Kas oled kindel, et soovid kustutada “%s” stiili?',
	'STYLE_DELETE_SUCCESS'				=> 'Stiil kustutatud.',

	'STYLE_ZIP_DELETE'					=> 'Kustuta zip fail',
	'STYLE_ZIP_DELETE_CONFIRM'			=> 'Kas oled kindel, et soovid kustutada zip faili: “%s”?',
	'STYLE_ZIP_DELETE_SUCCESS'			=> 'Stiili zip fail on kustutatud.',

	'ACP_UPLOAD_STYLE_ERROR_DEST'		=> 'Sihtkausta ei leitud üleslaaditud zip failile või phpBB versioon ei ole õige. Faili ei salvestatud serverisse.',
	'ACP_UPLOAD_STYLE_ERROR_COMP'		=> 'Faili style.cfg ei leitud üleslaaditud zip failist. Faili ei salvestatud serverisse.',

	'UPLOAD_STYLE_DEVELOPERS'			=> 'Arendajad',

	'SHOW_FILETREE'						=> '<< Näita failipuud >>',
	'HIDE_FILETREE'						=> '>> Peida failipuu <<',

	'ziperror'		=> array(
		'10'		=> 'Fail juba eksisteerib.',
		'21'		=> 'Zip arhiiv on  vastuoluline.',
		'18'		=> 'Vigane argument.',
		'14'		=> 'Malloc ebaõnnestus.',
		'9'			=> 'Sellist faili ei leitud.',
		'19'		=> 'Pole zip arhiiv.',
		'11'		=> 'Ei saa avada faili.',
		'5'			=> 'Loe veateadet.',
		'4'			=> 'Otsi viga.'
	),

	'REQUIRES_STYLE'					=> 'See stiil nõuab, et `%s` oleks paigaldatud.',
	'STYLE_UPLOAD_SAVE_ZIP'				=> 'Salvesta üleslaaditud zip fail serverisse',
	'ZIP_UPLOADED'						=> 'Stiili zip fail on üleslaaditud',
	'STYLE_ENABLE'						=> 'Luba',
	'STYLE_UPLOADED'					=> 'üleslaaditud',
	'STYLE_UPLOAD_BACK'					=> '« Tagasi laadi stiile üles lehele',
	'STYLE_NAME'						=> 'Stiili nimi',
	'COPYRIGHT'							=> 'Autoriõigus',
	'STYLE_VERSION'						=> 'Stiili versioon',
	'PHPBB_VERSION'						=> 'phpBB versoon',
	'INSTALLED'							=> 'Paigaldatud'
));
