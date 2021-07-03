<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Ref. {$internshipData.pk_internship_id} | {$internshipData.internship_title} in {$internshipData.section_name} Section, page {$page|default:"1"} {if $searchInternship neq ""} while searching for "{$searchInternship}"{/if}</title>
<meta name="description" content='Ref. {$internshipData.pk_internship_id} | {$internshipData.internship_title} in {$internshipData.section_name} Section, page {$page|default:"1"} {if $searchInternship neq ""} while searching for "{$searchInternship}"{/if}'>
<meta name="keywords" content="south african internships,south africa internships,internships south africa,willowvine,willowvine,internships,internships, {$internshipData.internship_title}, {$internshipData.section_name}">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
{include_php file="includes/css.php"}
{include_php file="includes/javascript.php"}
{literal}
<style type="text/css">
.left_content ul {
    line-height: 18px;
	list-style-type: none;
}	

.left_content ul li {
  background: url("/images/larrow.jpg") no-repeat scroll 0 5px transparent;
   /* color: #3F3F3F; */
    font: 12px/18px Arial,Helvetica,sans-serif;
    padding: 0 0 8px 14px;	
}

.left_content ul li a {
    color: #CA7316;
    text-decoration: none;
}

a {
    color: #CA7316;
    text-decoration: none;
}

span p {
	margin: 1px;
}
</style>
{/literal}
</head>
<body OnLoad="document.search_for_jobs.searchJob.focus();">
<div id="container">
	{include_php file="includes/navigation.php"}
	<div id="contnav" class="fl">
		<p class="fl">
			<a href="/">Home</a> &nbsp; 	
			<span>|</span> &nbsp; 
			<span>Internships</span>
			<span>|</span> &nbsp; 
			<span>{$internshipData.section_name}</span>			
			<span>|</span> &nbsp; 
			<span>{$internshipData.internship_title} {if $internshipData.internship_area neq ''}in <span class="green_text">{$internshipData.internship_area}</span>{/if}</span>		
			
		</p>
	</div>
	
	{include_php file="includes/search_internships.php"}
	<br>
	<a class="standard_blue_btn fr" title="Go back to your search results" href="/internships/?searchInternship={$searchInternship}&page={$page}">
		<span id="Login">Back to your search</span>								
	</a>	
	<h1>
		{$internshipData.internship_title}	
	</h1>	
	<span class="blue_text">{$internshipData.section_name}</span><br>
	<span>{$internshipData.internship_area}</span>

	<div class="clear"></div><br>
	<div class="left_content">
			<br>
			<div class="share_btn border_top">
			</div>
			<div class="clear"></div>
			<br>
			<p>
				{if $internshipData.internship_company neq ''}<span class="blue_text">Company/Organization:</span><br><span>{$internshipData.internship_company}</span><br><br>{/if}
				{if $internshipData.internship_contact_name neq ''}<span class="blue_text">Contact Email:</span><br><span>{$internshipData.internship_contact_name}</span><br><br>{/if}
				{if $internshipData.internship_contact_email neq ''}<span class="blue_text">Contact Email:</span><br><span>{$internshipData.internship_contact_email}</span><br><br>{/if}
				{if $internshipData.internship_contact_number neq ''}<span class="blue_text">Contact Number/s:</span><br><span>{$internshipData.internship_contact_number}</span><br><br>{/if}			
			</p>				
			<span class="default_text">{$internshipData.internship_page|trim}</span>
	</div>			
	<div class="right_content">		
			{include_php file="includes/side_ad_container.php"}
		<div class="clear"></div>
		<br><br>
		{include_php file="includes/facebook_wall.php"} 			
	</div>
	{include_php file="includes/footer.php"}
</div>

</body>
</html>