<?php
/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');
//standard config include.
require_once 'config/setup.php';
require_once 'includes/auth.php';
require_once 'functions.php';
require_once 'includes/shortlist.php';

/* Classes. */
require_once 'class/job.php';
require_once 'class/jobApplication.php';
require_once 'class/areaMap.php';

//$slsession->jobs);

/* Check if property reference exists. */
$jobReference		= (isset($_GET['jobReference']) && trim($_GET['jobReference']) !='' ) ? trim($_GET['jobReference']) : '';
$searchJob			= (isset($_GET['searchJob']) && trim($_GET['searchJob']) !='' ) ? trim($_GET['searchJob']) : '';
$searchArea			= (isset($_GET['searchArea']) && trim($_GET['searchArea']) !='' ) ? trim($_GET['searchArea']) : '';
$page				= (isset($_GET['page']) && trim($_GET['page']) !='' ) ? trim($_GET['page']) : '';
$sectionId			= (isset($_GET['sectionId']) && (int)trim($_GET['sectionId']) != 0 ) ? trim($_GET['sectionId']) : '';

$smarty->assign('searchJob', $searchJob);
$smarty->assign('searchArea', $searchArea);
$smarty->assign('page', $page);
$smarty->assign('sectionId', $sectionId);

if($jobReference != '') {
	/* Create object. */
	$jobObject = new class_job();
	
	/* Get job by reference. */
	$jobData = $jobObject->getByReference($jobReference);
	
	/* Check if job exists. */
	if(count($jobData) == 1) {
		$jobData[0]['shortlist'] = in_array((int)$jobData[0]['job_reference'], $slsession->jobs) ? 1 : 0; 
		$smarty->assign('jobData', $jobData[0]);
		$smarty->assign('jobReference', $jobReference);
	} else {
		/* Redirect to the details page. */
		header('Location: /errors/404/');	
		exit;	
	}
} else {
		/* Redirect to the details page. */
		header('Location: /errors/404/');			
		exit;	
}

/* Get Area Details. */
$areaMapObject = new class_areaMap();

/* Get by job area. */

$areaData = $areaMapObject->fetchByShortPath(str_replace(' ', '', strtolower($jobData[0]['job_area'])));
if(count($areaData) > 0) { 
	/* Get view. */
	$areaData['polyDataName'] = str_replace(' ', '', strtolower($areaData['areaMap_name']));
	$smarty->assign('areaData', $areaData);	
}

