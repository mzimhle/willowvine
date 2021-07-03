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

//$slsession->jobs);

/* Check if property reference exists. */
$jobReference		= (isset($_GET['jobReference']) && trim($_GET['jobReference']) !='' ) ? trim($_GET['jobReference']) : '';
$searchJob			= (isset($_GET['searchJob']) && trim($_GET['searchJob']) !='' ) ? trim($_GET['searchJob']) : '';
$page				= (isset($_GET['page']) && trim($_GET['page']) !='' ) ? trim($_GET['page']) : '';
$area				= (isset($_GET['area']) && trim($_GET['area']) !='' ) ? trim($_GET['area']) : '';
$type				= (isset($_GET['type']) && trim($_GET['type']) !='' ) ? trim($_GET['type']) : '';
$sectionId			= (isset($_GET['sectionId']) && (int)trim($_GET['sectionId']) != 0 ) ? (int)trim($_GET['sectionId']) : 0;

$smarty->assign('searchJob', $searchJob);
$smarty->assign('page', $page);
$smarty->assign('area', $area);
$smarty->assign('type', $type);
$smarty->assign('sectionId', $sectionId);

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
		header('Location: /jobs/search/');	
		exit;
}

//display template
$smarty->display('jobs/search/directions.tpl');
?>