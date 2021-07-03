<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>WillowVine | Careers {if isset($sectionCareerData)}in {$sectionCareerData.section_name}{/if} returned {$paginator->totalItemCount|default:'0'} results</title>
<meta name="description" content="Willowvine career search for {if isset($sectionCareerData)}{$sectionCareerData.section_name}, {/if}{$searchCareer|trim|default:'any careers'|escape} on willowvine and {$paginator->totalItemCount|default:'0'} career results" />
<meta name="keywords" content="south african jobs, careers,south africa careers,jobs south africa,willowvine,willowvine,jobs,careers, Cape Town, East London, Port Elizabeth, Johannesburg, Durban, Polokwane, Bloemfontein, Pretoria" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
{include_php file="includes/css.php"}
{include_php file="includes/javascript.php"}
</head>
<body OnLoad="document.search_for_careers.searchCareer.focus();">
<div id="container">
{include_php file="includes/navigation.php"}
<div id="contnav" class="fl">
	<p class="fl">
		<a href="/">Home</a> &nbsp; 	
		<span>|</span> &nbsp; 
		<span>Careers</span>
		<span>|</span> &nbsp; 
		<span>Searching for <span class="green_text">"{$searchCareer|default:"all careers"}"</span>			
	</p>
</div>
{include_php file="includes/search_careers.php"}
<h1>
	Careers
</h1>
<div class="left_content width760">
		<span class="descr_text">
			Searching for <span class="green_text">"{$searchCareer|default:"all careers"}"</span> which brought back
			<span class="green_text">"{$paginator->totalItemCount|default:"0"}"</span> different career results you can choose to learn about. 
			{if isset($sectionCareerData)}Jobs for the <span class="green_text">{$sectionCareerData.section_name}</span> category{/if}
		</span>
{if $careerItems|@count gt 0}		
	<!-- Pagination -->
	{capture name="pagination"}
	{if $paginator->totalItemCount gt 10}
	<div class="clear"></div>
	<p class="pagination fr">
		{if $paginator->current gt 1}
			<a class="prev-page" href="/careers/{if isset($sectionCareerData)}{$sectionCareerData.section_urlName}/{/if}?page={$paginator->previous}&searchCareer={$searchCareer}">Previous</a>
		{/if}	
			{foreach from=$paginator->pagesInRange item=page}
			{if $page neq $paginator->current}		
			<a class="page-num" href="/careers/{if isset($sectionCareerData)}{$sectionCareerData.section_urlName}/{/if}?page={$page}&searchCareer={$searchCareer}">{$page}</a>
			{else}
			<strong class="current-page">{$page}</strong>
			{/if}
		{/foreach}
		{if $paginator->current lt $paginator->lastPageInRange}
			<a class="next-page" href="/careers/{if isset($sectionCareerData)}{$sectionCareerData.section_urlName}/{/if}?page={$paginator->next}&searchCareer={$searchCareer}">Next</a>
		{/if}	
	</p>
	{/if}
	{/capture}	
	{$smarty.capture.pagination|replace:'?&amp;':'?'}
	<div class="clear"></div>	
		<div class="fl">
		{literal}
			<script type="text/javascript"><!--
			google_ad_client = "ca-pub-3167387384914043";
			/* internship_side_banner */
			google_ad_slot = "8166804044";
			google_ad_width = 160;
			google_ad_height = 600;
			//-->
			</script>
			<script type="text/javascript"
			src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
			</script>	
			<div class="clear"></div><br /><br />
			<script type="text/javascript"><!--
			google_ad_client = "ca-pub-3167387384914043";
			/* internship_banner_2 */
			google_ad_slot = "0037365643";
			google_ad_width = 160;
			google_ad_height = 600;
			//-->
			</script>
			<script type="text/javascript"
			src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
			</script>			
		{/literal}		
		</div>	
	<div class="internship_container fr">
	{foreach from=$careerItems item=item name=foo}
	<div class="search_item search_odd_{if $smarty.foreach.foo.index is even}blue{else}dark{/if}">
		<div class="title_box">		
			<a style="color: #063166;" title="View this intnership, {$item.career_title|normal_text}'s details" href="/careers/{$item.section_urlName}/details/{$item.career_link}/{$item.pk_career_id}/?searchCareer={$searchCareer}&sectionId={$sectionId}&page={$paginator->current}" style="text-decoration: none;">			
				<h2>{$item.career_title|normal_text}</h2>					
				<span class="blue_text">{$item.section_name|trim}</span>
			</a>
		</div>
		<div class="clear"></div>
		<div class="search_desc">
			{$item.career_page|normal_text|strip_tags|truncate:300}
			<div class="clear"></div>
		</div>		
		<div class="clear"></div>
	</div>
	{/foreach}
	</div>
	{$smarty.capture.pagination}		
	<!-- End Pagination -->
	{else}
	<div class="clear"></div>
	{include_php file="includes/side_ad_container.php"}
{/if}
	</div>
	<div class="right_content">
		{include_php file="includes/registration_box.php"}	
		<br>
		{include_php file="includes/facebook_wall.php"} 
		{if $careerItems|@count gt 0}			
		{include_php file="includes/side_ad_container.php"}
		{/if}		
	</div>
	{include_php file="includes/footer.php"}
</div>

</body>
</html>