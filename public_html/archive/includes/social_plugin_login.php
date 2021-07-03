<?php
require_once('config/setup.php');

global $smarty;

/* Get current page. */
$smarty->assign('fb_currentPage', $_SERVER['HTTP_HOST]'].$_SERVER['REQUEST_URI']);

$smarty->display('includes/social_plugin_login.tpl');
?>