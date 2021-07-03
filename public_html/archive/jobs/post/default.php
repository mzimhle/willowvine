<?php
/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');

//standard config include.
require_once 'config/setup.php';
require_once 'includes/auth.php';
require_once 'functions.php';

/* Classes. */
require_once 'class/section.php';
require_once 'class/areaMap.php';
require_once 'class/job.php';

/* Create object. */
$sectionObject	= new class_section();
$areaMapObject	= new class_areaMap();
$jobObject		= new class_job();

 /* Pairs. */
$sectionOptions = $sectionObject->sectionPairs();

$smarty->assign('sectionOptions', $sectionOptions);
	
if(isset($_POST) && count($_POST) > 0) {
	
	$errorArray		= array();
	$data 			= array();
	$formValid		= true;
	$success		= NULL;
	$areaByName		= NULL;	
	
	if(isset($_POST['job_title']) && trim($_POST['job_title']) == '') {
		$errorArray['job_title'] = 'required';
		$formValid = false;		
	}	
	
	if(isset($_POST['job_poster_name']) && trim($_POST['job_poster_name']) == '') {
		$errorArray['job_poster_name'] = 'required';
		$formValid = false;		
	}
	
	if(isset($_POST['fk_section_id']) && (int)trim($_POST['fk_section_id']) == 0) {
		$errorArray['fk_section_id'] = 'required';
		$formValid = false;		
	}
	
	/* Check email. */
	if(isset($_POST['job_poster_email']) && trim($_POST['job_poster_email']) != '') {
		if(!preg_match('/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/', trim($_POST['job_poster_email']))) {
			$errorArray['job_poster_email'] = 'Enter Valid email.';
		} 
	} else {
		$errorArray['job_poster_email'] = 'Email missing.';
	}	
	
	if(isset($_POST['areaName']) && trim($_POST['areaName']) == '') {
		$errorArray['areaName'] = 'required';
		$formValid = false;		
	} else {
		/* Check if it exists. */
		$areaByName = $areaMapObject->getByFullPath(trim($_POST['areaName']));
		if(count($areaByName) == 0) {
			$errorArray['areaName'] = 'required';
			$formValid = false;				
		}
	}
	
	if(isset($_POST['job_added']) && trim($_POST['job_added']) == '') {
		$errorArray['job_added'] = 'required';
		$formValid = false;		
	} 
	
	if(isset($_POST['job_page']) && (trim($_POST['job_page']) == '<br>' or trim($_POST['job_page']) == '')) {
		$errorArray['job_page'] = 'required';
		$formValid = false;		
	} 

	if(count($errorArray) == 0 && $formValid == true) {

		/* Check if it exists. */
		$areaByName = $areaMapObject->getByFullPath(trim($_POST['areaName']));
			
		$data['job_title'] 			= trim($_POST['job_title']);
		$data['job_poster_name']	= trim($_POST['job_poster_name']);
		$data['job_poster_email']	= trim($_POST['job_poster_email']);
		$data['job_poster_number']	= trim($_POST['job_poster_number']);
		$data['job_AdType']			= trim($_POST['job_AdType']);
		$data['job_type']			= trim($_POST['job_type']);
		$data['fk_section_id']		= trim($_POST['fk_section_id']);
		$data['job_page']			= htmlspecialchars_decode(stripslashes(trim($_POST['job_page'])));	
		$data['job_address']		= trim($_POST['job_address']);
		$data['job_map_reference']	= trim($_POST['google_map_reference']);
		$data['fk_area_id']			= $areaByName[0]['fkAreaId'];		
		$data['job_area'] 			= $areaMapObject->getShortPath($areaByName[0]);				
		$data['job_active']			= 0;
		$data['job_reference']		= $jobObject->createReference();
		$data['job_link']			= StringToUrl(($data['job_title']));
		$data['jobs_affiliate']		= 'yes';
		$data['job_hashcode']		= md5(date('Y-m-d H:i:s'));
		
		$success = $jobObject->insert($data);
		
		if( $success > 0) {
		
			$sectionData = $sectionObject->getById($data['fk_section_id']);
			$smarty->assign('sectionData', $sectionData[0]);
			$data['areaName'] = $data['job_area'];
			$smarty->assign('jobData', $data);
			/* Send an email for the user to confirm it. */
			/* Send to the recruiter emails. */
			require('Zend/Mail.php');

			$mail = new Zend_Mail();

			/* Send Job to the Enquiring person. 		
			$message = $smarty->fetch('emails/post_completed.html');	

			$mail->setFrom('no-reply@willowvine.co.za' , 'Willowvine'); //EDIT!!											
			$mail->addTo($data['job_poster_email']); 									
			$mail->setSubject('Willowvine - New Job Post added');
			$mail->setBodyHtml($message);
			$mail->send();	
			*/
			$mail = $message = null;
			
			$mail = new Zend_Mail();
			
			$message = $smarty->fetch('emails/post_completed.html');	
		
			$mail->setFrom('no-reply@willowvine.co.za' , 'Willowvine'); //EDIT!!											
			$mail->addTo('mzimhle.mosiwe@gmail.com'); 									
			$mail->setSubject('Willowvine - New Job Post added');
			$mail->setBodyHtml($message);
			$mail->send();
			
			$postJob_success = array();
			
			$postJob_success['job_title'] = $data['job_title'];
			$postJob_success['job_area']  = $data['job_area'];
			$smarty->assign('postJob_success', $postJob_success);
			
			$mail = $errorArray = $_POST = $postJob_success = NULL;		
			
		}
	}
	
	/* if we are here there are errors. */
	$smarty->assign('errorArray', $errorArray);	
	$smarty->assign('jobData', $_POST);	
}

$smarty->display('jobs/post/new.tpl');
?>