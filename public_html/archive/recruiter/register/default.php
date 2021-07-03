<?php
/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');

/* standard config include. */
require_once 'config/setup.php';
require_once 'functions.php';
require_once 'includes/auth.php';

/* Classes. */
require_once 'class/areaMap.php';
require_once 'class/section.php';
require_once 'class/recruiter.php';

/* Object. */
$areaMapObject		= new class_areaMap();
$sectionObject		= new class_section();
$recruiterObject	= new class_recruiter();
 
 /* Pairs. */
$areaMapOptions = $areaMapObject->areaMapPairsByType();
$sectionOptions = $sectionObject->sectionWithJobsPairs();


if(count($_POST) > 0) {
	
	$data = array();
	$errorMessages = array();
	
	/* Check name. */
	if(isset($_POST['recruiter_name']) && trim($_POST['recruiter_name']) == '') {
		$errorMessages['recruiter_name'] = 'Name missing.';
	}
	
	/* Check email. */
	if(isset($_POST['recruiter_email']) && trim($_POST['recruiter_email']) != '') {
		if(preg_match('/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/', trim($_POST['recruiter_email']))) {
		
			/* Check if email exists. */
			$emailConfirm = $recruiterObject->getByEmail(trim($_POST['recruiter_email']));

			if(count($emailConfirm) > 0) {
				/* Email exists. */
				$errorMessages['recruiter_email'] = 'Email already used.';
			}
		} else {
			$errorMessages['recruiter_email'] = 'Enter Valid email.';
		} 
	} else {
		$errorMessages['recruiter_email'] = 'Email missing.';
	}

	if(isset($_POST['fkAreaId']) && (int)trim($_POST['fkAreaId']) == 0) {
		$errorMessages['fkAreaId'] = 'Enter your city/town.';
	}	
	
	if((isset($_POST['recruiter_password']) && trim($_POST['recruiter_password']) == '') OR (isset($_POST['recruiter_password_2']) && trim($_POST['recruiter_password_2']) == '')) {
		$errorMessages['recruiter_password'] = 'Please enter password on both fields.';
	} else {
		if(strtolower (trim($_POST['recruiter_password'])) != strtolower (trim($_POST['recruiter_password_2']))) {
			$errorMessages['recruiter_password'] = 'Passwords must be the same.';
		}
	}
	
	if(count($errorMessages) == 0) {
	
		$data['recruiter_name'] 	= strtolower(trim($_POST['recruiter_name']));
		$data['recruiter_number']	= isset($_POST['recruiter_number']) && trim($_POST['recruiter_number']) != '' ? trim($_POST['recruiter_number']) : '';
		$data['recruiter_address']	= isset($_POST['recruiter_address']) && trim($_POST['recruiter_address']) != '' ? strtolower(trim($_POST['recruiter_address'])) : '';
		$data['recruiter_email']	= trim($_POST['recruiter_email']);
		$data['recruiter_password'] = trim($_POST['recruiter_password']);
		$data['fkAreaId']			= (int)trim($_POST['fkAreaId']);
		
		$data['recruiter_registrationCode'] = GenerateMD5Code(trim($_POST['recruiter_email']));
		$data['recruiter_reference']		= $recruiterObject->createReference();		
		
		//print_r($errorMessages); print_r($_FILES); exit;
		if(count($errorMessages) == 0) {
			/* Insert data. */
			$recruiterId = $recruiterObject->insert($data);
			/* Data to be used for the email. */
			$smarty->assign('data', $data);
				
			/* Send email to the registered user. */
			/* Send to the recruiter emails. */
			//require('Zend/Mail.php');
		
			//$mail = new Zend_Mail();
					
			/* Send Job to the Enquiring person. */		
			/*
			$message = $smarty->fetch('emails/recruiter_registration.html');	
			
			$mail->setFrom('no-reply@willowvine.co.za' , 'Willowvine Email Confirmation'); //EDIT!!											
			$mail->addTo($data['recruiter_email']); 									
			$mail->setSubject('Willowvine - Email Confirmation Notice');
			$mail->setBodyHtml($message);
			$mail->send();	
			
			$mail = NULL;			
			*/
			/* Redirect links. */
			header('Location: /recruiter/register/complete.php?jsk='.$data['recruiter_reference']);
			exit;		
		}
	}
	
	/* There is an error if we are here. */
	$smarty->assign('data', $_POST);
	$smarty->assign('errorMessages', $errorMessages);
}

$smarty->assign('areaMapOptions', $areaMapOptions);
$smarty->assign('sectionOptions', $sectionOptions);

/* Clean up. */
$data = $errorMessages = $_POST = $dataCV = $_FILES =  $areaMapObject = $sectionObject = $recruiterObject = $recruiterCVObject = null;
unset($data,$errorMessages,$_POST,$dataCV,$_FILES, $areaMapObject,$sectionObject,$recruiterObject,$recruiterCVObject);

/* 
 * display template
 */
$smarty->display('recruiter/register/default.tpl');
?>