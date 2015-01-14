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
'ACP_UPLOAD_STYLE_TITLE'	=> 'Carica stile',
'ACP_UPLOAD_STYLE_TITLE_EXPLAIN'	=> 'Carica stile permette di caricare i file zip di stile o di rimuovere le cartelle di stile dal server.<br />Con quest\'estensione, è possibile installare, aggiornare o rimuovere stili senza usare il server FTP. Se lo stile caricato è già installato, viene aggiornato coi file caricati.',
'UPLOAD'	=> 'Carica',
'BROWSE'	=> 'Apri',
'STYLE_UPLOAD'	=> 'Carica stile',
'STYLE_UPLOAD_EXPLAIN'	=> 'Qui è possibile caricare il file zip di uno stile contenente i file necessari all\'installazione dal proprio computer o da un server remoto. “Carica stile” proverà ad estrarre i file per l\'installazione.<br />Scegli un file o specifica l\'indirizzo del file da installare qui in basso.<br />NOTA: Alcuni server (come, ad esempio, github.com) non supportano il caricamento da remoto.',
'STYLE_UPLOAD_INIT_FAIL'	=> 'Errore nell\'inizializzazione del processo di caricamento dello stile.',
'STYLE_NOT_WRITABLE'	=> 'La cartella ext/ è di sola lettura. Perché “Carica stile” funzioni, è necessario che sia scrivibile. Correggere i permessi o le impostazioni e riprovare.',
'STYLE_UPLOAD_ERROR'	=> 'Stile non caricato. Assicurarsi di avere un file zip di stile corretto e riprovare.',
'EXT_UPLOAD_ERROR'	=> 'Stile non caricato. Assicurarsi di avere un file zip di stile corretto e riprovare.',
'NO_UPLOAD_FILE'	=> 'Nessun file specificato o errore di caricamento.',
'NOT_AN_STYLE'	=> 'Il file zip caricato non è uno stile per phpBB. Il file non è stato salvato sul server.',
'STYLE_UPLOADED'	=> 'Lo stile “%s” è stato caricato con successo.',
'STYLE_AVAILABLE'	=> 'Stili disponibili',
'STYLE_INVALID_LIST'	=> 'Elenco stili',
'STYLE_UPLOADED_ENABLE'	=> 'Abilita lo stile caricato',
'ACP_UPLOAD_STYLE_UNPACK'	=> 'Estrai stile',
'ACP_UPLOAD_STYLE_CONT'	=> 'Contenuto del pacchetto: %s',
'STYLE_INSTALL'	=> 'Installa',
'STYLE_DELETE'	=> 'Rimuovi',
'STYLE_DELETE_INSTALL'	=> 'Installa / Rimuovi',
'STYLE_DELETE_CONFIRM'	=> 'Sei sicuro di voler rimuovere lo stile “%s”?',
'STYLE_DELETE_SUCCESS'	=> 'Lo stile selezionato è stato rimosso.',
'STYLE_ZIP_DELETE'	=> 'Rimuovi file zip',
'STYLE_ZIP_DELETE_CONFIRM'	=> 'Sei sicuro di voler rimuoere il file zip “%s”?',
'STYLE_ZIP_DELETE_SUCCESS'	=> 'Il file zip dello stile è stato rimosso.',
'ACP_UPLOAD_STYLE_ERROR_DEST'	=> 'Nessuna cartella di destinazione specificata nel file zip caricato o versione di phpBB non corretta. Il file non è stato salvato.',
'ACP_UPLOAD_STYLE_ERROR_COMP'	=> 'File style.cfg non trovato nel file zip caricato. Il file non è stato salvato.',
'UPLOAD_STYLE_DEVELOPERS'	=> 'Sviluppatori',
'SHOW_FILETREE'	=> '<< Mostra struttura file >>',
'HIDE_FILETREE'	=> '>> Nascondi struttura file <<',
'ziperror'	=> array(
'10'	=> 'Il file già esiste.',
'21'	=> 'Archivio zip inconsistente.',
'18'	=> 'Argomento non valido.',
'14'	=> 'Errore di allocazione.',
'9'	=> 'Il file non esiste.',
'19'	=> 'Il file specificato non è di tipo ZIP.',
'11'	=> 'Impossibile aprire il file.',
'5'	=> 'Errore di lettura.',
'4'	=> 'Errore di ricerca.'
),
'REQUIRES_STYLE'	=> 'Questo stile richiede l\'installazione dello stile `%s`.',
'STYLE_UPLOAD_SAVE_ZIP'	=> 'Salva file zip caricato',
'ZIP_UPLOADED'	=> 'File zip dello stile caricato',
'STYLE_ENABLE'	=> 'Abilita',
'STYLE_UPLOADED'	=> 'caricato',
'STYLE_UPLOAD_BACK'	=> '« Torna a Carica stile',
'STYLE_NAME'	=> 'Nome stile',
'COPYRIGHT'	=> 'Copyright',
'STYLE_VERSION'	=> 'Versione stile',
'PHPBB_VERSION'	=> 'Versione phpBB',
'INSTALLED'	=> 'Installato'
));
