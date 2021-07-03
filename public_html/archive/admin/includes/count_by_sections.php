<?php
//standard config include.
require_once 'config/setup.php';

global $smarty;

/* Includes. */
require_once 'class/job.php';

/* Object. */
$jobObject = new class_job();

/* Get data. */
$jobSectionCount = $jobObject->jobCoutBySection();

/* Check if not empty. */
if(count($jobSectionCount) > 0) $smarty->assign('jobSectionCount', $jobSectionCount);

// Display the template
$smarty->display('includes/count_by_sections.tpl');
?>