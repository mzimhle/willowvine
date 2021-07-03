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

error_reporting(E_ALL);

$areaMapObject = new class_areaMap();
$areaTypeObject = new class_areaType();

/* Getting full names separate process. */
if(isset($_GET['fullnames']) && (int)trim($_GET['fullnames']) != 0) {
	/* Fetch the areas. */
	$areaData = $areaMapObject->getAllByType(array(6, 5, 4));
	
	/* Loop through all of them. */
	if(count($areaData) > 0) {
		/* Get the names in one array. */
		$namesArray = array();
		foreach($areaData as $area) {
		
			//$data					= array();
			//$data['areaMap_path']	= $areaMapObject->getPath($area['fkAreaId'], $area['areaMap_name']);	
			if($area['areaMap_path'] != '') $namesArray[] = $area['areaMap_path'];
			//echo $area['areaMap_name'].' ====== > '.$data['areaMap_path'].'<br />';		
			/* Create file for the auto complete. 
			if($area['areaMap_path'] == '') {
				$where = $areaMapObject->getAdapter()->quoteInto('fkAreaId = ?', $area['fkAreaId']);
				$success = $areaMapObject->update($data, $where);			
			}
			*/
		}
		
		echo json_encode($namesArray);
		
	}
	exit;	
}
/* End GEtting full names. */
/* Create short names. */
if(isset($_GET['shortnames']) && (int)trim($_GET['shortnames']) != 0) {
	$areaData = $areaMapObject->getAllareas();
	/* Loop through all of them. */
	if(count($areaData) > 0) {
		/* Get the names in one array. */
		$namesArray = array();
		foreach($areaData as $area) {
			/* Array to be inserted. */
			$data = array();
			/* Build data. */
			$data['areaMap_shortPath']	= $areaMapObject->getShortPath($area);	
			/* Display data. */
			echo '<br>'.$area['areaMap_name'].' ====== > '.$data['areaMap_shortPath'];		
			/* Insert Data.*/
			if(trim($area['areaMap_name']) != '') {
				$where = $areaMapObject->getAdapter()->quoteInto('fkAreaId = ?', $area['fkAreaId']);
				$success = $areaMapObject->update($data, $where);	
				echo  ' ======> UPDATED';
			}
		}
	}
	exit;	
}
/* End creating short names. */
/* Pagination. */
$currentPage	= (isset($_GET['page']) && $_GET['page'] !='' ) ? (int)$_GET['page'] : 1;
$perPage 		= (isset($_GET['per_page~i']) && !is_null($_GET['per_page~i']) && $_GET['per_page~i'] != '' && is_numeric($_GET['per_page~i'])) ? $_GET['per_page~i'] : 30;
$listedPages	= 10;
$scrollingStyle	= 'Sliding';

/* Ajax */
$action	= (isset($_GET['a']) && !is_null($_GET['a']) && $_GET['a'] != '') ? $_GET['a'] : '';
$areaId	= (isset($_GET['areaId']) && !is_null($_GET['areaId']) && $_GET['areaId'] != '') ? $_GET['areaId'] : '';
$areaIds	= (isset($_GET['areaIds']) && !is_null($_GET['areaIds']) && $_GET['areaIds'] != '') ? $_GET['areaIds'] : '';
$toggle	= isset($_GET['toggle']) && !is_null($_GET['toggle']) &&  is_numeric($_GET['toggle']) && trim($_GET['toggle']) != '' ? $_GET['toggle'] : '';

$fkAreaTypeId	= (isset($_GET['fkAreaTypeId']) && trim($_GET['fkAreaTypeId']) != '') ? trim($_GET['fkAreaTypeId']) : '';
$fkAreaParentId = (isset($_GET['fkAreaParentId']) && !is_null($_GET['fkAreaParentId']) && (int)trim($_GET['fkAreaParentId']) != 0) ? (int)trim($_GET['fkAreaParentId']) : '';
if($fkAreaTypeId != '') {
	/* Create a select. */
	$areaMapData = $areaMapObject->getByType($fkAreaTypeId);
	$parentString = '';
	
	if(count($areaMapData) > 0) {
		$parentString .= '<select id="fkAreaParentId" name="fkAreaParentId">';
		
		$parentString .= '<option value="" label="Select something"> --- </option>';
		for($i = 0; $i <= count($areaMapData); $i++) {
			$selected = $areaMapData[$i]['fkAreaId'] == $fkAreaParentId ? 'SELECTED' : '';
			$parentString .= '<option value="'.$areaMapData[$i]['fkAreaId'].'" '.$selected .' label="'.$areaMapData[$i]['areaMap_name'].'">'.$areaMapData[$i]['areaMap_name'].'</option>';
		}
		$parentString .= '</select>';
		
		echo $parentString;
	} else {
		echo 'This is a country.';
	}
	
	exit;
}

if ($action != '') {
	if ($areaId != '' || $areaIds != '') {
		if ($action == 'delete') {
			$areaIds = explode(',',$areaIds);			
			$data = array('area_deleted' => 1);
			foreach ($areaIds as $areaId) {
				$where = $areaMapObject->getAdapter()->quoteInto('pk_area_id = ?', $areaId);
				$areaMapObject->update($data, $where);
			}
		}
		if ($action == 'activate') {
			$areaIds = explode(',',$areaIds);			
			$data = array('area_deleted' => 1);
			foreach ($areaIds as $areaId) {
				$where = $areaMapObject->getAdapter()->quoteInto('pk_area_id = ?', $areaId);
				$areaMapObject->update($data, $where);
			}
		}		
	}
	
	exit;
}

/* Get Pairs. */
$areaMapPairs = $areaMapObject->areaMapPairs();
$smarty->assign('areaMapPairs', $areaMapPairs);

$areaTypePairs = $areaTypeObject->areaTypePairs();
$smarty->assign('areaTypePairs', $areaTypePairs);

/* End Getting Pairs. */
/* Filter. */
$filter					= "areaMap_deleted = 0";
$filter_fields			= "search_text~t"; // filter fields to remember
$filter_search_fields 	= "areaMap_name~t"; // should be text only fields
$select_score 			= '';
$order_score 			= '';

require_once 'admin/includes/filter.php';
global $filter;

/* Setup Pagination. */
$areaData = $areaMapObject->getPaginatedarea($filter,array('areaMap.areaMap_active DESC',' areaMap.areaMap_added DESC'), $currentPage, $perPage, $listedPages, $scrollingStyle);
 
$areaItems = $areaData->getCurrentItems();

$smarty->assign_by_ref('areaItems', $areaItems);

$paginator = $areaData->setView()->getPages();

$smarty->assign_by_ref('paginator', $paginator);

/* End Pagination Setup. */

/* 
	display template
*/
$smarty->display('admin/resources/areas/areasHtml.tpl');

?>