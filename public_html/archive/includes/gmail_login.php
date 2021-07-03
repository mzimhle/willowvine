<?php
/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');

/* standard config include. */
require_once 'config/setup.php';

/* include the Zend class for Authentification */
require_once 'Zend/Session.php';

/* Set up the namespace */
$zfsession = new Zend_Session_Namespace('FrontLogin');

/* Check for mode. */
$openid_mode = isset($_GET['openid_mode']) ? trim($_GET['openid_mode']) : NULL;

/* First lets check if there is no one logged in. */
if(!isset($zfsession->identity)) {
	if($openid_mode == 'cancel') {
		/* Do nothing. */
	} else { 
		/* Get google login API class file. */
		require_once 'gmail/openid.php';

		/* Get the variables that we will save later. */
		$openid_ext1_value_firstname	= isset($_GET['openid_ext1_value_firstname']) ? trim($_GET['openid_ext1_value_firstname']) : NULL;
		$openid_ext1_value_lastname		= isset($_GET['openid_ext1_value_lastname']) ? trim($_GET['openid_ext1_value_lastname']) : NULL;
		$openid_ext1_value_email		= isset($_GET['openid_ext1_value_email']) ? trim($_GET['openid_ext1_value_email']) : NULL;
		$openid_identity				= isset($_GET['openid_identity']) ? trim($_GET['openid_identity']) : NULL;

		/* Check if email is an actual email. */
		if($openid_ext1_value_email != NULL) {
			/* Check here. */
			if(!preg_match('/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/', $openid_ext1_value_email)) { 
				$openid_ext1_value_email = NULL;
			}
		}

		if($openid_ext1_value_firstname == NULL && $openid_ext1_value_lastname == NULL && $openid_ext1_value_email == NULL) {
			/* Creating new instance */
			$openid = new LightOpenID;
			$openid->identity = 'https://www.google.com/accounts/o8/id';
			
			/* setting call back url */
			$openid->returnUrl = 'http://'.$_SERVER['HTTP_HOST'].'/includes/gmail_login.php';
			
			/* finding open id end point from google */
			$endpoint 	=	$openid->discover('https://www.google.com/accounts/o8/id');
			$fields 	=	'?openid.ns=' . urlencode('http://specs.openid.net/auth/2.0') .
							'&openid.return_to=' . urlencode($openid->returnUrl) .
							'&openid.claimed_id=' . urlencode('http://specs.openid.net/auth/2.0/identifier_select') .
							'&openid.identity=' . urlencode('http://specs.openid.net/auth/2.0/identifier_select') .
							'&openid.mode=' . urlencode('checkid_setup') .
							'&openid.ns.ax=' . urlencode('http://openid.net/srv/ax/1.0') .
							'&openid.ax.mode=' . urlencode('fetch_request') .
							'&openid.ax.required=' . urlencode('email,firstname,lastname') .
							'&openid.ax.type.firstname=' . urlencode('http://axschema.org/namePerson/first') .
							'&openid.ax.type.lastname=' . urlencode('http://axschema.org/namePerson/last') .
							'&openid.ax.type.email=' . urlencode('http://axschema.org/contact/email');
			
			/* Ask user to using his/her gmail account. */
			header('Location: ' . $endpoint . $fields);	
			exit;
			
		} else {

			/* Get required class. */
			require_once 'config/setup.php';
			require_once 'class/jobSeeker.php';
			/* jobSeeker Instance. */
			$jobSeekerObject = new class_jobSeeker();
			
			/* Check if user exists in our database and insert if not. */
			$userData	= $jobSeekerObject->checkGoogle($openid_ext1_value_email);
			/* Insert/Update data array. */
			$data = array();
			
			if(count($userData) == 0) {
				/* Insert new user. */
				$data['jobSeeker_name'] 		= $openid_ext1_value_firstname;
				$data['jobSeeker_surname'] 		= $openid_ext1_value_lastname;
				$data['jobSeeker_email']		= $openid_ext1_value_email;									
				$data['jobSeeker_password']		= '';
				$data['google_identity']		= $openid_identity;
				$data['jobSeeker_active']		= 1;								
				$data['jobSeeker_reference']	= $jobSeekerObject->createReference();		
				$data['jobSeeker_lastLogin']	= date('Y-m-d H:i:s');	
				
				/* Insert the data. */ 
				$jobSeekerObject->insert($data);				
			} else {
				/* Update "last login" */
				$data['google_identity']		= $openid_identity;
				$data['jobSeeker_lastLogin']	= date('Y-m-d H:i:s');
							
				$where = $jobSeekerObject->getAdapter()->quoteInto('jobSeeker_email = ? AND (google_identity != \'\' OR google_identity != NULL)', $openid_ext1_value_email);
				$jobSeekerObject->update($data, $where);			
			}
			
			/* Setup the login variables. */
			$zfsession->type		= 'jobseeker';
			$zfsession->google_id	= $openid_identity;
			$zfsession->identity	= $openid_ext1_value_email;
		}
	}
}

/* Redirect to the account page. */
header('Location: /job_seeker/account/');
exit;	

?>
