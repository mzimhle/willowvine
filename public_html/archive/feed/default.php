<?php
/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');
/* standard config include. */
require_once 'config/setup.php';
require_once 'includes/auth.php';
require_once 'includes/shortlist.php';

/* Get classes. */
require_once 'class/job.php';
require_once 'class/section.php';

/* Create object. */
$jobObject = new class_job();
$sectionObject = new class_section();

/* Pagination. */
$currentPage	= (isset($_GET['page']) && $_GET['page'] !='' ) ? (int)$_GET['page'] : 1;
$perPage 		= 50;
$listedPages	= 10;
$scrollingStyle	= 'Sliding';

/* Setup query. */

/* Setup Pagination. */
$jobData = $jobObject->getPaginatedjob('','job.job_added DESC', $currentPage, $perPage, $listedPages, $scrollingStyle);

$jobItems = $jobData->getCurrentItems();

/* End Pagination Setup. */

//SET XML HEADER
//header('Content-type: text/xml');

//CONSTRUCT RSS FEED HEADERS
$output = '<rss version="2.0">';
$output .= '<channel>';
$output .= '<title>Willowvine Jobs</title>';
$output .= '<description>Recently added jobs from willowvine</description>';
$output .= '<link>http://www.willowvine.co.za</link>';
$output .= '<copyright></copyright>';

//BODY OF RSS FEED
foreach($jobItems as $item) {
$page =  substr(strip_tags($item['job_page']), 0, 500);

$page = utf8_encode(htmlentities($page,ENT_COMPAT,'utf-8'));
$page = preg_replace("/&#?[a-z0-9]+;/i","",$page);

//$page = str_replace('™', '', $page);
//$page = str_replace('?', '', $page);
//$page = str_replace('&', ' ', $page);

$output .= '<item>';
	$output .= '<title>'.$item['job_title'].', in '.$item['job_area'].'</title>';
	$output .= '<description>'.$page.'</description>';
	$output .= '<link>http://www.willowvine.co.za/jobs/search/'.$item['section_urlName'].'/details/'.$item['job_link'].'/'.$item['job_reference'].'</link>';
	$output .= '<pubDate>'.(string)date('D, d M Y h:i:s', strtotime($item['job_added'])).' GMT</pubDate>'; 
	$output .= '<guid>'.$item['job_reference'].'</guid>';
$output .= '</item> ';
}
//Wed, 02 Oct 2002 13:00:00 GMT

//CLOSE RSS FEED
$output .= '</channel>';
$output .= '</rss>';

//SEND COMPLETE RSS FEED TO BROWSER
echo($output);
?>