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

require_once 'class/recruiter.php';
require_once 'class/category.php';

$recruiterObject = new class_recruiter();
$categoryObject = new class_category();

/* Get Pairs. */
$categoryPairs = $categoryObject->pairs();
if($categoryPairs) 	$smarty->assign('categoryPairs', $categoryPairs);

/**
  * If the item exists populate the form with data
  */
if (!empty($_GET['code']) && $_GET['code'] != '') {
	
	$code = trim($_GET['code']);
	
	$recruiterData = $recruiterObject->getByCode($code);
	
	if($recruiterData) {
		$smarty->assign('recruiterData', $recruiterData);
	}	
}

/* Check posted data. */
if(count($_POST) > 0) {

	$errorArray	= array();	
	$formValid	= true;
	$success		= NULL;
	
	if(isset($_POST['recruiter_name']) && trim($_POST['recruiter_name']) == '') {
		$errorArray['recruiter_name'] = 'Name required';
		$formValid = false;		
	}
	
	if(isset($_POST['areapost_code']) && trim($_POST['areapost_code']) == '') {
		$errorArray['areapost_code'] = 'Area required';
		$formValid = false;		
	}
	
	if(isset($_POST['recruiter_number']) && trim($_POST['recruiter_number']) != '') {
		if($recruiterObject->validateCell(trim($_POST['recruiter_number'])) == '') {
			$errorArray['recruiter_number'] = 'Valid number required';
			$formValid = false;		
		}	
	}
	
	if(isset($_POST['recruiter_email']) && trim($_POST['recruiter_email']) != '') {
		if($recruiterObject->validateEmail(trim($_POST['recruiter_email'])) == '') {
			$errorArray['recruiter_email'] = 'Valid email required';
			$formValid = false;		
		}	
	} else {
		$errorArray['recruiter_email'] = 'Email required';
		$formValid = false;		
	}
	
	if(isset($_POST['recruiter_website']) && trim($_POST['recruiter_website']) == '') {
		$errorArray['recruiter_website'] = 'Website required';
		$formValid = false;		
	}
	
	if(count($errorArray) == 0 && $formValid == true) {
		
		/* required. */
		$data 											= array();
		$data['areapost_code'] 				= trim($_POST['areapost_code']);
		$data['recruiter_name'] 					= trim($_POST['recruiter_name']);
		$data['recruiter_number'] 			= trim($_POST['recruiter_number']);
		$data['recruiter_email'] 	= trim($_POST['recruiter_email']);
		$data['recruiter_address'] 	= trim($_POST['recruiter_address']);
		$data['recruiter_logo_path'] = trim($_POST['recruiter_logo_path']);
		$data['recruiter_website'] 					= trim($_POST['recruiter_website']);	

		if(isset($recruiterData)) {
			/*Update. */
			$where		= $recruiterObject->getAdapter()->quoteInto('recruiter_code = ?', $code);
			$success	= $recruiterObject->update($data, $where);
		} else {		
			$success = $recruiterObject->insert($data);			
		}

		header('Location: /resources/recruiters/');				
		exit;		
			
	}
	
	/* if we are here there are errors. */
	$smarty->assign('errorArray', $errorArray);	
}

$smarty->display('resources/recruiters/details.tpl');

?>