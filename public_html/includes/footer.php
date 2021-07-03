<?php
/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');

// global variables
global $smarty, $siteRoot;

/**
 * Display the template
 */

require_once 'global_functions.php';

if(isset($_POST['action']) && trim($_POST['action']) == 'loginForm') {

	/*** Standard includes */
	require_once 'config/database.php';
	require_once 'class/participantlogin.php';
	
	//include the Zend class for Authentification
	require_once 'Zend/Auth.php';
	require_once 'Zend/Auth/Adapter/DbTable.php';
	require_once 'Zend/Session.php';

	$zfsession = new Zend_Session_Namespace('FrontLogin');
	
	$zfsession->setExpirationSeconds(3600);	
	
	// Set up the authentication adapter
	$authAdapter = new Zend_Auth_Adapter_DbTable($conn);	
	
	$errorArray					= array();
	$errorArray['message']	= array();
	$errorArray['result']		= true;
	
	$participantloginObject 	= new class_participantlogin();

	if(isset($_POST['username']) && trim($_POST['username']) != '') {
		if($participantloginObject->validateEmail(trim($_POST['username'])) == '') {
			$errorArray['message'][] = 'Email needs to be a valid';
			$errorArray['result'] = false;	
		}
	} else {
		$errorArray['message'][] = 'Email / Username address is required';
		$errorArray['result'] = false;		
	}
	
	if(isset($_POST['password']) && trim($_POST['password']) == '') {
		$errorArray['message'][] = 'Password is required';
		$errorArray['result'] = false;		
	}
	
	if(count($errorArray['message'])  == 0 && $errorArray['result']  == true ) {

		$participantloginData	= $participantloginObject->checkLogin(trim($_POST['username']), trim($_POST['password']));	
		
		if($participantloginData) {			
			// Identity exists; store in session
			$zfsession->identity	= $participantloginData['participantlogin_code'];			
			
			//record last login for user
			$data = array('participantlogin_lastlogin' => date('Y-m-d H:i:s'));
			
			$where = array();
			$where[] = $participantloginObject->getAdapter()->quoteInto('participantlogin_surname = ?', $participantloginData['participantlogin_username']);
			$where[] = $participantloginObject->getAdapter()->quoteInto('participantlogin_code = ?', $participantloginData['participantlogin_code']);
			
			$participantloginObject->update($data, $where);
			
			$errorArray['message']	= array();
			$errorArray['result']	= 1;
			
		} else {
			$errorArray['message'][]	= 'Invalid username and password, please try again.';
			$errorArray['result']	= 0;				
		}
		
	}
	
	echo json_encode($errorArray);
	die();	
}

if(isset($_POST['action']) && trim($_POST['action']) == 'passwordForm') {

	/*** Standard includes */
	require_once 'config/database.php';
	require_once 'config/smarty.php';
	require_once 'class/participantlogin.php';
	
	$errorArray					= array();
	$errorArray['message']	= array();
	$errorArray['result']		= true;
	
	$participantloginObject 	= new class_participantlogin();
	
	if(isset($_POST['email']) && trim($_POST['email']) != '') {
		if($participantloginObject->validateEmail(trim($_POST['email'])) == '') {
			$errorArray['message'][] = 'Email needs to be valid';
			$errorArray['result'] = false;	
		} else {

			$participantloginData = $participantloginObject->checkUsername(trim($_POST['email']), 'EMAIL');

			if($participantloginData) {
				/* Send Email with password. */
				$participantloginObject->_comm->sendMail('templates/mail/login_password_reminder.html', 'PASSWORD_REMINDER', $participantloginData, 'Willowvine Password Reminder', array());
			} else {
				$errorArray['message'][] = 'Email entered not found, please try another one.';
				$errorArray['result'] = false;					
			}
		}
	} else {
		$errorArray['message'][] = 'Email address is required';
		$errorArray['result'] = false;		
	}

	echo json_encode($errorArray);
	die();	
	
}

