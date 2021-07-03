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

require_once 'class/jobSeeker.php';

$jobSeekerObject = new class_jobSeeker();

/**
  * If the item exists populate the form with data
  */
if (!empty($_GET['reference']) && $_GET['reference'] != '') {
	
	$jobSeekerId = (int)$_GET['reference'];
	
	$jobSeekerData = $jobSeekerObject->getJobSeekerDetails($jobSeekerId);
	if(count($jobSeekerData) > 0) {
		$smarty->assign('jobSeekerData', $jobSeekerData[0]);
	}	
}

$smarty->display('admin/users/jobSeekers/details.tpl');

?>