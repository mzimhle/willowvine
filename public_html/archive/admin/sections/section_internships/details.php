<?php
/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');

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
require_once 'class/internship_section.php';

$sectionObject = new class_internship_section();

/**
  * If the item exists populate the form with data
  */
if (!empty($_GET['sectionId']) && $_GET['sectionId'] != '') {
	
	$sectionId = (int)$_GET['sectionId'];
	
	$sectionData = $sectionObject->getById($sectionId)->toArray();
	if(count($sectionData) > 0) {
		$smarty->assign('sectionData', $sectionData[0]);
	}
}

/* Check posted data. */
if(count($_POST) > 0) {
	
	$errorArray	= array();
	$data 			= array();
	$formValid	= true;
	$success		= NULL;
	
	if(isset($_POST['section_name']) && trim($_POST['section_name']) == '') {
		$errorArray['section_name'] = 'required';
		$formValid = false;
	}
	
	if(isset($_POST['fk_category_id']) && trim($_POST['fk_category_id']) == '') {
		$errorArray['fk_category_id'] = 'required';
		$formValid = false;		
	}
	
	if(count($errorArray) == 0 && $formValid == true) {
		
		/* required. */
		$data['section_name'] 		= trim($_POST['section_name']);
		$data['section_active']		= isset($_POST['section_active']) && trim($_POST['section_active']) == 1 ? 1 : 0;
		$data['section_urlName']	= StringToUrl(trim($data['section_name'])); 
		
		if(isset($sectionId) && $sectionId != '') {
			/*Update. */
			$where = $sectionObject->getAdapter()->quoteInto('pk_section_id = ?', $sectionId);
			$success = $sectionObject->update($data, $where);
		} else {
			/* Insert. */
			$success = $sectionObject->insert($data);
		}
		
		/* check if successful. */
		if(is_numeric($success) && $success > 0) {
			
				header('Location: /admin/sections/section_internships/');
				exit;
		}		
		/* if we are here there are errors. */
		$smarty->assign('errorArray', $errorArray);		
	}			
}

$smarty->display('admin/sections/section_internships/details.tpl');

?>