if(isset($_POST['action']) && trim($_POST['action']) == 'registrationEmailForm') {

	/*** Standard includes */
	require_once 'config/database.php';
	require_once 'config/smarty.php';
	require_once 'class/participant.php';
	
	$errorArray					= array();
	$errorArray['message']	= array();
	$errorArray['result']		= true;	
	$participantObject 			= new class_participant();
	
	if(isset($_POST['participant_name']) && trim($_POST['participant_name']) == '') {
		$errorArray['message'][] = 'Name is required';
		$errorArray['result'] = false;
	}
	
	if(isset($_POST['areapost_code']) && trim($_POST['areapost_code']) == '') {
		$errorArray['message'][] = 'Your area is required';
		$errorArray['result'] = false;
	}
	
	if(isset($_POST['participant_surname']) && trim($_POST['participant_surname']) == '') {
		$errorArray['message'][] = 'Surname is required';
		$errorArray['result'] = false;		
	}
	
	if(isset($_POST['participant_email']) && trim($_POST['participant_email']) != '') {
		if($participantObject->validateEmail(trim($_POST['participant_email'])) == '') {
			$errorArray['message'][] = 'Needs to be a valid email address';
			$errorArray['result'] = false;	
		} else {
			
			$participantData = $participantObject->_participantlogin->checkUsername(trim($_POST['participant_email']), 'EMAIL');

			if($participantData) {
				$errorArray['message'][] = 'Email already is being used';
				$errorArray['result'] = false;				
			}
		}
	} else {
		$errorArray['message'][] = 'Email address is required';
		$errorArray['result'] = false;		
	}
	
	if(count($errorArray['message'])  == 0 && $errorArray['result']  == true ) {
	
		$data 	= array();					
		$data['participant_name']		= trim($_POST['participant_name']);		
		$data['participant_surname']	= trim($_POST['participant_surname']);			
		$data['participant_email']		= trim($_POST['participant_email']);		
		$data['areapost_code']			= trim($_POST['areapost_code']);		
		$data['participant_active']		= 0;

		$success	= $participantObject->insertParticipant($data, 'EMAIL');	
		
		if($success) {
			$errorArray['message']	= array();
			$errorArray['result']	= 1;			
		} else {
			$errorArray['message'][]	= 'Could not delete, please try again.';
			$errorArray['result']	= 0;				
		}
		
	}
	
	echo json_encode($errorArray);
	die();	
}

if(isset($_POST['action']) && trim($_POST['action']) == 'registrationFacebookForm') {

	/*** Standard includes */
	require_once 'config/database.php';
	
	require_once 'class/participant.php';
	
	$errorArray					= array();
	$errorArray['message']	= array();
	$errorArray['result']		= true;	
	$participantObject 			= new class_participant();
	
	if(isset($_POST['id']) && trim($_POST['id']) == '') {
		$errorArray['message'][]	= 'No facebook id received.';
		$errorArray['result'] 			= false;		
	}
	
	if(isset($_POST['first_name']) && trim($_POST['first_name']) == '') {
		$errorArray['message'][] = 'name is required';
		$errorArray['result'] = false;
	}
	
	if(isset($_POST['email']) && trim($_POST['email']) != '') {
		if($participantObject->validateEmail(trim($_POST['email'])) == '') {
			$errorArray['message'][] 	= 'Needs to be a valid email address';
			$errorArray['result'] 			= false;	
		} else {
			
			$participantData = $participantObject->_participantlogin->checkUsername(trim($_POST['email']), 'FACEBOOK');

			if($participantData) {
				$errorArray['message'][] 	= 'This email is already registered with us';
				$errorArray['result'] 			= false;				
			}
		}
	} else {
		$errorArray['message'][]	= 'Email address is required';
		$errorArray['result'] 			= false;		
	}
	
	if($errorArray['result'] == true && count($errorArray['message']) == 0) {
			$data 									= array();	
			$data['participant_name'] 		= isset($_POST['first_name']) && trim($_POST['first_name']) != '' ? trim($_POST['first_name']) : null;
			$data['participant_surname'] 	= isset($_POST['last_name']) && trim($_POST['last_name']) != '' ? trim($_POST['last_name']) : null;
			$data['participant_gender'] 	= isset($_POST['gender']) && trim($_POST['gender']) != '' ? strtolower(trim($_POST['gender'])) : null;
			$data['participant_email'] 		= isset($_POST['email']) && trim($_POST['email']) != '' ? trim($_POST['email']) : null;
			$data['participant_active']	 	= 1;
			
			/* Insert the data. */
			$success = $participantObject->insertParticipant(array_merge($data, $_POST), 'FACEBOOK');
			
			if($success) {
				$errorArray['message']	= array();
				$errorArray['result']	= 1;			
			} else {
				$errorArray['message'][]	= 'Could not delete, please try again.';
				$errorArray['result']	= 0;				
			}			
	}
	
	echo json_encode($errorArray);
	exit;	
	
}

