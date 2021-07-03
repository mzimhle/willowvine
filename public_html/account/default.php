<?php
/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');
/**
 * Standard includes
 */
require_once 'config/database.php';
require_once 'config/smarty.php';

require_once 'includes/auth.php';

require_once 'class/cv.php';
require_once 'class/File.php';

$cvObject		= new class_cv();
$fileObject 	= new File(array('txt', 'pdf', 'doc', 'docx'));

$cvData = $cvObject->getByParticipant($zfsession->participant['participant_code']);
if($cvData) $smarty->assign('cvData', $cvData);

 if(isset($_GET['deletecode'])) {
	
	$errorArray				= array();
	$errorArray['error']	= '';
	$errorArray['result']	= 0;	
	$formValid				= true;
	$success					= NULL;
	$deletecode			= trim($_GET['deletecode']);
		
	if($errorArray['error']  == '' && $errorArray['result']  == 0 ) {
		$data	= array();
		$data['subscription_deleted'] = 1;
		
		$where = $subscriptionObject->getAdapter()->quoteInto('subscription_code = ?', $deletecode);
		$success	= $subscriptionObject->update($data, $where);	
		
		if(is_numeric($success) && $success > 0) {
			$errorArray['error']	= '';
			$errorArray['result']	= 1;			
		} else {
			$errorArray['error']	= 'Could not delete, please try again.';
			$errorArray['result']	= 0;				
		}
	}
	
	echo json_encode($errorArray);
	exit;
}

/* Check posted data. */
if(count($_POST) > 0 || isset($_FILES)) {
	$errorArray		= array();
	$data 				= array();
	$formValid		= true;
	$success			= NULL;
	$areapostByName	= NULL;

	if(isset($_REQUEST['newsletter_form'])) {
		if(isset($_POST['subscription_type']) && trim($_POST['subscription_type']) == '') {
			$errorArray['subscription_type'] = 'required';
			$formValid = false;		
		}
		
		if(isset($_POST['subscription_schedule']) && trim($_POST['subscription_schedule']) == '') {
			$errorArray['subscription_schedule'] = 'required';
			$formValid = false;		
		}
		
		if(count($errorArray) == 0 && $formValid == true) {
			
			$data['participant_code']				= $zfsession->participant['participant_code'];
			$data['subscription_type'] 		= trim($_POST['subscription_type']);
			$data['subscription_schedule']	= trim($_POST['subscription_schedule']);
			
			$checkexists = $subscriptionObject->checkExists($zfsession->participant['participant_code'], trim($_POST['subscription_type']));
			
			if(!$checkexists) {
				$success = $subscriptionObject->insert($data);
				
				header('Location: /account/');
				exit;		
			} else {
				$errorArray['subscription_type'] = 'Already exists.';
			}
		}
	}
	
	if(isset($_FILES['documentfile'])) {
	
		$errorArray	= array();
		$data 			= array();
		$formValid	= true;
		$success		= NULL;
		
		if(isset($_FILES['documentfile'])) {
			/* Check validity of the CV. */
			if((int)$_FILES['documentfile']['size'] != 0 && trim($_FILES['documentfile']['name']) != '') {
				/* Check if its the right file. */
				$ext = $fileObject->file_extention($_FILES['documentfile']['name']); 

				if($ext != '') {				
					$checkExt = $fileObject->getValidateExtention('documentfile', $ext);				
					if(!$checkExt) {
						$errorArray['documentfile'] = 'Please only upload doc, docx, pdf or txt';
						$formValid = false;						
					}
				} else {
					$errorArray['documentfile'] = 'Invalid file type';
					$formValid = false;									
				}
			} else {			
				switch((int)$_FILES['documentfile']['error']) {
					case 1 : $errorArray['documentfile'] = 'The uploaded file exceeds the maximum upload file size, should be less than 1M'; $formValid = false; break;
					case 2 : $errorArray['documentfile'] = 'File size exceeds the maximum file size'; $formValid = false; break;
					case 3 : $errorArray['documentfile'] = 'File was only partically uploaded, please try again'; $formValid = false; break;
					case 4 : $errorArray['documentfile'] = 'No file was uploaded'; $formValid = false; break;
					case 6 : $errorArray['documentfile'] = 'Missing a temporary folder'; $formValid = false; break;
					case 7 : $errorArray['documentfile'] = 'Faild to write file to disk'; $formValid = false; break;
				}
			}
		}
		
		if(count($errorArray) == 0 && $formValid == true) {
			
			$data = array();
			$data['cv_code']		= $cvObject->createReference();		
			$data['participant_code']		= $zfsession->participant['participant_code'];
				
			$ext 							= strtolower($fileObject->file_extention($_FILES['documentfile']['name']));	
			
			$filename					= $data['cv_code'].'.'.$ext;
			$directorydocument	= '/media/participant/'.$zfsession->participant['participant_code'].'/cv/';
			$directory					= $_SERVER['DOCUMENT_ROOT'].$directorydocument;
			$file							= $directory.'/'.$filename;	
			
			if(!is_dir($directory)) mkdir($directory, 0777, true);
			
			if(file_put_contents($file, file_get_contents($_FILES['documentfile']['tmp_name']))) {
			
				$data['cv_path']			= '/media/participant/'.$zfsession->participant['participant_code'].'/cv/'.$data['cv_code'].'.'.$ext;
				$data['cv_filename']	= trim($_FILES['documentfile']['name']);
				$data['cv_content'] 	= $ext == 'pdf' ? null : $cvObject->parseWord($file);
				
				$success	= $cvObject->insert($data);	
				
				$cvObject->updatePrimaryByParticipant(trim($data['cv_code']), $zfsession->participant['participant_code']);					
				
				header('Location: /account/');
				exit;
			} else {
				$errorArray['documentfile'] = 'required';
				$formValid = false;			
			}		
		}
	}
	
	$smarty->assign('errorArray', $errorArray);
}

$smarty->display('account/default.tpl');
?>