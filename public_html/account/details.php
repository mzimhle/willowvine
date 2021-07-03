<?php
/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');
/**
 * Standard includes
 */
require_once 'config/database.php';
require_once 'config/smarty.php';

require_once 'includes/auth.php';
require_once 'class/participant.php';
require_once 'class/File.php';

$participantObject 	= new class_participant();
$fileObject				= new File(array('png', 'jpg', 'jpeg'));

$loginData = $participantObject->_participantlogin->getByParticipant($zfsession->participant['participant_code']);
if($loginData) $smarty->assign('loginData', $loginData);

/* Check posted data. */
if(count($_POST) > 0) {

	$errorArray		= array();
	$formValid		= true;
	
	/*
	if(isset($_POST['areapost_code']) && trim($_POST['areapost_code']) == '') {
		$errorArray['areapost_code'] = 'Your area, town, suburb is required';
		$formValid = false;		
	}
	*/
	
	if(isset($_POST['participant_name']) && trim($_POST['participant_name']) == '') {
		$errorArray['participant_name'] = 'Your name(s) are required';
		$formValid = false;		
	}
	
	if(isset($_POST['participant_surname']) && trim($_POST['participant_surname']) == '') {
		$errorArray['participant_surname'] = 'Your surname is required';
		$formValid = false;		
	}
	
	/*
	if(isset($_POST['participant_bidrthdate']) && trim($_POST['participant_birthdate']) != '') {
		if($participantObject->validateDate(trim($_POST['participant_birthdate'])) == '') {
			$errorArray['participant_birthdate'] = 'Birth date needs to be a valid date';
			$formValid = false;
		}
	} else {
		$errorArray['participant_birthdate'] = 'Please add your date of birth';
		$formValid = false;		
	}
	*/
	if(isset($_POST['participant_gender']) && trim($_POST['participant_gender']) == '') {
		$errorArray['participant_gender'] = 'Please select your gender';
		$formValid = false;		
	}
	
	if(isset($_FILES['profileimage'])) {
		/* Check validity of the CV. */
		if((int)$_FILES['profileimage']['size'] != 0 && trim($_FILES['profileimage']['name']) != '') {
			/* Check if its the right file. */
			$ext = $fileObject->file_extention($_FILES['profileimage']['name']); 

			if($ext != '') {				
				$checkExt = $fileObject->getValidateExtention('profileimage', $ext);				
				if(!$checkExt) {
					$errorArray['profileimage'] = 'Please only upload jpg, jpeg or png image types';
					$formValid = false;						
				} else {
					/* Check width and height */
					$profileimage = getimagesize($_FILES['profileimage']['tmp_name']);
					
					if($profileimage[0] < 150 || $profileimage[1] < 150) {
						$errorArray['profileimage'] = 'Image needs to have a width more than 150 pixels as well as a height that is more than 150 pixels';
						$formValid = false;
					}
				}
			} else {
				$errorArray['profileimage'] = 'Invalid file type';
				$formValid = false;									
			}
		} else {			
			switch((int)$_FILES['profileimage']['error']) {
				case 1 : $errorArray['profileimage'] = 'The uploaded file exceeds the maximum upload file size, should be less than 1M'; $formValid = false; break;
				case 2 : $errorArray['profileimage'] = 'File size exceeds the maximum file size'; $formValid = false; break;
				case 3 : $errorArray['profileimage'] = 'File was only partically uploaded, please try again'; $formValid = false; break;
				//case 4 : $errorArray['profileimage'] = 'No file was uploaded'; $formValid = false; break;
				case 6 : $errorArray['profileimage'] = 'Missing a temporary folder'; $formValid = false; break;
				case 7 : $errorArray['profileimage'] = 'Faild to write file to disk'; $formValid = false; break;
			}
		}
	}
	
	if(count($errorArray) == 0 && $formValid == true) {
		
		$data 	= array();				
		$data['areapost_code']			= trim($_POST['areapost_code']);		
		$data['participant_name']		= trim($_POST['participant_name']);		
		$data['participant_surname']	= trim($_POST['participant_surname']);		
		$data['participant_birthdate']	= trim($_POST['participant_birthdate']);
		$data['participant_gender']		= trim($_POST['participant_gender']);
		$data['participant_code']		= $zfsession->participant['participant_code'];
		
		$where		= $participantObject->getAdapter()->quoteInto('participant_code = ?', $zfsession->participant['participant_code']);
		$success	= $participantObject->update($data, $where);		
		
		/* UPDATE EMAIL LOGIN IF EXISTS AND UPDATE. */
		$emaillogin = $participantObject->_participantlogin->getByLogin($zfsession->participant['participant_code'], 'EMAIL');
		
		if($emaillogin) {
			$updateData = $participantObject->getByCode($zfsession->participant['participant_code']);
			
			$where = null;
			$where		= $participantObject->_participantlogin->getAdapter()->quoteInto('participantlogin_code = ?', $zfsession->identity);
			
			$participantObject->_participantlogin->updateLogin($updateData, $where, 'EMAIL');
		}
		
		/* UPLOAD LOGO. */
		if(isset($_FILES['profileimage'])) {
			if((int)$_FILES['profileimage']['size'] != 0 && trim($_FILES['profileimage']['name']) != '') {
				
				$image = array();
				$image['participant_image_name']		= $fileObject->getRandomFileName();
				$image['participant_image_path']		= '';
				$image['participant_image_ext']			= '';
				
				$ext 			= strtolower($fileObject->file_extention($_FILES['profileimage']['name']));					
				$filename	= $image['participant_image_name'].'.'.$ext;			
				$directory	= $_SERVER['DOCUMENT_ROOT'].'/media/participant/'.$zfsession->participant['participant_code'].'/';
				$file			= $directory.'/'.$filename;	
				
				if(!is_dir($directory)) mkdir($directory, 0777, true);

				foreach($fileObject->logo as $item) {
					
					$newfilename = str_replace($filename, $item['code'].$filename, $file);
					
					$uploadObject	= PhpThumbFactory::create($_FILES['profileimage']['tmp_name']);
					$uploadObject->adaptiveResize($item['width'], $item['height']);
					$uploadObject->save($newfilename);
				
				}

				$image['participant_image_path']	= '/media/participant/'.$zfsession->participant['participant_code'].'/';
				$image['participant_image_ext']		= '.'.$ext;
				$image['participant_code']				= $zfsession->participant['participant_code'];
				
				$where = $participantObject->getAdapter()->quoteInto('participant_code = ?', $zfsession->participant['participant_code']);
				$participantObject->update($image, $where);			
			
			}
		}

		$smarty->assign('success', $zfsession->identity);

	}
	
	/* if we are here there are errors. */
	$smarty->assign('errorArray', $errorArray);	
}

$smarty->display('account/details.tpl');
?>