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

require_once 'class/jobSeekerCV.php';
require_once 'class/jobSeeker.php';

$jobSeekerObject = new class_jobSeeker();
$jobSeekerCVObject = new class_jobSeekerCV();

/**
  * If the item exists populate the form with data
  */
if (!empty($_GET['jobSeeker_reference']) && $_GET['jobSeeker_reference'] != '') {
	
	$jobSeekerReference = (int)$_GET['jobSeeker_reference'];
	
	$jobSeekerCVData = $jobSeekerCVObject->getJobSeekerReference($jobSeekerReference);
	if(count($jobSeekerCVData) > 0) {
	
		$jobSeekerData = $jobSeekerObject->getByReference($jobSeekerReference);
		
		$smarty->assign('jobSeekerData', $jobSeekerData[0]);
		$smarty->assign('jobSeekerCVData', $jobSeekerCVData);
	}	
	
	
}

$smarty->display('admin/users/jobSeekers/cv.tpl');

?>