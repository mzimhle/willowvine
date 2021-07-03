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

require_once 'class/internship.php';
require_once 'class/category.php';

$internshipObject = new class_internship();
$categoryObject = new class_category();

/* Get Pairs. */
$categoryPairs = $categoryObject->pairs();
if($categoryPairs) 	$smarty->assign('categoryPairs', $categoryPairs);

/**
  * If the item exists populate the form with data
  */
if (!empty($_GET['code']) && $_GET['code'] != '') {
	
	$code = trim($_GET['code']);
	
	$internshipData = $internshipObject->getByCode($code);
	
	if($internshipData) {
		$smarty->assign('internshipData', $internshipData);
	}	
}

/* Check posted data. */
if(count($_POST) > 0) {

	$errorArray	= array();	
	$formValid	= true;
	$success		= NULL;
	
	if(isset($_POST['internship_name']) && trim($_POST['internship_name']) == '') {
		$errorArray['internship_name'] = 'Name required';
		$formValid = false;		
	}
	
	if(isset($_POST['category_code']) && trim($_POST['category_code']) == '') {
		$errorArray['category_code'] = 'Category required';
		$formValid = false;		
	}
	
	if(isset($_POST['internship_company']) && trim($_POST['internship_company']) == '') {
		$errorArray['internship_company'] = 'Company required';
		$formValid = false;		
	}
	
	if(isset($_POST['internship_date_opening']) && trim($_POST['internship_date_opening']) == '') {
		$errorArray['internship_date_opening'] = 'Start date required';
		$formValid = false;		
	}
	
	if(isset($_POST['internship_date_closing']) && trim($_POST['internship_date_closing']) == '') {
		$errorArray['internship_date_closing'] = 'End date required';
		$formValid = false;		
	}
	
	if(isset($_POST['internship_page']) && strlen(trim($_POST['internship_page'])) < 100) {
		$errorArray['internship_page'] = 'Page required';
		$formValid = false;		
	}
	
	if(count($errorArray) == 0 && $formValid == true) {
		
		/* required. */
		$data 											= array();
		$data['internship_name'] 				= trim($_POST['internship_name']);
		$data['category_code'] 					= trim($_POST['category_code']);
		$data['internship_company'] 			= trim($_POST['internship_company']);
		$data['internship_contact_name'] 	= trim($_POST['internship_contact_name']);
		$data['internship_contact_email'] 	= trim($_POST['internship_contact_email']);
		$data['internship_contact_number'] = trim($_POST['internship_contact_number']);
		$data['internship_link'] 					= trim($_POST['internship_link']);
		$data['internship_date_opening'] 	= trim($_POST['internship_date_opening']);
		$data['internship_date_closing'] 		= trim($_POST['internship_date_closing']);
		$data['internship_area'] 					= trim($_POST['internship_area']);
		$data['internship_page'] 				= htmlspecialchars_decode(stripslashes(trim($_POST['internship_page'])));		
		
		if(isset($internshipData)) {
			/*Update. */
			$where = $internshipObject->getAdapter()->quoteInto('internship_code = ?', $code);
			$success = $internshipObject->update($data, $where);
		} else {		
			$success = $internshipObject->insert($data);			
		}

		header('Location: /internships/');				
		exit;		
			
	}
	
	/* if we are here there are errors. */
	$smarty->assign('errorArray', $errorArray);	
}

$smarty->display('internships/details.tpl');

?>