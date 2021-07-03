<?php
/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/:'.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');

/**
 * Standard includes
 */
require_once 'config/setup.php';

/**
 * Check for login
 */
require_once 'admin/includes/auth.php';

 /* Display the template
 */	
$smarty->display('admin/jobs/scrape/default.tpl');

?>