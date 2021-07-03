<?php
/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');
/* standard config include. */
require_once 'config/setup.php';
require_once 'includes/auth.php';
require_once 'includes/shortlist.php';

/* Get classes. */
require_once 'class/career.php';
require_once 'class/career_section.php';
require_once 'includes/jobSeeker_registration.php';

/* Create object. */
$careerObject 			= new class_career();
$sectionCareerObject	= new class_career_section();

/* Search parameters. */
$searchCareer	= (isset($_GET['searchCareer']) && trim($_GET['searchCareer'] !='') ) ? trim($_GET['searchCareer']) : '';
$sectionUrl		= (isset($_GET['sectionUrl']) && trim($_GET['sectionUrl']) !='' ) ? trim($_GET['sectionUrl']) : '';

/* Setup search query. */
$searchQuery	= $searchCareer != '' ? "career_title LIKE '%".$searchCareer."%'" : '';

/* Check if section exists and is valid. */
if($sectionUrl != '') {
	/* Get section data. */
	$sectionCareerData = $sectionCareerObject->getBysectionUrl($sectionUrl);
	/* Check it. */
	if(count($sectionCareerData) > 0) {
		$smarty->assign('sectionCareerData', $sectionCareerData[0]);
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
$careerData = $careerObject->getPaginatedCareer($searchQuery,'careers.career_added DESC', $currentPage, $perPage, $listedPages, $scrollingStyle);

$careerItems = $careerData->getCurrentItems();

/* End Check if they are in the "shortlisted" session array. */
$smarty->assign_by_ref('careerItems', $careerItems);

$paginator = $careerData->setView()->getPages();

$smarty->assign_by_ref('paginator', $paginator);
/* End Pagination Setup. */

/* Assign parameters. */
$smarty->assign('searchCareer', $searchCareer);
$smarty->assign('page', $currentPage);

/* display template */
$smarty->display('careers/default.tpl');
?>