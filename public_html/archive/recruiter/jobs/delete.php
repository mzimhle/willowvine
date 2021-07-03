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
		header('Location: errors/404/');
		exit;		
	}
} else {
	header('Location: errors/404/');
	exit;
}

 
if(isset($_GET['delete']) && trim($_GET['delete']) == 'yes') {
		$data = array();
		$data['job_deleted'] = 1;
		/* Update. */
		$where = $jobObject->getAdapter()->quoteInto('job_reference = ?', $jobReference);
		$success = $jobObject->update($data, $where);
		
		if(is_numeric($success)) {
			$smarty->assign('success', $success);
		}
}
	
$smarty->display('recruiter/jobs/delete.tpl');
?>