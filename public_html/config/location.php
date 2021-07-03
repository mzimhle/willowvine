<?php
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');

/* standard config include. */
require_once 'config/setup.php';

/* include the Zend class for Authentification */
require_once 'Zend/Session.php';

/* Set up the namespace */
$location = new Zend_Session_Namespace('loc');

/* Define smarty global variable. */
global $smarty;

/* only when there is an area to add. */
if(isset($_REQUEST['searchArea']) && trim($_REQUEST['searchArea']) != '') {
	
	/* Check first if its not the same as the previous one. */
	if(trim($_REQUEST['searchArea']) != $location->sessionArea) {
		/* Get Ip Address. */
		if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
			/* check ip from share internet */
			$location->ipAddress = $_SERVER['HTTP_CLIENT_IP'];
		}
		elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			/* to check ip is pass from proxy */
			$location->ipAddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} else {
			/* Get IP address. */
			$location->ipAddress = $_SERVER['REMOTE_ADDR'];
		}
		  
		/* Get sessionId of current user. */
		$location->sessionId = Zend_Session::getId();	
		
		/* Assign location. */
		$location->sessionArea = trim($_REQUEST['searchArea']);
		
		/* Search for area selected with this sessionId. */
		require_once 'class/accessLog.php';
		
		/* Instantiate. */
		$accessLogObject = new class_accessLog();
		
		/* Check first if it exists. */	
		$accessLogArea = $accessLogObject->getBySessionId($location->sessionId);
		
		if(count($accessLogArea) == 0) {
			/* Build SQL. */
			$data = array();
			$data['accessLog_areaName']		= isset($_GET['searchArea']) && trim($_GET['searchArea']) != '' ? trim($_GET['searchArea']) : '';
			$data['accessLog_ipAddress']	= $location->ipAddress;
			$data['accessLog_sessionId']	= $location->sessionId;
			/* Insert the data. */
			$accessLogObject->insert($data);
		} else {
			/* Build SQL */
			$data['accessLog_areaName']	= isset($_GET['searchArea']) && trim($_GET['searchArea']) != '' ? trim($_GET['searchArea']) : '';
			$data['accessLog_updated']	= date('Y-m-d H:i:s');
			/* Update access. */
			$where = $accessLogObject->getAdapter()->quoteInto('accessLog_sessionId = ?', $location->sessionId);
			$accessLogObject->update($data, $where);				
		}
		
		/* Clean up. */
		$accessLogObject = $accessLogArea = $data = $where = NULL;
		UNSET($accessLogObject, $accessLogArea, $data, $where);
	}
}

/* Assign current location. */
if(isset($location->sessionArea)) $smarty->assign('location', $location->sessionArea);
?>