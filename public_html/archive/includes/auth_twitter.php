<?php 
/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');

/* standard config include. */
require_once 'config/setup.php';
/* include the Zend class for Authentification */
require_once 'Zend/Session.php';

/* Set up the namespace */
$zfsession = new Zend_Session_Namespace('FrontLogin');
/* Get the class. */
require_once 'twitter/twitteroauth.php';

if(!empty($_GET['oauth_verifier']) && !empty($zfsession->oauth_token) && !empty($zfsession->oauth_token_secret)){

	/* TwitterOAuth instance, with two new parameters we got in twitter_login.php */
	$twitteroauth = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $zfsession->oauth_token, $zfsession->oauth_token_secret);
	
	/* Let's request the access token */
	$access_token = $twitteroauth->getAccessToken($_GET['oauth_verifier']);
	
	/* Save it in a session var */
	$zfsession->access_token = $access_token;
	
	/* Let's get the user's info */
	$user_info = $twitteroauth->get('account/verify_credentials');
	
	/* Save the data if its not present. */ 
	if(!isset($user_info->error)){
		/* Get classese and objects. */
		require_once 'class/jobSeeker.php';
		
		/* Get Object. */
		$jobSeekerObject = new class_jobSeeker();
		
		/* Check if user already exists. check by ID. */
		$twitterData = $jobSeekerObject->checkTwitter(trim($user_info->id));
		
		/* insert if not present. */
		if(count($twitterData) == 0) {
		
			/* Build data. */
			$data = array();			
			$data['twitter_uid'] 			= trim($user_info->id);
			$data['jobSeeker_name'] 		= trim($user_info->name);
			$data['twitter_link']			= 'http://twitter.com/'.trim($user_info->screen_name);	
			$data['jobSeeker_active']		= 1;								
			$data['jobSeeker_reference']	= $jobSeekerObject->createReference();	
			
			/* Insert the data. */ 
			$jobSeekerObject->insert($data);
		}
		
		/* Setup the login variables. */
		$zfsession->type		= 'jobseeker';
		$zfsession->twitter_id	= trim($user_info->id);
		$zfsession->identity	= trim($user_info->id);
		
		/* Update "last login" */
		$data = array('jobSeeker_lastLogin' => date('Y-m-d H:i:s'));
		$where = $jobSeekerObject->getAdapter()->quoteInto('twitter_uid = ?', trim($user_info->id));
		$jobSeekerObject->update($data, $where);	

		/* Clean up. */
		$jobSeekerObject = $data = $where = $user_info = $access_token = $twitteroauth = NULL;
		UNSET($jobSeekerObject, $data, $where, $user_info, $access_token, $twitteroauth);
		
	}
	
} else {
	/* Clean up. */
	$zfsession = NULL; UNSET($zfsession);
}

/* Either way we are redirecting. */
header('Location: /');
exit;

?>