if(isset($_POST['action']) && trim($_POST['action']) == 'shareJobForm') {

	/*** Standard includes */
	require_once 'config/database.php';
	require_once 'config/smarty.php';
	
	require_once 'class/share.php';
	require_once 'class/job.php';
	
	$errorArray					= array();
	$errorArray['message']	= array();
	$errorArray['result']		= true;	
	$shareObject 				= new class_share();
	$jobObject 					= new class_job();
	
	if(isset($_POST['share_friend_name']) && trim($_POST['share_friend_name']) == '') {
		$errorArray['message'][] = 'Fullname of your friend is required';
		$errorArray['result'] = false;
	}
	
	if(isset($_POST['share_friend_email']) && trim($_POST['share_friend_email']) != '') {
		if($shareObject->validateEmail(trim($_POST['share_friend_email'])) == '') {
			$errorArray['message'][] = 'Email of your friend needs to be valid';
			$errorArray['result'] = false;	
		}
	} else {
		$errorArray['message'][] = 'Email of your friend is required';
		$errorArray['result'] = false;		
	}
	
	if(isset($_POST['share_participant_name']) && trim($_POST['share_participant_name']) == '') {
		$errorArray['message'][] = 'Your fullname is required';
		$errorArray['result'] = false;
	}
	
	if(isset($_POST['share_participant_email']) && trim($_POST['share_participant_email']) != '') {
		if($shareObject->validateEmail(trim($_POST['share_participant_email'])) == '') {
			$errorArray['message'][] = 'Your email address needs to be valid';
			$errorArray['result'] = false;	
		}
	} else {
		$errorArray['message'][] = 'Your email address is required';
		$errorArray['result'] = false;		
	}
	
	if(isset($_POST['jobshare_code']) && trim($_POST['jobshare_code']) == '') {
		$errorArray['message'][] = 'Job to share is not selected';
		$errorArray['result'] = false;
	} else {
		
		$tempjobData = $jobObject->getByCode(trim($_POST['jobshare_code']));
		
		if(!$tempjobData) {
			$errorArray['message'][] = 'Job selected does not exist';
			$errorArray['result'] = false;			
		}
	}
	
	if(count($errorArray['message'])  == 0 && $errorArray['result']  == true ) {
	
		$data 	= array();
		$data['participant_code']		= isset($participantloginData) ? $participantloginData['participant_code'] : null;
		$data['share_type']				= 'JOB';
		$data['share_reference']		= $tempjobData['job_code'];
		$data['share_name']				= trim($_POST['share_participant_name']);		
		$data['share_email']				= trim($_POST['share_participant_email']);			
		$data['share_friendname']		= trim($_POST['share_friend_name']);		
		$data['share_friendemail']		= trim($_POST['share_friend_email']);

		$success	= $shareObject->insert($data);	
		
		if($success) {
			$errorArray['message']	= array();
			$errorArray['result']	= 1;			
		} else {
			$errorArray['message'][]	= 'Could not submit, please try again.';
			$errorArray['result']	= 0;				
		}
		
	}
	
	echo json_encode($errorArray);
	die();	
}

