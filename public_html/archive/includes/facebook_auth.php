<?php
/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');

require_once 'config/setup.php';
				

if($_SERVER['HTTP_HOST'] == 'willowvine.dev') {
	/* For .dev. */
	define('APP_ID', '403087556391206'); 
	define('APP_SECRET', 'da27de9c87b1da3ce078822fac600de7');
} else {
	/* For .co.za */
	define('APP_ID', '208476749269525'); 
	define('APP_SECRET', 'baa224f206af2f57d6021259249750cf');
}

$smarty->assign('APP_ID', APP_ID);
$smarty->assign('APP_SECRET', APP_SECRET);

/* First Check if there is a user logged in. */
if(!isset($userData)) {
	/* Include relevent files. */
	require_once 'facebook/facebook.php';
	
	/* Create our Application instance (replace this with your appId and secret) */
	$facebook = new Facebook(array('appId'  => APP_ID, 'secret' => APP_SECRET,));	
	
	/* Get User ID */
	$social_user = $facebook->getUser();
	
	/* check user. */
	if($social_user) {
		
		/* Get facebook user. */
		try {
			/* Get facebook user. */
			$facebookGuest = $facebook->api('/me');
		
		} catch(FacebookApiException $fae) {
			/* Clean up. */
			$social_user = NULL;
			if(isset($facebookGuest)) UNSET($facebookGuest);
		}
		
		/* Check if user exists on our database by email and user id. */
		if(isset($facebookGuest['email']) && trim($facebookGuest['email']) != '') {
			/* Get jobSeeker class. */
			require_once 'class/jobSeeker.php';
			
			/* Create Objects. */
			$jobSeekerObject = new class_jobSeeker();		
			/* Check if email exists. */
			$facebookUser = $jobSeekerObject->checkFB(trim($facebookGuest['email']), $facebookGuest['id']);
			
			/* Check if user exists. */
			if(count($facebookUser) > 0) {
				
				/* Setup the login variables. */
				$zfsession->type = 'jobseeker';
				$zfsession->fb_id = $facebookGuest['id'];
				$zfsession->identity = trim($facebookGuest['email']);
				
				/* Update "last login" */
				$data = array('jobSeeker_lastLogin' => date('Y-m-d H:i:s'));
				$where = $jobSeekerObject->getAdapter()->quoteInto('fb_user_id = ?', trim($facebookGuest['id']));
				$jobSeekerObject->update($data, $where);				
				
			} else {
				/* Get area class when inserting. */
				require_once 'class/areaMap.php';
				
				/* Objects. */
				$areaMapObject = new class_areaMap();
								
				/* Create a new user and insert. Dont forget to save the user id for future purposes. */
				$data = array();
				$data['jobSeeker_name'] 	= trim($facebookGuest['first_name']);
				$data['jobSeeker_surname'] 	= trim($facebookGuest['last_name']);
				$data['fb_user_id']			= trim($facebookGuest['id']);
				$data['fb_user_link']		= trim($facebookGuest['link']);
				$data['fkAreaId']			= '';
				
				/* Get the location. */
				if(isset($facebookGuest['location']['name']) && trim($facebookGuest['location']['name']) != '') {
					$data['fb_user_location'] = $facebookGuest['location']['name'];
				} else if (isset($facebookGuest['location']['hometown']) && trim($facebookGuest['location']['hometown']) != ''){
					$data['fb_user_location'] = $facebookGuest['location']['hometown'];
				}
				
				if(isset($data['fb_user_location']) && trim($data['fb_user_location']) != '') {
					$areaData = $areaMapObject->fetchByShortPath(trim(str_replace(' ', '', strtolower($data['fb_user_location']))));
					if(count($areaData) > 0) $data['fkAreaId'] = $areaData['fkAreaId'];
				}				
				/* End getting location. */
				$data['jobSeeker_email']			= trim($facebookGuest['email']);	
				$data['jobSeeker_active']			= 1;								
				$data['jobSeeker_reference']		= $jobSeekerObject->createReference();	
								
				/* Insert the data. */ 
				$jobSeekerObject->insert($data);							
			}
		} else {
			/* Emptry the user. */
			$social_user = NULL;			
		}
	} else {
		/* Emptry the user. */
		$social_user = NULL;
	}
	
}
?>