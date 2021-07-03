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

$smarty->assign('searchJob', $searchJob);
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

/* Get Area Details. */
$areaMapObject = new class_areaMap();

/* Get by job area. */

$areaData = $areaMapObject->fetchByShortPath(str_replace(' ', '', strtolower($jobData[0]['job_area'])));

if(count($areaData) > 0) { 
	/* Get view. */
	$areaData['polyDataName'] = str_replace(' ', '', strtolower($areaData['areaMap_name']));
	$smarty->assign('areaData', $areaData);	
}

/* Job Application. */
require_once 'includes/job_application.php';

//display template
$smarty->display('jobs/search/details.tpl');
?>