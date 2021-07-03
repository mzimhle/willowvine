<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>WillowVine | Internships {if isset($sectionInternshipData)}in {$sectionInternshipData.section_name}{/if} returned {$paginator->totalItemCount|default:'0'} results, page {$page|default:"1"} {if $searchInternship neq ""} while searching for "{$searchInternship}"{/if}</title>
<meta name="description" content="Willowvine internship search for {if isset($sectionInternshipData)}{$sectionInternshipData.section_name}, {/if}{$searchInternship|trim|default:'any internships'|escape} on willowvine and {$paginator->totalItemCount|default:'0'} internship results, page {$page|default:'1'} {if $searchInternship neq ''} while searching for '{$searchInternship}'{/if}" />
<meta name="keywords" content="south african jobs, internships,south africa internships,jobs south africa,willowvine,willowvine,jobs,internships, Cape Town, East London, Port Elizabeth, Johannesburg, Durban, Polokwane, Bloemfontein, Pretoria" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
{include_php file="includes/css.php"}
{include_php file="includes/javascript.php"}
</head>
<body OnLoad="document.search_for_internships.searchInternship.focus();">
<div id="container">
{include_php file="includes/navigation.php"}
<div id="contnav" class="fl">
	<p class="fl">
		<a href="/">Home</a> &nbsp; 	
		<span>|</span> &nbsp; 
		<span>Internships</span>
		{if isset($sectionInternshipData)}
			<span>|</span> &nbsp; 
			<span class="green_text">{$sectionInternshipData.section_name}</span>
		{/if}		
		<span>|</span> &nbsp; 
		<span>Searching for <span class="green_text">"{$searchInternship|default:"all internships"}"</span>		

	</p>
</div>
{include_php file="includes/search_internships.php"}
<h1>
	Internships
</h1>
<div class="left_content width760">
		<span class="descr_text">
			Searching for <span class="green_text">"{$searchInternship|default:"all internships / bursaries / scholarships"}"</span> which brought back
			<span class="green_text">"{$paginator->totalItemCount|default:"0"}"</span> results you can choose to apply for.
			{if isset($sectionInternshipData)}These are internships for <span class="green_text">{$sectionInternshipData.section_name}.</span>{/if}
			Good luck!
		</span>
{if $internshipItems|@count gt 0}		
	<!-- Pagination -->
	{capture name="pagination"}
	{if $paginator->totalItemCount gt 10}
	<div class="clear"></div>
	<p class="pagination fr">
		{if $paginator->current gt 1}
			<a class="prev-page" href="/internships/{if isset($sectionInternshipData)}{$sectionInternshipData.section_urlName}/{/if}?page={$paginator->previous}&searchInternship={$searchInternship}">Previous</a>
		{/if}	
			{foreach from=$paginator->pagesInRange item=page}
			{if $page neq $paginator->current}		
			<a class="page-num" href="/internships/{if isset($sectionInternshipData)}{$sectionInternshipData.section_urlName}/{/if}?page={$page}&searchInternship={$searchInternship}&searchArea={$searchArea}">{$page}</a>
			{else}
			<strong class="current-page">{$page}</strong>
			{/if}
		{/foreach}
		{if $paginator->current lt $paginator->lastPageInRange}
			<a class="next-page" href="/internships/{if isset($sectionInternshipData)}{$sectionInternshipData.section_urlName}/{/if}?page={$paginator->next}&searchInternship={$searchInternship}">Next</a>
		{/if}	
	</p>
	{/if}
	{/capture}	
	{$smarty.capture.pagination|replace:'?&amp;':'?'}
	<div class="clear"></div>	
	{foreach from=$internshipItems item=item name=foo}
	<div class="search_item search_odd_{if $smarty.foreach.foo.index is even}blue{else}dark{/if}">
		<div class="title_box">
			<!--<a class="standard_blue_btn fr" title="View this internship - {$item.internship_title}" href="/internships/{$item.section_urlName}/details/{$item.internship_link}/{$item.pk_internship_id}/?searchInternship={$searchInternship}&sectionId={$sectionId}&page={$paginator->current}">
				<span id="Login">View Internship</span>								
			</a> -->			
			<a style="color: #063166;" title="View this intnership, {$item.internship_title|normal_text}'s details" href="/internships/{$item.section_urlName}/details/{$item.internship_link}/{$item.pk_internship_id}/?searchInternship={$searchInternship}&sectionId={$sectionId}&page={$paginator->current}" style="text-decoration: none;">			
				<h2>{$item.internship_title|normal_text}</h2>					
				<span class="blue_text">{$item.section_name|trim}</span>
			</a>
		</div>
		<div class="clear"></div>
		<div class="search_desc">
			{$item.internship_page|normal_text|strip_tags|truncate:300}
			<div class="clear"></div>
			<br>
			<span class="fr"><b>Posted on the {$item.internship_added|date_format}</b> {if $item.internship_area neq ''}in <b>{$item.internship_area|trim}</b>{/if}</span>
			<div class="clear"></div>
		</div>		
		<div class="share_btn">
		<ul>
			<li>
				<a href="https://twitter.com/share" class="twitter-share-button" data-text="Apply for this internship - {$item.internship_title|normal_text} at " data-related="willowvine" data-count="none">Share job</a>
				{literal}
				<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
				{/literal}
			</li>
			<li>
				<a href='javascript:void(0);' onclick="openWindow_fb_share('http://www.facebook.com/sharer/sharer.php?u=http://www.willowvine.co.za/internships/{$item.section_urlName}/details/{$item.internship_link}/{$item.pk_internship_id}/');" title="Share this internship - {$item.internship_title|normal_text}">
					<img src="/images/facebook_share_up.png" title="Share this internship - {$item.internship_title|normal_text}" />
				</a>			
			</li>	
			<li><a class="small_blue_bg_dark_btn fl" title="Share internship with a friend" alt="Share internship with a friend" href='Javascript:showShareInternship("{$item.internship_title|normal_text}", {$item.pk_internship_id});'><span id="share_job">Share this internship with a friend</span></a></li>						
		</ul>
		</div>
		<div class="clear"></div>
	</div>
	{/foreach}
	{$smarty.capture.pagination}		
	<!-- End Pagination -->
	{else}
	<div class="clear"></div><br>
		<span class="descr_text">
			There are no internships for your search criteria.
		</span>	
	{include_php file="includes/side_ad_container.php"}
{/if}
	</div>
	<div class="right_content">
		{include_php file="includes/registration_box.php"}	
		<br>
		{include_php file="includes/facebook_wall.php"} 
		{if $internshipItems|@count gt 0}			
		{include_php file="includes/side_ad_container.php"}
		{/if}		
	</div>
	{include_php file="includes/footer.php"}
</div>

</body>
</html>