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

require_once 'class/participant.php';
require_once 'class/areapost.php';

$participantObject = new class_participant();
$areapostObject = new class_areapost();

/**
  * If the item exists populate the form with data
  */
if (!empty($_GET['code']) && $_GET['code'] != '') {
	
	$code = trim($_GET['code']);
	
	$participantData = $participantObject->getByCode($code);
	
	if($participantData) {
		$smarty->assign('participantData', $participantData);
	}	
}

/* Check posted data. */
if(count($_POST) > 0) {

	$errorArray	= array();	
	$formValid	= true;
	$success		= NULL;
	
	if(isset($_POST['participant_name']) && trim($_POST['participant_name']) == '') {
		$errorArray['participant_name'] = 'Name required';
		$formValid = false;		
	}
	
	if(isset($_POST['participant_surname']) && trim($_POST['participant_surname']) == '') {
		$errorArray['participant_surname'] = 'Surname required';
		$formValid = false;		
	}
	
	/* Check email. */
	if(isset($_POST['participant_email']) && trim($_POST['participant_email']) != '') {
		if($participantObject->validateEmail(trim($_POST['participant_email'])) == '') {
			$errorArray['participant_email'] = 'Enter Valid email.';
			$formValid = false;	
		} 
	} else {
		$errorArray['participant_email'] = 'Email missing.';
		$formValid = false;	
	}
	
	if(isset($_POST['areapost_code']) && trim($_POST['areapost_code']) == '') {
		$errorArray['areapost_code'] = 'Area required';
		$formValid = false;		
	} else {
		$areapostData = $areapostObject->getByCode(trim($_POST['areapost_code']));
		
		if(!$areapostData) {
			$errorArray['areapost_code'] = 'Area required';
			$formValid = false;				
		}
	}
	
	if(count($errorArray) == 0 && $formValid == true) {
		
		/* required. */
		$data 									= array();
		$data['areapost_code'] 			= trim($_POST['areapost_code']);
		$data['participant_name'] 		= trim($_POST['participant_name']);
		$data['participant_surname']	= trim($_POST['participant_surname']);
		$data['participant_email']		= trim($_POST['participant_email']);	
		$data['participant_active']		= isset($_POST['participant_active']) && trim($_POST['participant_active']) == 1 ? 1 : 0;
		
		if(isset($participantData)) {
			/*Update. */
			$data['participant_code']		= $participantData['participant_code'];
			$where = $participantObject->getAdapter()->quoteInto('participant_code = ?', $code);
			$success = $participantObject->update($data, $where);
		} else {		
			$success = $participantObject->insertParticipant($data, 'EMAIL');			
		}

		header('Location: /participants/view/');				
		exit;		
			
	}
	
	/* if we are here there are errors. */
	$smarty->assign('errorArray', $errorArray);	
}

$smarty->display('participants/view/details.tpl');

?>