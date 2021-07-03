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
require_once 'class/property.php';


$propertyObject = new class_property();
 
/* Setup Pagination. */
$currentPage	= (isset($_GET['page']) && $_GET['page'] !='' ) ? (int)$_GET['page'] : 1;
$perPage 		= (isset($_GET['per_page~i']) && !is_null($_GET['per_page~i']) && $_GET['per_page~i'] != '' && is_numeric($_GET['per_page~i'])) ? $_GET['per_page~i'] : 30;
$listedPages	= 10;
$scrollingStyle	= 'Sliding';

$propertyData = $propertyObject->getPaginatedproperty('property.property_created != ""','property.property_created ASC', $currentPage, $perPage, $listedPages, $scrollingStyle);
 
$propertyItems = $propertyData->getCurrentItems();

$smarty->assign_by_ref('propertyItems', $propertyItems);

$paginator = $propertyData->setView()->getPages();

$smarty->assign_by_ref('paginator', $paginator);

/* End Pagination Setup. */

/* 
	display template
*/
$smarty->display('admin/flats/seeff/seeffHtml.tpl');

?>