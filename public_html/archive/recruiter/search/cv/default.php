<?php
/* standard includes */
require('config/setup.php');

/* Authentication. */
require_once 'includes/auth.php';

/* Get classes. */
require_once 'class/section.php';
require_once 'class/jobSeekerCV.php';

/* Create object. */
$sectionObject = new class_section();
$jobSeekerCVObject = new class_jobSeekerCV();

/* Get sectionId parameter. */
$sectionId	= (isset($_POST['sectionId']) && (int)trim($_POST['sectionId']) != 0 ) ? (int)trim($_POST['sectionId']) : '';
$cvText		= isset($_POST['cvText']) && trim($_POST['cvText']) != 'Enter Text' && trim($_POST['cvText']) != 'Enter text' && trim($_POST['cvText']) != ''? trim($_POST['cvText']) : '';

/* Get section details. */
if($sectionId != 0) {
	$sectionData = $sectionObject->getBysectionId($sectionId);
	if(count($sectionData) == 1) {
		$smarty->assign('sectionData', $sectionData[0]);
	} else {
		$sectionData = NULL; UNSET($sectionData);
	}
}

$searchQuery =  $cvText != '' ? "jobSeekerCV_cvContent LIKE '%".$cvText."%'" : '';
if($sectionId != '') {
	$searchQuery .= $searchQuery == '' ? "fkSectionId LIKE '%".$sectionId."%'" : "AND fkSectionId LIKE '%".$sectionId."%'";
}

/* Pagination. */
$currentPage	= (isset($_GET['page']) && $_GET['page'] !='' ) ? (int)$_GET['page'] : 1;
$perPage 		= 10;
$listedPages	= 10;
$scrollingStyle	= 'Sliding';

/* Setup query. */

/* Setup Pagination. */
$cvData = $jobSeekerCVObject->getPaginatedjobSeekerCV($searchQuery,'jobseekercv.jobSeekerCV_added DESC', $currentPage, $perPage, $listedPages, $scrollingStyle);

$cvItems = $cvData->getCurrentItems();

$smarty->assign_by_ref('cvItems', $cvItems);

$paginator = $cvData->setView()->getPages();

$smarty->assign_by_ref('paginator', $paginator);
/* End Pagination Setup. */

/* Assign parameters. */
$smarty->assign('cvText', $cvText);
$smarty->assign('sectionId', $sectionId);

// Display template
$smarty->display('recruiter/search/cv/default.tpl');
?>