<?php
$filename = isset($_GET['cv']) && trim($_GET['cv']) != '' ? trim($_GET['cv']) : '';
$jobSeeker = isset($_GET['jskr']) && (int)trim($_GET['jskr']) != 0 ? (int)trim($_GET['jskr']) : 0;

if($filename != '' && $jobSeeker != 0) {

	header("Content-Disposition: attachment; filename=\"$filename\"");
	header("Content-Type: application/force-download");
	header("Connection: close");


	/* standard config include. */
	require_once 'config/setup.php';
	require_once 'includes/auth.php';


	echo file_get_contents('http://willowvine.dev/media/jobSeeker/cv/'.$jobSeeker.'/'.$filename);
} else {
	header('Location: /');
	exit;
}

?>