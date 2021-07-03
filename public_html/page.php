<?php 

/* Add this on all pages on top. */

set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');

/* standard config include. */
require_once 'config/database.php';
require_once 'config/smarty.php';

require_once 'includes/auth.php';

require_once 'class/job.php';
require_once 'class/category.php';

$jobObject = new class_job();
$categoryObject = new class_category();

$categorypairs = $categoryObject->pairs();
if($categorypairs) $smarty->assign('categorypairs', $categorypairs);

/* Pagination. */
$pageNumber	= (isset($_GET['page']) && $_GET['page'] !='' ) ? (int)$_GET['page'] : 1;
$listedPages		= 10;

$jobData = $jobObject->search(''); //select from db

$smarty->assign('jobData', $jobData);
$smarty->assign('pageNumber', $pageNumber);
$smarty->assign('one', 1);
$smarty->assign('listedPages', $listedPages);

$smarty->display('default.tpl');

?>