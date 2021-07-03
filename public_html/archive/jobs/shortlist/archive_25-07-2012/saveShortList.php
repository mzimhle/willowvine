<?php
/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR .$_SERVER['DOCUMENT_ROOT'].'/library/classes/');

/* standard config include. */
require_once 'config/setup.php';
require_once 'includes/auth.php';

/* include the Zend class for Authentification */
require_once 'Zend/Session.php';
require_once 'class/job.php';

/* Set up the namespace */
$slsession = new Zend_Session_Namespace('shortList');
$jobObject = new class_job();

/* Check if it exists before saving. */
if(isset($userData) && count($userData) > 0) {
	require_once 'class/shortList.php';
	
	$shortListObject = new class_shortList();
	
	/* Save the current shortList. First delete the current data if any. */
	if(is_numeric($shortListObject->remove($userData[0]['jobSeeker_reference']))) {
		/* Insert the current ones. */
		if((isset($slsession->jobs) && count($slsession->jobs) > 0)) {			
			for($i = 0; $i < count($slsession->jobs); $i++) {
				/* Build up data. */				if(isset($slsession->jobs[$i])) {
					$data = array();
					$data['jobSeeker_reference'] = $userData[0]['jobSeeker_reference'];
					$data['job_reference'] = $slsession->jobs[$i];
					/* Insert data. */
					$shortListObject->insert($data);
					/* Clean up.*/
					$data = NULL; UNSET($data);				}
			}
			echo '<span style="color: green;"><br><b>Your shortList was saved.</b></span>';
			exit;
		}
			echo '<span style="color: green;"><br><b>Your list has been deleted.</b></span>';
			exit;		
	} else {
		echo '<span style="color: red;"><br><b>There was an error saving, please try again later.</b></span>';
	}
} else {
	echo '<span style="color: red;"><br><b>You are not logged in.</b></span>';
}
?>