<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>WillowVine jobs in {$location|trim|default:"South Africa"} | {if isset($sectionData)} Search for {$sectionData.section_name} jobs {/if}{if $searchJob neq ''} "{$searchJob|trim|default:escape}" jobs and {/if}{$paginator->totalItemCount|default:"0"} results are shown in page {$page|default:'1'}</title>
<meta name="description" content="WillowVine jobs in {$location|trim|default:'South Africa'} |{if isset($sectionData)} Search for {$sectionData.section_name} jobs {/if}{if $searchJob neq ''} '{$searchJob|trim|default:escape}' jobs and {/if}{$paginator->totalItemCount|default:'0'} results are shown in page {$page|default:'1'}" />
<meta name="keywords" content="south african jobs,south africa careers,jobs south africa,willowvine,willowvine,jobs,careers, Cape Town, East London, Port Elizabeth, Johannesburg, Durban, Polokwane, Bloemfontein, Pretoria" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
{include_php file="includes/css.php"}
{include_php file="includes/javascript.php"}
{include_php file="includes/auto_complete.php"}
{literal}
<script type="text/javascript">
$().ready(function() {
$("#areaName").autocomplete(areas);
$("#searchJob").autocomplete(jobs);
});
</script>
{/literal}
<script src="http://static.ak.fbcdn.net/connect.php/js/FB.Share" type="text/javascript"></script>
</head>
<body OnLoad="document.search_for_jobs.searchJob.focus();">
<div id="container">
{include_php file="includes/navigation.php"}
<div class="clear"></div>
{include_php file="includes/search_jobs.php"}
{if $jobShareCount gt 0}	
<a class="standard_blue_btn fr" style="margin-top: 5px;" title="View my shortlisted jobs" href="/jobs/shortlist/">
	<span id="Login">View my Shortlist ({$jobShareCount})</span>								
</a>	
{/if}
<div class="clear"></div>
<div class="sub_container_left">
	{include_php file="includes/filter_jobs_right.php"}
</div>
<div class="sub_container_right"><br />
<div class="clear"></div>
<div class="left_content">
{if $jobItems|@count gt 0}		
	<!-- Pagination -->
	{capture name="pagination"}
	{if $paginator->totalItemCount gt 10}
	<div class="clear"></div>
	<p class="pagination fr">
		{if $paginator->current gt 1}
			<a class="prev-page" href="/jobs/search/{if isset($sectionData)}{$sectionData.section_urlName}/{/if}?page={$paginator->previous}{if $searchJob neq ''}&searchJob={$searchJob}{/if}{if $type neq ''}&type={$type}{/if}{if $area neq ''}&area={$area}{/if}">Previous</a>
		{/if}	
			{foreach from=$paginator->pagesInRange item=page}
			{if $page neq $paginator->current}		
			<a class="page-num" href="/jobs/search/{if isset($sectionData)}{$sectionData.section_urlName}/{/if}?page={$page}{if $searchJob neq ''}&searchJob={$searchJob}{/if}{if $type neq ''}&type={$type}{/if}{if $area neq ''}&area={$area}{/if}">{$page}</a>
			{else}
			<strong class="current-page">{$page}</strong>
			{/if}
		{/foreach}
		{if $paginator->current lt $paginator->lastPageInRange}
			<a class="next-page" href="/jobs/search/{if isset($sectionData)}{$sectionData.section_urlName}/{/if}?page={$paginator->next}{if $searchJob neq ''}&searchJob={$searchJob}{/if}{if $type neq ''}&type={$type}{/if}{if $area neq ''}&area={$area}{/if}">Next</a>
		{/if}	
	</p>
	{/if}
	{/capture}	
	{$smarty.capture.pagination|replace:'?&amp;':'?'}
	<div class="clear"></div>	
	{foreach from=$jobItems item=item name=foo}
	<div class="search_item search_odd_{if $smarty.foreach.foo.index is even}blue{else}dark{/if}">
		<div class="title_box">
			<a style="color: #063166;" title="View this job, {$item.job_title|normal_text}'s details" href="/jobs/search/{$item.section_urlName}/details/{$item.job_link}/{$item.job_reference}/?page={$paginator->current}{if $searchJob neq ''}&searchJob={$searchJob}{/if}{if $type neq ''}&type={$type}{/if}{if $area neq ''}&area={$area}{/if}{if isset($sectionData)}&sectionId={$sectionData.pk_section_id}{/if}" style="text-decoration: none;">
				<h2>{$item.job_title|normal_text}</h2>	
				<span class="blue_text">{$item.section_name|trim}</span>
			</a>
		</div>
		<div class="clear"></div>
		<div class="search_desc">
			{$item.job_page|normal_text|strip_tags|truncate:300}
			<div class="clear"></div>
			<br>
			<span class="fr"><b>{$item.job_added|date_format}</b> in <b>{$item.job_area|trim}</b></span>
			<div class="clear"></div>
		</div>		
		<div class="share_btn">
		<ul>
			<li>
				<a href='javascript:void(0);' onclick="openWindow_fb_share('http://www.facebook.com/sharer/sharer.php?u=http://www.willowvine.co.za/jobs/search/{$item.section_urlName}/details/{$item.job_link}/{$item.job_reference}/');" title="Share this job on facebook: {$item.job_title|normal_text}">
					<img src="/images/facebook_share_up.png" title="Share this job on facebook: {$item.job_title|normal_text}" />
				</a>
			</li>
			<li>
				<a href="https://twitter.com/share" class="twitter-share-button" data-text="Job available - {$item.job_title|normal_text} at " data-related="willowvine" data-count="none">Share job</a>
				{literal}
				<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
				{/literal}
			</li>
			<li>
				<a class="small_blue_bg_dark_btn fl" title="Share job or career with a friend" alt="Share job or career with a friend" href='Javascript: showShare("{$item.job_title|normal_text} in  {$item.job_area|trim}", {$item.job_reference});'>
					<span id="share_job">Share this job</span>								
				</a>
			</li>
			{if $item.shortlist eq 0}
			<li>
				<a class="small_blue_bg_dark_btn fr" title="Share job or career with a friend" alt="Share job or career with a friend" href="{if $item.shortlist eq 0}Javascript:shortList({$item.job_reference});{else}/jobs/shortlist/{/if}">
					<span id="share_job">Add to shortlist ({$jobShareCount})</span>								
				</a>				
			</li>
			{/if}			
		</ul>
		</div>
		<div class="clear"></div>
	</div>
	{/foreach}
	{$smarty.capture.pagination}		
	<!-- End Pagination -->
	{else}
	<div class="clear"></div>
	{include_php file="includes/side_ad_container.php"}
{/if}
	</div>
	<div class="right_content">
		{include_php file="includes/registration_box.php"}	
		<br><br>
		{if $jobItems|@count gt 0}	
		{include_php file="includes/internships_side.php"}	
		{include_php file="includes/side_ad_container.php"}
		{/if}
		
	</div>
	</div>
	{include_php file="includes/footer.php"}
</div>

</body>
</html>