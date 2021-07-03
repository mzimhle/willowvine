<?php
/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');
/**
 * Standard includes
 */
require_once 'config/setup.php';
require_once 'class/job.php';

$itemsLink = array (
	0 => array(
						'link' => 'http://www.jobspace.co.za/jobs/accounting-334',
						'section' => 3
			),
	1	=> array(
						'link' => 'http://www.jobspace.co.za/jobs/banking_&_finance-337',
						'section' => 3	
	),
	2	=> array(
						'link' => 'http://www.jobspace.co.za/jobs/hospitality-20004',
						'section' => 11
	),
	3	=> array(
						'link' => 'http://www.jobspace.co.za/jobs/maintenance_&_facilities-20106',
						'section' => 4		
	),
	4	=> array(
						'link' => 'http://www.jobspace.co.za/jobs/marketing_media_&_communication-10280',
						'section' => 2	
	),
	5	=> array(
						'link' => 'http://www.jobspace.co.za/jobs/science-10143',
						'section' => 20		
	),
	6	=> array(
						'link' => 'http://www.jobspace.co.za/jobs/tourism-350',
						'section' => 11		
	),
	7	=> array(
						'link' => 'http://www.jobspace.co.za/jobs/other-352',
						'section' => 0
	),
	8	=> array(
						'link' => 'http://www.jobspace.co.za/jobs/administration-335',
						'section' => 6	
	),
	9	=> array(
						'link' => 'http://www.jobspace.co.za/jobs/computers_&_it-339',
						'section' => 1
	),
	10	=> array(
						'link' => 'http://www.jobspace.co.za/jobs/engineering-342',
						'section' => 4	
	),
	11	=> array(
						'link' => 'http://www.jobspace.co.za/jobs/hr_&_recruitment-344',
						'section' => 12
	),
	12	=> array(
						'link' => 'http://www.jobspace.co.za/jobs/management_&_executive-20085',
						'section' => 6		
	),
	13	=> array(
						'link' => 'http://www.jobspace.co.za/jobs/retail-347',
						'section' => 7		
	),
	14	=> array(
						'link' => 'http://www.jobspace.co.za/jobs/sport_&_fitness-20114',
						'section' => 26	
	),
	15	=> array(
						'link' => 'http://www.jobspace.co.za/jobs/trades_&_services-10144',
						'section' => 22	
	),
	16	=> array(
						'link' => 'http://www.jobspace.co.za/jobs/agriculture-336',
						'section' => 21		
	),
	17	=> array(
						'link' => 'http://www.jobspace.co.za/jobs/construction_&_architecture-340',
						'section' => 4		
	),
	18	=> array(
						'link' => 'http://www.jobspace.co.za/jobs/healthcare-343',
						'section' => 26
	),
	19	=> array(
						'link' => 'http://www.jobspace.co.za/jobs/legal_&_paralegal-345',
						'section' => 5		
	),
	20	=> array(
						'link' => 'http://www.jobspace.co.za/jobs/manufacturing-346',
						'section' => 4		
	),
	21	=> array(
						'link' => 'http://www.jobspace.co.za/jobs/sales-348',
						'section' => 2		
	),
	22	=> array(
						'link' => 'http://www.jobspace.co.za/jobs/teaching_&_education-349',
						'section' => 12
	),
	23	=> array(
						'link' => 'http://www.jobspace.co.za/jobs/transport_&_logistics-351',
						'section' => 22	
	)
);

	/* Get variables. */
	$key 	= rand(0, 23);
	$page 	= '?page='.rand(1, 10);
	$link		= 'http://www.willowvine.co.za/admin/jobs/scrape/jobspace/jobspaceHtml.php?sectionId='.$itemsLink[$key]['section'].'&link='.$itemsLink[$key]['link'].$page;
	
	/* Setup curl. */
    $options = array(
        CURLOPT_RETURNTRANSFER 	=> true,     // return web page
        CURLOPT_HEADER         			=> false,    // don't return headers
        CURLOPT_FOLLOWLOCATION 	=> true,     // follow redirects
        CURLOPT_ENCODING       		=> "",       // handle all encodings
        CURLOPT_USERAGENT      		=> "spider", // who am i
        CURLOPT_AUTOREFERER    		=> true,     // set referer on redirect
        CURLOPT_CONNECTTIMEOUT 	=> 120,      // timeout on connect
        CURLOPT_TIMEOUT        			=> 120,      // timeout on response
        CURLOPT_MAXREDIRS      		=> 10,       // stop after 10 redirects
    );

    $curl = curl_init($link);
    curl_setopt_array($curl, $options);
    $urlContent = curl_exec($curl);
    curl_close($curl);
	
	/* Clean it up. */
	$curl = NULL; UNSET($curl);
	
	echo $urlContent;
	
	/* Facebook, add one of the jobs to facebook. */
	
	$jobObject = new class_job();
	
	$jobData = $jobObject->getMostJobs(1);
	
	print_r($jobData);
?>