if(isset($_POST['action']) && trim($_POST['action']) == 'shareInternForm') {

	/*** Standard includes */
	require_once 'config/database.php';
	require_once 'config/smarty.php';

	require_once 'class/share.php';
	require_once 'class/internship.php';
	
	$errorArray					= array();
	$errorArray['message']	= array();
	$errorArray['result']		= true;	
	$shareObject 				= new class_share();
	$internshipObject 			= new class_internship();
	
	if(isset($_POST['share_friend_name']) && trim($_POST['share_friend_name']) == '') {
		$errorArray['message'][] = 'Fullname of your friend is required';
		$errorArray['result'] = false;
	}
	
	if(isset($_POST['share_friend_email']) && trim($_POST['share_friend_email']) != '') {
		if($shareObject->validateEmail(trim($_POST['share_friend_email'])) == '') {
			$errorArray['message'][] = 'Email of your friend needs to be valid';
			$errorArray['result'] = false;	
		}
	} else {
		$errorArray['message'][] = 'Email of your friend is required';
		$errorArray['result'] = false;		
	}
	
	if(isset($_POST['share_participant_name']) && trim($_POST['share_participant_name']) == '') {
		$errorArray['message'][] = 'Your fullname is required';
		$errorArray['result'] = false;
	}
	
	if(isset($_POST['share_participant_email']) && trim($_POST['share_participant_email']) != '') {
		if($shareObject->validateEmail(trim($_POST['share_participant_email'])) == '') {
			$errorArray['message'][] = 'Your email address needs to be valid';
			$errorArray['result'] = false;	
		}
	} else {
		$errorArray['message'][] = 'Your email address is required';
		$errorArray['result'] = false;		
	}
	
	if(isset($_POST['internshare_code']) && trim($_POST['internshare_code']) == '') {
		$errorArray['message'][] = 'Internship to share is not selected';
		$errorArray['result'] = false;
	} else {
		
		$tempinternshipData = $internshipObject->getByCode(trim($_POST['internshare_code']));
		
		if(!$tempinternshipData) {
			$errorArray['message'][] = 'Internship selected does not exist';
			$errorArray['result'] = false;			
		}
	}
	
	if(count($errorArray['message'])  == 0 && $errorArray['result']  == true ) {
	
		$data 	= array();
		$data['participant_code']		= isset($participantloginData) ? $participantloginData['participant_code'] : null;
		$data['share_type']				= 'INTERNSHIP';
		$data['share_reference']		= $tempinternshipData['internship_code'];
		$data['share_name']				= trim($_POST['share_participant_name']);		
		$data['share_email']				= trim($_POST['share_participant_email']);			
		$data['share_friendname']		= trim($_POST['share_friend_name']);		
		$data['share_friendemail']		= trim($_POST['share_friend_email']);

		$success	= $shareObject->insert($data);	
		
		if($success) {
			$errorArray['message']	= array();
			$errorArray['result']	= 1;			
		} else {
			$errorArray['message'][]	= 'Could not submit, please try again.';
			$errorArray['result']	= 0;				
		}
		
	}
	
	echo json_encode($errorArray);
	die();	
}

if(isset($_POST['action']) && trim($_POST['action']) == 'shareCareerForm') {

	/*** Standard includes */
	require_once 'config/database.php';
	require_once 'config/smarty.php';

	require_once 'class/share.php';
	require_once 'class/career.php';
	
	$errorArray					= array();
	$errorArray['message']	= array();
	$errorArray['result']		= true;	
	$shareObject 				= new class_share();
	$careerObject 				= new class_career();
	
	if(isset($_POST['share_friend_name']) && trim($_POST['share_friend_name']) == '') {
		$errorArray['message'][] = 'Fullname of your friend is required';
		$errorArray['result'] = false;
	}
	
	if(isset($_POST['share_friend_email']) && trim($_POST['share_friend_email']) != '') {
		if($shareObject->validateEmail(trim($_POST['share_friend_email'])) == '') {
			$errorArray['message'][] = 'Email of your friend needs to be valid';
			$errorArray['result'] = false;	
		}
	} else {
		$errorArray['message'][] = 'Email of your friend is required';
		$errorArray['result'] = false;		
	}
	
	if(isset($_POST['share_participant_name']) && trim($_POST['share_participant_name']) == '') {
		$errorArray['message'][] = 'Your fullname is required';
		$errorArray['result'] = false;
	}
	
	if(isset($_POST['share_participant_email']) && trim($_POST['share_participant_email']) != '') {
		if($shareObject->validateEmail(trim($_POST['share_participant_email'])) == '') {
			$errorArray['message'][] = 'Your email address needs to be valid';
			$errorArray['result'] = false;	
		}
	} else {
		$errorArray['message'][] = 'Your email address is required';
		$errorArray['result'] = false;		
	}
	
	if(isset($_POST['careershare_code']) && trim($_POST['careershare_code']) == '') {
		$errorArray['message'][] = 'Career to share is not selected';
		$errorArray['result'] = false;
	} else {
		
		$tempcareerData = $careerObject->getByCode(trim($_POST['careershare_code']));
		
		if(!$tempcareerData) {
			$errorArray['message'][] = 'Career selected does not exist';
			$errorArray['result'] = false;			
		}
	}
	
	if(count($errorArray['message'])  == 0 && $errorArray['result']  == true ) {
	
		$data 	= array();
		$data['participant_code']		= isset($participantloginData) ? $participantloginData['participant_code'] : null;
		$data['share_type']				= 'CAREER';
		$data['share_reference']		= $tempcareerData['career_code'];
		$data['share_name']				= trim($_POST['share_participant_name']);		
		$data['share_email']				= trim($_POST['share_participant_email']);			
		$data['share_friendname']		= trim($_POST['share_friend_name']);		
		$data['share_friendemail']		= trim($_POST['share_friend_email']);

		$success	= $shareObject->insert($data);	
		
		if($success) {
			$errorArray['message']	= array();
			$errorArray['result']	= 1;			
		} else {
			$errorArray['message'][]	= 'Could not submit, please try again.';
			$errorArray['result']	= 0;				
		}
		
	}
	
	echo json_encode($errorArray);
	die();	
}

