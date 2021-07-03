<?php 
/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');

/* Required classes. */
require_once 'config/setup.php';
require_once 'includes/auth.php';
require_once 'includes/jobSeeker_registration.php';

/* 
 * Display Template. 
 */
$smarty->display('errors/404.tpl');
?>