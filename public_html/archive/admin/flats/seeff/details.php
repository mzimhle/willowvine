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

/* objects. */
require_once 'class/property.php';

$propertyObject = new class_property();

/**
  * If the item exists populate the form with data
  */
if (!empty($_GET['propertyReference']) && $_GET['propertyReference'] != '') {
	
	$propertyReference = (int)$_GET['propertyReference'];
	
	$propertyData = $propertyObject->getReferences($propertyReference);
	if(count($propertyData) > 0) {
		$smarty->assign('propertyData', $propertyData[0]);
	}
}

/* Check posted data. */
if(count($_POST) > 0) {
	
	$errorArray		= array();
	$data 			= array();
	$formValid		= true;
	$success		= NULL;
	
	if(isset($_POST['property_name']) && trim($_POST['property_name']) == '') {
		$errorArray['property_name'] = 'required';
		$formValid = false;
	}
	
	if(isset($_POST['fk_category_id']) && trim($_POST['fk_category_id']) == '') {
		$errorArray['fk_category_id'] = 'required';
		$formValid = false;		
	}
	
	if(count($errorArray) == 0 && $formValid == true) {
		
		/* required. */
		$data['property_name'] 		= trim($_POST['property_name']);
		$data['property_active']		= isset($_POST['property_active']) && trim($_POST['property_active']) == 1 ? 1 : 0;
		$data['property_urlName']	= StringToUrl(trim($data['property_name'])); 
		
		if(isset($propertyId) && $propertyId != '') {
			/*Update. */
			$where = $propertyObject->getAdapter()->quoteInto('pk_property_id = ?', $propertyId);
			$success = $propertyObject->update($data, $where);
		} else {
			/* Insert. */
			$success = $propertyObject->insert($data);
		}

		/* check if successful. */
		if(is_numeric($success) && $success > 0) {
				header('Location: /admin/flats/');
				exit;
		}		
		
		/* if we are here there are errors. */
		$smarty->assign('errorArray', $errorArray);		
	}			
}

$smarty->display('admin/flats/seeff/details.tpl');

?>