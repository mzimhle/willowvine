<?php
/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/:'.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');

error_reporting(E_ALL);

/**
 * Standard includes
 */
require_once 'config/setup.php';
require_once 'includes/auth.php';

global $zfsession;

// Clear the identity from the session
UNSET($zfsession->identity);

/* Delete facebook session/cookie. */
setcookie('fbsr_'.APP_ID, '', time()-3600, "/");
setcookie('fbm_'.APP_ID, '', time()-3600, "/");

/* Just remove the cookie. */
if(isset($_COOKIE['fbsr_'.APP_ID])) UNSET($_COOKIE['fbsr_'.APP_ID]);
if(isset($_COOKIE['fbm_'.APP_ID])) UNSET($_COOKIE['fbm_'.APP_ID]);

if(isset($social_user)) UNSET($social_user);
if(isset($facebookGuest)) UNSET($facebookGuest);

/* Delete sessions. */
if(isset($_SESSION['fb_'.APP_ID.'_state'])) UNSET($_SESSION['fb_'.APP_ID.'_state']); 
if(isset($_SESSION['fb_'.APP_ID.'_code'])) UNSET($_SESSION['fb_'.APP_ID.'_code']); 
if(isset($_SESSION['fb_'.APP_ID.'_user_id'])) UNSET($_SESSION['fb_'.APP_ID.'_user_id']); 
if(isset($_SESSION['fb_'.APP_ID.'_access_token'])) UNSET($_SESSION['fb_'.APP_ID.'_access_token']); 

if(isset($zfsession->fb_id)) UNSET($zfsession->fb_id);
if(isset($zfsession->twitter_id)) UNSET($zfsession->twitter_id);
if(isset($zfsession->google_id)) UNSET($zfsession->google_id);
	
//redirect to login page
header('Location: /');
exit;
?>