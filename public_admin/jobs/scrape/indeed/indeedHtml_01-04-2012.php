<?php
/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/:'.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');
/**
 * Standard includes
 */
require_once 'config/setup.php';
require_once 'functions.php';

/**
 * Check for login
 */
require_once 'admin/includes/auth.php';
/* Other classes. */
require_once 'class/section.php';


$sectionObject = new class_section();
 
 if(isset($_GET['ajax']) && trim($_GET['ajax']) == '1') {
	
	/* Get job class */
	require_once 'class/job.php';
	
	/* Create object for job. */
	$jobObject = new class_job();
	
	/* Get the parameters. */
	$sectionId		= (isset($_GET['pk_section_id']) && $_GET['pk_section_id'] !='') ? trim($_GET['pk_section_id']) : '';
	$page			= (isset($_GET['page']) && $_GET['page'] !='') ? (int)trim($_GET['page']) * 30 : '';	
	$query			= (isset($_GET['query']) && $_GET['query'] !='') ? trim($_GET['query']) : '';
	$location		= (isset($_GET['location']) && $_GET['location'] !='') ? trim($_GET['location']) : '';
	
	if($sectionId != NULL AND $page != NULL AND $query != NULL AND $location != NULL) {
		/* Get the jobs. */				
		$query 		= urlencode(trim($query));		
		$location 	= urlencode(strtolower(trim($location)));
		
		$indeenLink = 'http://api.indeed.com/ads/apisearch?publisher=4982021015921188&q='.$query.'&l='.$location.'&sort=date&radius=400&st=&jt=&start='.$page.'&limit=30&fromage=&filter=&latlong=1&co=za&chnl=job_results&userip=1.2.3.4&useragent=Mozilla/%2F4.0%28Firefox%29&v=2';
		
		$xmlFeed 		= file_get_contents($indeenLink);
		$xmlObject		= simplexml_load_string($xmlFeed);
		$xmlJson		= json_encode($xmlObject);
		$jobItems		= json_decode($xmlJson,TRUE);
		
		if(count($jobItems['results']['result']) > 0) {
			
			for($i = 0; $i < count($jobItems['results']['result']); $i++) {
				/* Get the jobKey. */			
				$jobLink = 'http://api.indeed.com/ads/apigetjobs?publisher=4982021015921188&jobkeys='.$jobItems['results']['result'][$i]['jobkey'].'&v=2';
				
				/* Get the job. */			
				$xmlFeed 		= file_get_contents($jobLink);
				$xmlObject		= simplexml_load_string($xmlFeed);
				$xmlJson		= json_encode($xmlObject);
				$jobItem		= json_decode($xmlJson,TRUE);
				
				/* Check if job exists. */
				$jobExists = $jobObject->checkJobExists(trim($jobItem['results']['result']['jobkey']));
				
				/* Get the job details. */
				$data = array();
				
				// Link example: /jobs/search/computer_science_information_technology/details/php_developer/4117/
				
				$data['fk_area_id'] 		= '';
				$data['fk_section_id'] 		= $sectionId;
				$data['job_poster_name'] 	= isset($jobItem['results']['result']['company']) && is_array($jobItem['results']['result']['company']) != true ? $jobItem['results']['result']['company'] : $jobItem['results']['result']['source'];
				$data['job_poster_email'] 	= ''; 
				$data['job_poster_number'] 	= '';
				$data['job_advertBy'] 	= 'agency'; 
				$data['job_AdType'] 	= '';
				$data['jobs_affiliate'] = 'indeed';
				$data['job_reference'] 	= $jobObject->createReference(); 
				$data['job_affiliateReference'] = $jobItem['results']['result']['jobkey'];
				$data['job_title'] 		= $jobItem['results']['result']['jobtitle'];
				$data['job_type'] 		= '';
				$data['job_affiliateLink'] 	= $jobItem['results']['result']['url']; 
				$data['job_link'] 		= StringToUrl($data['job_title']);
				$data['job_page'] 		= $jobItem['results']['result']['snippet'];
				$data['job_area'] 		= $jobItem['results']['result']['formattedLocationFull'];
				$data['job_address'] 	= '';
				$data['job_longitude'] 	= isset($jobItem['results']['result']['longitude']) ? $jobItem['results']['result']['longitude'] : '';
				$data['job_latitude'] 	= isset($jobItem['results']['result']['latitude']) ? $jobItem['results']['result']['latitude'] : '';
				$data['job_address'] 	= '';
				$data['job_added']		= date('Y-m-d h:i:s A', strtotime($jobItem['results']['result']['date']));
				$data['job_active']		= 1;
				$data['job_deleted']	= 0;
				
				if(isset($jobItem['results']['result']['longitude']) && trim($jobItem['results']['result']['longitude']) != '') {
					if(count($jobExists) == 0) {
						/* Insert job. */
						$jobObject->insert($data);
					} else {
						/* Update job. */
						$where = $jobObject->getAdapter()->quoteInto('job_affiliateReference = ?', $jobItem['results']['result']['jobkey']);
						$success = $jobObject->update($data, $where);
					}
					echo $data['job_title'].'<br />';
				}
			}
		}		
		exit;
	}
 }
 
/* Setup Pagination. */
$currentPage	= (isset($_GET['page']) && $_GET['page'] !='' ) ? (int)$_GET['page'] : 1;
$perPage 		= (isset($_GET['per_page~i']) && !is_null($_GET['per_page~i']) && $_GET['per_page~i'] != '' && is_numeric($_GET['per_page~i'])) ? $_GET['per_page~i'] : 10;
$listedPages	= 10;
$scrollingStyle	= 'Sliding';

$sectionData = $sectionObject->getPaginatedsection('section.section_added != ""','section.section_name ASC', $currentPage, $perPage, $listedPages, $scrollingStyle);
 
$sectionItems = $sectionData->getCurrentItems();

$smarty->assign_by_ref('sectionItems', $sectionItems);

$paginator = $sectionData->setView()->getPages();

$smarty->assign_by_ref('paginator', $paginator);

/* End Pagination Setup. */

/* 
	display template
*/
$smarty->display('admin/jobs/scrape/indeed/indeedHtml.tpl');

?>