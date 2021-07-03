<?php
require_once('config/setup.php');
/* Get file to define the current city for this user. */
require_once 'config/location.php';

global $smarty;

$smarty->display('includes/search_jobs.tpl');
?>