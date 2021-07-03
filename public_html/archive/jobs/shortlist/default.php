<?php
/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');
/* standard config include. */
require_once 'config/setup.php';
require_once 'includes/auth.php';
require_once 'includes/shortlist.php';

/* Get classes. */
require_once 'class/job.php';
require_once 'class/section.php';

/* Create object. */
$jobObject = new class_job();

/* Setup search query. */
$searchQuery	= count($slsession->jobs) > 0 ? "job_reference IN (".implode(',',$slsession->jobs).")" : 'job_reference IN (-1)';

/* Pagination. */
$currentPage	= (isset($_GET['page']) && $_GET['page'] !='' ) ? (int)$_GET['page'] : 1;
$perPage 		= 10;
$listedPages	= 10;
$scrollingStyle	= 'Sliding';

/* Setup Pagination. */
$jobData = $jobObject->getPaginatedjob($searchQuery,'job.job_added DESC', $currentPage, $perPage, $listedPages, $scrollingStyle);

$jobItems = $jobData->getCurrentItems();

/* End Check if they are in the "shortlisted" session array. */
$smarty->assign_by_ref('jobItems', $jobItems);

$paginator = $jobData->setView()->getPages();

$smarty->assign_by_ref('paginator', $paginator);
/* End Pagination Setup. */

/* display template */
$smarty->display('jobs/shortlist/default.tpl');
?>