<?php
require_once('config/setup.php');

global $smarty;

$smarty->assign('currentLink', $_SERVER['REQUEST_URI']);

$smarty->display('includes/job_application_box.tpl');
?>