<?php
//standard config include.
require_once 'config/setup.php';

//include the Zend class for Authentification
require_once 'Zend/Session.php';

// Set up the namespace
$zfsession = new Zend_Session_Namespace('BackendLogin');

// Check if logged in, otherwise redirect
if (!isset($zfsession->identity) || is_null($zfsession->identity) || $zfsession->identity == '') {
	header('Location: /admin/login.php');
	exit();
} else {
	//instantiate the users class
	require_once 'class/administrator.php';
	$users = new class_administrator();
	//get user details by username
	$usersData = $users->checkEmail($zfsession->identity)->toArray();
	$smarty->assign('admin', $usersData[0]);
}

?>