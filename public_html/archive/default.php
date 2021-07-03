<?php header('Location: /jobs/search/');exit;
/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');
/* standard config include. */
require_once 'config/setup.php';
require_once 'includes/auth.php';
require_once 'includes/shortlist.php';
/* Get classes. */
require_once 'class/section.php';require_once 'class/internship_section.php';
require_once 'includes/jobSeeker_registration.php';
/* Create object. */
$sectionObject				= new class_section();$sectionInternshipObject	= new class_internship_section();/* Get Sections. */$sectionData			= $sectionObject->getAllsections();$sectionInternshipData	= $sectionInternshipObject->getAllsections();/* Assign smarty variables. */$smarty->assign('sectionData', $sectionData);$smarty->assign('sectionInternshipData', $sectionInternshipData);$smarty->assign('sectionHalf', (int)(count($sectionData) / 2));$smarty->assign('sectionInternshipHalf', (int)(count($sectionInternshipData) / 2));
/* Display Template. */
$smarty->display('default.tpl');/* Clean Up. */$sectionInternshipData = $sectionCareerData = $sectionData = $sectionObject = $sectionInternshipObject = $smarty = NULL;UNSET($sectionInternshipData, $sectionData, $sectionCareerData, $sectionObject, $sectionInternshipObject, $smarty);
?>