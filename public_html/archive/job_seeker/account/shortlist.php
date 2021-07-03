<?php
/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR .$_SERVER['DOCUMENT_ROOT'].'/library/classes/');
/* standard config include. */
require_once 'config/setup.php';
require_once 'includes/auth.php';

global $userData;

require_once 'functions.php';

/* Classes. */
require_once 'class/shortList.php';

/* Object. */
$shortListObject 	= new class_shortList();

/************************************************************************ Setup Pagination for Jobs applied for.  */
$currentPage	= (isset($_GET['page']) && $_GET['page'] !='' ) ? (int)$_GET['page'] : 1;
$perPage 		= 5;
$listedPages	= 10;
$scrollingStyle	= 'Sliding';

$shortListData = $shortListObject->getPaginatedShortList('jobSeeker_reference = '.$userData[0]['jobSeeker_reference'], NULL, $currentPage, $perPage, $listedPages, $scrollingStyle);

$shortListeItems = $shortListData->getCurrentItems();

/* End Check if they are in the "shortlisted" session array. */
$smarty->assign_by_ref('shortListeItems', $shortListeItems);

$paginator = $shortListData->setView()->getPages();

$smarty->assign_by_ref('paginator', $paginator);
/************************************************************************ End Setup Pagination for Jobs applied for.  */

/* 
 * display template
 */
$smarty->display('job_seeker/account/shortlist.tpl');

/* Clean up. */
$shortListData = $shortListObject = $shortListeItems = $paginator = NULL;
unset($shortListData, $shortListObject, $shortListeItems, $paginator);
?>