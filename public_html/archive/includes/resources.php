<?php

global $smarty;

/* Job Section. */
$jobTypes = array(
											''					=> '-------------',
											'casual' 		=> 'Casual',
											'temporary' 	=> 'Temporary',
											'contract' 		=> 'Contract',
											'parttime' 	=> 'Part-Time',
											'fulltime' 		=> 'Fulltime',
											'graduate' 	=> 'Graduate',
											'internship' 	=> 'Internship',
											'volunteer' 	=> 'Volunteer',
											'permanent' 	=> 'Permanent'
										);
$smarty->assign('jobTypePairs', $jobTypes);
										
$employmentEquity = array(
											''					=> 'Not Specified',
											'ee/ee' 		=> 'EE/AA',
											'non ee/aa' 	=> 'Non EE/AA'
									);
$smarty->assign('employmentEquityPairs', $employmentEquity);

/* Area Types/Tree. */			
/* Format:  suburb/Town, city, province, country. */
$areaTypes = array(
									''				=> 'Please Select',
									'country'	=> 'Country',
									'province' => 'Province',
									'city'			=> 'City',
									'area'		=> 'Area',
									'town' 		=> 'Town',									
									'suburb'	=> 'Surburb'									
						);
						
$smarty->assign('areaTypePairs', $areaTypes);

/* Categories. */
$categories = array(
									''				=> 'Please Select',
									'job' 		=> 'Jobs',
									'property' => 'Property to rent/buy',
									'car' 			=> 'Cars',
									'service' 	=> 'Business Services'
						);
$smarty->assign('categoryPairs', $categories);
?>