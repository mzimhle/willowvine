<?php
/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');
/* standard config include. */
require_once 'config/setup.php';

/* Get classes. */
require_once 'class/job.php';


/* Create object. */
$jobObject 		= new class_job();

/* Setup Pagination. */
$jobData = $jobObject->getSearchJob();

$array = array();

for($i = 0; $i < count($jobData); $i++) {
	
	$array[] = preg_replace('/[^A-Za-z\- ]/', '', strtolower(trim($jobData[$i]['job_title'])));
	
}

$json = 'var jobs = ';

$json .= json_encode($array).';';

$file = $_SERVER['DOCUMENT_ROOT'].'/feed/jobs_auto_complete.js';

if(file_put_contents($file, $json)) {
	echo $json;
};
?>