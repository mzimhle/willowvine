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

/* Type of jobs. 

    Analysis / Consulting 						= http://www.e-merge.co.za/index.cfm?x=selectopp&cat=48 = nikki@e-merge.co.za
    Business Intelligence / Data Warehousing	= http://www.e-merge.co.za/index.cfm?x=selectopp&cat=54 = julia@e-merge.co.za
    C / C++										= http://www.e-merge.co.za/index.cfm?x=selectopp&cat=53 = jason@e-merge.co.za
    C# / Dot Net								= http://www.e-merge.co.za/index.cfm?x=selectopp&cat=42 = jason@e-merge.co.za
    Delphi Developers/Perl/Phyton				= http://www.e-merge.co.za/index.cfm?x=selectopp&cat=59 = celeste@e-merge.co.za
    ERP Platforms								= http://www.e-merge.co.za/index.cfm?x=selectopp&cat=50 = julia@e-merge.co.za
    Integration									= http://www.e-merge.co.za/index.cfm?x=selectopp&cat=52 = garth@e-merge.co.za
    Java / J2ee									= http://www.e-merge.co.za/index.cfm?x=selectopp&cat=14 = dolandi@e-merge.co.za
    Oracle/SQL									= http://www.e-merge.co.za/index.cfm?x=selectopp&cat=60 = nicolev@e-merge.co.za
    Other Opportunities							= http://www.e-merge.co.za/index.cfm?x=selectopp&cat=38 = garth@e-merge.co.za
    PHP/Linux Developers						= http://www.e-merge.co.za/index.cfm?x=selectopp&cat=58 = celeste@e-merge.co.za
    Project Management							= http://www.e-merge.co.za/index.cfm?x=selectopp&cat=33 = julia@e-merge.co.za
    Quality Assurance							= http://www.e-merge.co.za/index.cfm?x=selectopp&cat=55 =  Kaylin@e-merge.co.za
    RDBMS										= http://www.e-merge.co.za/index.cfm?x=selectopp&cat=57 = nicolev@e-merge.co.za
    SAP											= http://www.e-merge.co.za/index.cfm?x=selectopp&cat=49 = julia@e-merge.co.za
    Win / Unix Infrastructure and Support		= http://www.e-merge.co.za/index.cfm?x=selectopp&cat=56 = celeste@e-merge.co.za

	*/
/* Object. */
if(isset($_GET['page']) && (int)trim($_GET['page']) > 0 && isset($_GET['cat']) && (int)trim($_GET['cat']) > 0 ) {
	/* Create object for job. */
	$jobObject = new class_job();
	
	/* Get the page. */
	$cat 	= isset($_GET['cat']) ? (int)$_GET['cat'] : 54;
	$page	= (int)$_GET['page'] == 1 ? 1 : (int)$_GET['page'];
	$page	= ($page*20) + 1;
	
	/* Get email. */
	$email = '';
	if($cat == 48) $email = 'nikki@e-merge.co.za';
	if($cat == 54) $email = 'julia@e-merge.co.za';
	if($cat == 53) $email = 'jason@e-merge.co.za';
	if($cat == 42) $email = 'jason@e-merge.co.za';
	if($cat == 59) $email = 'celeste@e-merge.co.za';
	if($cat == 50) $email = 'julia@e-merge.co.za';
	if($cat == 52) $email = 'garth@e-merge.co.za';
	if($cat == 14) $email = 'dolandi@e-merge.co.za';
	if($cat == 60) $email = 'nicolev@e-merge.co.za';
	if($cat == 38) $email = 'garth@e-merge.co.za';
	if($cat == 58) $email = 'celeste@e-merge.co.za';
	if($cat == 33) $email = 'julia@e-merge.co.za';
	if($cat == 55) $email = 'Kaylin@e-merge.co.za';
	if($cat == 57) $email = 'nicolev@e-merge.co.za';
	if($cat == 49) $email = 'julia@e-merge.co.za';
	if($cat == 56) $email = 'celeste@e-merge.co.za'; 
	if($email == '') $email = 'celeste@e-merge.co.za'; 
	
	$urlContent = file_get_contents('http://www.e-merge.co.za/index.cfm?x=selectopp&cat='.$cat.'&&&strt='.$page.'&show=20');

	/* Get the first DIV in the results page. */
	$results = str_get_html($urlContent)->find('.textbg ', 0)->innertext;
	
	/* Loop through all the jobs. */
	$counter = 0;
	while(($item = str_get_html($results)->find('.goldborder tr', $counter)->innertext) != NULL) {		
		/* Get the job. */
		$data = array();
		/* Process the data. */
		$tempData =  str_get_html($item)->find('.karen ', 1)->innertext;		
		$tempAreaPos = str_get_html(str_get_html($item)->find('.karen ', 2)->innertext)->find('strong', 1)->innertext; 	
		$tempAreaPosArray = explode('-', $tempAreaPos);
		
		$data['job_affiliateReference'] = str_replace('Ref:', '', $tempData);
		$data['job_affiliateLink'] 		= 'http://www.e-merge.co.za/'.str_get_html(str_get_html($item)->find('.karen ', 2)->innertext)->find('a', 0)->href; 		
		$data['job_title'] 				= str_replace('â€', '', str_replace('â€“', '',str_get_html(str_get_html($item)->find('.karen ', 2)->innertext)->find('strong', 0)->innertext)); 
		$data['job_type']				= strtolower(str_replace('Position','', $tempAreaPosArray[0]));
		$data['job_area']				= $tempAreaPosArray[1].', Gauteng';		
		$data['fk_recruiter_id']		= 1001;
		$data['job_active']				= 1;
		$data['job_AdType']				= 'offering';
		$data['fk_area_id'] 			= '';	
		$data['job_deleted']			= 0;
		$data['job_advertBy'] 			= 'agency'; 
		$data['fk_section_id'] 			= 1;	
		$data['jobs_affiliate'] 		= 'emerge';
		$data['job_added']  			= date('Y-m-d h:i:s A');
		$data['job_poster_number'] 		= '0114633633';		
		$data['job_link']				= StringToUrl($data['job_title']);
		$data['job_longitude'] 			= '28.023607';
		$data['job_latitude'] 			= '-26.044681';
		$data['job_address'] 			= 'Building A, Culross Court South, 16 Culross Road, Bryanston, Gauteng, South Africa';	
		$data['job_poster_name']  		= 'e-Merge';			
		$data['job_poster_email'] 		= $email; 
		$data['job_reference'] 			= $jobObject->createReference(); 		

		/* Get page. */
		$pageContent 		= file_get_contents($data['job_affiliateLink']);
		$data['job_page']	= str_replace('â€', '', str_replace('â€“', '',str_get_html($pageContent)->find('.karen', 0)->innertext)); 
		
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
		$data = $tempData = $tempAreaPos = $tempAreaPosArray = NULL;
		UNSET($data,$tempData,$tempAreaPos,$tempAreaPosArray);
	}
	$datafinObject = $jobsData = NULL; UNSET($datafinObject, $jobsData);
}

	
	

	
	
	
	
					
			

?>