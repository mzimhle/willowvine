<?php 
/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');

require_once('config/setup.php');
require_once 'includes/jobSeeker_registration.php';

global $smarty;

// Display the template
$smarty->display('advice/cv.tpl');
?>