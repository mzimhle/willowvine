<?php
/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');

/**
 * Standard includes
 */
require_once 'config/database.php';
require_once 'config/smarty.php';

/**
 * Check for login
 */
require_once 'includes/auth.php';

require_once 'class/exam.php';
require_once 'class/subject.php';
require_once 'class/File.php';

$examObject 	= new class_exam();
$subjectObject	= new class_subject();
$fileObject			= new File(array('docx', 'doc', 'pdf'));

/* Get Pairs. */
$subjectPairs = $subjectObject->pairs();
if($subjectPairs) 	$smarty->assign('subjectPairs', $subjectPairs);

/**
  * If the item exists populate the form with data
  */
if (!empty($_GET['code']) && $_GET['code'] != '') {
	
	$code = trim($_GET['code']);
	
	$examData = $examObject->getByCode($code);
	
	if($examData) {
		$smarty->assign('examData', $examData);
	}	
}

/* Check posted data. */
if(count($_POST) > 0) {

	$errorArray	= array();	
	$formValid	= true;
	$success		= NULL;
	
	if(isset($_POST['exam_name']) && trim($_POST['exam_name']) == '') {
		$errorArray['exam_name'] = 'Name required';
		$formValid = false;		
	}
	
	if(isset($_POST['subject_code']) && trim($_POST['subject_code']) == '') {
		$errorArray['subject_code'] = 'Subject required';
		$formValid = false;		
	}
	
	if(isset($_POST['exam_date']) && trim($_POST['exam_date']) == '') {
		$errorArray['exam_date'] = 'Date required';
		$formValid = false;		
	}
	
	if(isset($_POST['exam_language']) && trim($_POST['exam_language']) == '') {
		$errorArray['exam_language'] = 'Language required';
		$formValid = false;		
	}
	
	if(isset($_FILES['examfile'])) {
		/* Check validity of the CV. */
		if((int)$_FILES['examfile']['size'] != 0 && trim($_FILES['examfile']['name']) != '') {
			/* Check if its the right file. */
			$ext = $fileObject->file_extention($_FILES['examfile']['name']); 

			if($ext != '') {
				$checkExt = $fileObject->getValidateExtention('examfile', $ext);				
				if(!$checkExt) {
					$errorArray['examfile'] = 'Something funny with the file format, only .pdf, .docx, .doc and .txt files allowed.';
					$formValid = false;						
				} else {
					/* Check width and height */
					$examfile = $fileObject->getValidateSize($_FILES['examfile']['size']);
					
					if(!$examfile) {
						$errorArray['examfile'] = 'File needs to be less than 2MB.';
						$formValid = false;							
					}
				}
			} else {
				$errorArray['examfile'] = 'Something funny with the file format, only .pdf, .docx and .doc  files allowed.';
				$formValid = false;									
			}
		} else {
			switch((int)$_FILES['examfile']['error']) {
				case 1 : $errorArray['examfile'] = 'The uploaded file exceeds the maximum upload file size, should be less than 1M'; $formValid = false; break;
				case 2 : $errorArray['examfile'] = 'File size exceeds the maximum file size'; $formValid = false; break;
				case 3 : $errorArray['examfile'] = 'File was only partically uploaded, please try again'; $formValid = false; break;
				//case 4 : $errorArray['examfile'] = 'No file was uploaded'; $formValid = false; break;
				case 6 : $errorArray['examfile'] = 'Missing a temporary folder'; $formValid = false; break;
				case 7 : $errorArray['examfile'] = 'Faild to write file to disk'; $formValid = false; break;
			}
		}
	}
		
	if(count($errorArray) == 0 && $formValid == true) {
		
		/* required. */
		$data 								= array();
		$data['exam_name'] 			= trim($_POST['exam_name']);
		$data['subject_code'] 		= trim($_POST['subject_code']);
		$data['exam_date'] 			= trim($_POST['exam_date']);
		$data['exam_language'] 	= trim($_POST['exam_language']);
		
		if(isset($examData)) {
			$where = $examObject->getAdapter()->quoteInto('exam_code = ?', $examData['exam_code']);
			$success = $examObject->update($data, $where);	
			$success = $examData['exam_code'];
		} else {		
			$success = $examObject->insert($data);	
		}
		
		if(isset($_FILES['examfile'])) {
			/* Check validity of the CV. */
			if((int)$_FILES['examfile']['size'] != 0 && trim($_FILES['examfile']['name']) != '') {		
			
				$ext 		= strtolower($fileObject->file_extention($_FILES['examfile']['name']));					
				$filename	= $success.'.'.$ext;
				$directory	= $_SERVER['DOCUMENT_ROOT'].'/media/exams/'.$success.'/';
				$file		= $directory.'/'.$filename;	
				
				if(!is_dir($directory)) mkdir($directory, 0777, true);
				
				if(file_put_contents($file, file_get_contents($_FILES['examfile']['tmp_name']))) {
					
					$data = null; $data = array();
					$data['exam_path']	= '/media/exams/'.$success.'/'.$filename;

					$where = $examObject->getAdapter()->quoteInto('exam_code = ?', $success);
					$success = $examObject->update($data, $where);						

					if($success) {
						$smarty->assign('success', 'The exam has been successfully uploaded.');
					} else {
						$errorArray['examfile'] = 'You need to actually upload something to "Upload a exam."';
					}
					
				} else {
					$errorArray['examfile'] = 'could not upload file, please try again';
					$formValid = false;			
				}			
			}
		}
		
		header('Location: /exams/view/details.php');				
		exit;		
			
	}
	
	/* if we are here there are errors. */
	$smarty->assign('errorArray', $errorArray);	
}

$smarty->display('exams/view/details.tpl');

?>