if(isset($_POST['action']) && trim($_POST['action']) == 'shareExamForm') {

	/*** Standard includes */
	require_once 'config/database.php';
	require_once 'config/smarty.php';

	require_once 'class/share.php';
	require_once 'class/exam.php';
	
	$errorArray					= array();
	$errorArray['message']	= array();
	$errorArray['result']		= true;	
	$shareObject 				= new class_share();
	$examObject 				= new class_exam();
	
	if(isset($_POST['share_friend_name']) && trim($_POST['share_friend_name']) == '') {
		$errorArray['message'][] = 'Fullname of your friend is required';
		$errorArray['result'] = false;
	}
	
	if(isset($_POST['share_friend_email']) && trim($_POST['share_friend_email']) != '') {
		if($shareObject->validateEmail(trim($_POST['share_friend_email'])) == '') {
			$errorArray['message'][] = 'Email of your friend needs to be valid';
			$errorArray['result'] = false;	
		}
	} else {
		$errorArray['message'][] = 'Email of your friend is required';
		$errorArray['result'] = false;		
	}
	
	if(isset($_POST['share_participant_name']) && trim($_POST['share_participant_name']) == '') {
		$errorArray['message'][] = 'Your fullname is required';
		$errorArray['result'] = false;
	}
	
	if(isset($_POST['share_participant_email']) && trim($_POST['share_participant_email']) != '') {
		if($shareObject->validateEmail(trim($_POST['share_participant_email'])) == '') {
			$errorArray['message'][] = 'Your email address needs to be valid';
			$errorArray['result'] = false;	
		}
	} else {
		$errorArray['message'][] = 'Your email address is required';
		$errorArray['result'] = false;		
	}
	
	if(isset($_POST['examshare_code']) && trim($_POST['examshare_code']) == '') {
		$errorArray['message'][] = 'Exam to share is not selected';
		$errorArray['result'] = false;
	} else {
		
		$tempexamData = $examObject->getByCode(trim($_POST['examshare_code']));
		
		if(!$tempexamData) {
			$errorArray['message'][] = 'Exam selected does not exist';
			$errorArray['result'] = false;			
		}
	}
	
	if(count($errorArray['message'])  == 0 && $errorArray['result']  == true ) {
	
		$data 	= array();
		$data['participant_code']		= isset($participantloginData) ? $participantloginData['participant_code'] : null;
		$data['share_type']				= 'EXAM';
		$data['share_reference']		= $tempexamData['exam_code'];
		$data['share_name']				= trim($_POST['share_participant_name']);		
		$data['share_email']				= trim($_POST['share_participant_email']);			
		$data['share_friendname']		= trim($_POST['share_friend_name']);		
		$data['share_friendemail']		= trim($_POST['share_friend_email']);

		$success	= $shareObject->insert($data);	
		
		if($success) {
			$errorArray['message']	= array();
			$errorArray['result']	= 1;			
		} else {
			$errorArray['message'][]	= 'Could not submit, please try again.';
			$errorArray['result']	= 0;				
		}
		
	}
	
	echo json_encode($errorArray);
	die();	
}

