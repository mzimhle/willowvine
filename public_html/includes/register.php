<?php
/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');

require_once 'config/database.php';
require_once 'config/smarty.php';

global $smarty, $zfsession;

if(isset($zfsession->participant)) {

	require_once 'class/cv.php';
	require_once 'class/File.php';

	$cvObject 				= new class_cv();
	$fileObject				= new File(array('docx', 'doc', 'pdf', 'txt'));
	
	/* Check posted data. */
	if(isset($_FILES['documentfile'])) {

		$errorArray		= array();
		$data 				= array();
		$formValid		= true;
		$success			= NULL;

		if(isset($_FILES['documentfile'])) {
			/* Check validity of the CV. */
			if((int)$_FILES['documentfile']['size'] != 0 && trim($_FILES['documentfile']['name']) != '') {
				/* Check if its the right file. */
				$ext = $fileObject->file_extention($_FILES['documentfile']['name']); 

				if($ext != '') {				
					$checkExt = $fileObject->getValidateExtention('documentfile', $ext);				
					if(!$checkExt) {
						$errorArray[] = 'Something funny with the file format, only .pdf, .docx, .doc and .txt files allowed.';
						$formValid = false;						
					} else {
						/* Check width and height */
						$documentfile = $fileObject->getValidateSize($_FILES['documentfile']['size']);
						
						if(!$documentfile) {
							$errorArray[] = 'File needs to be less than 2MB.';
							$formValid = false;							
						}
					}
				} else {
					$errorArray[] = 'Something funny with the file format, only .pdf, .docx, .doc and .txt files allowed.';
					$formValid = false;									
				}
			} else {			
				switch((int)$_FILES['documentfile']['error']) {
					case 1 : $errorArray[] = 'The uploaded file exceeds the maximum upload file size, should be less than 1M'; $formValid = false; break;
					case 2 : $errorArray[] = 'File size exceeds the maximum file size'; $formValid = false; break;
					case 3 : $errorArray[] = 'File was only partically uploaded, please try again'; $formValid = false; break;
					case 4 : $errorArray[] = 'No file was uploaded'; $formValid = false; break;
					case 6 : $errorArray[] = 'Missing a temporary folder'; $formValid = false; break;
					case 7 : $errorArray[] = 'Faild to write file to disk'; $formValid = false; break;
				}
			}
		}
		
		if(count($errorArray) == 0 && $formValid == true) {
			
			$data 	= array();				
			$data['participant_code']	= $zfsession->participant['participant_code'];		
			
			$ext 			= strtolower($fileObject->file_extention($_FILES['documentfile']['name']));					
			$filename	= $fileObject->getRandomFileName($zfsession->participant['participant_code']).'.'.$ext;
			$directory	= $_SERVER['DOCUMENT_ROOT'].'/media/participants/'.$zfsession->participant['participant_code'].'/cv/';
			$file			= $directory.'/'.$filename;	
			
			if(!is_dir($directory)) mkdir($directory, 0777, true);
			
			if(file_put_contents($file, file_get_contents($_FILES['documentfile']['tmp_name']))) {
			
				$data['cv_path']		= '/media/participants/'.$zfsession->participant['participant_code'].'/cv/'.$filename;
				$data['cv_name']			= trim($_FILES['documentfile']['name']);
				$data['cv_content']	= $ext != 'pdf' ? $cvObject->parseWord($file) : null;
				
				$success = $cvObject->insert($data);	

				if($success) {
					$smarty->assign('success', 'Your CV has been successfully uploaded.');
				} else {
					$errorArray[] = 'You need to actually upload something to "Upload a CV."';
				}
				
			} else {
				$errorArray[] = 'could not upload file, please try again';
				$formValid = false;			
			}
		}

		/* if we are here there are errors. */
		if(count($errorArray) != 0) $smarty->assign('errorArray', implode('<br />', $errorArray));	

	}

	$cvData = $cvObject->getByParticipant($zfsession->participant['participant_code']);
	
	if($cvData) {
		$smarty->assign('cvData', $cvData);
	}
}

$smarty->display('includes/register.tpl');


