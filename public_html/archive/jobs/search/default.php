<?php
/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');
/* standard config include. */
require_once 'config/setup.php';
require_once 'config/location.php';
require_once 'includes/auth.php';
require_once 'includes/shortlist.php';
require_once 'config/location.php';

/* Get classes. */
require_once 'class/job.php';
require_once 'class/areaMap.php';
require_once 'class/section.php';
require_once 'includes/jobSeeker_registration.php';

/* Create object. */
$jobObject 		= new class_job();
$sectionObject	= new class_section();
$areaMapObject	= new class_areaMap();

/* Search parameters. */
$searchJob	= (isset($_GET['searchJob']) && trim($_GET['searchJob'] !='') ) ? trim($_GET['searchJob']) : '';
$sectionUrl	= (isset($_GET['sectionUrl']) && trim($_GET['sectionUrl']) !='' ) ? trim($_GET['sectionUrl']) : '';
$area		= (isset($_GET['area']) && trim($_GET['area']) !='' ) ? trim($_GET['area']) : '';
$type		= (isset($_GET['type']) && trim($_GET['type']) !='' ) ? trim($_GET['type']) : '';

/* Setup search query. */
$searchQuery = $searchJob != '' ? "job_title LIKE '%".$searchJob."%'" : '';

/* Check area search. */
$areaData = $areaMapObject->fetchByLink($area);

if(is_array($areaData) && isset($areaData['fkAreaId']) && (int)$areaData['fkAreaId'] != 0) {
	if($searchQuery == '') {
		$searchQuery = " fk_area_id = ".$areaData['fkAreaId'];
	} else {
		$searchQuery .= " AND fk_area_id = ".$areaData['fkAreaId'];
	}	
} else {
	if($searchQuery == '') {
		$searchQuery = isset($location->sessionArea) && $location->sessionArea != 'South Africa' ? "job_area LIKE '%".$location->sessionArea."%'" : '';
	} else {
		$searchQuery .= isset($location->sessionArea) && $location->sessionArea != 'South Africa' ? " AND job_area LIKE '%".$location->sessionArea."%'" : '';
	}	
}

if(trim($type) != '') {
	if($searchQuery != '') {
	$searchQuery .= ' AND job_type = \''.$type.'\'';
	} else {
		$searchQuery = 'job_type = \''.$type.'\'';
	}
}

/* Check if section exists and is valid. */
if($sectionUrl != '') {
	/* Get section data. */
	$sectionData = $sectionObject->getBysectionUrl($sectionUrl);
	/* Check it. */
	if(count($sectionData) > 0) {
		$smarty->assign('sectionData', $sectionData[0]);
		if($searchQuery != '') $searchQuery .= $sectionUrl != '' ? " AND section_urlName = '".$sectionUrl."'" : '';
		if($searchQuery == '') $searchQuery .= $sectionUrl != '' ? "section_urlName = '".$sectionUrl."'" : '';		
	}
}

/* Pagination. */
$currentPage	= (isset($_GET['page']) && $_GET['page'] !='' ) ? (int)$_GET['page'] : 1;
$perPage 		= 10;
$listedPages	= 10;
$scrollingStyle	= 'Sliding';

/* Setup query. */

/* Setup Pagination. */
$jobData = $jobObject->getPaginatedjob($searchQuery,'job.job_added DESC', $currentPage, $perPage, $listedPages, $scrollingStyle);

$jobItems = $jobData->getCurrentItems();

/* Check if they are in the "shortlisted" session array. */
for($i = 0; $i < count($jobItems); $i++) {
	$jobItems[$i]['shortlist'] = in_array((int)$jobItems[$i]['job_reference'], $slsession->jobs) ? 1 : 0; 
}
/* End Check if they are in the "shortlisted" session array. */
$smarty->assign_by_ref('jobItems', $jobItems);

$paginator = $jobData->setView()->getPages();

$smarty->assign_by_ref('paginator', $paginator);
/* End Pagination Setup. */

/* Assign parameters. */
$smarty->assign('searchJob', $searchJob);
if(count($areaData) > 0) $smarty->assign('areaData', $areaData);
$smarty->assign('area', $area);
$smarty->assign('type', $type);
$smarty->assign('page', $currentPage);

/* display template */
$smarty->display('jobs/search/default.tpl');
$jobObject = $sectionObject = $areaMapObject = $searchJob = $sectionUrl = $area = $type = $searchQuery = $areaData = $sectionData = null;
$currentPage = $perPage = $listedPages = $scrollingStyle = $jobData = $jobItems = $paginator = null; 
unset($jobObject, $sectionObject, $areaMapObject, $searchJob, $sectionUrl, $area, $type, $searchQuery, $areaData, $sectionData);
unset($currentPage, $perPage, $listedPages, $scrollingStyle, $jobData, $jobItems, $paginator);
?>