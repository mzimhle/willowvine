<?php

/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');

/** Standard includes */
require_once 'config/database.php';
require_once 'config/smarty.php';

require_once 'includes/auth.php';
require_once 'class/internship.php';
require_once 'class/File.php';

$internshipObject 	= new class_internship();
$enquiryObject		= new class_enquiry();
$fileObject				= new File(array('docx', 'doc', 'pdf', 'txt'));
	
if (isset($_GET['code']) && trim($_GET['code']) != '') {
	
	$code = trim($_GET['code']);
	
	$internshipData = $internshipObject->getByCode($code);
	
	if(!$internshipData) {
		header('Location: /');
		exit;
	}
	
	$smarty->assign('internshipData', $internshipData);
	
} else {
	header('Location: /');
	exit;
}

/* Check posted data. */
if(count($_POST) > 0) {

	$errorArray		= array();
	$data 				= array();
	$formValid		= true;
	$success			= NULL;
	
	if(isset($_POST['enquiry_name']) && trim($_POST['enquiry_name']) == '') {
		$errorArray[] = 'Full name required';
		$formValid = false;		
	}
	
	if(isset($_POST['enquiry_email']) && trim($_POST['enquiry_email']) != '') {
		if($internshipObject->validateEmail(trim($_POST['enquiry_email'])) == '') {
			$errorArray[] = 'Email needs to be a valid email address';
			$formValid = false;	
		}
	} else {
		$errorArray[] = 'Email required';
		$formValid = false;			
	}
	
	if(isset($_POST['enquiry_message']) && trim($_POST['enquiry_message']) == '') {
		$errorArray[] = 'Message required';
		$formValid = false;		
	}

	if(isset($_FILES['cvdocument'])) {
		/* Check validity of the CV. */
		if((int)$_FILES['cvdocument']['size'] != 0 && trim($_FILES['cvdocument']['name']) != '') {
			/* Check if its the right file. */
			$ext = $fileObject->file_extention($_FILES['cvdocument']['name']); 

			if($ext != '') {				
				$checkExt = $fileObject->getValidateExtention('cvdocument', $ext);				
				if(!$checkExt) {
					$errorArray[] = 'Invalid file type something funny with the file format';
					$formValid = false;						
				} else {
					/* Check width and height */
					$cvdocument = $fileObject->getValidateSize($_FILES['cvdocument']['size']);
					
					if(!$cvdocument) {
						$errorArray[] = 'File needs to be less than 2MB.';
						$formValid = false;							
					}
				}
			} else {
				$errorArray[] = 'Invalid file type';
				$formValid = false;									
			}
		} else {			
			switch((int)$_FILES['cvdocument']['error']) {
				case 1 : $errorArray[] = 'The uploaded file exceeds the maximum upload file size, should be less than 1M'; $formValid = false; break;
				case 2 : $errorArray[] = 'File size exceeds the maximum file size'; $formValid = false; break;
				case 3 : $errorArray[] = 'File was only partically uploaded, please try again'; $formValid = false; break;
				case 4 : $errorArray[] = 'No file was uploaded'; $formValid = false; break;
				case 6 : $errorArray[] = 'Missing a temporary folder'; $formValid = false; break;
				case 7 : $errorArray[] = 'Faild to write file to disk'; $formValid = false; break;
			}
		}
	}
	
	if(count($errorArray) == 0 && $formValid == true) {
		
		$data 	= array();				
		$data['enquiry_name']			= trim($_POST['enquiry_name']);		
		$data['enquiry_email']			= $internshipObject->validateEmail(trim($_POST['enquiry_email']));	
		$data['enquiry_message']		= trim($_POST['enquiry_message']);			
		$data['enquiry_reference']		= $internshipData['internship_code'];
		$data['enquiry_type']				= 'INTERNSHIP';
		
		$ext 			= strtolower($fileObject->file_extention($_FILES['cvdocument']['name']));					
		$filename	= $fileObject->getRandomFileName($internshipData['internship_code']).'.'.$ext;
		$directory	= $_SERVER['DOCUMENT_ROOT'].'/media/internships/'.$internshipData['internship_code'].'/application/';
		$file			= $directory.'/'.$filename;	
		
		if(!is_dir($directory)) mkdir($directory, 0777, true);
		
		if(file_put_contents($file, file_get_contents($_FILES['cvdocument']['tmp_name']))) {
		
			$data['enquiry_file_path']	= '/media/internships/'.$internshipData['internship_code'].'/application/'.$filename;
			$data['enquiry_file_name']	= trim($_FILES['cvdocument']['name']);

			$success = $enquiryObject->insert($data);	
			
			if($success) {
				/* Send out application. */
				$enquiryData = $enquiryObject->getByCode($success, 'INTERNSHIP');
				
				if($enquiryData) {
					
					$to = array();
					$to[] = array('name' =>$enquiryData['enquiry_name'], 'email' => $enquiryData['enquiry_email']);
					$to[] = array('name' =>$internshipData['internship_poster_name'], 'email' => $internshipData['internship_poster_email']);
					
					$enquirysuccess = $enquiryObject->_comm->sendEnquiry('templates/mail/enquiry_internship.html', $enquiryData, 'Willowvine Internship Application: '.$internshipData['internship_name'], $to);
					
					if($enquirysuccess) {
						$smarty->assign('success', $success);
					}
				} else {
					$errorArray[] = 'Could not save the application, please try again.';
				}
			} else {
				$errorArray[] = 'Faild to add the file';
			}
			
		} else {
			$errorArray[] = 'could not upload file, please try again';
			$formValid = false;			
		}
	}
	
	/* if we are here there are errors. */
	if(count($errorArray) != 0) $smarty->assign('errorArray', implode(', ', $errorArray));	

}


 /* Display the template */	
$smarty->display('internships/details.tpl');
?>