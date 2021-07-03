<?php
/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/:'.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');

error_reporting(E_ALL);

/**
 * Standard includes
 */
require_once 'config/setup.php';
require_once 'admin/includes/auth.php';

global $zfsession;

// Clear the identity from the session
unset($zfsession->identity);

//redirect to login page
header('Location: /admin/login.php');
exit;
?>