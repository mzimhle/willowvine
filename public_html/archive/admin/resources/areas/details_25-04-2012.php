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

require_once 'class/areaMap.php';
require_once 'class/areaType.php';

require_once 'includes/resources.php';

$areaMapObject = new class_areaMap();
$areaTypeObject = new class_areaType();

/**
  * If the item exists populate the form with data
  */
if (!empty($_REQUEST['fkAreaId']) && $_REQUEST['fkAreaId'] != '') {
	
	$fkAreaId = (int)$_REQUEST['fkAreaId'];
	
	$areaData = $areaMapObject->getByfkAreaId($fkAreaId);
	if(count($areaData) > 0) {
		$smarty->assign('areaData', $areaData[0]);
	}
	
	$smarty->assign('fkfkAreaId', $fkAreaId);
}

/* Get Pairs. */
$areaTypePairs = $areaTypeObject->areaTypePairs();
if(count($areaTypePairs) > 0) {
	$smarty->assign('areaTypePairs', $areaTypePairs);
}

/* Check posted data. */
if(count($_POST) > 0) {
	
	$errorArray	= array();
	$data 			= array();
	$formValid	= true;
	$success		= NULL;
	
	if(isset($_POST['areaMap_name']) && trim($_POST['areaMap_name']) == '') {
		$errorArray['areaMap_name'] = 'required';
		$formValid = false;
	}
	
	if(isset($_POST['fkAreaTypeId']) && trim($_POST['fkAreaTypeId']) == '') {
		$errorArray['fkAreaTypeId'] = 'required';
		$formValid = false;		
	}
	
	if(count($errorArray) == 0 && $formValid == true) {
		
		
		/* required. */
		$data['areaMap_name'] 			= trim($_POST['areaMap_name']);
		$data['fkAreaTypeId']			= trim($_POST['fkAreaTypeId']);
		
		$data['areaMap_longitude'] 		= isset($_POST['areaMap_longitude']) && trim($_POST['areaMap_longitude']) != '' ? trim($_POST['areaMap_longitude']) : '';
		$data['areaMap_latitude'] 		= isset($_POST['areaMap_latitude']) && trim($_POST['areaMap_latitude']) != '' ? trim($_POST['areaMap_latitude']) : '';
		$data['areaMap_active']			= isset($_POST['areaMap_active']) && (int)trim($_POST['areaMap_active']) == 1 ? 1 : 0;
		
		if(isset($areaData) && count($areaData) == 1) {
			/*Update. */
			/* Get the path. */
			$data['areaMap_path']			= $areaMapObject->getPath($areaData[0]['fkAreaId'], $areaData[0]['areaMap_name']);
		
			$where = $areaMapObject->getAdapter()->quoteInto('fkAreaId = ?', $fkAreaId);
			$success = $areaMapObject->update($data, $where);
		} else {
			/* Insert. */
			$success = $areaMapObject->insert($data);
		}
		
		/* check if successful. */
		if(is_numeric($success) && $success > 0) {
		
				header('Location: /admin/resources/areas/polygon.php?fkAreaId='.$areaData[0]['fkAreaId']);
				exit;
		}		
	}
	
	/* if we are here there are errors. */
	$smarty->assign('errorArray', $errorArray);
	
}

$smarty->display('admin/resources/areas/details.tpl');

?>