<?php
/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/:'.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');
/* standard config include. */
require_once 'config/setup.php';

/* Classes. */
require_once 'class/jobSeeker.php';

/* Objects. */
$jobSeekerObject = new class_jobSeeker();

$jobSeekerReference = isset($_GET['jsk']) && (int)trim($_GET['jsk']) != 0 ? (int)trim($_GET['jsk']) : 0;

if($jobSeekerReference == 0) {
	/* Redirect links. */
	header('Location: /job_seeker/');
	exit;	
} else {
	/* Check reference exists. */
	$jobSeekerData = $jobSeekerObject->getByReference($jobSeekerReference);
	
	if(count($jobSeekerData) > 0) {
		$smarty->assign('data', $jobSeekerData[0]);
	} else {
		/* Redirect links. */
		header('Location: /job_seeker/');
		exit;		
	}
}

/* display template */
$smarty->display('job_seeker/register/complete.tpl');
?>