<?php
/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR .$_SERVER['DOCUMENT_ROOT'].'/library/classes/');

/* Standard includes */
require_once 'config/setup.php';
require_once 'includes/auth.php';

/* Classes. */
require_once 'class/areaMap.php';
require_once 'class/section.php';

/* Object. */
$areaMapObject		= new class_areaMap();
$sectionObject		= new class_section();

 /* Pairs. */
$areaMapOptions = $areaMapObject->areaMapPairsByType();
$sectionOptions = $sectionObject->sectionWithJobsPairs();

$smarty->assign('areaMapOptions', $areaMapOptions);
$smarty->assign('sectionOptions', $sectionOptions);

if(isset($_POST) && count($_POST) > 0) {
	$errorMessages = array();
	/* Get post data. */
	/* Check email. */
	if(isset($_POST['enquiry_email']) && trim($_POST['enquiry_email']) != '') {
		if(!preg_match('/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/', trim($_POST['enquiry_email']))) {
			$errorMessages['enquiry_email'] = 'Enter Valid email.';
		} 
	} else {
		$errorMessages['enquiry_email'] = 'Email missing.';
	}
	
	/* Check name. */
	if(isset($_POST['enquiry_name']) && trim($_POST['enquiry_name']) == '') {
		$errorMessages['enquiry_name'] = 'Name missing.';
	}
	
	/* Check comments. */
	if(isset($_POST['enquiry_comments']) && trim($_POST['enquiry_comments']) == '') {
		$errorMessages['enquiry_comments'] = 'Message missing.';
	}	
	
	/* For 'enquiry_location'. */
	if(isset($_POST['areaName']) && trim($_POST['areaName']) == '') {
		$errorMessages['areaName'] = 'Enter your area';
	} else {
		/* Get Id, by areaName. */
		$areaData = $areaMapObject->getByFullPath(trim($_POST['areaName']));
		if(count($areaData) == 0) {
			$errorMessages['areaName'] = 'Please select area from given list';
		} 
	}	
	
	if(count($errorMessages) == 0) {
		/* Get the class. */
		require_once 'class/enquiry.php';
		
		/* Object. */
		$enquiryObject = new class_enquiry();
		
		/* Data. */
		$data = array();
		$data['enquiry_name'] 				= strtolower(trim($_POST['enquiry_name']));
		$data['enquiry_email']				= trim($_POST['enquiry_email']);
		$data['enquiry_number']				= isset($_POST['enquiry_number']) ? trim($_POST['enquiry_number']) : '';
		$data['enquiry_comments'] 			= trim($_POST['enquiry_comments']);
		$data['fkAreaId']					= $areaData[0]['fkAreaId'];
		$data['enquiry_reference']			= 'ENQUIRY_'.rand(100, 100000).md5($data['enquiry_email']);
		
		$success = $enquiryObject->insert($data);
		
		if(is_numeric($success)) {
			$data['areaName']	= trim($_POST['areaName']);
			/* Data to be used for the email. */
			$smarty->assign('data', $data);
				
			/* Send email to the registered user. */
			/* Send to the recruiter emails. */
			require('Zend/Mail.php');
		
			$mail = new Zend_Mail();
					
			/* Send Job to the Enquiring person. */		

			$message = $smarty->fetch('emails/enquiry.html');	
			/*
			$mail->setFrom('no-reply@willowvine.co.za' , 'Willowvine Admin'); //EDIT!!											
			$mail->addTo($data['enquiry_email']); 									
			$mail->addTo('willowvine.enquiry@gmail.com'); 	
			$mail->setSubject('Willowvine - Enquiry Confirmation');
			$mail->setBodyHtml($message);
			$mail->send();	
			
			$mail = NULL;			
			*/
			/* Redirect links. */
			$smarty->assign('enquiryData_success', $data);
			$data = $mail = $_POST = $errorMessages = NULL;			
		}
	}
	
	$smarty->assign('enquiryData', $_POST);
	$smarty->assign('errorMessages', $errorMessages);	
}

$smarty->display('contact_us/default.tpl');
?>