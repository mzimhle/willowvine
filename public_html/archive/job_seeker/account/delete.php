<?php
	
	/* Add this on all pages on top. */
	set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');
	$filename = isset($_GET['cv']) && trim($_GET['cv']) != '' ? trim($_GET['cv']) : '';

	if($filename != '') {

		header("Content-Disposition: attachment; filename=\"$filename\"");
		header("Content-Type: application/force-download");
		header("Connection: close");


		/* standard config include. */
		require_once 'config/setup.php';
		require_once 'includes/auth.php';
		require_once 'class/jobSeekerCV.php';
		
		/* Delete file. */
		$dataCV = array('jobSeekerCV_deleted' => 1);
		$whereCV = $jobSeekerCVObject->getAdapter()->quoteInto('jobSeekerCV_filename = ?', $filename);
		$successCV = $jobSeekerCVObject->update($dataCV, $whereCV);	

	}

	/* Redirect anyways. */
	header('Location: /job_seeker/account/');
	exit;
?>