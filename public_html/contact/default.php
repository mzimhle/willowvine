<?php

/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');

/** Standard includes */
require_once 'config/database.php';
require_once 'config/smarty.php';

require_once 'includes/auth.php';
require_once 'class/enquiry.php';

$enquiryObject		= new class_enquiry();
	

/* Check posted data. */
if(count($_POST) > 0) {

	$data 							= array();
	$errorArray					= array();
	$errorArray['message']	= array();
	$errorArray['result']		= true;
	
	if(isset($_POST['enquiry_name']) && trim($_POST['enquiry_name']) == '') {
			$errorArray['message'][] = 'Fullname is required';
			$errorArray['result'] = false;		
	}
	
	if(isset($_POST['areapost_code']) && trim($_POST['areapost_code']) == '') {
		$errorArray['message'][] = 'Your area is required';
		$errorArray['result'] = false;	
	}
	
	if(isset($_POST['enquiry_email']) && trim($_POST['enquiry_email']) != '') {
		if($enquiryObject->validateEmail(trim($_POST['enquiry_email'])) == '') {
		$errorArray['message'][] = 'Your email needs to be valid';
		$errorArray['result'] = false;	

		}
	} else {
		$errorArray['message'][] = 'Your email is required';
		$errorArray['result'] = false;			
	}
	
	if(isset($_POST['enquiry_message']) && trim($_POST['enquiry_message']) == '') {
		$errorArray['message'][] = 'Your message is required';
		$errorArray['result'] = false;		
	}
	
	if(!isset($_POST['action'])) {
		if(count($errorArray['message']) == 0 && $errorArray['result'] == true) {
			
			$data 	= array();				
			$data['enquiry_name']		= trim($_POST['enquiry_name']);		
			$data['enquiry_email']		= $enquiryObject->validateEmail(trim($_POST['enquiry_email']));	
			$data['enquiry_message']	= trim($_POST['enquiry_message']);			
			$data['areapost_code']		= trim($_POST['areapost_code']);			
			$data['participant_code']	= isset($paritcipantloginData) && trim($participantloginData['participant_code']) != '' ? trim($participantloginData['participant_code']) : null;		
			$data['enquiry_type']			= 'ENQUIRY';

			$success = $enquiryObject->insert($data);

			if($success) {
				/* Send out application. */
				$enquiryData = $enquiryObject->getByCode($success, 'ENQUIRY');

				if($enquiryData) {
					
					$to = array();
					$to[] = array('name' =>	$enquiryData['enquiry_name'], 'email' => $enquiryData['enquiry_email']);
					$to[] = array('name' =>	'Willowvine', 'email' => 'info@willowvine.co.za');
					
					$enquirysuccess = $enquiryObject->_comm->sendEnquiry('templates/mail/enquiry.html', $enquiryData, 'Willowvine Enquiry', $to);

					if($enquirysuccess) {
						$smarty->assign('success', $success);
					} else {
						$errorArray['message'][] = 'We could not send the email, please connect to the internet. ';
						$errorArray['result'] = false;							
					}
				} else {
					$errorArray['message'][] = 'Could not save the application, please try again.';
					$errorArray['result'] = false;		
				}
			} else {
				$errorArray['message'][] = 'Please try again.';
				$errorArray['result'] = false;		
			}
		}
	} else {
		echo json_encode($errorArray);
		die();
	}
	if(count($errorArray['message']) != 0) $smarty->assign('errorArray', implode(', ', $errorArray['message']));		
}


 /* Display the template */	
$smarty->display('contact/default.tpl');
?>