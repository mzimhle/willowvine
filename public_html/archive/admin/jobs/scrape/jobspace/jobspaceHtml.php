<?php
/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');
/**
 * Standard includes
 */
require_once 'config/setup.php';
//require_once 'admin/includes/auth.php';
require_once 'scrape/simple_html_dom.php';
require_once 'functions.php';

/* Get job class */
require_once 'class/job.php';
require_once 'class/areaMap.php';

/* Create object for job. */
$jobObject = new class_job();
$areaMapObject = new class_areaMap();

//error_reporting(!E_NOTICE);

/* Object. */
if(isset($_GET['link']) && trim($_GET['link']) != '') {

	/* Get variables. */
	$link		= trim($_GET['link']);
	$page		= isset($_GET['page']) && (int)trim($_GET['page']) > 0 ? (int)trim($_GET['page']) : 1;
	$sectionId 	= (int)trim($_GET['sectionId']);
	
	/* Setup curl. */
    $options = array(
        CURLOPT_RETURNTRANSFER => true,     // return web page
        CURLOPT_HEADER         => false,    // don't return headers
        CURLOPT_FOLLOWLOCATION => true,     // follow redirects
        CURLOPT_ENCODING       => "",       // handle all encodings
        CURLOPT_USERAGENT      => "spider", // who am i
        CURLOPT_AUTOREFERER    => true,     // set referer on redirect
        CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect
        CURLOPT_TIMEOUT        => 120,      // timeout on response
        CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects
    );

    $curl = curl_init($link);
    curl_setopt_array($curl, $options);
    $urlContent = curl_exec($curl);
    curl_close($curl);
	
	/* Clean it up. */
	$curl = NULL; UNSET($curl);


	/* Get the first DIV in the results page. */
	$results = str_get_html($urlContent)->find('.items', 0)->innertext;

	/* Loop through all the jobs. */
	$counter = 0;
	while(($item = str_get_html($results)->find('.item_summary', $counter)->innertext) != NULL) {
	
		/* Get the job. */
		$data = array();
		/* Fetch Data to temporary store. */
		// Get link.
		$data['job_affiliateLink']	= 'www.jobspace.co.za'.str_get_html($item)->find('a', 0)->href; 		 
		$data['job_title'] 			= str_get_html($item)->find('a', 0)->innertext; 
		$data['jobs_affiliate']		= 'jobspace';		
		
		/* Fetch more data in the current job's details. */
		$curl = curl_init($data['job_affiliateLink']);
		curl_setopt_array($curl, $options);
		$detailsContent = curl_exec($curl);
		curl_close($curl);	
		
		/* Clean it up. */
		$curl = NULL; UNSET($curl);	
		
		/* Get current job important content. */
		$jobContent = str_get_html($detailsContent)->find('.itemblockcontainer', 0)->innertext;
		
		/* Check if they have email. */
		$emailContent	= str_get_html($jobContent)->find('p', 0)->innertext;		
		$pattern		="/[a-z0-9]+([_\\.-][a-z0-9]+)*@([a-z0-9]+([\.-][a-z0-9]+)*)+\\.[a-z]{2,}/i"; 
		/* Pregmatch to find an email address. */
		preg_match_all($pattern, $emailContent, $matches);
		
		if(count($matches) > 0) {
			for($i = 0; $i < count($matches); $i++) {
				if(isset($matches[$i][0])) {
					if(preg_match('/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/', $matches[$i][0])) {
						$data['job_poster_email'] = $matches[$i][0];
					}			
				}
			}
		}

		/* Get the temporary area. */			
		$tempLocation		= str_get_html($jobContent)->find('dd', 1)->innertext;
		$tempTwoLocation	= str_get_html($tempLocation)->find('a', 0)->innertext;
		$tempThreeLocation	= str_get_html($tempLocation)->find('a', 1)->innertext;
		
		$finalArea = str_replace(' ', '', str_replace('-', '',strtolower($tempThreeLocation.''.$tempTwoLocation)));
		$areaExists = $areaMapObject->fetchByShortPath_removeCharacters($finalArea);
		
		if(count($areaExists) > 0) {
			
			$data['fk_area_id'] 		= $areaExists['fkAreaId'];
			$data['job_area']			= $areaExists['areaMap_shortPath'];		
			$listedDate					= str_get_html($jobContent)->find('dd', 3)->innertext;			
			$data['job_added']  		= date('Y-m-d h:i:s A', strtotime($listedDate));			
			
			/* Remove email addresses from the content. */
			$pattern = "/[a-z0-9]+([_\\.-][a-z0-9]+)*@([a-z0-9]+([\.-][a-z0-9]+)*)+\\.[a-z]{2,}/i";
			$replacement = "[you must apply via willowvine website]";
			$emailContent = preg_replace($pattern, $replacement, $emailContent);			
			
			$data['job_page']				= $emailContent;
			$data['fk_section_id'] 			= $sectionId;
			/* Get job type. */
			$jobTypeTemp = str_get_html($jobContent)->find('dd', 2)->innertext;
			if(trim($jobTypeTemp) == 'Full Time') $data['job_type'] = 'permanent';
			if(trim($jobTypeTemp) == 'Part Time') $data['job_type'] = 'temp';
			if(trim($jobTypeTemp) == 'Contract') $data['job_type'] = 'contract';
			if(trim($jobTypeTemp) == 'Freelance') $data['job_type'] = 'contract';
			
			/* NO need for processing fields. */
			$data['job_deleted']			= 0;
			$data['job_active']				= 1;
			$data['job_advertBy'] 			= 'agency';			
			$data['job_link']				= StringToUrl($data['job_title']);
			$data['job_longitude'] 			= '';
			$data['job_latitude'] 			= '';
			$data['job_address'] 			= '';	
			$data['fk_recruiter_id']		= 1003;
			$data['job_poster_number'] 		= '';
			$data['job_poster_name']		= '';	
			$data['job_poster_number']		= '';	
			$data['job_AdType']				= 'offering';
			$data['job_affiliateReference'] = '';			

			/* Check if job exists. */
			$jobExists = $jobObject->getByAffiliateLink(trim($data['job_affiliateLink']));
			if(count($jobExists) == 0) {
				/* Insert job. */
				$data['job_reference'] 	= $jobObject->createReference(); 	
				$success = $jobObject->insert($data);
				echo '<span style="color: green;">New Job: '.$data['job_title'].' - '.$data['job_affiliateLink'].'</span><br />';
			} else {
				/* Update job. */
				$where = $jobObject->getAdapter()->quoteInto('job_affiliateLink = ?', $data['job_affiliateLink']);
				$success = $jobObject->update($data, $where);
				echo '<span>Updated Job: '.$data['job_title'].' - '.$data['job_affiliateLink'].'</span><br />';
			}			
		}
		
		
		if(!isset($jobExists)) {
			echo '<span style="color: red;">No Area for: '.$data['job_title'].' - '.$data['job_affiliateLink'].' - '.$tempThreeLocation.':'.$tempTwoLocation.'</span><br />';
			
		}
		
		/* Got to the next one. */
		$counter++;
		
		/* Clean up. */
		$where = $success = $data = $jobExists = $jobTypeTemp = $jobContent = $emailContent = $replacement = $pattern = $listedDate = $areaExists = $finalArea = NULL;
		$tempThreeLocation = $tempTwoLocation = $tempLocation = $matches = $emailContent = $detailsContent = $curl = NULL;
		
		UNSET($where  ,$success ,$data ,$jobExists ,$jobTypeTemp ,$jobContent ,$emailContent ,$replacement ,$pattern ,$listedDate ,$areaExists ,$finalArea);
		UNSET($tempThreeLocation ,$tempTwoLocation ,$tempLocation ,$matches ,$emailContent ,$detailsContent ,$curl);
	}	
}

	
	

	
	
	
	
					
			

?>