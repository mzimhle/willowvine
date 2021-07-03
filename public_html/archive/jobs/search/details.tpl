<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Ref. {$jobData.job_reference}, {$jobData.job_title}, {$jobData.section_name}, jobs in {$jobData.job_area}{if $page neq ''}, on page {$page}{/if}</title>
<meta name="description" content="Ref. {$jobData.job_reference}, {$jobData.job_title}, {$jobData.section_name}, jobs in {$jobData.job_area}{if $page neq ''}, "" {$page}{/if}">
<meta name="keywords" content="south african jobs,south africa careers,jobs south africa,willowvine,willowvine,jobs,careers, {$jobData.job_title}, {$jobData.section_name},  {$jobData.job_area}">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
{include_php file="includes/css.php"}
{include_php file="includes/javascript.php"}
<script src="http://static.ak.fbcdn.net/connect.php/js/FB.Share" type="text/javascript"></script>
</head>
<body OnLoad="document.search_for_jobs.searchJob.focus();">
<div id="container">
	{include_php file="includes/navigation.php"}
	<div class="clear"></div>
	{include_php file="includes/search_jobs.php"}
	<br />
	<a class="standard_blue_btn fr" title="Go back to your search results" href="/jobs/search/{if isset($sectionData)}{$sectionData.section_urlName}/{/if}?page={$page}{if $searchJob neq ''}&searchJob={$searchJob}{/if}{if $type neq ''}&type={$type}{/if}{if $area neq ''}&area={$area}{/if}">
		<span id="Login">Back to your search</span>								
	</a>
	<h1>
		{$jobData.job_title}	
	</h1>

	<span class="blue_text">{$jobData.section_name}</span><br>
	<span>{$jobData.job_area}</span>

	<div class="clear"></div>
	<div class="left_content width760">
			<br>
			<div class="share_btn border_top">
				<ul>
					<li>
					<a href='javascript:void(0);' onclick="openWindow_fb_share('http://www.facebook.com/sharer/sharer.php?u=http://www.willowvine.co.za/jobs/search/{$jobData.section_urlName}/details/{$jobData.job_link}/{$jobData.job_reference}/');" title="Share this job on facebook: {$item.job_title|normal_text}">
						<img src="/images/facebook_share_up.png" title="Share this job on facebook: {$item.job_title|normal_text}" />
					</a>
					</li>
					<li><a href="https://twitter.com/share" class="twitter-share-button" data-text="Job available - {$jobData.job_title|normal_text} at " data-related="willowvine" data-count="none">Share job</a>
					{literal}
					<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
					{/literal}
					</li>
					<li><a class="small_blue_bg_dark_btn fl" title="Share job or career with a friend" alt="Share job or career with a friend" href='Javascript: showShare("{$jobData.job_title|normal_text} in  {$jobData.job_area|trim}", {$jobData.job_reference});'><span id="share_job">Share this job</span></a></li>
					<li><a class="small_blue_bg_dark_btn fr" title="Add this job to short list" alt="Add this job to short list" href="{if $jobData.shortlist eq 0}Javascript:shortList({$jobData.job_reference});{else}/jobs/shortlist/{/if}"><span id="share_job">{if $jobData.shortlist eq 0}Shortlist this job{else}View my shortlist{/if} ({$jobShareCount})</span></a></li>			
				</ul>
			</div>
			<div class="clear"></div>
			<span class="default_text">{$jobData.job_page|trim}</span>
			<br><br>
			<div class="map_image_container">
				<a href="/jobs/search/{$jobData.section_urlName}/directions/{$jobData.job_link}/{$jobData.job_reference}/?page={$page}{if $searchJob neq ''}&searchJob={$searchJob}{/if}{if isset($sectionData)}&sectionId={$sectionData.pk_section_id}{/if}{if $type neq ''}&type={$type}{/if}{if $area neq ''}&area={$area}{/if}">
					<span class="blue_text">View directions on a map</span><br><br>				
					<img class="map_image" src="http://maps.googleapis.com/maps/api/staticmap?center={$jobData.job_area|trim}&zoom=14&size=540x200&sensor=false" alt="jobs in {$jobData.job_area|trim}" title="jobs in {$jobData.job_area|trim}" width="730" height="250" />
				</a>
			</div>			
			<div class="clear"></div>			
	</div>			
	<div class="right_content">
			{if $jobData.job_poster_email neq ''}
			{include_php file="includes/job_application_box.php"}	
			{/if}
			{include_php file="includes/side_ad_container.php"}
	</div>
	{include_php file="includes/footer.php"}
</div>

</body>
</html>