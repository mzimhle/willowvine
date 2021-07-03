<?php
/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');
/* standard config include. */
require_once 'config/setup.php';
require_once 'includes/auth.php';
require_once 'includes/shortlist.php';

/* Get classes. */
require_once 'class/job.php';
require_once 'class/section.php';
require_once 'includes/jobSeeker_registration.php';

/* Create object. */
$jobObject = new class_job();
$sectionObject = new class_section();

/* Search parameters. */
$searchJob			= (isset($_GET['searchJob']) && trim($_GET['searchJob'] !='') ) ? trim($_GET['searchJob']) : '';
$searchArea			= (isset($_GET['searchArea']) && trim($_GET['searchArea']) !='' ) ? trim($_GET['searchArea']) : '';
$jobReference		= (isset($_GET['jobReference']) && trim($_GET['jobReference']) !='' ) ? trim($_GET['jobReference']) : '';
$sectionId			= (isset($_GET['sectionId']) && (int)trim($_GET['sectionId']) != 0 ) ? (int)trim($_GET['sectionId']) : 0;

if($jobReference != '')  {
	/* Get job Details first. */
	$referenceData = $jobObject->getSearchReference(trim($jobReference));
	if(count($referenceData) == 1) {
		/* Redirect to the details page. */
		header('Location: /jobs/search/'.$referenceData[0]['section_urlName'].'/details/'.$referenceData[0]['job_link'].'/'.$jobReference.'/');	
		exit;	
	} else {
		/* Redirect to the details page. */
		header('Location: /jobs/search/details.php?jobReference='.$jobReference);	
		exit;
	}
}

if($sectionId != 0) {
	$sectionData = $sectionObject->getBysectionId($sectionId);
	
	if(count($sectionData) == 1) {
		$smarty->assign('sectionData', $sectionData[0]);
	} else {
		$sectionData = NULL; UNSET($sectionData);
	}
}

/* Setup search query. */
$searchQuery	= $searchJob != '' ? "job_title LIKE '%".$searchJob."%'" : '';
if($searchQuery == '') {
	$searchQuery = $searchArea != '' ? "job_area LIKE '%".$searchArea."%'" : '';
} else {
	$searchQuery .= $searchArea != '' ? " AND job_area LIKE '%".$searchArea."%'" : '';
}

if($searchQuery != '') {

	$searchQuery .= $sectionId != 0 ? " AND pk_section_id = ".$sectionId : '';
} else {
	$searchQuery = $sectionId != 0 ? "pk_section_id = ".$sectionId : '';
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
$smarty->assign('searchArea', $searchArea);
$smarty->assign('sectionId', $sectionId);
$smarty->assign('page', $currentPage);

/* display template */
$smarty->display('jobs/search/default.tpl');
?>