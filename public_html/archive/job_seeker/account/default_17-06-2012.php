<?php
/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR .$_SERVER['DOCUMENT_ROOT'].'/library/classes/');
/* standard config include. */
require_once 'config/setup.php';
require_once 'job_seeker/account/cv.php';
require_once 'includes/auth.php';
require_once 'includes/shortlist.php';

require_once 'functions.php';

/* Classes. */
require_once 'class/areaMap.php';
require_once 'class/section.php';
require_once 'class/jobSeeker.php';
require_once 'class/jobSeekerCV.php';

/* Object. */
$areaMapObject		= new class_areaMap();
$sectionObject		= new class_section();
$jobSeekerObject	= new class_jobSeeker();
$jobSeekerCVObject	= new class_jobSeekerCV();
 
 /* Pairs. */
$areaMapOptions = $areaMapObject->areaMapPairsByType();
$sectionOptions = $sectionObject->sectionWithJobsPairs();

/* parameters. */
$updated = isset($_GET['jsk']) && (int)$_GET['jsk'] != 0 ? (int)trim($_GET['jsk']): NULL;

if(count($_POST) > 0) {

	$data = array();
	$errorMessages = array();
	
	/* Check name. */
	if(isset($_POST['jobSeeker_name']) && trim($_POST['jobSeeker_name']) == '') {
		$errorMessages['jobSeeker_name'] = 'Name missing.';
	}
	
	/* Check surname. */
	if(isset($_POST['jobSeeker_surname']) && trim($_POST['jobSeeker_surname']) == '') {
		$errorMessages['jobSeeker_surname'] = 'Surname missing.';
	}	
	
	/* Check email. */
	if(isset($_POST['jobSeeker_email']) && trim($_POST['jobSeeker_email']) != '') {
		if(preg_match('/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/', trim($_POST['jobSeeker_email']))) {
			
			/* First check if email is the same as the current one of the logged in user. */
			if(trim($userData[0]['jobSeeker_email']) != trim($_POST['jobSeeker_email'])) {
				/* Check if email exists. */
				$emailConfirm = $jobSeekerObject->getByEmail(trim($_POST['jobSeeker_email']));

				if(count($emailConfirm) > 0) {
					/* Email exists. */
					$errorMessages['jobSeeker_email'] = 'Email already used.';
				}
			}
		} else {
			$errorMessages['jobSeeker_email'] = 'Enter Valid email.';
		} 
	} else {
		$errorMessages['jobSeeker_email'] = 'Email missing.';
	}

	if(isset($_POST['areaMap_path']) && trim($_POST['areaMap_path']) == '') {
		$errorMessages['areaMap_path'] = 'Enter your location';
	} else {
		/* Get Id, by areaMap_path. */
		$areaData = $areaMapObject->getByFullPath(trim($_POST['areaMap_path']));
		if(count($areaData) == 0) {
			$errorMessages['areaMap_path'] = 'Please select area from the drop down list';
		} 
	}
	
	if($userData[0]['fb_user_id'] == '' AND $userData[0]['twitter_uid']) {
		if(isset($_POST['jobSeeker_password']) && trim($_POST['jobSeeker_password']) == '') {
			$errorMessages['jobSeeker_password'] = 'Enter your password';
		}
	}

	if(count($errorMessages) == 0) {
	
		$data['jobSeeker_name'] 		= strtolower(trim($_POST['jobSeeker_name']));
		$data['jobSeeker_surname']		= strtolower(trim($_POST['jobSeeker_surname']));
		$data['jobSeeker_email']		= trim($_POST['jobSeeker_email']);
		$data['jobSeeker_password'] 	= isset($_POST['jobSeeker_password']) && trim($_POST['jobSeeker_password']) != '' ? trim($_POST['jobSeeker_password']) : '';
		$data['fkAreaId']				= $areaData[0]['fkAreaId'];
		$data['jobSeeker_alerts']		= isset($_POST['jobSeeker_alerts']) && (int)trim($_POST['jobSeeker_alerts']) == 1 ? 1 : 0;		
		$data['jobSeeker_description'] 	= isset($_POST['jobSeeker_description']) && trim($_POST['jobSeeker_description']) != '' ? trim($_POST['jobSeeker_description']) : '';		

		//print_r($errorMessages); print_r($_FILES); exit;
		/* Check for errors. */		
		
		/* Update jobSeeker table. */
		$where = $jobSeekerObject->getAdapter()->quoteInto('pk_jobSeeker_id = ?', $userData[0]['pk_jobSeeker_id']);
		$success = $jobSeekerObject->update($data, $where);
		
		if(is_numeric($success)) {
			$smarty->assign('updateSuccess', 1);
			/* Update user details for display. */
			require 'includes/auth.php';
		}
	}
	
	/* There is an error if we are here. */
	$_POST = NULL;
	$smarty->assign('errorMessages', $errorMessages);
}

$smarty->assign('areaMapOptions', $areaMapOptions);
$smarty->assign('sectionOptions', $sectionOptions);
if($updated != NULL) $smarty->assign('updated', $updated);

/* Clean up. */
$data = $errorMessages = $_POST = $dataCV = $_FILES =  $areaMapObject = $sectionObject = $jobSeekerObject = $jobSeekerCVObject = null;
unset($data,$errorMessages,$_POST,$dataCV,$_FILES, $areaMapObject,$sectionObject,$jobSeekerObject,$jobSeekerCVObject);

/* 
 * display template
 */
$smarty->display('job_seeker/account/default.tpl');
?>