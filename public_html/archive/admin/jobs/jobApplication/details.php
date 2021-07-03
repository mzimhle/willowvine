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

require_once 'class/jobApplication.php';

$jobApplicationObject = new class_jobApplication();

/**
  * If the item exists populate the form with data
  */
if (!empty($_GET['id']) && $_GET['id'] != '') {
	
	$jobApplicationId = (int)$_GET['id'];
	
	$jobApplicationData = $jobApplicationObject->getByjobApplicationId($jobApplicationId);
	if(count($jobApplicationData) > 0) {
		$smarty->assign('jobApplicationData', $jobApplicationData[0]);
	}	
}

$smarty->display('admin/jobs/jobApplication/details.tpl');

?>