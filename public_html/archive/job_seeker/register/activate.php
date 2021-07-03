<?php
/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');
//standard config include.
require_once 'config/setup.php';
require_once 'class/jobSeeker.php';

/* Get parameter. */
$cde = isset($_GET['cde']) && trim($_GET['cde']) != '' ? trim($_GET['cde']) : '';

if($cde == '') {
	/* Get the hell out of here. */
	header('Location: /jobs/search/');
	exit;
} else {
	/* Object. */
	$jobSeekerObject = new class_jobSeeker();
	
	/* Fetch the use. */
	$jobSeekerData = $jobSeekerObject->getByHashCode($cde);
	
	if(count($jobSeekerData) == 1) {
		/* Activate account and stay on this page. */
		$data = array('jobSeeker_active' => 1);
		$where = $jobSeekerObject->getAdapter()->quoteInto('jobSeeker_reference = ?', $jobSeekerData[0]['jobSeeker_reference']);
		$success = $jobSeekerObject->update($data, $where);
		
		/* if successful */
		if(is_numeric($success)) $smarty->assign('jobSeekerData', $jobSeekerData[0]);
		
	} else {
		/* Get the hell out of here. */
		header('Location: /jobs/search/');
		exit;
	}
}


//display template
$smarty->display('job_seeker/register/activate.tpl');
?>