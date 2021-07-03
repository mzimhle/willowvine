<?php

/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');

require_once 'config/database.php';
require_once 'includes/auth.php';

$formValid		= true;
	
if(!isset($_GET['type'])) {
	$formValid = false;		
} else if(trim($_GET['type']) == '') {
	$formValid = false;	
}

if(!isset($_GET['code'])) {
	$formValid = false;		
} else if(trim($_GET['code']) == '') {
	$formValid = false;	
}

if($formValid) {
	
	$type 	= trim($_GET['type']);
	$code 	= trim($_GET['code']);
	$data	= array();
	
	switch($type) {
		case 'cv' : 
		
			require_once 'class/cv.php';
			
			$cvObject = new class_cv();
			
			$cvObject->download($code);
			
			exit;
		case 'exam' : 
		
			require_once 'class/exam.php';
			
			$examObject = new class_exam();
			
			$examObject->download($code);
			
			exit;			
		case 'profileimage' : 
			
			if(isset($_GET['imagesize'])) {
				require_once 'class/participant.php';

				$participantObject = new class_participant();

				$participantObject->download($zfsession->participant['participant_code'], trim($_GET['imagesize']));
				
				exit;
			}
	}
}

header('Location: /404/');
exit;

?>