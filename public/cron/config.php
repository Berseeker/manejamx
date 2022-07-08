<?
define('DEBUG', 1); 
define('MAINTENANCE', 0); 

define('STAGING', 0);  
   
if (DEBUG==1) {    
	error_reporting(E_ALL); 
} else {
	error_reporting(E_STRICT);  
} 


// PRODUCCION
define('DATABASE_NAME', 'maneja_database'); 
define('DATABASE_USER', 'maneja_macasoft');
define('DATABASE_PASS', '.rx]q#=(v)(V');  
define('DATABASE_HOST', 'localhost'); 
define('DATABASE_PORT', '3306'); 
define('DATABASE_PREFIX', ''); 


// DIR
define('DIR_FOLDER', '/'); 
define('DIR_SYSTEM', '/');
define('DIR_CLASS', 'class/');
define('DIR_CONFIG', '/');  

//DEFAULT TIMEZONE  
date_default_timezone_set('America/Mexico_City');

// Class Mysql Application
require_once DIR_CLASS.'MysqliDb.php';

// Class System Core
require_once DIR_CLASS.'SystemScrape.php';

// DATABASE MYSQLI CONNECTION
$oDB = new Mysqlidb(DATABASE_HOST, DATABASE_USER, DATABASE_PASS, DATABASE_NAME);

// MAINTENANCE 
// 0 = Normal  
// 1 = Maintenance 
// HTTP


// System Core Object 
$oSystemScrape           = new SystemScrape();

?>
 