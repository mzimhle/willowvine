<?php
/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');
/**
 * Standard includes
 */
require_once 'config/setup.php';
require_once 'admin/includes/auth.php';
require_once 'scrape/simple_html_dom.php';
require_once 'functions.php';

/* Get job class */
require_once 'class/job.php';

/* Create object for job. */
$jobObject = new class_job();

error_reporting(E_ALL);

/* Object. */
if(isset($_GET['page']) && (int)trim($_GET['page']) > 0) {
	/* Get the page. */
	$urlContent = file_get_contents('http://www.datafin.com/vacancies.aspx');

	/* Get the first DIV in the results page. */
	$page = '#page_'.trim($_GET['page']);
	$results = str_get_html($urlContent)->find($page, 0)->innertext;

	/* Loop through all the jobs. */
	$counter = 0;
	while(($item = str_get_html($results)->find('.searchResult', $counter)->innertext) != NULL) {
		/* Get the job. */
		$data = array();
		/* Fetch Data to temporary store. */
		// Get link.
		$tempLink = 'http://www.datafin.com/'.str_get_html($item)->find('a', 0)->href; 
		// Get reference, date created and agent name. 
		$tempData =  str_get_html($item)->find('.meta ', 0)->innertext;
		$tempData = str_replace('&nbsp;', '', $tempData);
		$tempData = str_replace('&bull;', '', $tempData);
		$tempData = str_replace('</strong>', '|', $tempData);
		$tempData = str_replace('<strong>', '|', $tempData);
		$tempData = str_replace('|Ref:|', '', $tempData);
		$tempData = str_replace('|Added: |', '|', $tempData);
		$tempData = str_replace('|Consultant: |', '|', $tempData);
		$tempArray = explode("|", $tempData);
		//Get Area. 
		$tempAreaArray	=  explode(',',str_replace("South Africa,", "",str_get_html(str_get_html($item)->find('.location ul li', 0)->innertext)->find('span .location', 0)->innertext));
		//Get salary.
		$tempSalary		=  str_get_html(str_get_html($item)->find('.location ul li', 1)->innertext)->find('span .location', 0)->innertext;
		//Get job type.
		$tempType		=  strtolower(str_get_html(str_get_html($item)->find('.location ul li', 2)->innertext)->find('span .location', 0)->innertext);
		
		/* Get page. */
		$pageContent = file_get_contents($tempLink);
		/* Get the first DIV in the results page. */
		$page = str_get_html($pageContent)->find('.entry', 0)->innertext;	
		$page = str_replace(' style="padding-left:0px;"', '', $page);
		$page = str_replace('<h3>', '<strong>', $page);
		$page = str_replace('</h3>', '</strong>', $page);
		$page = str_replace('<br /><br />', '<br>', $page);
		
		$environment	= str_get_html($page)->find('p', 5)->innertext;
		$requirements	= str_replace('REQUIREMENTS', '<br><strong>REQUIREMENTS</strong><br>', str_get_html($page)->find('p', 6)->innertext);
		$requirements	= str_replace('DUTIES:', '<br><strong>DUTIES</strong><br>', $requirements);

		/* Collect job data. */
		$data['job_title']				= str_get_html($item)->find('.heading .title .searchResultItem strong', 0)->innertext;			
		$data['job_affiliateReference'] = $tempArray[0];
		$data['job_added']  			= date('Y-m-d h:i:s A', strtotime($tempArray[1]));
		$data['job_poster_name']  		= $tempArray[2];
		$data['job_area']				= implode(',',array_reverse($tempAreaArray));
		$data['job_type'] 				= $tempType;
		$data['job_poster_email'] 		= str_replace('mailto:', '', str_get_html($page)->find('a', 0)->href);  
		$data['job_link']				= StringToUrl($data['job_title']);
		$data['job_longitude'] 			= '18.414052';
		$data['job_latitude'] 			= '-33.923874';
		$data['job_address'] 			= '5th Floor, Buitengracht Centre, 125 Buitengracht Street, Cape Town';	
		$data['job_active']				= 1;
		$data['job_AdType']				= 'offering';
		$data['fk_area_id'] 			= '';	
		$data['job_deleted']			= 0;
		$data['job_advertBy'] 			= 'agency'; 
		$data['fk_section_id'] 			= 1;	
		$data['jobs_affiliate'] 		= 'datafin';
		$data['job_reference'] 			= $jobObject->createReference(); 	
		$data['job_affiliateLink'] 		= $tempLink; 
		$data['job_poster_number'] 		= '0214097820';
		$data['job_page'] 				= 'Salary: '.$tempSalary.'. <br>'.$environment.'<br>'.$requirements;
		$data['fk_recruiter_id']		= 1000;
		
		/* Check if job exists. */
		$jobExists = $jobObject->getByAffiliateReference(trim($data['job_affiliateReference']));
		if(count($jobExists) == 0) {
			/* Insert job. */
			$success = $jobObject->insert($data);
		} else {
			/* Update job. */
			$where = $jobObject->getAdapter()->quoteInto('job_affiliateReference = ?', $data['job_affiliateReference']);
			$success = $jobObject->update($data, $where);
		}
		echo $data['job_title'].'<br />';
		
		$counter++;
		$data = $requirements = $success = $environment = $tempType = $tempSalary = $tempAreaArray = $tempArray = $page = $pageContent = $where = $jobExists = $tempLink = NULL;
		UNSET($data,$success, $requirements,$environment,$tempType,$tempSalary,$tempAreaArray,$tempArray,$page,$pageContent,$where,$jobExists,$tempLink);
	}
	$datafinObject = $jobsData = NULL; UNSET($datafinObject, $jobsData);
}

	
	

	
	
	
	
					
			

?>