if(count($_POST) > 0 && count($jobData) == 1) {
	$data = array();
	$errorMessages = array();
	
	/* Check name. */
	if(isset($_POST['jobApplication_name']) && trim($_POST['jobApplication_name']) == '') {
		$errorMessages['jobApplication_name'] = 'Name missing.';
	}
	
	/* Check email. */
	if(isset($_POST['jobApplication_email']) && trim($_POST['jobApplication_email']) != '') {
		if(!preg_match('/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/', trim($_POST['jobApplication_email']))) {
			$errorMessages['jobApplication_email'] = 'Enter Valid email.'; 
		}
	} else {
		$errorMessages['jobApplication_email'] = 'Email missing.';
	}	
	
	/* Check comment. */
	if(isset($_POST['jobApplication_comments']) && trim($_POST['jobApplication_comments']) == '') {
		$errorMessages['jobApplication_comments'] = 'Comments missing.';
	}	
	
	/* Check CV. */	
	if (!isset($userData)) {
		if(isset($_FILES['applicationCV1']) && trim($_FILES['applicationCV1']['name']) == '') { 
			$errorMessages['applicationCV1'] = 'Please upload CV.';
		} else {
			/* Check validity of the CV. */
				if((int)$_FILES['applicationCV1']['size'] < 131072 && (int)$_FILES['applicationCV1']['size'] != 0) {
									/* Check if its the right file. */
					if($_FILES['applicationCV1']['type'] == 'text/plain' || 
						$_FILES['applicationCV1']['type'] == 'application/pdf' || 
							$_FILES['applicationCV1']['type'] == 'application/msword' || 
								$_FILES['applicationCV1']['type'] == 'application/docx') { /* Do nothing. */ } 
								else {
									$errorMessages['applicationCV1'] = 'CV must be .pdf, .doc, docx or .txt';
								}
				} else {
					$errorMessages['applicationCV1'] = 'CV must be less than 1 MB.';
				}
		}
	} else {
		/* Check comment. */
		if(!isset($_POST['userCV']) OR trim($_POST['userCV']) == '') {
			$errorMessages['userCV'] = 'Choose a CV';
		}		
	}
	
	if(count($errorMessages) == 0) {
		
		/* Object. */
		$jobApplicationObject = new class_jobApplication();
		
		/* No errors. Lets save the applicaion and send a CV. */ 
		$data['jobApplication_name']		= strtolower(trim($_POST['jobApplication_name']));
		$data['jobApplication_email']		= trim($_POST['jobApplication_email']);
		$data['jobApplication_comments']	= trim($_POST['jobApplication_comments']);
		$data['fkJobReferenceId']			= $jobData[0]['job_reference'];
		$data['fkRecruiterId']				= isset($recruiterData[0]['recruiter_reference']) && $recruiterData[0]['recruiter_reference'] != '' ? $recruiterData[0]['recruiter_reference'] : NULL;
		$data['fkRecruiterId']				= $jobData[0]['fk_recruiter_id'] != '' && $data['fkRecruiterId'] == NULL ? $jobData[0]['fk_recruiter_id'] : $data['fkRecruiterId'];
		$data['jobApplication_status']		= 'pending';
		
		if (!isset($userData)) {
			/* Upload and get the CV. */
			/* Create folder in /media/jobSeeker/cv/ using reference. */		
			$tempRandomNumber = rand(100, 1000000);
			$directory	= $_SERVER['DOCUMENT_ROOT']."/media/jobApplications/".$data['fkJobReferenceId'];
			$file		= $_SERVER['DOCUMENT_ROOT']."/media/jobApplications/".$data['fkJobReferenceId'].'/'.StringToUrl($data['jobApplication_name'].'_'.$tempRandomNumber).'.'.end(explode('.', $_FILES['applicationCV1']['name']));
			$tempPath	= "/media/jobApplications/".$data['fkJobReferenceId'].'/'.StringToUrl($data['jobApplication_name'].'_'.$tempRandomNumber).'.'.end(explode('.', $_FILES['applicationCV1']['name']));
			
			/* Create directory. */
			if(!is_dir($directory)) mkdir($directory, 0777);
			/* Now lets upload to this directory. */
			if(move_uploaded_file($_FILES['applicationCV1']['tmp_name'], $file)) {
				/* File uploaded, save record on database. */	
				$data['jobApplication_userFilename']	= $_FILES['applicationCV1']['name'];
				$data['jobApplication_pathToCV']		= $tempPath;
				
				/* Convert to simple words afterwards. if its not pdf. */
				if($_FILES['applicationCV1']['type'] != 'application/pdf') $data['jobApplication_content'] =  parseWord($file);
				
				/* Save new application and send email to both parties. */
				/* Insert data. */
				$attachedFile = file_get_contents('http://www.willowvine.co.za'.$data['jobApplication_pathToCV']);	
				if($attachedFile != '') {	
					/* insert if there is a CV. */
					$success = $jobApplicationObject->insert($data);			
					if(is_numeric($success)) {
						/* Data to be used for the email. */
						$smarty->assign('data', $data);
						$smarty->assign('success', $success);
						
						/* Send email to the registered user. */
						/* Send to the recruiter emails. */
						require('Zend/Mail.php');
						
						$mail = new Zend_Mail();
											
						$at = new Zend_Mime_Part($attachedFile);
						$at->type        = $_FILES['applicationCV1']['type'];
						$at->disposition = Zend_Mime::DISPOSITION_ATTACHMENT;
						$at->encoding    = Zend_Mime::ENCODING_BASE64;
						$at->filename    = basename('http://www.willowvine.co.za'.$data['jobApplication_pathToCV']);
						$mail->addAttachment($at);
						
						$message = $smarty->fetch('emails/job_application.html');
						$mail->setFrom('no-reply@willowvine.co.za' , 'Willowvine'); //EDIT!!											
						$mail->addTo($data['jobApplication_email']);
						$mail->addTo($jobData[0]['job_poster_email']);									
						$mail->setSubject('Willowvine - Application for: '.$jobData[0]['job_title']);
						$mail->setBodyHtml($message);			

						$mail->send();	
						/* Clean up. */
						$mail = $at = NULL; UNSET($mail, $at);					
					} else {
						$errorMessages['mail'] = 'Could not send email, please try again.';
					}			
				} else {
					$errorMessages['mail'] = 'Could not send email, please try again.';
				}	
			}
		} else {			
			/* Logged in. */
				$filepath = 'http://www.willowvine.co.za/media/jobSeeker/cv/'.$userData[0]['jobSeeker_reference'].'/'.trim($_REQUEST['userCV']);
				$attachedFile = file_get_contents($filepath);
				$ext = end(explode('.', trim($_REQUEST['userCV'])));
				
				if($ext == 'doc') {
					$fileType = 'application/msword';
				} else if($ext == 'pdf') {
					$fileType = 'application/pdf';
				} else if($ext == 'txt') {
					$fileType = 'text/plain';
				}
				
				if(($attachedFile != '' && $fileType != '') ) {
					/* Get CV and user information. */	
					$fileName	= trim($_REQUEST['userCV']);
					$tempPath	= '/media/jobSeeker/cv/'.$userData[0]['jobSeeker_reference'].'/'.$fileName;
					$file		= $_SERVER['DOCUMENT_ROOT'].'/media/jobSeeker/cv/'.$userData[0]['jobSeeker_reference'].'/'.$fileName;
					
					$data['jobApplication_pathToCV']		= $tempPath;
					$data['jobSeeker_reference'] 			= $userData[0]['jobSeeker_reference'];
					/* Check if its not PDF first to get the data. */
					if($fileType != 'application/pdf') 		$data['jobApplication_content'] =  parseWord($file);
					
					$success = $jobApplicationObject->insert($data);
					
					if(is_numeric($success)) {
						/* Data to be used for the email. */
						$smarty->assign('data', $data);
						$smarty->assign('success', $success);
						
						/* Send email to the registered user. */
						/* Send to the recruiter emails. */
						require('Zend/Mail.php');
						
						$mail = new Zend_Mail();
											
						$at = new Zend_Mime_Part($attachedFile);
						$at->type        = $fileType;
						$at->disposition = Zend_Mime::DISPOSITION_ATTACHMENT;
						$at->encoding    = Zend_Mime::ENCODING_BASE64;
						$at->filename    = basename($filepath);
						$mail->addAttachment($at);
						
						$message = $smarty->fetch('emails/job_application.html');
						$mail->setFrom('no-reply@willowvine.co.za' , 'Willowvine'); //EDIT!!											
						$mail->addTo($data['jobApplication_email']);
						$mail->addTo($jobData[0]['job_poster_email']);									
						$mail->setSubject('Willowvine - Application for: '.$jobData[0]['job_title']);
						$mail->setBodyHtml($message);			

						$mail->send();	
						/* Clean up. */
						$mail = $at = NULL; UNSET($mail, $at);	
					} else {
						$errorMessages['mail'] = 'Could not send application, please try again later.';
					}	
				} else {
					$errorMessages['mail'] = 'Could not send application, please try again.';
				}			
		}
	}
	if(!isset($success)) $smarty->assign('application', $_POST);
	$smarty->assign('errorMessages', $errorMessages);
}
//display template
$smarty->display('jobs/shortlist/details.tpl');
?>