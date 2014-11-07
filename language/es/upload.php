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
	'ACP_UPLOAD_STYLE_TITLE'			=> 'Subir estilo',
	'ACP_UPLOAD_STYLE_TITLE_EXPLAIN'	=> 'Upload Styles le permite subir archivos zip de estilos o eliminar estilos de carpetas del servidor.<br />Con esta extensión puede instalar/actualizar/borras estilos sin utilizar FTP. Si ya existe el estilo subido, se actualizará con los archivos subidos.',
	'UPLOAD'							=> 'Subir',
	'BROWSE'							=> 'Navegar...',
	'STYLE_UPLOAD'						=> 'Subir estilo',
	'STYLE_UPLOAD_EXPLAIN'				=> 'Aquí puede cargar un paquete de estilo zip que contiene los archivos necesarios para realizar la instalación desde el equipo local o en un servidor remoto. “Upload Style” luego intentará descomprimir el archivo y tenerlo listo para la instalación.<br />Elija un archivo o escriba un enlace en los campos de abajo.<br />NOTA: Algunos servidore (por ejemplo, github.com) no soporta subidas remotas.',
	'STYLE_UPLOAD_INIT_FAIL'			=> 'Se ha producido un error al inicializar el proceso de subida del estilo.',
	'STYLE_NOT_WRITABLE'				=> 'En el directorio ext/ no se puede escribir. Esto es requerido para que “Upload Style” funcione correctamente. Por favor, ajuste sus permisos y/o la configuración y vuelva a intentarlo.',
	'STYLE_UPLOAD_ERROR'				=> 'El estilo no se ha subido. Por favor, confirma que cargue el archivo zip estilo verdadero e inténtelo de nuevo.',
	'EXT_UPLOAD_ERROR'					=> 'El estilo no se ha subido. Por favor, confirma que cargue el archivo zip estilo verdadero e inténtelo de nuevo.',
	'NO_UPLOAD_FILE'					=> 'No hay archivo especificado o se produjo un error durante el proceso de subida.',
	'NOT_AN_STYLE'						=> 'El archivo zip subido no es un estilo de phpBB. El archivo no se ha guardado en el servidor.',

	'STYLE_UPLOADED'					=> 'El estilo “%s” ha sido subido correctamente.',
	'STYLE_AVAILABLE'					=> 'Estilos disponibles',
	'STYLE_INVALID_LIST'				=> 'Lista de estilos',
	'STYLE_UPLOADED_ENABLE'				=> 'Habilitar el estilo subido',
	'ACP_UPLOAD_STYLE_UNPACK'			=> 'Descomprimir estilo',
	'ACP_UPLOAD_STYLE_CONT'				=> 'Contenido del paquete: %s',

	'STYLE_INSTALL'						=> 'Instalar',
	'STYLE_DELETE'						=> 'Borrar',
	'STYLE_DELETE_INSTALL'				=> 'Instalar / Borrar',
	'STYLE_DELETE_CONFIRM'				=> '¿Está seguro de querer borrar el estilo “%s”?',
	'STYLE_DELETE_SUCCESS'				=> 'El estilo ha sido borrado correctamente.',

	'STYLE_ZIP_DELETE'					=> 'Borrar archivo zip',
	'STYLE_ZIP_DELETE_CONFIRM'			=> '¿Está seguro de querer borrar el archivo zip “%s”?',
	'STYLE_ZIP_DELETE_SUCCESS'			=> 'El archivo zip ha sido borrado correctamente.',

	'ACP_UPLOAD_STYLE_ERROR_DEST'		=> 'Sin carpeta de destino en el archivo zip cargado o la versión de phpBB no es correcta. El archivo no se ha guardado en el servidor.',
	'ACP_UPLOAD_STYLE_ERROR_COMP'		=> 'style.cfg no se encontró en el archivo zip cargado. El archivo no se ha guardado en el servidor.',

	'UPLOAD_STYLE_DEVELOPERS'			=> 'Desarrolladores',

	'SHOW_FILETREE'						=> '<< Mostrar árbol del archivo >>',
	'HIDE_FILETREE'						=> '>> Ocultar árbol del archivo <<',

	'ziperror'		=> array(
		'10'		=> 'El archivo ya existe.',
		'21'		=> 'Archivo zip inconsistente.',
		'18'		=> 'Argumento no válido.',
		'14'		=> 'Fracaso malloc.',
		'9'			=> 'No existe el fichero.',
		'19'		=> 'No es un archivo zip.',
		'11'		=> 'No se puede abrir el archivo.',
		'5'			=> 'Error de lectura.',
		'4'			=> 'Error de seek.'
	),

	'REQUIRES_STYLE'					=> 'Este estilo requiere el estilo `%s` para ser instalado.',
	'STYLE_UPLOAD_SAVE_ZIP'				=> 'Guardar archivo zip subido',
	'ZIP_UPLOADED'						=> 'Paquetes zip de estilos subidos',
	'STYLE_ENABLE'						=> 'Habilitar',
	'STYLE_UPLOADED'					=> 'subido',
	'STYLE_UPLOAD_BACK'					=> '« Volver a Subir Estilos',
	'STYLE_NAME'						=> 'Nombre del estilo',
	'COPYRIGHT'							=> 'Copyright',
	'STYLE_VERSION'						=> 'Versión del estilo',
	'PHPBB_VERSION'						=> 'Versión de phpBB',
	'INSTALLED'							=> 'Instalado'
));
