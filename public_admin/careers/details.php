<?php
/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');

/**
 * Standard includes
 */
require_once 'config/database.php';
require_once 'config/smarty.php';

/**
 * Check for login
 */
require_once 'includes/auth.php';

require_once 'class/career.php';
require_once 'class/category.php';

$careerObject = new class_career();
$categoryObject = new class_category();

/* Get Pairs. */
$categoryPairs = $categoryObject->pairs();
if($categoryPairs) 	$smarty->assign('categoryPairs', $categoryPairs);

/**
  * If the item exists populate the form with data
  */
if (!empty($_GET['code']) && $_GET['code'] != '') {
	
	$code = trim($_GET['code']);
	
	$careerData = $careerObject->getByCode($code);
	
	if($careerData) {
		$smarty->assign('careerData', $careerData);
	}	
}

/* Check posted data. */
if(count($_POST) > 0) {

	$errorArray	= array();	
	$formValid	= true;
	$success		= NULL;
	
	if(isset($_POST['career_name']) && trim($_POST['career_name']) == '') {
		$errorArray['career_name'] = 'Name required';
		$formValid = false;		
	}
	
	if(isset($_POST['category_code']) && trim($_POST['category_code']) == '') {
		$errorArray['category_code'] = 'Category required';
		$formValid = false;		
	}
	
	if(isset($_POST['career_page']) && strlen(trim($_POST['career_page'])) < 100) {
		$errorArray['career_page'] = 'Page required';
		$formValid = false;		
	}
	
	if(isset($_POST['career_education']) && strlen(trim($_POST['career_education'])) < 100) {
		$errorArray['career_education'] = 'Education required';
		$formValid = false;		
	}
	
	if(isset($_POST['career_contact']) && strlen(trim($_POST['career_contact'])) < 100) {
		$errorArray['career_contact'] = 'Contact required';
		$formValid = false;		
	}
	
	if(count($errorArray) == 0 && $formValid == true) {
		
		/* required. */
		$data 								= array();
		$data['career_name'] 		= trim($_POST['career_name']);
		$data['category_code'] 		= trim($_POST['category_code']);
		$data['career_page'] 			= htmlspecialchars_decode(stripslashes(trim($_POST['career_page'])));		
		$data['career_education'] 	= htmlspecialchars_decode(stripslashes(trim($_POST['career_education'])));	
		$data['career_contact'] 		= htmlspecialchars_decode(stripslashes(trim($_POST['career_contact'])));	
		
		if(isset($careerData)) {
			/*Update. */
			$where = $careerObject->getAdapter()->quoteInto('career_code = ?', $code);
			$success = $careerObject->update($data, $where);
		} else {		
			$success = $careerObject->insert($data);			
		}

		header('Location: /careers/');				
		exit;		
			
	}
	
	/* if we are here there are errors. */
	$smarty->assign('errorArray', $errorArray);	
}

$smarty->display('careers/details.tpl');

?>