<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>WillowVine | Home | Online Job Classified Adverts - Jobs, Careers, holiday or weekend work in your town or city and near you.</title>
<meta name="description" content="Register our CV with us and let the recruiters and employers come to you. Look for work, jobs or careers as well as internships, bursaries or scholarships" />
<meta name="keywords" content="south african jobs,south africa careers,jobs south africa,willowvine,willowvine,jobs,careers, Cape Town, East London, Port Elizabeth, Johannesburg, Durban, Polokwane, Bloemfontein, Pretoria" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
{include_php file="includes/css.php"}
{include_php file="includes/javascript.php"}
{include_php file="includes/auto_complete.php"}
{literal}
<script type="text/javascript">
$().ready(function() {
$("#areaName").autocomplete(areas);
});
</script>
{/literal}
</head>
<body OnLoad="document.search_for_jobs.searchJob.focus();">
<div id="container">
	{include_php file="includes/navigation.php"}
	<div class="clear"></div><br>
	{include_php file="includes/search_jobs.php"}
	<div class="clear"></div><br>
	{if $jobShareCount gt 0}	
	<a class="standard_blue_btn fr" style="margin-top: 5px;" title="View my shortlisted jobs" href="/jobs/shortlist/">
		<span id="Login">View my Shortlist ({$jobShareCount})</span>								
	</a>		
	{/if}
	<div class="left_content width760">
	<h2 class="font_25">Jobs</h2>
	<ul class="category_section fl">
	{foreach from=$sectionData item=data name=jobName}
		<li><a href="/jobs/search/{$data.section_urlName}/">{$data.section_name}</a></li>
		{if $smarty.foreach.jobName.iteration eq $sectionHalf}
			</ul><ul class="category_section fr">
		{/if}
	{/foreach}
	</ul>
	<div class="clear"></div>
	<h2 class="font_25">Internships / Bursaries / Scholarships</h2>
	<ul class="category_section fl">
	{foreach from=$sectionInternshipData item=data name=internshipName}
		<li><a href="/internships/{$data.section_urlName}/">{$data.section_name}</a></li>
		{if $smarty.foreach.internshipName.iteration eq $sectionInternshipHalf}
			</ul><ul class="category_section fr">
		{/if}
	{/foreach}
	</ul>	
	</div>
	<div class="right_content">
		{include_php file="includes/social_plugin_login.php"}
		{include_php file="includes/registration_box.php"}	
		{if isset($userData)}
		<br><br>
			{include_php file="includes/internships_side.php"}	
		{/if}
	</div>
	{include_php file="includes/footer.php"}
</div>

</body>
</html>