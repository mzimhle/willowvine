<?php 
/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');
/* standard config include. */
require_once 'config/smarty.php';

/* Display Template. */
$smarty->display('advice/cv.tpl');
?>