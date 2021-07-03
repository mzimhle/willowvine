<?php
/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');

/* Standard includes */
require 'config/setup.php';

/* Other resources. */
require_once 'includes/resources.php';
require_once 'includes/global_functions.php';

/* Classes. */
require_once 'class/areaMap.php';
require_once 'class/section.php';
require_once 'class/job.php';


$jobReference	= isset($_REQUEST['post']) && (int)trim($_REQUEST['post']) > 0 ? (int)trim($_REQUEST['post']) : 0;
$jobHashCode	= isset($_REQUEST['job']) && trim($_REQUEST['job']) != '' ? trim($_REQUEST['job']) : '';

$smarty->assign('jobReference', $jobReference);
$smarty->assign('jobHashCode', $jobHashCode);

if($jobReference != 0 && $jobHashCode != '') {
	/* Get job by reference and code. */
	$jobObject	= new class_job();
	$jobData = $jobObject->getByReferenceHashCode($jobReference, $jobHashCode);
	
	/* check if it exists. */
	if(count($jobData) > 0 && $jobData['job_title'] != '') {
		$smarty->assign('jobData', $jobData);
	} else {
		header('Location: /errors/404/');
		exit;		
	}
} else {
	header('Location: /errors/404/');
	exit;
}

/* Object. */
$sectionObject	= new class_section();
$areaMapObject	= new class_areaMap();
 
 /* Pairs. */
$sectionOptions = $sectionObject->sectionPairs();

$smarty->assign('sectionOptions', $sectionOptions);

$errorArray		= array();
$data 			= array();
$formValid		= true;
$success		= NULL;
$areaByName		= NULL;
	
if(isset($_POST) && count($_POST) > 0) {
	
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
	
	if(isset($_POST['areaMap_path']) && trim($_POST['areaMap_path']) == '') {
		$errorArray['areaMap_path'] = 'required';
		$formValid = false;		
	} else {
		/* Check if it exists. */
		$areaByName = $areaMapObject->getByFullPath(trim($_POST['areaMap_path']));
		if(count($areaByName) == 0) {
			$errorArray['areaMap_path'] = 'required';
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
		
		/* Get post data. */			
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
		$data['job_area'] 			= $areaMapObject->getShortPath($areaByName[0]);	
		$data['fk_area_id']			= $areaByName[0]['fkAreaId'];	
		$data['job_link']			= StringToUrl(($data['job_title']));
		
		/* Update. */
		$where = $jobObject->getAdapter()->quoteInto('job_reference = ?', $jobReference);
		$success = $jobObject->update($data, $where);
		
		if(is_numeric($success)) {
			header('Location: /jobs/search/'.$jobData['section_urlName'].'/details/'.$data['job_link'].'/'.$jobReference.'/');
			exit;			
		}
	}
	
	/* if we are here there are errors. */
	$smarty->assign('errorArray', $errorArray);	
}
	
$smarty->display('recruiter/jobs/edit.tpl');
?>