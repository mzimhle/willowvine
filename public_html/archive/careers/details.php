<?php
/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');

// decode html tags: htmlspecialchars_decode()

//standard config include.
require_once 'config/setup.php';
require_once 'includes/auth.php';
require_once 'functions.php';

/* Classes. */
require_once 'class/career.php';

/* Check if property reference exists. */
$careerId			= (isset($_REQUEST['careerId']) && trim($_REQUEST['careerId']) != '' ) ? trim($_REQUEST['careerId']) : '';
$searchCareer		= (isset($_REQUEST['searchCareer']) && trim($_REQUEST['searchCareer']) !='' ) ? trim($_REQUEST['searchCareer']) : '';
$page				= (isset($_REQUEST['page']) && trim($_REQUEST['page']) !='' ) ? trim($_REQUEST['page']) : '';

$smarty->assign('careerId', $careerId);
$smarty->assign('searchCareer', $searchCareer);
$smarty->assign('page', $page);

if($careerId != '') {
	/* Create object. */
	$careerObject = new class_career();
	
	/* Get career by reference. */
	$careerData = $careerObject->getById($careerId);
	
	/* Check if career exists. */
	if(count($careerData) > 1) {
		$careerData['career_page'] = htmlspecialchars_decode(stripslashes($careerData['career_page']));
		$careerData['career_education'] = htmlspecialchars_decode(stripslashes($careerData['career_education']));
		$careerData['career_contact'] = htmlspecialchars_decode(stripslashes($careerData['career_contact']));
		
		$smarty->assign('careerData', $careerData);
		
	} else {
		/* Redirect to the details page. */
		header('Location: /errors/404/');	
		exit;	
	}
} else {
		/* Redirect to the details page. */
		header('Location: /careers/');	
		exit;
}

//display template
$smarty->display('careers/details.tpl');
?>