if(isset($_POST['action']) && trim($_POST['action']) == 'shortlistjob') {

	/*** Standard includes */
	require_once 'config/database.php';
	
	require_once 'includes/auth.php';
	
	require_once 'class/job.php';	
	
	$errorArray					= array();
	$errorArray['message']	= array();
	$errorArray['result']		= true;	
	$jobObject 					= new class_job();
	
	if(isset($_POST['jobcode']) && trim($_POST['jobcode']) == '') {
		$errorArray['message'][] = 'Job to shortlist is not selected';
		$errorArray['result'] = false;
	} else {
		
		$tempjobData = $jobObject->getByCode(trim($_POST['jobcode']));
		
		if(!$tempjobData) {
			$errorArray['message'][] = 'Job selected does not exist';
			$errorArray['result'] = false;			
		}
	}
		
	if(count($errorArray['message'])  == 0 && $errorArray['result']  == true ) {
		
		if(!in_array($tempjobData['job_code'], $zfsession->shortlist)) {
			/* Add to the shortlist session. */
			$zfsession->shortlist[] 		= $tempjobData['job_code'];
			$zfsession->shortlistdata[]	= $tempjobData;
			
			if(isset($participantloginData)) {
				
				require_once 'class/shortlist.php';
				
				$shortlistObject	= new class_shortlist();
				
				/* Save for the participant. */
				$data = array();
				$data['shortlist_type']			= 'JOB';
				$data['participant_code'] 	= $participantloginData['participant_code'];
				$data['shortlist_reference']	= $tempjobData['job_code'];
				
				$shortlistObject->insert($data);
				
			}
		}
		
		$errorArray['message']	= array();
		$errorArray['result']	= 1;			
		
	}
	
	echo json_encode($errorArray);
	die();	
}

if(isset($_POST['action']) && trim($_POST['action']) == 'removeshortlistjob') {

	/*** Standard includes */
	require_once 'config/database.php';
	
	require_once 'includes/auth.php';
	
	require_once 'class/job.php';
	
	$errorArray					= array();
	$errorArray['message']	= array();
	$errorArray['result']		= true;	
	$jobObject 					= new class_job();
	
	if(isset($_POST['jobcode']) && trim($_POST['jobcode']) == '') {
		$errorArray['message'][] = 'Job to shortlist is not selected';
		$errorArray['result'] = false;
	}
		
	if(count($errorArray['message'])  == 0 && $errorArray['result']  == true ) {
			
			for($i = 0; $i < count($zfsession->shortlist); $i++) {
			
				if(trim($_POST['jobcode']) == trim($zfsession->shortlist[$i])) {
					unset($zfsession->shortlist[$i]);
					unset($zfsession->shortlistdata[$i]);
				}
			}
			
			$zfsession->shortlistdata 	= array_values($zfsession->shortlistdata);
			$zfsession->shortlist 			= array_values($zfsession->shortlist);
			
			if(isset($participantloginData)) {
				
				require_once 'class/shortlist.php';
				
				$shortlistObject	= new class_shortlist();
				
				/* Delete for the participant. */
				$data = array();
				$data['shortlist_deleted']	= 1;

				$where = array();
				$where[] = $shortlistObject->getAdapter()->quoteInto('shortlist_reference = ?', trim($_POST['jobcode']));
				$where[] = $shortlistObject->getAdapter()->quoteInto('shortlist_type = ?', 'JOB');
				$where[] = $shortlistObject->getAdapter()->quoteInto('participant_code = ?', $participantloginData['participant_code']);
				$shortlistObject->update($data, $where);
				
			}
			
			$errorArray['message']	= array();
			$errorArray['result']		= 1;						
	}
		
	echo json_encode($errorArray);
	die();	
		
}

