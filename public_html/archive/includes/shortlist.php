<?php
/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR .$_SERVER['DOCUMENT_ROOT'].'/library/classes/');

/* standard config include. */
require_once 'config/setup.php';
require_once 'includes/auth.php';

/* include the Zend class for Authentification */
require_once 'Zend/Session.php';

require_once 'class/job.php';

global $smarty;

/* Set up the namespace */
$slsession = new Zend_Session_Namespace('shortList');
$jobObject = new class_job();

/* Check if it exists. */
if(!isset($slsession->jobs)) $slsession->jobs = array();

/* Check for parameters. Removing a job. */
if(isset($_GET['job']) && (int)trim($_GET['job']) != 0 && isset($_GET['action']) && trim($_GET['action']) == 'remove') {
	/* Remove job from the array using its value. */
	$slsession->jobs = array_diff($slsession->jobs , array((int)trim($_GET['job'])));
	
	/* Delete from database if user is logged in. */
	if(isset($userData) && count($userData) > 0) {
		/* Initialize the objects. */
		require_once 'class/shortList.php';
		
		$shortListObject = new class_shortList();
		
		/* Remove. */
		$shortListObject->removeJob($userData[0]['jobSeeker_reference'], (int)trim($_GET['job']));
		/* Clean up. */
		$shortListObject = NULL;
		UNSET($shortListObject);
	}
}

/* Check for parameters. Adding a job. */
if(isset($_GET['job']) && (int)trim($_GET['job']) != 0 && !isset($_GET['action'])) {
	
	/* Check if job exists. */
	$jobData = $jobObject->getByReference((int)trim($_GET['job']));
	/* Add to the session. */
	if(count($jobData) > 0 && !in_array((int)trim($_GET['job']), $slsession->jobs)) $slsession->jobs[] = (int)trim($_GET['job']);
}

$smarty->assign('jobShareCount', count($slsession->jobs));
?>