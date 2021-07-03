<?php
/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR .$_SERVER['DOCUMENT_ROOT'].'/library/classes/');
/* standard config include. */
require_once 'config/setup.php';
require_once 'includes/auth.php';

global $userData;

require_once 'functions.php';

/* Classes. */
require_once 'class/jobApplication.php';

/* Object. */
$jobApplicationObject 	= new class_jobApplication();

/************************************************************************ Setup Pagination for Jobs applied for.  */
$currentPage	= (isset($_GET['page']) && $_GET['page'] !='' ) ? (int)$_GET['page'] : 1;
$perPage 		= 5;
$listedPages	= 10;
$scrollingStyle	= 'Sliding';

$jobAppliedData = $jobApplicationObject->getPaginatedjobApplication('jobSeeker_reference = '.$userData[0]['jobSeeker_reference'], 'jobApplication.jobApplication_added DESC', $currentPage, $perPage, $listedPages, $scrollingStyle);

$jobAppliedItems = $jobAppliedData->getCurrentItems();
//print_r($jobAppliedItems);
/* End Check if they are in the "shortlisted" session array. */
$smarty->assign_by_ref('jobAppliedItems', $jobAppliedItems);

$paginator = $jobAppliedData->setView()->getPages();

$smarty->assign_by_ref('paginator', $paginator);
/************************************************************************ End Setup Pagination for Jobs applied for.  */

/* 
 * display template
 */
$smarty->display('job_seeker/account/applied.tpl');

/* Clean up. */
$jobAppliedData = $jobApplicationObject = $jobAppliedItems = $paginator = NULL;
unset($jobAppliedData, $jobApplicationObject, $jobAppliedItems, $paginator);
?>