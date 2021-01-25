<?php

class Bootstrap {

    static function init() {

        #Error reporting...Good idea to ENABLE error reporting to a file. i.e display_errors should be set to false
        $error_reporting = E_ALL & ~E_NOTICE;
        if (defined('E_STRICT')) # 5.4.0
            $error_reporting &= ~E_STRICT;
        if (defined('E_DEPRECATED')) # 5.3.0
            $error_reporting &= ~(E_DEPRECATED | E_USER_DEPRECATED);
        error_reporting($error_reporting); //Respect whatever is set in php.ini

        #Don't display errors
        ini_set('display_errors', '0'); // Set by installer
        ini_set('display_startup_errors', '0'); // Set by installer       

        if (!isset($_SERVER['REMOTE_ADDR']))
            $_SERVER['REMOTE_ADDR'] = '';
    }

    function loadConfig() {
        #load config info
        $configfile='';
        if(file_exists(INCLUDE_DIR.'settings.php')) { 
            $configfile=INCLUDE_DIR.'settings.php';
            //Die gracefully!
            if(!strcasecmp(basename($_SERVER['SCRIPT_NAME']), 'settings.php'))
                Http::response(500,
                    'Please check for the config file. If missing, create one to continue!');
        } elseif(file_exists(ROOT_DIR.'setup/'))
            Http::redirect(ROOT_PATH.'setup/');

        if(!$configfile || !file_exists($configfile))
            Http::response(500,'<b>Error loading settings. Contact admin.</b>');

        require($configfile);
        define('CONFIG_FILE',$configfile); 
    }

    function loadCode() {
        #include required files
        require_once INCLUDE_DIR.'class.util.php';
        require_once INCLUDE_DIR.'class.translation.php';
        require_once(INCLUDE_DIR.'class.signal.php');
        require(INCLUDE_DIR.'class.model.php');
        require(INCLUDE_DIR.'class.user.php');
        require(INCLUDE_DIR.'class.auth.php');
        require(INCLUDE_DIR.'class.pagenate.php'); //Pagenate helper!
        require(INCLUDE_DIR.'class.log.php');
        require(INCLUDE_DIR.'class.crypto.php');
        require(INCLUDE_DIR.'class.page.php');
        require_once(INCLUDE_DIR.'class.format.php'); //format helpers
        require_once(INCLUDE_DIR.'class.validator.php'); //Class to help with basic form input validation...please help improve it.
        require(INCLUDE_DIR.'class.mailer.php');
        require_once INCLUDE_DIR.'mysqli.php';
        require_once INCLUDE_DIR.'class.i18n.php';
        require_once INCLUDE_DIR.'class.queue.php';
    }
}

#Get real path for root dir 
$here = dirname(__FILE__);
$here = ($h = realpath($here)) ? $h : $here;
define('ROOT_DIR',str_replace('\\', '/', $here.'/'));
unset($here); unset($h);

define('INCLUDE_DIR', ROOT_DIR . 'include/'); // Set by installer
define('PEAR_DIR',INCLUDE_DIR.'pear/');
define('SETUP_DIR',ROOT_DIR.'setup/');

define('CLIENTINC_DIR',INCLUDE_DIR.'client/');
define('STAFFINC_DIR',INCLUDE_DIR.'staff/');

define('UPGRADE_DIR', INCLUDE_DIR.'upgrader/');
define('I18N_DIR', INCLUDE_DIR.'i18n/');
define('CLI_DIR', INCLUDE_DIR.'cli/');

/*############## Do NOT monkey with anything else beyond this point UNLESS you really know what you are doing ##############*/

//Path separator
if(!defined('PATH_SEPARATOR')){
    if(strpos($_ENV['OS'],'Win')!==false || !strcasecmp(substr(PHP_OS, 0, 3),'WIN'))
        define('PATH_SEPARATOR', ';' ); //Windows
    else
        define('PATH_SEPARATOR',':'); //Linux
}

//Set include paths. Overwrite the default paths.
ini_set('include_path', './'.PATH_SEPARATOR.INCLUDE_DIR.PATH_SEPARATOR.PEAR_DIR);

require(INCLUDE_DIR.'class.osticket.php');
require(INCLUDE_DIR.'class.misc.php');
require(INCLUDE_DIR.'class.http.php');
require(INCLUDE_DIR.'class.validator.php');

// Determine the path in the URI used as the base of the osTicket
// installation
if (!defined('ROOT_PATH') && ($rp = osTicket::get_root_path(dirname(__file__))))
    define('ROOT_PATH', rtrim($rp, '/').'/');

Bootstrap::init();

#CURRENT EXECUTING SCRIPT.
define('THISPAGE', Misc::currentURL());

define('DEFAULT_MAX_FILE_UPLOADS', ini_get('max_file_uploads') ?: 5);
define('DEFAULT_PRIORITY_ID', 1);

?>
