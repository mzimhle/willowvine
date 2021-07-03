<?php
/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');

/* Standard includes */
require_once 'config/database.php';
require_once 'config/smarty.php';

/* Check for login */
require_once 'includes/auth.php';

/* objects. */
require_once 'class/_message.php';
require_once 'class/File.php';

$messageObject	= new class_message();
$htmlObject			= new File(array('html', 'htm'));
$imageObject		= new File(array('jpeg', 'jpg', 'png', 'gif'));

if (isset($_GET['code']) && trim($_GET['code']) != '') {
	
	$code = trim($_GET['code']);
	
	$messageData = $messageObject->getByCode($code);

	if($messageData) {
		$smarty->assign('messageData', $messageData);
	} else {
		header('Location: /communication/messages/');
		exit;		
	}
}

/* Check posted data. */
if(count($_POST) > 0) {
	$errorArray	= array();
	$data 		= array();
	$formValid	= true;
	$success	= NULL;

	if(isset($_POST['_message_name']) && trim($_POST['_message_name']) == '') {
		$errorArray['_message_name'] = 'Name required';
		$formValid = false;		
	}
	
	if(isset($_POST['_message_type']) && trim($_POST['_message_type']) == '') {
		$errorArray['_message_type'] = 'Type required';
		$formValid = false;		
	}
	
	if(isset($messageData)) {
		if(trim($_POST['_message_type']) == 'EMAIL'){
			if(isset($_POST['_message_subject']) && trim($_POST['_message_subject']) == '') {
				$errorArray['_message_subject'] = 'Subject required for emails';
				$formValid = false;		
			}
			
			if(isset($_FILES['htmlfile'])) {
				/* Check validity of the CV. */
				if((int)$_FILES['htmlfile']['size'] != 0 && trim($_FILES['htmlfile']['name']) != '') {
					/* Check if its the right file. */
					$ext = $htmlObject->file_extention($_FILES['htmlfile']['name']); 

					if($ext != '') {				
						$checkExt = $htmlObject->getValidateExtention('htmlfile', $ext);				
						if(!$checkExt) {
							$errorArray['htmlfile'] = 'Invalid file type something funny with the file format';
							$formValid = false;						
						} else {
							/* Check width and height */
							$htmlfile = $htmlObject->getValidateSize($_FILES['htmlfile']['size']);
							
							if(!$htmlfile) {
								$errorArray['htmlfile'] = 'File needs to be less than 2MB.';
								$formValid = false;							
							}
						}
					} else {
						$errorArray['htmlfile'] = 'Invalid file type';
						$formValid = false;									
					}
				} else {			
					switch((int)$_FILES['htmlfile']['error']) {
						case 1 : $errorArray['htmlfile'] = 'The uploaded file exceeds the maximum upload file size, should be less than 1M'; $formValid = false; break;
						case 2 : $errorArray['htmlfile'] = 'File size exceeds the maximum file size'; $formValid = false; break;
						case 3 : $errorArray['htmlfile'] = 'File was only partically uploaded, please try again'; $formValid = false; break;
						//case 4 : $errorArray['htmlfile'] = 'No file was uploaded'; $formValid = false; break;
						case 6 : $errorArray['htmlfile'] = 'Missing a temporary folder'; $formValid = false; break;
						case 7 : $errorArray['htmlfile'] = 'Faild to write file to disk'; $formValid = false; break;
					}
				}
			}

			if(isset($_FILES['imagefiles']['name']) && count($_FILES['imagefiles']['name']) > 0) {
				for($i = 0; $i < count($_FILES['imagefiles']['name'][$i]); $i++) {
					/* Check validity of the CV. */
					if((int)$_FILES['imagefiles']['size'][$i] != 0 && trim($_FILES['imagefiles']['name'][$i]) != '') {
						/* Check if its the right file. */
						$ext = $imageObject->file_extention($_FILES['imagefiles']['name'][$i]); 

						if($ext != '') {
							$checkExt = $imageObject->getValidateExtention('imagefiles', $ext, $i);

							if(!$checkExt) {
								$errorArray['imagefiles'] = 'Invalid file type something funny with the file format';
								$formValid = false;						
							} else {
								/* Check width and height */
								$imagefiles = $imageObject->getValidateSize($_FILES['imagefiles']['size'][$i]);
								
								if(!$imagefiles) {
									$errorArray['imagefiles'] = 'File needs to be less than 2MB.';
									$formValid = false;							
								}
							}
						} else {
							$errorArray['imagefiles'] = 'Invalid file type';
							$formValid = false;									
						}
					} else {			
						switch((int)$_FILES['imagefiles']['error'][$i]) {
							case 1 : $errorArray['imagefiles'] = 'The uploaded file exceeds the maximum upload file size, should be less than 1M'; $formValid = false; break;
							case 2 : $errorArray['imagefiles'] = 'File size exceeds the maximum file size'; $formValid = false; break;
							case 3 : $errorArray['imagefiles'] = 'File was only partically uploaded, please try again'; $formValid = false; break;
							//case 4 : $errorArray['imagefiles'] = 'No file was uploaded'; $formValid = false; break;
							case 6 : $errorArray['imagefiles'] = 'Missing a temporary folder'; $formValid = false; break;
							case 7 : $errorArray['imagefiles'] = 'Faild to write file to disk'; $formValid = false; break;
						}
					}
				}
			}
			
		} else if(trim($_POST['_message_type']) == 'SMS'){
			if(isset($_POST['_message_text']) && trim($_POST['_message_text']) == '') {
				$errorArray['_message_text'] = 'Message is required for sms';
				$formValid = false;		
			} else if(strlen(trim($_POST['_message_text'])) < 160) {
				$errorArray['_message_text'] = 'Text message less than 160 characters';
				$formValid = false;		
			}
		}
	}
	
	if(count($errorArray) == 0 && $formValid == true) {
	
		$data 	= array();				
		$data['_message_name']	= trim($_POST['_message_name']);				
		$data['_message_type']		= trim($_POST['_message_type']);
		
		if(isset($messageData)) {			
			if($messageData['_message_type'] == 'SMS') {
				$data['_message_text'] = trim($_POST['_message_text']);	
			} else {			
				$data['_message_subject'] = trim($_POST['_message_subject']);		
			}
		}
		
		if(isset($messageData)) {
			$where		= $messageObject->getAdapter()->quoteInto('_message_code = ?', $messageData['_message_code']);
			$success	= $messageObject->update($data, $where);			
			$success 	= $messageData['_message_code'];
		} else {
			$success = $messageObject->insert($data);
			
			$directory	= $_SERVER['DOCUMENT_ROOT'].'/templates/messages/'.$success.'/';		
			if(!is_dir($directory)) mkdir($directory, 0777, true);

			$imagedirectory	= $_SERVER['DOCUMENT_ROOT'].'/templates/messages/'.$success.'/images/';		
			if(!is_dir($imagedirectory)) mkdir($imagedirectory, 0777, true);				
		}
		
		if(count($errorArray) == 0) {		
			/* Upload actual .html and .htm file. */
			if(isset($messageData) && isset($_FILES['htmlfile'])) {
				if((int)$_FILES['htmlfile']['size'] != 0 && trim($_FILES['htmlfile']['name']) != '') {
				
					$ext 			= strtolower($htmlObject->file_extention($_FILES['htmlfile']['name']));					
					$filename	= $success.'.'.$ext;
					$directory	= $_SERVER['DOCUMENT_ROOT'].'/templates/messages/'.$success.'/';	
					$file			= $directory.'/'.$filename;
				
					if(file_put_contents($file, file_get_contents($_FILES['htmlfile']['tmp_name']))) {
						
						$data = null; $data = array();
						$data['_message_file']	= '/messages/'.$filename;
						
						$where		= $messageObject->getAdapter()->quoteInto('_message_code = ?', $messageData['_message_code']);
						$success	= $messageObject->update($data, $where);	
						
					} else {
						$errorArray['htmlfile'] = 'could not upload file, please try again';
						$formValid = false;			
					}						
				}
			}
		}
		
		if(count($errorArray) == 0) {
			/* Upload image files. */
			if(isset($messageData) && isset($_FILES['imagefiles']) && count($_FILES['imagefiles']['name']) > 0) {
				for($i = 0; $i < count($_FILES['imagefiles']['name']); $i++) {
					if(isset($_FILES['imagefiles']['size'][$i])) {
						if((int)$_FILES['imagefiles']['size'][$i] != 0 && trim($_FILES['imagefiles']['name'][$i]) != '') {				
							$filename	= $_FILES['imagefiles']['name'][$i];
							$directory	= $_SERVER['DOCUMENT_ROOT'].'/templates/messages/'.$success.'/images/';
							$file			= $directory.'/'.$filename;
						
							if(!file_put_contents($file, file_get_contents($_FILES['imagefiles']['tmp_name'][$i]))) {					
								$errorArray['imagefiles'] = 'could not upload file, please try again';
								$formValid = false;			
							}						
						}
					}
				}
			}
		}
		if(count($errorArray) == 0) {
			header('Location: /communication/messages/details.php?code='.$success);	
			exit;		
		}
		
	}
	
	/* if we are here there are errors. */
	$smarty->assign('errorArray', $errorArray);	
}

$smarty->display('communication/messages/details.tpl');

?>