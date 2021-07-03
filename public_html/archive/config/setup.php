<?php

/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/:'.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');

/* Show all errors. */
error_reporting(E_ALL);

/* path constants */
define('ROOT', $_SERVER['DOCUMENT_ROOT']);
define('LIBS', ROOT . '/library/');
define('WWW', 'http://' . $_SERVER['HTTP_HOST']);
define('URI', 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);

$AREA_ROOT_PATH	= $_SERVER['DOCUMENT_ROOT'].'/frames/maps/areas';
$AREA_HTTP_PATH	= '/frames/maps/areas';
$WEB_ROOT		= 'http://willowvine.dev';

/* 
	Setup Database Connection. 
*/

require_once('Zend/Db.php');
require_once('Zend/Db/Table.php');

try {
	$conn = Zend_Db::factory('Mysqli', array(
		'host'     	=> 'localhost',
		'username' 	=> 'willowvi_userdb', 
		'password' 	=> 'dkghdu337s1sdgd', 
		'dbname'   	=> 'willowvi_dbwill'
	));
	$conn->getConnection();
} catch (Zend_Db_Adapter_Exception $e) {
	/* perhaps a failed login credential, or perhaps the RDBMS is not running */
} catch (Zend_Exception $e) {
	/* perhaps factory() failed to load the specified Adapter class */
	echo 'Failed to connect to database.';
}

/* set the fetchmode to object (this enables you to choose fetchAssoc as well as object */
$conn->setFetchMode(Zend_Db::FETCH_ASSOC);

/* set $conn as the default adapter for all abstracted tables */
Zend_Db_Table_Abstract::setDefaultAdapter($conn);

/* 
	Setup Smarty Templating System.
*/

require_once(LIBS.'/classes/smarty/Smarty.class.php');

$smarty = new Smarty;

/* config smarty debug build setup. */
$smarty->debugging 		= false;

/* set smarty cache settings */
$smarty->caching 			= false;
$smarty->force_compile 	= true;

$smarty->compile_check 	= true; 	/* don't check for dependent file changes */
$smarty->cache_lifetime 	= 0; 		/* 2 = per template defined! 0=disabled */

/* set smarty folders */
$smarty->template_dir 		= ROOT.'/';
$smarty->compile_dir 		= ROOT.'/cache/smarty/compile/';
$smarty->config_dir 		= LIBS.'/classes/smarty/config/';
$smarty->cache_dir 		= ROOT.'/cache/smarty/cache/';
$smarty->plugins_dir 		= array(
													LIBS.'/classes/smarty/plugins/',
													LIBS.'/classes/smarty/smarty_custom_plugins/');

/* Get a random number for the images. */
$cachRandom = substr(md5(rand(123,9876123) . time()), 1, 10); $smarty->assign('nc',$cachRandom); 

/* Setup twitter.*/
if($_SERVER['HTTP_HOST'] == 'willowvine.dev') {
	/* For .dev. */
	define('CONSUMER_KEY', 'bMXEQTvO67H1Li4XHkiiQ'); 
	define('CONSUMER_SECRET', 'tVNHLbfI6fNPPbm7KcEDgAIGJCaLaGWoLAH606K9Q');
} else {
	/* For .co.za */
	define('CONSUMER_KEY', 'ZVoEjiYkWXN0CzPhBB5gEQ'); 
	define('CONSUMER_SECRET', 'SfCS5IDSlOnN8C4iOsjYkm1z5GzqdGXQXPN4XaTw');
}

/* Declare connection and smarty variables global. */
global $smarty, $conn;

$smarty->assign('siteName', 'WillowVine');
?>