<?php
/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');
/**
 * Standard includes
 */
require_once 'config/database.php';
require_once 'includes/auth.php';
global $zfsession;
// Clear the identity from the session
$zfsession->identity = null; unset($zfsession->identity);
//redirect to login page
header('Location: /');
exit;
?>