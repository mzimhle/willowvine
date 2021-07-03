<?php
/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');


/**
 * Standard includes
 */
require_once 'config/setup.php';

/**
 * Check for login
 */
require_once 'admin/includes/auth.php';

/* Other classes. */
require_once 'class/email.php';


$emailObject = new class_email();
 
/* Setup Pagination. */
$currentPage	= (isset($_GET['page']) && $_GET['page'] !='' ) ? (int)$_GET['page'] : 1;
$perPage 		= (isset($_GET['per_page~i']) && !is_null($_GET['per_page~i']) && $_GET['per_page~i'] != '' && is_numeric($_GET['per_page~i'])) ? $_GET['per_page~i'] : 50;
$listedPages	= 10;
$scrollingStyle	= 'Sliding';

$emailData = $emailObject->getPaginatedemail('email.email_added != ""','email.email_name ASC', $currentPage, $perPage, $listedPages, $scrollingStyle);
 
$emailItems = $emailData->getCurrentItems();

$smarty->assign_by_ref('emailItems', $emailItems);

$paginator = $emailData->setView()->getPages();

$smarty->assign_by_ref('paginator', $paginator);

/* End Pagination Setup. */

/* 
	display template
*/
$smarty->display('admin/resources/emails/emailsHtml.tpl');

?>