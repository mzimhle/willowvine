<?php
/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR .$_SERVER['DOCUMENT_ROOT'].'/library/classes/');

/* standard config include. */
require_once 'config/setup.php';
require_once 'includes/auth.php';

require_once 'functions.php';

/* Classes. */
require_once 'class/jobSeekerCV.php';

/* Object. */
$jobSeekerCVObject	= new class_jobSeekerCV();
 
/* Check if there is an update on the CV's. */
if(count($_POST) > 0 && isset($_POST['fkSectionId'])) {
		
	$errorMessages = array();
	
	if(isset($_POST['cvName']) && trim($_POST['cvName']) == '') {
		$errorMessages['jobSeekerCV'] = 'You do not have a CV.';
	}
	
	if(isset($_POST['cvId']) && trim($_POST['cvId']) == '') {
		$errorMessages['jobSeekerCV'] = 'You do not have a CV.';
	}	
	
	if(isset($_POST['fkSectionId']) && count($_POST['fkSectionId']) == 0) {
		$errorMessages['jobSeekerCV'] = 'Please select categories for the CV first.';
	}
	
	if(count($errorMessages) == 0) {
		/* Update. */
		$whereCV['jobSeekerCV_filename = ?'] = trim($_POST['cvName']);
		$whereCV['pk_jobSeekerCV_id = ?'] = trim($_POST['cvId']);
		$whereCV['fkJobSeekerReference = ?'] = $userData[0]['jobSeeker_reference'];	
		$dataCV['fkSectionId'] = implode(',', $_POST['fkSectionId']);
		/* update. */
		$successCV = $jobSeekerCVObject->update($dataCV, $whereCV);	
		
		if(!is_numeric($successCV)) {
			$errorMessages['jobSeekerCV'] = 'Could not update at this time, please try again.';
		} else {
			/* Reference the page. */
			header('Location: /job_seeker/account/cv/');
			exit;							
		}
	}
}

/* Check if there is a CV. */
if(isset($_FILES['jobSeekerCV']) && trim($_FILES['jobSeekerCV']['name']) != '') {
	$uploadErrorMessages = array();
	/* Only inserts here. but should not be more than 3 CV's. */
	$jobSeekerCount = $jobSeekerCVObject->getJobSeekerReference($userData[0]['jobSeeker_reference']);
	
	if(count($jobSeekerCount) < 3) { 	
	
		/* Check size. */
		if((int)$_FILES['jobSeekerCV']['size'] < 131072 && (int)$_FILES['jobSeekerCV']['size'] != 0) {
			/* Check if its the right file. */
			if($_FILES['jobSeekerCV']['type'] == 'text/plain' || $_FILES['jobSeekerCV']['type'] == 'application/pdf' || 
				$_FILES['jobSeekerCV']['type'] == 'application/msword' || $_FILES['jobSeekerCV']['type'] == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document') {
					/* upload the CV. */
					/* Create folder in /media/jobSeeker/cv/ using reference. */
					$rand = rand(1, 100);
					$fullFilename = $userData[0]['jobSeeker_reference'].'_'.$rand.'.'.end(explode('.', $_FILES['jobSeekerCV']['name']));
					$directory	= $_SERVER['DOCUMENT_ROOT']."/media/jobSeeker/cv/".$userData[0]['jobSeeker_reference'];
					$file		= $_SERVER['DOCUMENT_ROOT']."/media/jobSeeker/cv/".$userData[0]['jobSeeker_reference'].'/'.$fullFilename;
					
					/* Create directory. */
					if(!is_dir($directory)) mkdir($directory, 0777);
					/* Now lets upload to this directory. */
					if(move_uploaded_file($_FILES['jobSeekerCV']['tmp_name'], $file)) {
						/* File uploaded, save record on database. */	
						$dataCV = array();
						$dataCV['jobSeekerCV_filename'] = $fullFilename;
						$dataCV['jobSeekerCV_primary'] = !isset($userData[0]['cv']) ? 1 : 0;
						$dataCV['fkJobSeekerReference'] = $userData[0]['jobSeeker_reference'];
						$dataCV['jobSeekerCV_userName'] = trim($_FILES['jobSeekerCV']['name']);
						
						if($_FILES['jobSeekerCV']['type'] != 'application/pdf') $dataCV['jobSeekerCV_cvContent'] =  parseWord($file);	
						
						/* Insert when less than or equal to 3. */
						$success = $jobSeekerCVObject->insert($dataCV);
						if(!is_numeric($success)) {
							$uploadErrorMessages['jobSeekerCV'] = 'Could not upload at this time, please try again.';
						} else {
							/* Update user details for display. */
							require 'includes/auth.php';							
						}
						//$whereCV = $jobSeekerCVObject->getAdapter()->quoteInto('fkJobSeekerReference = ?', $userData[0]['jobSeeker_reference']);
						//$successCV = $jobSeekerCVObject->update($dataCV, $whereCV);												
					} else {
						$uploadErrorMessages['jobSeekerCV'] = 'Could not upload at this time, please try again.';
					}																	
			} else {
				$uploadErrorMessages['jobSeekerCV'] = 'CV must be .text, .doc or .docx.';
			}
		} else {
			$uploadErrorMessages['jobSeekerCV'] = 'CV must be less than 1 Megabyte (MB).';
		}
	} else {
		$uploadErrorMessages['jobSeekerCV'] = 'Maximum number of CVs to be uploaded is 3.';
	}
	
	$uploadErrorMessages['jobSeekerCV'] = count($uploadErrorMessages) == 0 ? '<span style="color: green;">File was succesfully uploaded</span>' : $uploadErrorMessages['jobSeekerCV'];
	$smarty->assign('uploadErrorMessages', $uploadErrorMessages);
}
?>