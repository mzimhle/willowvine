<?php
/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');
//standard config include.
require_once 'config/setup.php';
require_once 'includes/auth.php';
require_once 'functions.php';
require_once 'includes/shortlist.php';

/* Classes. */
require_once 'class/job.php';
require_once 'class/jobApplication.php';
require_once 'class/areaMap.php';
require_once 'class/section.php';

//$slsession->jobs);

/* Check if property reference exists. */
$jobReference		= (isset($_GET['jobReference']) && trim($_GET['jobReference']) !='' ) ? trim($_GET['jobReference']) : '';
$searchJob			= (isset($_GET['searchJob']) && trim($_GET['searchJob']) !='' ) ? trim($_GET['searchJob']) : '';
$page				= (isset($_GET['page']) && trim($_GET['page']) !='' ) ? trim($_GET['page']) : '';
$area				= (isset($_GET['area']) && trim($_GET['area']) !='' ) ? trim($_GET['area']) : '';
$type				= (isset($_GET['type']) && trim($_GET['type']) !='' ) ? trim($_GET['type']) : '';
$sectionId			= (isset($_GET['sectionId']) && (int)trim($_GET['sectionId']) != 0 ) ? (int)trim($_GET['sectionId']) : 0;

$smarty->assign('searchJob', $searchJob);
$smarty->assign('area', $area);
$smarty->assign('type', $type);
$smarty->assign('page', $page);


if($jobReference != '') {
	/* Create object. */
	$jobObject = new class_job();
	
	/* Get job by reference. */
	$jobData = $jobObject->getByReference($jobReference);
	
	/* Check if job exists. */
	if(count($jobData) == 1) {
		$jobData[0]['shortlist'] = in_array((int)$jobData[0]['job_reference'], $slsession->jobs) ? 1 : 0; 
		$smarty->assign('jobData', $jobData[0]);
		$smarty->assign('jobReference', $jobReference);
	} else {
		/* Redirect to the details page. */
		header('Location: /errors/404/');	
		exit;	
	}
} else {
		/* Redirect to the details page. */
		header('Location: /errors/404/');			
		exit;	
}

/* Check if section exists and is valid. */
if($sectionId != 0) {
	/* Object. */
	$sectionObject = new class_section();
	/* Get section data. */
	$sectionData = $sectionObject->getBysectionId($sectionId);
	/* Check it. */
	if(count($sectionData) > 0) {
		$smarty->assign('sectionData', $sectionData[0]);
	}
}

if($jobData[0]['job_poster_email'] != '') {
	/* Job Application. */
	require_once 'includes/job_application.php';
}
//display template
$smarty->display('jobs/search/details.tpl');
?>