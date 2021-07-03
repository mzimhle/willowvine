<?php
/* standard config include. */
require_once 'config/setup.php';

global $smarty;

/* include the Zend class for Authentification */
require_once 'Zend/Session.php';

/* Set up the namespace */
$zfsession = new Zend_Session_Namespace('FrontLogin');

/* Check for facebook authenitcation. */
require_once 'includes/facebook_auth.php';

/* Check if logged in, otherwise redirect */
if ((isset($zfsession->identity) || !is_null($zfsession->identity) || $zfsession->identity != '') && (isset($zfsession->type) && $zfsession->type == 'jobseeker')) {
	/* Class */
	require_once 'class/jobSeeker.php';
	require_once 'class/jobSeekerCV.php';
	
	/* Object */
	$jobSeekerObject = new class_jobSeeker();
	$jobSeekerCVObject = new class_jobSeekerCV();
	
	/* get user details by username */
	if(isset($zfsession->fb_id) && $zfsession->fb_id != '') {	
		$userData	= $jobSeekerObject->getByEmail($zfsession->identity, "fb_user_id = '".$zfsession->fb_id."'");
	} else {
		$userData	= $jobSeekerObject->getByEmail($zfsession->identity);
	}
	
	$userCV		= $jobSeekerCVObject->getByjobSeekerCVReference($userData[0]['jobSeeker_reference']);
	
	if(is_array($userData) && count($userData) > 0) {
		/* Add the CVs. */
		if(is_array($userCV) && count($userCV) > 0) {
			$userCVSections = array();
			for($i = 0; $i < count($userCV); $i++) {
				/* Convert fkSectionId to array for the checkboxes. */
				$userCV[$i]['sectionArray'] = trim($userCV[$i]['fkSectionId']) != '' ? explode(",",$userCV[$i]['fkSectionId']) : NULL;
				$fileName = $userCV[$i]['jobSeekerCV_filename'];
				$userCVSections[$fileName] = trim($userCV[$i]['fkSectionId']) != '' ? explode(",",$userCV[$i]['fkSectionId']) : NULL;
			}				
			$userData[0]['cv'] = $userCV;			
			$userData[0]['cvSections'] = $userCVSections;			
		}
		$smarty->assign('userData', $userData[0]);

		global $userData;
		
	} else {
		/* Then it must be a recruiter. */
		/* Class */
		require_once 'class/recruiter.php';			
		
		/* Object */
		$recruierObject = new class_recruiter();		
		
		/* Get by the email. */
		$recruiterData	= $recruierObject->getByEmail($zfsession->identity);
		
		/* Assign to smarty. */
		$smarty->assign('recruiterData', $recruiterData[0]);
		print_r($recruiterData); exit;
		global $recruiterData;
	}
} else {

	/* Lets first check if we are not in the account folder. */
	if(strripos($_SERVER['REQUEST_URI'], '/job_seeker/account/') !== false) {
		/* Redirect to the main page. */
		header('Location: /');
		exit;
	}
}

?>