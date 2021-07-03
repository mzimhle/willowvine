<?php
/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');

if(count($_POST) > 0 && isset($_POST['jobSeeker_name'])) {

	/* standard config include. */
	require_once 'config/setup.php';
	require_once 'functions.php';
	require_once 'includes/auth.php';
	
	/* Classes. */
	require_once 'class/areaMap.php';
	require_once 'class/jobSeeker.php';
	require_once 'class/jobSeekerCV.php';

	/* Object. */
	$areaMapObject		= new class_areaMap();
	$jobSeekerObject	= new class_jobSeeker();
	$jobSeekerCVObject	= new class_jobSeekerCV();

	$data = array();
	$errorMessages = array();
	
	/* Check name. */
	if(isset($_POST['jobSeeker_name']) && trim($_POST['jobSeeker_name']) == '') {
		$errorMessages['jobSeeker_name'] = 'Name missing.';
	}	
	
	/* Check email. */
	if(isset($_POST['jobSeeker_email']) && trim($_POST['jobSeeker_email']) != '') {
		if(preg_match('/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/', trim($_POST['jobSeeker_email']))) {
		
			/* Check if email exists. */
			$emailConfirm = $jobSeekerObject->getByEmail(trim($_POST['jobSeeker_email']));

			if(count($emailConfirm) > 0) {
				/* Email exists. */
				$errorMessages['jobSeeker_email'] = 'Email already used.';
			}
		} else {
			$errorMessages['jobSeeker_email'] = 'Enter Valid email.';
		} 
	} else {
		$errorMessages['jobSeeker_email'] = 'Email missing.';
	}

	if(isset($_POST['areaName']) && trim($_POST['areaName']) == '') {
		$errorMessages['areaName'] = 'Enter your area.';
	} else {
		/* Get Id, by areaName. */
		$areaData = $areaMapObject->getByFullPath(trim($_POST['areaName']));
		if(count($areaData) == 0) {
			$errorMessages['areaName'] = 'Select from list.';
		} 
	}
	
	if((isset($_POST['jobSeeker_password']) && trim($_POST['jobSeeker_password']) == '') OR (isset($_POST['jobSeeker_password_2']) && trim($_POST['jobSeeker_password_2']) == '')) {
		$errorMessages['jobSeeker_password'] = 'Please enter password on both fields.';
	} else {
		if(strtolower (trim($_POST['jobSeeker_password'])) != strtolower (trim($_POST['jobSeeker_password_2']))) {
			$errorMessages['jobSeeker_password'] = 'Passwords must be the same.';
		}
	}
	
	if(!isset($_FILES['jobSeekerCV'])) {
		$errorMessages['jobSeekerCV'] = 'Please upload CV.';
	}

	if(count($errorMessages) == 0) {
	
		$data['jobSeeker_name'] 			= strtolower(trim($_POST['jobSeeker_name']));
		$data['jobSeeker_email']			= trim($_POST['jobSeeker_email']);
		$data['jobSeeker_password'] 		= trim($_POST['jobSeeker_password']);
		$data['fkAreaId']					= $areaData[0]['fkAreaId'];		
		$data['jobSeeker_registrationCode'] = GenerateMD5Code(trim($_POST['jobSeeker_email']));
		$data['jobSeeker_reference']		= $jobSeekerObject->createReference();			
		
		/* Check if there is a CV. */
		if(isset($_FILES['jobSeekerCV']) && trim($_FILES['jobSeekerCV']['name']) != '') {
		
			/* Check size. */
			if((int)$_FILES['jobSeekerCV']['size'] < 131072 && (int)$_FILES['jobSeekerCV']['size'] != 0) {
				/* Check if its the right file. */
				if($_FILES['jobSeekerCV']['type'] == 'text/plain' || 
					$_FILES['jobSeekerCV']['type'] == 'application/pdf' || 
						$_FILES['jobSeekerCV']['type'] == 'application/msword' || 
							$_FILES['jobSeekerCV']['type'] == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document') {
								/* upload the CV. */
									/* Create folder in /media/jobSeeker/cv/ using reference. */
									$directory	= $_SERVER['DOCUMENT_ROOT']."/media/jobSeeker/cv/".$data['jobSeeker_reference'];
									$file		= $_SERVER['DOCUMENT_ROOT']."/media/jobSeeker/cv/".$data['jobSeeker_reference'].'/'.$data['jobSeeker_reference'].'.'.end(explode('.', $_FILES['jobSeekerCV']['name']));
									
									/* Create directory. */
									if(!is_dir($directory)) mkdir($directory, 0777);
									/* Now lets upload to this directory. */
									if(move_uploaded_file($_FILES['jobSeekerCV']['tmp_name'], $file)) {
										/* File uploaded, save record on database. */	
										$dataCV = array();
										$dataCV['jobSeekerCV_filename'] = $data['jobSeeker_reference'].'.'.end(explode('.', $_FILES['jobSeekerCV']['name']));
										$dataCV['jobSeekerCV_primary'] 	= 1;
										$dataCV['fkJobSeekerReference'] = $data['jobSeeker_reference'];
										$dataCV['jobSeekerCV_userName'] = trim($_FILES['jobSeekerCV']['name']);										
										$dataCV['fkSectionId']			= isset($_POST['fkSectionId']) ? implode(",", $_POST['fkSectionId']) : '';
										
										/* Convert to simple words afterwards. if its not pdf. */
										if($_FILES['jobSeekerCV']['type'] != 'application/pdf') $dataCV['jobSeekerCV_cvContent'] =  parseWord($file);				
										
										/* Insert new jobSeeker afterwards. */
										$success = $jobSeekerCVObject->insert($dataCV);
																				
									} else {
										$errorMessages['jobSeekerCV'] = 'Could not upload at this time, please try again.';
									}
							} else {
								$errorMessages['jobSeekerCV'] = 'CV must be .text, .doc or .docx.';
							}
			} else {
				$errorMessages['jobSeekerCV'] = 'CV must be less than 1 Megabyte and not empty.';
			}
		} else {
			$errorMessages['jobSeekerCV'] = 'Please upload CV.';
		}
		//print_r($errorMessages); print_r($_FILES); exit;
		if(count($errorMessages) == 0) {	
			/* Insert data. */
			$jobSeekerId = $jobSeekerObject->insert($data);
			/* Data to be used for the email. */
			$smarty->assign('registerData', $data);
				
			/* Send email to the registered user. */
			/* Send to the recruiter emails. */
			require('Zend/Mail.php');
			
			$mail = new Zend_Mail();
					
			/* Send Job to the Enquiring person. */		
			$message = $smarty->fetch('emails/jobSeeker_registration.html');	
			
			$mail->setFrom('no-reply@willowvine.co.za' , 'Willowvine'); //EDIT!!											
			$mail->addTo($data['jobSeeker_email']);
			$mail->setSubject('Willowvine - Registration Confirmation');
			$mail->setBodyHtml($message);
			$mail->send();	
			
			$mail = NULL; UNSET($mail);			
			
			/* Success. */
			$smarty->assign('jobSeekerRegister_success', 1);
		}
	}

	/* There is an error if we are here. */
	$smarty->assign('registerData', $_POST);
	$smarty->assign('errorMessages', $errorMessages);

	/* Clean up. */
	$data = $errorMessages = $_POST = $dataCV = $_FILES =  $areaMapObject = $sectionObject = $jobSeekerObject = $jobSeekerCVObject = null;
	unset($data,$errorMessages,$_POST,$dataCV,$_FILES, $areaMapObject,$sectionObject,$jobSeekerObject,$jobSeekerCVObject);	
}

?>