<?php
/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');

/* to scrape: http://www.crsolutions.co.za/ */

/**
 * Standard includes
 */
require_once 'config/setup.php';

/**
 * Check for login
 */
require_once 'admin/includes/auth.php';


/* Other resources. */
require_once 'includes/resources.php';
require_once 'includes/global_functions.php';

/* objects. */
require_once 'class/job.php';
require_once 'class/areaMap.php';
require_once 'class/section.php';

$jobObject = new class_job();
$areaMapObject = new class_areaMap();
$sectionObject = new class_section();

/* Get Pairs. */
$areaMapPairs = $areaMapObject->areaMapPairs();
$sectionPairs = $sectionObject->sectionPairs();

if(count($areaMapPairs) > 0) {
	$smarty->assign('areaMapPairs', $areaMapPairs);
}

if(count($sectionPairs) > 0) {
	$smarty->assign('sectionPairs', $sectionPairs);
}

/**
  * If the item exists populate the form with data
  */
if (!empty($_GET['pk_job_id']) && $_GET['pk_job_id'] != '') {
	
	$jobId = (int)$_GET['pk_job_id'];
	
	$jobData = $jobObject->getByjobId($jobId);
	if(count($jobData) > 0) {
		$smarty->assign('jobData', $jobData);
	}
}

/* Check posted data. */
if(count($_POST) > 0) {
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
	
	if(isset($_POST['job_type']) && trim($_POST['job_type']) == '') {
		$errorArray['job_type'] = 'required';
		$formValid = false;		
	}
	
	if(isset($_POST['job_added']) && trim($_POST['job_added']) == '') {
		$errorArray['job_added'] = 'required';
		$formValid = false;		
	} 
	
	if(count($errorArray) == 0 && $formValid == true) {
		
		/* required. */
		$data['job_title'] 			= trim($_POST['job_title']);		$data['job_link']			= StringToUrl($data['job_title']);
		$data['job_added']			= trim($_POST['job_added']);
		$data['job_poster_name'] 	= trim($_POST['job_poster_name']);
		$data['job_poster_number'] 	= trim($_POST['job_poster_number']);
		$data['job_poster_email']	= trim($_POST['job_poster_email']);
		$data['fk_section_id'] 		= trim($_POST['fk_section_id']);		
		$data['job_AdType'] 		= trim($_POST['job_AdType']);				$data['job_type'] 			= trim($_POST['job_type']);	
		$data['job_address'] 		= trim($_POST['job_address']);
		
		$data['job_advertBy'] 		= trim($_POST['job_advertBy']);
		$data['jobs_affiliate'] 	= trim($_POST['jobs_affiliate']);		
		$data['job_affiliateLink'] 	= trim($_POST['job_affiliateLink']);
		$data['job_latitude'] 		= trim($_POST['job_latitude']);
		$data['job_longitude'] 		= trim($_POST['job_longitude']);
		$data['fk_area_id']			= $areaByName[0]['fkAreaId'];		
		$data['job_area'] 			= $areaMapObject->getShortPath($areaByName[0]);				
		$data['job_active']			= isset($_POST['job_active']) && trim($_POST['job_active']) == 1 ? 1 : 0;
		
		if(isset($jobId) && $jobId != '') {
			/*Update. */
			$where = $jobObject->getAdapter()->quoteInto('pk_job_id = ?', $jobId);
			$success = $jobObject->update($data, $where);
		} else {
			$data['job_reference'] = $jobObject->createReference();
			$success = $jobObject->insert($data);			if(is_numeric($success) && $success > 0) {								header('Location: /admin/jobs/view/page.php?pk_job_id='.$success);					exit;			}
		}				if(is_numeric($success) && $success > 0) {							header('Location: /admin/jobs/view/page.php?pk_job_id='.$jobId);				exit;		}
		
	}
	
	/* if we are here there are errors. */
	$smarty->assign('errorArray', $errorArray);	
	$smarty->assign('jobData', $_POST);
}

$smarty->display('admin/jobs/view/details.tpl');

?>