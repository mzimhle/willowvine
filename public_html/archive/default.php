<?php 
/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');
/* standard config include. */
require_once 'config/setup.php';
require_once 'includes/auth.php';
require_once 'includes/shortlist.php';
/* Get classes. */
require_once 'class/section.php';
require_once 'includes/jobSeeker_registration.php';
/* Create object. */
$sectionObject				= new class_section();
/* Display Template. */
$smarty->display('default.tpl');
?>