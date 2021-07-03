<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>WillowVine | Blog with latest jobs</title>
<meta name="description" content="willowvine blog with latest jobs" />
<meta name="keywords" content="blog, blog posts, south african jobs,south africa careers,jobs south africa,willowvine,willowvine,jobs,careers, Cape Town, East London, Port Elizabeth, Johannesburg, Durban, Polokwane, Bloemfontein, Pretoria" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
{include_php file="includes/css.php"}
{include_php file="includes/javascript.php"}
</head>
<body OnLoad="document.search_for_jobs.searchJob.focus();">
<div id="container">
{include_php file="includes/navigation.php"}
<div id="contnav" class="fl">
	<p class="fl">
		<a href="/">Home</a> &nbsp; 	
		<span>|</span> &nbsp; 
		<span>Blog</span>
		<span>|</span> &nbsp; 
		<span>Latest willowvine jobs</span>			
	</p>
</div>
{include_php file="includes/search_jobs.php"}
<h1>
	Blog
</h1>
<div class="left_content">
		<span class="descr_text">
			These are the latest jobs that have been added, please feel free to search for your appropriate job and apply for it.
		</span>		
	<div class="clear"></div>	
	{foreach from=$jobItems item=item name=foo}
	<div class="search_item search_odd_{if $smarty.foreach.foo.index is even}blue{else}dark{/if}">
		<div class="title_box">
			<a style="color: #063166;" title="View this job, {$item.job_title|normal_text}'s details" href="/jobs/search/{$item.section_urlName}/details/{$item.job_link}/{$item.job_reference}/?searchArea={$searchArea}&searchJob={$searchJob}&sectionId={$sectionId}&page={$paginator->current}" style="text-decoration: none;">
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
	<div class="clear"></div>
	{include_php file="includes/side_ad_container.php"}
	</div>
	<div class="right_content">
		{include_php file="includes/registration_box.php"}	
		<br><br>
		{if $jobItems|@count gt 0}	
		{include_php file="includes/internships_side.php"}
		<br><br>		
		{include_php file="includes/facebook_wall.php"}	
		{include_php file="includes/side_ad_container.php"}		
		{/if}
		
	</div>
	{include_php file="includes/footer.php"}
</div>

</body>
</html>