<?php
/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');
/**
 * Standard includes
 */
 error_reporting(E_ALL);
 
require_once 'config/setup.php';
require_once 'admin/includes/auth.php';
require_once 'scrape/simple_html_dom.php';
require_once 'functions.php';

/* Get job class */
require_once 'class/job.php';
require_once 'class/areaMap.php';

$jobObject = new class_job();
$areaMapObject = new class_areaMap();
	
	
$removeEmails  = array('meneng1@cv.networkrecruitment.co.za', 'eneng1@cv.networkrecruitment.co.za', 'www.networkrecruitment.co.za');	

$categoryArray = array(
	'engineering' => array(
						'link' => 'http://www.networkrecruitmentsa.co.za/candidate-search/engineering/', 
						'sectionId' => 4,
						'industry' => 2,
						'number' => '0123480279'
					),
	'finance' => array(
						'link' => 'http://www.networkrecruitmentsa.co.za/candidate-search/finance/', 
						'sectionId' => 3,
						'industry' => 3,
						'number' => '0123484940'
					),
	'information-technology' => array(
						'link' => 'http://www.networkrecruitmentsa.co.za/candidate-search/information-technology/', 
						'sectionId' => 1,
						'industry' => 1,
						'number' => '0116229526'
					)								
);

if(isset($_GET['cat']) && trim($_GET['cat']) != '')  {
	
	$cat 		= trim($_GET['cat']);
	$page 		= (int)trim($_GET['page']) != 0 ? (int)trim($_GET['page']) : 1;
	$category 	= $categoryArray[$cat];
	
	/*************************************************************************
	/************************************************************************* CURL CALLER.
	/*************************************************************************/
	//set POST variables
	$url = $category['link'];
	$fields = array(
							'ddlIndustry[]'	=> urlencode($category['industry']),
							'ddlSearch'		=> urlencode('keywords'),
							'txtFor'		=> urlencode(''),
							'ddlKeywords'	=> urlencode('any'),
							'ddlList'		=> urlencode('date'),
							'results_page'	=> urlencode(20),
							'thispagenr'	=> urlencode($page)
					);

	//url-ify the data for the POST
	$fields_string = '';
	foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
	rtrim($fields_string,'&');

	//open connection
	$ch = curl_init();

	//set the url, number of POST vars, POST data
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch,CURLOPT_POST,count($fields));
	curl_setopt($ch,CURLOPT_POSTFIELDS,$fields_string);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

	//execute post
	$urlContent = curl_exec($ch);
	
	//close connection
	curl_close($ch);	
	
	/*************************************************************************
	/************************************************************************* CURL CALLER.
	/*************************************************************************/
	
	/* Get the first DIV in the results page. */
	$results = str_get_html($urlContent)->find('.results ', 0)->innertext;
	
	/* Loop through all the jobs. */
	$counter = 0;
	while(($item = str_get_html($results)->find('.inreg', $counter)->innertext) != NULL) {	
		$data = array();
		/* Get area. */
		$area = str_get_html($item)->find('.inregVerde', 0)->innertext; 
		$area = str_replace(array(',', '>', '-',), ' ', $area);
		$area = trim(str_replace('  ', '', $area));
		
		/* Check some exeptions. */
		$areaId = null;
		if(substr_count($area, 'JHB') > 0) $areaId =  349;
		if(substr_count($area, 'CPT') > 0) $areaId =  3;
		if(substr_count($area, 'Port Elizabeth') > 0) $areaId =  50;
		if(substr_count($area, 'East London') > 0) $areaId =  1266;
		if($areaId == NULL) {
			$areaArray = explode(' ', $area);
			$lastString = $areaArray[count($areaArray) - 1];
			$areaData = $areaMapObject->getByName($lastString);
			if(count($areaData) > 0) $areaId = $areaData['fkAreaId'];
		}
		
		if($areaId == NULL) {
			/* Use provinces. */
			if(substr_count($area, 'Gauteng') > 0) {
				$areaId =  11;
			} else if(substr_count($area, 'Western Cape') > 0) {
				$areaId =  2;
			} else if(substr_count($area, 'Natal') > 0) {
				$areaId =  13;
			} else if(substr_count($area, 'limpopo') > 0) {
				$areaId =  14;
			} else if(substr_count($area, 'mpumalanga') > 0) {
				$areaId =  15;
			}
		}
		
		$data['fk_area_id'] = $areaId;
		
		if($areaId != NULL) {
						/* Get area. */
			$area = str_get_html($item)->find('.inregVerde', 0)->innertext; 
			$area = str_replace(array(',', '>', '-',), ' ', $area);
			$area = trim(str_replace('  ', '', $area));
			$areaArray = explode(' ', $area);
			
			/* Get details. */
			$data['job_title']				= trim(str_get_html($item)->find('h5 .alignleft', 0)->innertext); 
			$data['job_added']  			= date('Y-m-d', strtotime(str_get_html($item)->find('h5 .alignright', 0)->innertext));
			$data['job_affiliateReference']	= trim(str_replace('No:', '', str_replace('Ref.', '',str_get_html($item)->find('h5 span', 2)->innertext))); 
			$data['fk_recruiter_id']		= 1002;
			$data['job_active']				= 1;
			$data['job_AdType']				= 'offering';
			$data['job_deleted']			= 0;
			$data['job_advertBy'] 			= 'agency'; 			
			$data['jobs_affiliate'] 		= 'networkrecruitment';				
			$data['job_link']				= StringToUrl($data['job_title']);
			$areaTempData 					= $areaMapObject->getArea($data['fk_area_id']);
			$data['job_area']				= $areaMapObject->getShortPath($areaTempData);
			$data['job_longitude'] 			= '';
			$data['job_latitude'] 			= '';
			$data['job_address'] 			= '';
			$data['job_poster_name'] 		= 'Network Recruitment';
			$data['job_poster_number'] 		= $category['number'];			
			$data['fk_section_id'] 			= $category['sectionId'];					
			$data['job_type']				= 'permanent';
			
			/* Get page content. */
			$salary = str_get_html($item)->find('.inregVerde', 1)->innertext; 
			$salary = trim(substr($salary, 0, strpos($salary, '<form')));		
			$page1 	= str_replace('<div id="clasp_'.$counter.'" class="clasp"><a href="javascript:lunchboxOpen(\''.$counter.'\');">+ more info</a></div>', '', str_get_html($item)->find('.inregGri', 0)->innertext); 
			$page1 	= str_replace('<div id="lunch_'.$counter.'" class="lunchbox">', '', $page1); 		
			$remove1 = str_get_html($page1)->find('p', (substr_count($page1, '<p>') - 1))->innertext; 
			$page1 = str_replace($remove1, '', $page1);
			$page1 = str_replace($removeEmails , '', $page1);
			$page1 = str_replace(array('<div>', '</div>') , '', $page1);
			
			/* Remove last P again. */
			$page1 = str_replace('<p></p>', '', $salary.'<br />'.$page1);

			/* Get */
			$remove2 = str_get_html($page1)->find('p', (substr_count($page1, '<p>') - 1))->innertext; 
			$page1 = str_replace($remove2, '', $page1);
			$page1 = str_replace('<p></p>', '', $page1);
			
			$remove3 = str_get_html($page1)->find('p', (substr_count($page1, '<p>') - 1))->innertext; 
			$page1 = str_replace($remove3, '', $page1);
			$page1 = str_replace('<p></p>', '', $page1);
						
			$data['job_page']				= trim($page1);
			$data['job_poster_email'] 		= trim(str_replace('mailto:', '', str_get_html($remove1)->find('a', 0)->href)); 
			$data['job_affiliateLink']		= '';
			
			/* Check if job exists. */
			$jobExists = $jobObject->getByAffiliateReference(trim($data['job_affiliateReference']));
			if(count($jobExists) == 0) {
				/* Insert job. */
				$data['job_reference'] 		= $jobObject->createReference(); 
				$success = $jobObject->insert($data);
				echo 'insert - ';
			} else {
				/* Update job. */
				$where = $jobObject->getAdapter()->quoteInto('job_affiliateReference = ?', $data['job_affiliateReference']);
				$success = $jobObject->update($data, $where);
				echo 'update - ';
			}	
		} else {
			echo 'SKIPPED  - '.$area.' - ';
		}
		
		echo $data['job_title'].'<br />';
		
		$counter++;
	}
}


	
	

	
	
	
	
					
			

?>