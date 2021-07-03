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

/* Other resources. */
require_once 'includes/resources.php';
require_once 'includes/global_functions.php';

/* objects. */
require_once 'class/email.php';

$emailObject = new class_email();

/* Check posted data. */
if(count($_POST) > 0) {
	
	$errorMessages	= array();
	$data 			= array();
	$formValid	= true;
	$success		= NULL;
	
	if(isset($_FILES['emailFile']) && trim($_FILES['emailFile']['name']) == '') { 
		$errorMessages['emailFile'] = 'Please upload CV.';
	} else {
		/* Check validity of the CV. */
			if((int)$_FILES['emailFile']['size'] != 0) {
				/* Check if its the right file. */
				if($_FILES['emailFile']['type'] == 'text/plain') { 
						/* Do nothing. */ 
					} else {
						$errorMessages['emailFile'] = 'File must be .txt';
					}
			} else {
				$errorMessages['emailFile'] = 'CV must be less than 1 MB.';
			}
	}
	
	/* Check type. */
	if(isset($_POST['type']) && trim($_POST['type']) == '') {
		$errorMessages['type'] = 'missing.';
	}	
		
	if(count($errorMessages) == 0 && $formValid == true) {
		echo '<a href="/admin/resources/emails/details.php">Go Back</a><br /><br />';
		/* Read file line by line. */
		foreach (file($_FILES['emailFile']['tmp_name']) as $line) {
			/* Data to insert. */
			if(trim($line) != '') {
				/* Clean up. */
				$data = NULL; UNSET($data);
				$data = array(); 
				
				$letters = explode(" ", trim($line));
				/* Get last item which is the email. Also removing the last element. */
				$data['email_email'] = trim(array_pop($letters));
				
				/* Check if its an email. */
				
				if(!preg_match('/^[a-zA-Z0-9_\+-]+(\.[a-zA-Z0-9_\+-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*\.([a-z]{2,4})$/', $data['email_email'])) {
					echo '<span style="color: red;">Error: email not found: '.$line.':'.$data['email_email'].' </span><br />';
				} else {
					/* Check if email exists. */
					$exists = $emailObject->checkEmail($data['email_email']);
					if(trim($exists) != '') {
						echo '<span style="color: red;">Email exists: '.$line.': '.$data['email_email'].'</span><br />';				
					} else {
						/* Get name. */
						$data['email_name'] = implode(" ",$letters);
						$data['email_type'] = trim($_POST['type']);
						$data['email_sent'] = 0;
						
						/* Insert email. */
						$success = $emailObject->insert($data);	
						
						if(!is_numeric($success)) {
							echo '<span style="color: red;">Error: Cant insert line: '.$line.'</span><br />';		
						} else {
							echo '<span style="color: green;">'.$line.'</span><br />';
						}
					}
				}
			} else {
				echo '<span style="color: red;">Error: Line is empty</span><br />';	
			}
		}
		
		exit;	
	}			
}

$smarty->display('admin/resources/emails/details.tpl');

?>