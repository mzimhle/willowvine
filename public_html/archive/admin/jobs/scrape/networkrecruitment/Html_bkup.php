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

error_reporting(E_ALL);

	$removeEmails  = array('meneng1@cv.networkrecruitment.co.za', 'eneng1@cv.networkrecruitment.co.za', 'www.networkrecruitment.co.za');
	$citiesCheck = array('JHB', 'CPT');
	
	$contactArray = array(
		'engineering' => array(
							'link' => 'http://www.networkrecruitmentsa.co.za/candidate-search/engineering/', 
							'sectionId' => 4
						),
		'finance' => array(
							'link' => 'http://www.networkrecruitmentsa.co.za/candidate-search/finance/', 
							'sectionId' => 1
						)						
	);
	$urlContent = file_get_contents('http://www.networkrecruitmentsa.co.za/candidate-search/engineering/');
	
	/* Get the first DIV in the results page. */
	$results = str_get_html($urlContent)->find('.results ', 0)->innertext;

	/* Loop through all the jobs. */
	$counter = 0;
	while(($item = str_get_html($results)->find('.inreg', $counter)->innertext) != NULL) {	
		/* Get area. */
		$area = str_get_html($item)->find('.inregVerde', 0)->innertext; 
		$area = str_replace(array(',', '>', '-',), ' ', $area);
		$area = trim(str_replace('  ', '', $area));
$areaArray = explode(' ', $area);
print_r($areaArray); 


		//echo $area; exit; 
		
		/* Get details. */
		$data['job_title']				= str_get_html($item)->find('h5 .alignleft', 0)->innertext; 
		$data['job_added']  			= date('Y-m-d', strtotime(str_get_html($item)->find('h5 .alignright', 0)->innertext));
		$data['job_affiliateReference']	= str_replace('No:', '', str_replace('Ref.', '',str_get_html($item)->find('h5 span', 2)->innertext)); 
		$data['fk_recruiter_id']		= 1002;
		$data['job_active']				= 1;
		$data['job_AdType']				= 'offering';
		$data['fk_area_id'] 			= '';	
		$data['job_deleted']			= 0;
		$data['job_advertBy'] 			= 'agency'; 			
		$data['jobs_affiliate'] 		= 'networkrecruitment';				
		$data['job_link']				= StringToUrl($data['job_title']);
		
		$data['job_longitude'] 			= '';
		$data['job_latitude'] 			= '';
		$data['job_address'] 			= '';			
		$data['fk_section_id'] 			= 4;		
		//$data['job_reference'] 			= $jobObject->createReference(); 
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
		/* Get the name and contact number. */
		$contactDetails = explode('(', $remove3);
		$data['job_poster_name']  		= $contactDetails[0];	
		$data['job_poster_number'] 		= (int)str_replace(array(' ', ')'), '', $contactDetails[1]) != '' ? (int)str_replace(array(' ', ')'), '', $contactDetails[1])  : '';		
		//$page1 = str_replace($remove3, '', $page1);
		$page1 = str_replace('<p></p>', '', $page1);
		
		
		$data['job_page']				= trim($page1);
		$data['job_poster_email'] 		= trim(str_replace('mailto:', '', str_get_html($remove1)->find('a', 0)->href)); 
		$data['job_affiliateLink']		= '';
		
		$counter++;
	}


	
	

	
	
	
	
					
			

?>