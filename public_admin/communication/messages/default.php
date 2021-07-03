<?php

/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');

/*** Standard includes */
require_once 'config/database.php';
require_once 'config/smarty.php';

/**
 * Check for login
 */
require_once 'includes/auth.php';
require_once 'class/_message.php';

$messageObject = new class_message();
 
 if(isset($_GET['delete_code'])) {
	
	$errorArray				= array();
	$errorArray['error']	= '';
	$errorArray['result']	= 0;	
	$formValid				= true;
	$success					= NULL;
	$code						= trim($_GET['delete_code']);
		
	if($errorArray['error']  == '' && $errorArray['result']  == 0 ) {
		$data	= array();
		$data['_message_deleted'] = 1;
		
		$where = $messageObject->getAdapter()->quoteInto('_message_code = ?', $code);
		$success	= $messageObject->update($data, $where);	
		
		if(is_numeric($success) && $success > 0) {
			$errorArray['error']	= '';
			$errorArray['result']	= 1;			
		} else {
			$errorArray['error']	= 'Could not delete, please try again.';
			$errorArray['result']	= 0;				
		}
	}
	
	echo json_encode($errorArray);
	exit;
}

 
 if(isset($_GET['status_code']) && isset($_GET['status'])) {
	
	$errorArray				= array();
	$errorArray['error']	= '';
	$errorArray['result']	= 1;	
	$formValid				= true;
	$success					= NULL;
	$code						= trim($_GET['status_code']);
	$status						= trim($_GET['status']);
	
	if($code != '') {
	
		$messageData = $messageObject->getByCode($code);
		
		if($messageData) {
			if(trim($messageData['_message_type']) == 'EMAIL'){
				if(isset($_POST['_message_subject']) && trim($messageData['_message_subject']) == '') {
					$errorArray['error']  = 'Please add a subject first';
					$errorArray['result']  = 0;	
				}

				if(isset($messageData['_message_file']) && trim($messageData['_message_file']) == '') {
					$errorArray['error']  = 'Please add a html file template first';
					$errorArray['result']  = 0;		
				}
			} else if(trim($messageData['_message_type']) == 'SMS'){
				if(isset($messageData['_message_text']) && trim($messageData['_message_text']) == '') {
					$errorArray['error']  = 'Please add a text message to send';
					$errorArray['result']  = 0;		
				} else if(strlen(trim($messageData['_message_text'])) < 160) {
					$errorArray['error']  = 'Text message needs to be less than 160 characters';
					$errorArray['result']  = 0;		
				}
			}		
		} else {
			$errorArray['error']  = 'Please select a valid message';
			$errorArray['result']  = 0;
		}
	} else {
		$errorArray['error']  = 'Please select a message';
		$errorArray['result']  = 0;
	}
	
	if($errorArray['error']  == '' && $errorArray['result']  == 1) {
		$data	= array();
		$data['_message_active'] = 1;
		
		$where = $messageObject->getAdapter()->quoteInto('_message_code = ?', $code);
		$success	= $messageObject->update($data, $where);	
		
		if(is_numeric($success) && $success > 0) {
			$errorArray['error']	= '';
			$errorArray['result']	= 1;			
		} else {
			$errorArray['error']	= 'Could not delete, please try again.';
			$errorArray['result']	= 0;				
		}
	}
	
	echo json_encode($errorArray);
	exit;
}

/* Setup Pagination. */
$messageData = $messageObject->getAll("_message_deleted = 0 and _message_type = 'EMAIL'",'_message._message_added');
if($messageData) $smarty->assign_by_ref('messageData', $messageData);

/* End Pagination Setup. */

$smarty->display('communication/messages/default.tpl');
?>