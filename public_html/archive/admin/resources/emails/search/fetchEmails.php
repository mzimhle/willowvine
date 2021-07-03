<?php
	/* Check file exists and submitted. */	
	if(isset($_FILES['searchFile'])) {
		echo '<a href="/admin/resources/emails/search/">Go Back to Search Emails</a><br /><br />';
		/* Check if there is a File. */
		if(isset($_FILES['searchFile']) && trim($_FILES['searchFile']['name']) != '') {
		
			/* Check size. */
			if((int)$_FILES['searchFile']['size'] != 0) {
				/* Check if its the right file. */
				if($_FILES['searchFile']['type'] == 'text/plain') {
					/* File data. */
					$fileData = file_get_contents($_FILES['searchFile']['tmp_name']);
					/* Excract the emails. */
					preg_match_all('/([\w\d\.\-\_]+)@([\w\d\.\_\-]+)/mi', $fileData, $matches);

					/* Get required files for database connection. */
					require_once 'config/setup.php';
					require_once 'class/email.php';
					
					$emailObject = new class_email();
					$addedEmails = array();
					
					/* process emails. */
					for($z = 0; $z < count($matches); $z++) {
						for($i = 0; $i < count($matches[$z]); $i++) {
							/* Check if its an email. */
							if (preg_match("/^([a-zA-Z0-9])+@([a-zA-Z0-9_-])+(\.[a-zA-Z0-9_-]+)+/", $matches[$z][$i])) {
								/* Check from which university this is from. */
								$domain		= trim(str_replace('@', '', strstr($matches[$z][$i], '@')));
								$data		= array();
								$checkEmail = '';
								
								/* Switch university. */
								switch($domain) {
									case 'uwc.ac.za': 
										/* UWC emails are only numbers. */
										if(preg_match("/^([0-9])+@([a-zA-Z0-9_-])+(\.[a-zA-Z0-9_-]+)+/", $matches[$z][$i])) {
											/* Check if email already exists. */
											$checkEmail = $emailObject->checkEmail($matches[$z][$i]);
											
											/* Proceed if it does not exist. */
											if(trim($checkEmail) == '') {
												/* Build insert data. */
												$data['email_type']		= 'uwc'; 
												$data['email_email']	= $matches[$z][$i];	
												
												/* Insert data. */
												$emailObject->insert($data);
												
												/* Add so as to record. */
												$addedEmails[] = $matches[$z][$i];
											}
										}
									break;
									default: $nothingToDo = ''; 
								}															
							}
						}
					}
					
					/* Check if there are any inserted emails. */
					if(isset($addedEmails)) {
					
						echo 'Inserted Emails<br /><br />';
						
						for($z = 0; $z < count($addedEmails); $z++) {
							/* Display inserted emails. */
							echo $addedEmails[$z].'<br />';
							
						}
					}
					exit;
				} else {
					echo '<b>File must be .text</b>';
				}
			} else {
				echo '<b>File must be less than 1 Megabyte and not empty.</b>';
			}
		} else {
			echo '<b>Please upload File.</b>';
		}
			
	}

?>