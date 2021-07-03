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

/**
  * If the item exists populate the form with data
  */
if (!empty($_GET['code']) && $_GET['code'] != '') {
	
	$code = trim($_GET['code']);
	
	$enquiryData = $enquiryObject->getByCode($code, 'JOB_APPLICATION');
	
	if($enquiryData) {
		$smarty->assign('enquiryData', $enquiryData);
	}	
}


$smarty->display('jobs/application/details.tpl');

?>