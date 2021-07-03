<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>WillowVine | CV Search cvItems | Online Job Classified Adverts - Jobs, Careers, holiday or weekend work in your town or city and near you.</title>
<meta name="description" content="Only jobs and careers in your area, city or town." />
<meta name="keywords" content="south african jobs,south africa careers,jobs south africa,willowvine,willowvine,jobs,careers, Cape Town, East London, Port Elizabeth, Johannesburg, Durban, Polokwane, Bloemfontein, Pretoria" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
{include_php file="includes/css.php"}
{include_php file="includes/javascript.php"}
</head>
<body>
<div id="home">
	<div id="main">
		<!-- Start Header -->
		{include_php file="includes/header.php"}
		<!-- End Header -->
		<!-- Start Navigation -->
		{include_php file="includes/navigation.php"}
		<!-- End Navigation -->
		<!-- Start Navigation -->
		<div id="contnav">
			<p>
			<a href="/">Home</a> &nbsp; 
			<span class="dash">|</span> &nbsp; 
			<a href="/recruiter/">Recruiter</a> &nbsp; 	
			<span class="dash">|</span> &nbsp; 
			<a href="/recruiter/search/cv/">CV Search</a> &nbsp; 	
			</p>
		</div>
		<!-- End Navigation -->
		<div id="content">
			<div class="success_left_wrap">
				<h1>CV Search results</h1>
				<p class="searchresulttext">
				<span class="orange_text">{$sectionData.section_name|default:'All Category'} CV's</span> with <span class="orange_text">'{$cvText|default:'Any Content'}'</span>
				in their CV's - <span class="orange_text">{$paginator->totalItemCount}</span> results(s).
				The most relevant CV's are listed first.<br />
				</p><br />
				{* {include_php file='includes/logged_in_welcome.php'} *}
				{include_php file='includes/post_a_job.php'}
				{include_php file='includes/search_our_cv_database.php'}			
			</div><!-- ending of success_left_wrap -->
			<div id="leftcontent_success">
				<div class="searchresult_top"></div>
				<div class="id_center">
{if $cvItems|@count gt 0}
{capture name="pagination"}
					<div class="specificjob">
						<div class="specificjob_top catnev_top"></div>
						<div class="specificjob_center">
							<!-- <div class="catnev_wrap">{if $paginator->current neq 1}<a href="/jobs/search/?searchJob={$searchJob}&searchArea={$searchArea}&page=1">First Page</a>{else}First Page{/if}</div> -->
							<div class="catnev_wrap">{if $paginator->current gt 1}<a href="/jobs/search/?searchJob={$searchJob}&searchArea={$searchArea}&sectionId={$sectionId}&page={$paginator->previous}">Previous Page</a>{else}Previous Page{/if}</div>
							<div class="catnev_wrap">
								{foreach from=$paginator->pagesInRange item=page}
									{if $page neq $paginator->current}
										<a href="/jobs/search/?searchJob={$searchJob}&searchArea={$searchArea}&sectionId={$sectionId}&page={$page}">{$page}</a> &nbsp;&nbsp; 
									{else}
									<span class="orange_text">{$page}</span> &nbsp;&nbsp;
									{/if}
								{/foreach}
							</div>
							<div class="catnev_wrap">{if $paginator->current lt $paginator->lastPageInRange}<a href="/jobs/search/?searchJob={$searchJob}&searchArea={$searchArea}&sectionId={$sectionId}&page={$paginator->next}">Next Page</a>{else}Next Page{/if}</div>
							<!-- <div class="catnev_wrap catnev_wrap_right">{if $paginator->current neq $paginator->lastPageInRange}<a href="/jobs/search/?searchJob={$searchJob}&searchArea={$searchArea}&page={$paginator->pageCount}">Last Page</a>{else}Last Page{/if}</div> -->
							<div class="clear"></div>
						</div><!-- ending of specificjob_center -->
						<div class="specificjob_bottom"></div>
					</div><!-- ending of specificjob -->
{/capture}
{/if}{$smarty.capture.pagination|replace:'?&amp;':'?'}
{foreach from=$cvItems item=item name=foo}
					<div class="activejob_{if $smarty.foreach.foo.index is even}white{else}brown{/if}">
							<h3>{$item.jobSeeker_name|trim|default}</h3> <br /> <span>Download CV <a href="/recruiter/search/cv/download.php?cv={$item.jobSeekerCV_filename}&jskr={$item.jobSeeker_reference}">({$item.jobSeekerCV_filename})</a></span>							
						<br /><div class="clear"></div>
						<div class="clear"></div>
					</div><!-- ending of activejob_{if $smarty.section.i.index is even}white{else}brown{/if} -->
					{foreachelse}
					<div class="content" align="left" style="padding:0px 10px 0px 10px;">
						Unfortunately there are no job listings matching your criteria.
						<br />
						<br />
						Your search may have been to specific. Try one of the links below for a broader search or use the 'Jobs search' menu item to search again.
						<br />
						<br />
						<br />
						Lodgestaff.com is the premier recruitment website for Travel and Tourism jobs throughout Africa. Jobs are added on a daily basis, so be sure to visit regularly to view the latest positions available.
					</div><!-- content -->
					{/foreach}
{if $cvItems|@count gt 0}
					<div class="acivejob_blank_bottom"></div>
{$smarty.capture.pagination}
{/if}
					<div class="acivejob_blank"></div>
					<div class="idtd_bottom"></div>
				</div><!-- ending of id_center -->
			</div><!-- ending of leftcontent_success -->
			<div class="clear"></div>
			<!-- ending of leftcontent_success -->
		</div><!-- ending of content -->
	</div><!--ending of main-->
</div><!--ending of home--><div class="clear"></div>
{include_php file='includes/footer.php'}
</body>
</html>