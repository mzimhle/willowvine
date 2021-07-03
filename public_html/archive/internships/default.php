<?php
/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');
/* standard config include. */
require_once 'config/setup.php';
require_once 'includes/auth.php';

/* Get classes. */
require_once 'class/internship.php';
require_once 'class/internship_section.php';
require_once 'includes/jobSeeker_registration.php';

/* Create object. */
$internshipObject 			= new class_internship();
$sectionInternshipObject	= new class_internship_section();

/* Search parameters. */
$searchInternship	= (isset($_GET['searchInternship']) && trim($_GET['searchInternship'] !='') ) ? trim($_GET['searchInternship']) : '';
$sectionUrl			= (isset($_GET['sectionUrl']) && trim($_GET['sectionUrl']) !='' ) ? trim($_GET['sectionUrl']) : '';
$sectionId			= (isset($_GET['sectionId']) && (int)trim($_GET['sectionId']) != 0 ) ? (int)trim($_GET['sectionId']) : 0;

/* Setup search query. */
$searchQuery	= $searchInternship != '' ? "internship_title LIKE '%".$searchInternship."%'" : '';
if($searchQuery != '') {
	$searchQuery .= $sectionId != 0 ? " AND fk_section_id = ".$sectionId : '';
} else {
	$searchQuery = $sectionId != 0 ? "fk_section_id = ".$sectionId : '';
}

/* Check if section exists and is valid. */
if($sectionUrl != '') {
	/* Get section data. */
	$sectionInternshipData = $sectionInternshipObject->getBysectionUrl($sectionUrl);
	/* Check it. */
	if(count($sectionInternshipData) > 0) {
		$smarty->assign('sectionInternshipData', $sectionInternshipData[0]);
		$searchQuery = $sectionUrl != '' ? "section_urlName = '$sectionUrl'" : '';
	}
}

/* Pagination. */
$currentPage	= (isset($_GET['page']) && $_GET['page'] !='' ) ? (int)$_GET['page'] : 1;
$perPage 		= 10;
$listedPages	= 10;
$scrollingStyle	= 'Sliding';

/* Setup query. */

/* Setup Pagination. */
$internshipData = $internshipObject->getPaginatedinternship($searchQuery,'internships.internship_added DESC', $currentPage, $perPage, $listedPages, $scrollingStyle);

$internshipItems = $internshipData->getCurrentItems();

/* End Check if they are in the "shortlisted" session array. */
$smarty->assign_by_ref('internshipItems', $internshipItems);

$paginator = $internshipData->setView()->getPages();

$smarty->assign_by_ref('paginator', $paginator);
/* End Pagination Setup. */

/* Assign parameters. */
$smarty->assign('searchInternship', $searchInternship);
$smarty->assign('sectionId', $sectionId);
$smarty->assign('page', $currentPage);

/* display template */
$smarty->display('internships/default.tpl');
?>