<?php
require_once('config/setup.php');
require_once 'class/internship.php';

global $smarty;

$internshipObject = new class_internship();

/* Get recent internships. */
$topinternships = $internshipObject->getRecentinternship(7);
/* Smarty. */
if(count($topinternships) > 0) $smarty->assign('topinternships', $topinternships);


$smarty->display('includes/internships_side.tpl');
?>