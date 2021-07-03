<?php
/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');

if(count($_POST) > 0 && count($jobData) == 1 && isset($_POST['jobApplication_name'])) {

	$domain 		= $_SERVER['HTTP_HOST'];	
	$data 			= array();
	$errorMessages 	= array();
	
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
								$_FILES['applicationCV1']['type'] == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document') { /* Do nothing. */ } 
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
				$attachedFile = file_get_contents('http://'.$domain.$data['jobApplication_pathToCV']);	
				if($attachedFile != '') {	
					/* insert if there is a CV. */
					$success = $jobApplicationObject->insert($data);			
					if(is_numeric($success)) {
						/* Data to be used for the email. */
						$smarty->assign('applicationData', $data);
						$smarty->assign('jobApplication_success', $success);
						
						/* Send email to the registered user. */
						/* Send to the recruiter emails. */
						require('Zend/Mail.php');
						
						$mail = new Zend_Mail();
											
						$at = new Zend_Mime_Part($attachedFile);
						$at->type        = $_FILES['applicationCV1']['type'];
						$at->disposition = Zend_Mime::DISPOSITION_ATTACHMENT;
						$at->encoding    = Zend_Mime::ENCODING_BASE64;
						$at->filename    = basename('http://'.$domain.$data['jobApplication_pathToCV']);
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
				$filepath = 'http://'.$domain.'/media/jobSeeker/cv/'.$userData[0]['jobSeeker_reference'].'/'.trim($_REQUEST['userCV']);
				$attachedFile = file_get_contents($filepath);
				$ext = end(explode('.', trim($_REQUEST['userCV'])));
				
				if($ext == 'doc') {
					$fileType = 'application/msword';
				} else if($ext == 'pdf') {
					$fileType = 'application/pdf';
				} else if($ext == 'txt') {
					$fileType = 'text/plain';
				} else if($ext == 'docx') {
					$fileType = 'application/vnd.openxmlformats-officedocument.wordprocessingml.document';
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
						$smarty->assign('applicationData', $data);
						$smarty->assign('jobApplication_success', $success);
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

?>