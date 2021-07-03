<?php
/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');

/* to scrape: http://www.crsolutions.co.za/ */

/**
 * Standard includes
 */
require_once 'config/database.php';
require_once 'config/smarty.php';

/**
 * Check for login
 */
require_once 'includes/auth.php';

/* objects. */
require_once 'class/spam.php';
require_once 'class/areapost.php';

$spamObject = new class_spam();
$areapostObject = new class_areapost();

/**
  * If the item exists populate the form with data
  */
if (!empty($_GET['code']) && $_GET['code'] != '') {
	
	$code = trim($_GET['code']);
	
	$spamData = $spamObject->getByCode($code);

	if($spamData) {
		$smarty->assign('spamData', $spamData);
	} else {
		header('Location: /resources/spam/');
		exit;
	}
}

/* Check posted data. */
if(count($_POST) > 0) {

	$errorArray	= array();	
	$formValid	= true;
	$success		= NULL;
	
	if(isset($_POST['spam_name']) && trim($_POST['spam_name']) == '') {
		$errorArray['spam_name'] = 'Name required';
		$formValid = false;		
	}	
	
	/* Check email. */
	if(isset($_POST['spam_email']) && trim($_POST['spam_email']) != '') {
		if($spamObject->validateEmail(trim($_POST['spam_email'])) == '') {
			$errorArray['spam_email'] = 'Enter Valid email.';
		} else {
			
			$tempcode = isset($spamData) ? $spamData['spam_code'] : null;
			
			$tempData = $spamObject->getByEmail(trim($_POST['spam_email']), $tempcode);

			if($tempData) {
				$errorArray['spam_email'] = 'Email already being used';
				$formValid = false;				
			}			
		}
	}
	
	if(isset($_POST['spam_cellphone']) && trim($_POST['spam_cellphone']) != '') {
		if($spamObject->validateCell(trim($_POST['spam_cellphone'])) == '') {
			$errorArray['spam_cellphone'] = 'Enter valid cellphone number.';
		} else {
			
			$tempcode = isset($spamData) ? $spamData['spam_code'] : null;
			
			$tempData = $spamObject->getByCell(trim($_POST['spam_cellphone']), $tempcode);

			if($tempData) {
				$errorArray['spam_cellphone'] = 'Cellphone already being used';
				$formValid = false;				
			}			
		}
	}
	
	if(isset($_POST['spam_fax']) && trim($_POST['spam_fax']) != '') {
		if($spamObject->validateCell(trim($_POST['spam_fax'])) == '') {
			$errorArray['spam_fax'] = 'Enter valid fax number.';
		}
	}
	
	if(isset($_POST['areapost_code']) && trim($_POST['areapost_code']) != '') {

		$areapostData = $areapostObject->getByCode(trim($_POST['areapost_code']));
		
		if(!$areapostData) {
			$errorArray['areapost_code'] = 'Area required';
			$formValid = false;				
		}
	}
	
	if(count($errorArray) == 0 && $formValid == true) {
		
		/* required. */
		$data 								= array();
		$data['spam_name'] 			= trim($_POST['spam_name']);		
		$data['spam_email']			= trim($_POST['spam_email']);
		$data['spam_cellphone'] 	= trim($_POST['spam_cellphone']);
		$data['spam_fax'] 				= trim($_POST['spam_fax']);
		$data['spam_address'] 		= trim($_POST['spam_address']);
		$data['areapost_code']		= trim($_POST['areapost_code']);			
		
		if(isset($spamData)) {
			/*Update. */
			$data['spam_code']		= $spamData['spam_code'];
			$where = $spamObject->getAdapter()->quoteInto('spam_code = ?', $code);
			$success = $spamObject->update($data, $where);
		} else {		
			$success = $spamObject->insert($data);			
		}

		header('Location: /resources/spam/');				
		exit;		
			
	}
	
	/* if we are here there are errors. */
	$smarty->assign('errorArray', $errorArray);	
}

$smarty->display('resources/spam/details.tpl');

?>