<?php
/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');

/**
 * Standard includes
 */
require_once 'config/database.php';
require_once 'config/smarty.php';

/**
 * Check for login
 */
require_once 'includes/auth.php';

require_once 'class/enquiry.php';

$enquiryObject = new class_enquiry();


$enquiryData = $enquiryObject->getAll('JOB_APPLICATION');

if($enquiryData) $smarty->assign('enquiryData', $enquiryData);

$smarty->display('jobs/application/default.tpl');

?>