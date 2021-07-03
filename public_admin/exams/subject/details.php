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

require_once 'class/subject.php';

$subjectObject = new class_subject();

/**
  * If the item exists populate the form with data
  */
if (!empty($_GET['code']) && $_GET['code'] != '') {
	
	$code = trim($_GET['code']);
	
	$subjectData = $subjectObject->getByCode($code);
	
	if($subjectData) {
		$smarty->assign('subjectData', $subjectData);
	}	
}

/* Check posted data. */
if(count($_POST) > 0) {

	$errorArray	= array();	
	$formValid	= true;
	$success		= NULL;
	
	if(isset($_POST['subject_name']) && trim($_POST['subject_name']) == '') {
		$errorArray['subject_name'] = 'Name required';
		$formValid = false;		
	}
	
	if(count($errorArray) == 0 && $formValid == true) {
		
		/* required. */
		$data 							= array();
		$data['subject_name'] 	= trim($_POST['subject_name']);
	
		
		if(isset($subjectData)) {
			/*Update. */
			$where = $subjectObject->getAdapter()->quoteInto('subject_code = ?', $code);
			$success = $subjectObject->update($data, $where);
		} else {		
			$success = $subjectObject->insert($data);			
		}

		header('Location: /exams/subject/');				
		exit;		
			
	}
	
	/* if we are here there are errors. */
	$smarty->assign('errorArray', $errorArray);	
}

$smarty->display('exams/subject/details.tpl');

?>