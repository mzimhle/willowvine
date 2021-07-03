<?php
/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');
/**
 * Standard includes
 */
require_once 'config/setup.php';

/**
 * Check for login
 */
require_once 'admin/includes/auth.php';
require_once 'class/section.php';

$sectionObject = new class_section();

$sectionPairs = $sectionObject->sectionPairs();

$smarty->assign('sectionPairs', $sectionPairs);

 
$smarty->display('admin/jobs/scrape/jobspace/default.tpl');

?>