<?php
/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');

/* to scrape: http://www.gostudy.mobi/careers/default.aspx */

/**
 * Standard includes
 */
require_once 'config/setup.php';

/**
 * Check for login
 */
require_once 'admin/includes/auth.php';

/* Other resources. */
require_once 'includes/resources.php';
require_once 'includes/global_functions.php';

/* objects. */
require_once 'class/career.php';
require_once 'class/section.php';

$careerObject = new class_career();

/**
  * If the item exists populate the form with data
  */
if (!empty($_GET['pk_career_id']) && $_GET['pk_career_id'] != '') {
	
	$careerId = (int)$_GET['pk_career_id'];
	
	$careerData = $careerObject->getBycareerId($careerId);
	if(count($careerData) > 0) {
		$smarty->assign('careerData', $careerData);
	}
}

/* Check posted data. */
if(count($_POST) > 0) {

	$errorArray		= array();
	$data 			= array();
	$formValid		= true;
	$success		= NULL;
	
	if(isset($_POST['career_education']) && trim($_POST['career_education']) == '') {
		$errorArray['career_education'] = 'required';
		$formValid = false;		
	}	
	
	if(count($errorArray) == 0 && $formValid == true) {
		
		/* required. */
		$data['career_education'] 	= htmlspecialchars_decode(stripslashes(trim($_POST['career_education'])));		
		
		if(isset($careerId) && $careerId != '') {
			/*Update. */
			$where = $careerObject->getAdapter()->quoteInto('pk_career_id = ?', $careerId);
			$success = $careerObject->update($data, $where);
		}			
		
		if(is_numeric($success) && $success > 0) {							
			header('Location: /admin/resources/careers/contact.php?pk_career_id='.$careerId);				
			exit;		
		}
		
	}
	
	/* if we are here there are errors. */
	$smarty->assign('errorArray', $errorArray);	
}

$smarty->display('admin/resources/careers/education.tpl');

?>