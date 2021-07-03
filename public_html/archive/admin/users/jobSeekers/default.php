<?php
/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');

/**
 * Standard includes
 */
require_once 'config/setup.php';

/**
 * Check for login
 */
require_once 'admin/includes/auth.php';
require_once 'class/jobSeeker.php';

$jobSeekerObject = new class_jobSeeker();

/* Setup Pagination. */
$jobSeekerData = $jobSeekerObject->getAllJobSeeker();
if($jobSeekerData) $smarty->assign('jobSeekerData', $jobSeekerData);
 
$smarty->display('admin/users/jobSeekers/default.tpl');

?>