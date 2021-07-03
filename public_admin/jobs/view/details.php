<?php
/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');

/* to scrape: http://www.crsolutions.co.za/ */

/**
 * Standard includes
 */
require_once 'config/database.php';
require_once 'config/smarty.php';

/*** Check for login */
require_once 'includes/auth.php';

/* objects. */
require_once 'class/job.php';
require_once 'class/category.php';
require_once 'class/areapost.php';

$jobObject 			= new class_job();
$categoryObject 	= new class_category();
$areapostObject 	= new class_areapost();

/* Get Pairs. */
$categoryPairs = $categoryObject->pairs();
if($categoryPairs) 	$smarty->assign('categoryPairs', $categoryPairs);

/**
  * If the item exists populate the form with data
  */
if (!empty($_GET['code']) && $_GET['code'] != '') {
	
	$code = trim($_GET['code']);
	
	$jobData = $jobObject->getByCode($code);

	if($jobData) {
		$smarty->assign('jobData', $jobData);
	} else {
		header('Location: /jobs/view/');
		exit;
	}
}

/* Check posted data. */
if(count($_POST) > 0) {

	$errorArray	= array();	
	$formValid	= true;
	$success		= NULL;
	
	if(isset($_POST['job_title']) && trim($_POST['job_title']) == '') {
		$errorArray['job_title'] = 'Title required';
		$formValid = false;		
	}	
	
	if(isset($_POST['job_poster_name']) && trim($_POST['job_poster_name']) == '') {
		$errorArray['job_poster_name'] = 'requiPosters name is requiredred';
		$formValid = false;		
	}
	
	if(isset($_POST['category_code']) && (int)trim($_POST['category_code']) == 0) {
		$errorArray['category_code'] = 'Category required';
		$formValid = false;		
	}
	
	/* Check email. */
	if(isset($_POST['job_poster_email']) && trim($_POST['job_poster_email']) != '') {
		if($jobObject->validateEmail(trim($_POST['job_poster_email'])) == '') {
			$errorArray['job_poster_email'] = 'Enter Valid email.';
		} 
	} else {
		$errorArray['job_poster_email'] = 'Email missing.';
	}	
	
	if(isset($_POST['job_poster_number']) && trim($_POST['job_poster_number']) != '') {
		if($jobObject->validateCell(trim($_POST['job_poster_number'])) == '') {
			$errorArray['job_poster_number'] = 'Enter Valid number.';
		} 
	}
	
	if(isset($_POST['areapost_code']) && trim($_POST['areapost_code']) == '') {
		$errorArray['areapost_code'] = 'Area required';
		$formValid = false;		
	} else {
		if(isset($_POST['areapost_name']) && trim($_POST['areapost_name']) == '') {
			$errorArray['areapost_code'] = 'Area name required';
			$formValid = false;		
		}
	}
	
	if(isset($_POST['job_type']) && trim($_POST['job_type']) == '') {
		$errorArray['job_type'] = 'Job type required';
		$formValid = false;		
	}
	
	if(isset($_POST['job_page']) && strlen(trim($_POST['job_page'])) < 255) {
		$errorArray['job_page'] = 'Job description required';
		$formValid = false;		
	}
	
	if(count($errorArray) == 0 && $formValid == true) {
		
		/* required. */
		$data 									= array();
		$data['job_title'] 					= trim($_POST['job_title']);
		$data['job_poster_name'] 		= trim($_POST['job_poster_name']);
		$data['job_poster_number'] 	= trim($_POST['job_poster_number']);
		$data['job_poster_email']		= trim($_POST['job_poster_email']);
		$data['job_reference']			= trim($_POST['job_reference']);
		$data['category_code'] 			= trim($_POST['category_code']);		
		$data['job_type'] 					= trim($_POST['job_type']);	
		$data['job_address'] 				= trim($_POST['job_address']);
		$data['areapost_code']			= trim($_POST['areapost_code']);
		$data['job_area'] 					= trim($_POST['areapost_name']);		
		$data['job_page'] 					= htmlspecialchars_decode(stripslashes(trim($_POST['job_page'])));		
		$data['job_active']					= isset($_POST['job_active']) && trim($_POST['job_active']) == 1 ? 1 : 0;
		
		if(isset($jobData)) {
			/*Update. */
			$data['job_code']		= $jobData['job_code'];
			$where = $jobObject->getAdapter()->quoteInto('job_code = ?', $code);
			$success = $jobObject->update($data, $where);
		} else {		
			$success = $jobObject->insert($data);			
		}

		header('Location: /jobs/view/');				
		exit;		
			
	}
	
	/* if we are here there are errors. */
	$smarty->assign('errorArray', $errorArray);	
}

$smarty->display('jobs/view/details.tpl');

?>