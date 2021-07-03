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
require_once 'includes/auth.php';

/* Other resources. */
require_once 'includes/resources.php';
require_once 'includes/global_functions.php';

/* objects. */
require_once 'class/job.php';

$jobObject = new class_job();


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

	if(isset($_POST['job_page']) && trim($_POST['job_page']) == '') {
		$errorArray['job_page'] = 'required';
		$formValid = false;		
	}	
	
	if(count($errorArray) == 0 && $formValid == true) {

		/* required. */
		$data['job_page'] 			= htmlspecialchars_decode(stripslashes(trim($_POST['job_page'])));		
		$data['job_active']			= isset($_POST['job_active']) && trim($_POST['job_active']) == 1 && $data['job_page'] != '' ? 1 : 0;

		if(isset($jobId) && $jobId != '') {
			/*Update. */
			$where = $jobObject->getAdapter()->quoteInto('pk_job_id = ?', $jobId);
			$success = $jobObject->update($data, $where);
		}
		
		if(is_numeric($success) && $success > 0) {			
				header('Location: /jobs/view/details.php?pk_job_id='.$jobId);
				exit;
		}
	}

	/* if we are here there are errors. */
	$smarty->assign('errorArray', $errorArray);	
}

$smarty->display('jobs/view/page.tpl');
?>