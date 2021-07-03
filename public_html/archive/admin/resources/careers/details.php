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
$sectionObject = new class_section();

/* Get Pairs. */
$sectionPairs = $sectionObject->sectionPairs();

if(count($sectionPairs) > 0) {
	$smarty->assign('sectionPairs', $sectionPairs);
}

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
	
	if(isset($_POST['career_title']) && trim($_POST['career_title']) == '') {
		$errorArray['career_title'] = 'required';
		$formValid = false;		
	}	else {
		/* Check if it exists. */
		$careerName = $careerObject->checkCareerExists(trim($_POST['career_title']));
		if(!isset($careerData) && $careerName != '') {
			$errorArray['career_title'] = 'required';
			$formValid = false;					
		}
	}
	
	if(isset($_POST['career_subjects']) && trim($_POST['career_subjects']) == '') {
		$errorArray['career_subjects'] = 'required';
		$formValid = false;		
	}
	
	if(isset($_POST['career_page']) && trim($_POST['career_page']) == '') {
		$errorArray['career_page'] = 'required';
		$formValid = false;		
	}
	
	if(isset($_POST['fk_section_id']) && (int)trim($_POST['fk_section_id']) == 0) {
		$errorArray['fk_section_id'] = 'required';
		$formValid = false;		
	}
	
	if(count($errorArray) == 0 && $formValid == true) {
		
		/* required. */
		$data['career_title'] 			= trim($_POST['career_title']);		
		$data['career_link']			= StringToUrl($data['career_title']);
		$data['career_extLink'] 		= trim($_POST['career_extLink']);		
		$data['career_page'] 			= htmlspecialchars_decode(stripslashes(trim($_POST['career_page'])));	
		$data['fk_section_id'] 			= trim($_POST['fk_section_id']);						
		$data['career_active']			= isset($_POST['career_active']) && trim($_POST['career_active']) == 1 ? 1 : 0;

		if(isset($careerId) && $careerId != '') {
			/*Update. */
			$where = $careerObject->getAdapter()->quoteInto('pk_career_id = ?', $careerId);
			$success = $careerObject->update($data, $where);
			
			if(is_numeric($success) && $success > 0) {							
				header('Location: /admin/resources/careers/education.php?pk_career_id='.$careerId);				
				exit;		
			}			
		} else {
			$success = $careerObject->insert($data);	
			
			if(is_numeric($success) && $success > 0) {							
				header('Location: /admin/resources/careers/education.php?pk_career_id='.$success);				
				exit;		
			}		
		}				
	}
	
	/* if we are here there are errors. */
	$smarty->assign('careerData', $_POST);
	$smarty->assign('errorArray', $errorArray);	
}

$smarty->display('admin/resources/careers/details.tpl');

?>