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

require_once 'class/category.php';

$categoryObject = new class_category();

/**
  * If the item exists populate the form with data
  */
if (!empty($_GET['code']) && $_GET['code'] != '') {
	
	$code = trim($_GET['code']);
	
	$categoryData = $categoryObject->getByCode($code);
	
	if($categoryData) {
		$smarty->assign('categoryData', $categoryData);
	}	
}

/* Check posted data. */
if(count($_POST) > 0) {

	$errorArray	= array();	
	$formValid	= true;
	$success		= NULL;
	
	if(isset($_POST['category_name']) && trim($_POST['category_name']) == '') {
		$errorArray['category_name'] = 'Name required';
		$formValid = false;		
	}
	
	if(count($errorArray) == 0 && $formValid == true) {
		
		/* required. */
		$data 					= array();
		$data['category_name']	= trim($_POST['category_name']);	
		
		if(isset($categoryData)) {
			/*Update. */
			$where = $categoryObject->getAdapter()->quoteInto('category_code = ?', $code);
			$success = $categoryObject->update($data, $where);
		} else {		
			$success = $categoryObject->insert($data);			
		}

		header('Location: /resources/category/');				
		exit;		
			
	}
	
	/* if we are here there are errors. */
	$smarty->assign('errorArray', $errorArray);	
}

$smarty->display('resources/category/details.tpl');

?>