if(isset($_POST['action']) && trim($_POST['action']) == 'shortlistinternship') {

	/*** Standard includes */
	require_once 'config/database.php';
	
	require_once 'includes/auth.php';
	
	require_once 'class/internship.php';	
	
	$errorArray					= array();
	$errorArray['message']	= array();
	$errorArray['result']		= true;	
	$internshipObject 			= new class_internship();
	
	if(isset($_POST['internshipcode']) && trim($_POST['internshipcode']) == '') {
		$errorArray['message'][] = 'Internship to shortlist is not selected';
		$errorArray['result'] = false;
	} else {
		
		$tempinternshipData = $internshipObject->getByCode(trim($_POST['internshipcode']));
		
		if(!$tempinternshipData) {
			$errorArray['message'][] = 'Internship selected does not exist';
			$errorArray['result'] = false;			
		}
	}
		
	if(count($errorArray['message'])  == 0 && $errorArray['result']  == true ) {
		
		if(!in_array($tempinternshipData['internship_code'], $zfsession->shortlistinternships)) {
			/* Add to the shortlistinternships session. */
			$zfsession->shortlistinternships[] 		= $tempinternshipData['internship_code'];
			$zfsession->shortlistinternshipsdata[]	= $tempinternshipData;
			
			if(isset($participantloginData)) {
				
				require_once 'class/shortlist.php';
				
				$shortlistObject	= new class_shortlist();
				
				/* Save for the participant. */
				$data = array();
				$data['shortlist_type']			= 'INTERNSHIP';
				$data['participant_code'] 	= $participantloginData['participant_code'];
				$data['shortlist_reference']	= $tempinternshipData['internship_code'];
				
				$shortlistObject->insert($data);
				
			}
		}
		
		$errorArray['message']	= array();
		$errorArray['result']	= 1;			
		
	}
	
	echo json_encode($errorArray);
	die();	
}

if(isset($_POST['action']) && trim($_POST['action']) == 'removeshortlistinternship') {

	/*** Standard includes */
	require_once 'config/database.php';
	
	require_once 'includes/auth.php';
	
	require_once 'class/internship.php';
	
	$errorArray					= array();
	$errorArray['message']	= array();
	$errorArray['result']		= true;	
	$internshipObject 			= new class_internship();
	
	if(isset($_POST['internshipcode']) && trim($_POST['internshipcode']) == '') {
		$errorArray['message'][] = 'Job to shortlist is not selected';
		$errorArray['result'] = false;
	}
		
	if(count($errorArray['message'])  == 0 && $errorArray['result']  == true ) {
			
			for($i = 0; $i < count($zfsession->shortlistinternships); $i++) {
			
				if(trim($_POST['internshipcode']) == trim($zfsession->shortlistinternships[$i])) {
					unset($zfsession->shortlistinternships[$i]);
					unset($zfsession->shortlistinternshipsdata[$i]);
				}
			}
			
			$zfsession->shortlistinternshipsdata 	= array_values($zfsession->shortlistinternshipsdata);
			$zfsession->shortlistinternships 			= array_values($zfsession->shortlistinternships);
			
			if(isset($participantloginData)) {
				
				require_once 'class/shortlist.php';
				
				$shortlistObject	= new class_shortlist();
				
				/* Delete for the participant. */
				$data = array();
				$data['shortlist_deleted']	= 1;

				$where = array();
				$where[] = $shortlistObject->getAdapter()->quoteInto('shortlist_reference = ?', trim($_POST['internshipcode']));
				$where[] = $shortlistObject->getAdapter()->quoteInto('shortlist_type = ?', 'INTERNSHIP');
				$where[] = $shortlistObject->getAdapter()->quoteInto('participant_code = ?', $participantloginData['participant_code']);
				$shortlistObject->update($data, $where);
				
			}
			
			$errorArray['message']	= array();
			$errorArray['result']		= 1;						
	}
		
	echo json_encode($errorArray);
	die();	

}

/* Ajax */
if(isset($_GET['action']) && trim($_GET['action']) == 'deleteCV') {
	
	require_once 'config/database.php';
		
	require_once 'class/cv.php';
	
	require_once 'includes/auth.php';
	
	$errorArray					= array();
	$errorArray['message']	= array();
	$errorArray['result']		= true;	
	$code							= trim($_GET['code_delete']);
	$cvObject						= new class_cv();
	
	if(!isset($zfsession->participant)) {
		$errorArray['message'][] = 'Please log in first.';
		$errorArray['result'] = false;
	}
	
	if(count($errorArray['message'])  == 0 && $errorArray['result']  == true ) {
	
		$data	= array();
		$data['cv_deleted'] = 1;
		
		$where = array();
		$where[] = $cvObject->getAdapter()->quoteInto('cv_code = ?', $code);
		$where[] = $cvObject->getAdapter()->quoteInto('participant_code = ?', $zfsession->participant['participant_code']);
		$cvObject->update($data, $where);	
	}
	
	echo json_encode($errorArray);
	exit;
}

$smarty->assign('APP_ID', APP_ID);

$smarty->display('includes/footer.tpl');


