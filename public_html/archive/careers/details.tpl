<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>WillowVine | Careers | Learn More about {$careerData.career_title} in {$careerData.section_name} Section</title>
<meta name="description" content="Learn More about {$careerData.career_title} in {$careerData.section_name} Section and Search for jobs relating to that career.">
<meta name="keywords" content="south african careers,south africa careers,careers south africa,willowvine,willowvine,careers,careers, {$careerData.career_title}, {$careerData.section_name}">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
{include_php file="includes/css.php"}
{include_php file="includes/javascript.php"}
{literal}
<style type="text/css">
#leftcontent_about ul {
    line-height: 18px;
	list-style-type: none;
}	

#leftcontent_about ul li {
  background: url("/images/larrow.jpg") no-repeat scroll 0 5px transparent;
    color: #3F3F3F;
    font: 12px/18px Arial,Helvetica,sans-serif;
    padding: 0 0 8px 14px;	
}

#leftcontent_about ul li a {
    color: #CA7316;
    text-decoration: none;
}

a {
    color: #CA7316;
    text-decoration: none;
}
</style>
{/literal}
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
			<span>{$careerData.section_name}</span>			
			<span>|</span> &nbsp; 
			<span>{$careerData.career_title}</span>		
			
		</p>
	</div>
	
	{include_php file="includes/search_careers.php"}
	<br>
	<a class="standard_blue_btn fr" title="Go back to your search results" href="/careers/?searchCareer={$searchCareer}&page={$page}">
		<span id="Login">Back to your search</span>								
	</a>	
	<h1>
		{$careerData.career_title}	
	</h1>	
	<span class="blue_text font_16">{$careerData.section_name}</span><br>
	<span>{$careerData.career_area}</span>
	<div class="clear"></div>
	<div class="left_content width760">
			<br>
			<div class="border_top"></div>
			<br>
			<div class="clear"></div>				
			<span class="default_text">{$careerData.career_page|trim}</span>
			{if $careerData.career_education neq ''}
				<span class="blue_text font_16">Education</span><br><br>
				<span class="default_text">{$careerData.career_education|trim}</span>
			{/if}	
			{if $careerData.career_contact neq ''}
				<span class="blue_text font_16">Contact</span><br><br>
				<span class="default_text">{$careerData.career_contact|trim}</span>
			{/if}	
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