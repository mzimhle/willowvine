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
require_once 'class/internship.php';
require_once 'class/section.php';
require_once 'class/areaMap.php';

$internshipObject = new class_internship();
$sectionObject = new class_section();
$areaMapObject = new class_areaMap();

/* Get Pairs. */
$sectionPairs = $sectionObject->sectionPairs();

if(count($sectionPairs) > 0) {
	$smarty->assign('sectionPairs', $sectionPairs);
}

/**
  * If the item exists populate the form with data
  */
if (!empty($_GET['pk_internship_id']) && $_GET['pk_internship_id'] != '') {
	
	$internshipId = (int)$_GET['pk_internship_id'];
	
	$internshipData = $internshipObject->getByInternshipIdAdmin($internshipId);

	if(count($internshipData) > 0) {	
		$smarty->assign('internshipData', $internshipData);
	}
}

/* Check posted data. */
if(count($_POST) > 0) {

	$errorArray		= array();
	$data 			= array();
	$formValid		= true;
	$success		= NULL;
	
	if(isset($_POST['internship_title']) && trim($_POST['internship_title']) == '') {
		$errorArray['internship_title'] = 'required';
		$formValid = false;		
	}	else {
		/* Check if it exists. */
		$internshipName = $internshipObject->checkInternshipExists(trim($_POST['internship_title']));
		if(!isset($internshipData) && $internshipName != '') {
			$errorArray['internship_title'] = 'required';
			$formValid = false;					
		}
	}
	
	if(isset($_POST['internship_page']) && trim($_POST['internship_page']) == '') {
		$errorArray['internship_page'] = 'required';
		$formValid = false;		
	}
	
	if(isset($_POST['fk_section_id']) && (int)trim($_POST['fk_section_id']) == 0) {
		$errorArray['fk_section_id'] = 'required';
		$formValid = false;		
	}
	
	/* Check email. 
	if(isset($_POST['internship_contact_email']) && trim($_POST['internship_contact_email']) != '') {
		if(!preg_match('/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/', trim($_POST['internship_contact_email']))) {
			$errorArray['internship_contact_email'] = 'Enter Valid email.';
		} 
	} else {
		$errorArray['internship_contact_email'] = 'Email missing.';
	}		
	*/
	
	if(trim($_POST['areaMap_path']) != '') { 
		$areaByName = $areaMapObject->getByFullPath(trim($_POST['areaMap_path']));
		if(count($areaByName) == 0) {
			$errorArray['areaMap_path'] = 'required';
			$formValid = false;				
		}
	}

	if(count($errorArray) == 0 && $formValid == true) {
		
		/* required. */
		$data['internship_title'] 			= trim($_POST['internship_title']);		
		$data['internship_appyLink']		= trim($_POST['internship_appyLink']);		
		$data['internship_link']			= StringToUrl($data['internship_title']);
		$data['internship_company'] 		= trim($_POST['internship_company']);		
		$data['internship_contact_name'] 	= trim($_POST['internship_contact_name']);				
		$data['internship_contact_email'] 	= trim($_POST['internship_contact_email']);		
		$data['internship_contact_number'] 	= trim($_POST['internship_contact_number']);		
		$data['internship_opening_date'] 	= (int)strtotime(trim($_POST['internship_opening_date'])) != 0 ? trim($_POST['internship_opening_date']) : '';		
		$data['internship_closing_date'] 	= (int)strtotime(trim($_POST['internship_closing_date'])) != 0 ? trim($_POST['internship_closing_date']) : '';	
		$data['internship_page'] 			= trim($_POST['internship_page']);		
		$data['internship_page'] 			= htmlspecialchars_decode(stripslashes(trim($_POST['internship_page'])));	
		$data['fk_section_id'] 				= trim($_POST['fk_section_id']);						
		$data['internship_active']			= isset($_POST['internship_active']) && trim($_POST['internship_active']) == 1 ? 1 : 0;
		$data['fk_area_id']					= isset($areaByName) && count($areaByName) > 0 ? $areaByName[0]['fkAreaId'] : '';		
		$data['internship_area'] 			= isset($areaByName) && count($areaByName) > 0 ? $areaByName[0]['areaMap_shortPath'] : '';	

		if(isset($internshipId) && $internshipId != '') {
			/*Update. */
			$where = $internshipObject->getAdapter()->quoteInto('pk_internship_id = ?', $internshipId);
			$success = $internshipObject->update($data, $where);		
		} else {
			$success = $internshipObject->insert($data);		
		}	
		
		if(is_numeric($success) && $success > 0) {							
			header('Location: /admin/resources/internships/');				
			exit;		
		}			
	}
	
	/* if we are here there are errors. */
	$smarty->assign('internshipData', $_POST);
	$smarty->assign('errorArray', $errorArray);	
}

$smarty->display('admin/resources/internships/details.tpl');

?>