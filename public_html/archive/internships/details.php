<?php
/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');

// decode html tags: htmlspecialchars_decode()

//standard config include.
require_once 'config/setup.php';
require_once 'includes/auth.php';
require_once 'functions.php';

/* Classes. */
require_once 'class/internship.php';

/* Check if property reference exists. */
$internshipId			= (isset($_REQUEST['internshipId']) && trim($_REQUEST['internshipId']) != '' ) ? trim($_REQUEST['internshipId']) : '';
$searchInternship		= (isset($_REQUEST['searchInternship']) && trim($_REQUEST['searchInternship']) !='' ) ? trim($_REQUEST['searchInternship']) : '';
$page					= (isset($_REQUEST['page']) && trim($_REQUEST['page']) !='' ) ? trim($_REQUEST['page']) : '';
$sectionId				= (isset($_REQUEST['sectionId']) && trim($_REQUEST['sectionId']) !='' ) ? trim($_REQUEST['sectionId']) : '';

$smarty->assign('internshipId', $internshipId);
$smarty->assign('searchInternship', $searchInternship);
$smarty->assign('page', $page);
$smarty->assign('page', $page);

if($internshipId != '') {
	/* Create object. */
	$internshipObject = new class_internship();
	
	/* Get internship by reference. */
	$internshipData = $internshipObject->getByInternshipId($internshipId);
	
	/* Check if internship exists. */
	if(count($internshipData) > 1) {
		$internshipData['internship_page'] = htmlspecialchars_decode(stripslashes($internshipData['internship_page']));
		$smarty->assign('internshipData', $internshipData);
		
	} else {
		/* Redirect to the details page. */
		header('Location: /errors/404/');	
		exit;	
	}
} else {
		/* Redirect to the details page. */
		header('Location: /internships/');	
		exit;
}

//display template
$smarty->display('internships/details.tpl');
?>