<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Willowvine - {$careerData.career_name}</title>
<meta name="keywords" content="list careers, job, career path">
<meta name="description" content="Willowvine has a list of careers to read up on and learn about like {$careerData.career_name}">          
<meta name="robots" content="index, follow">
<meta name="revisit-after" content="21 days">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta property="og:title" content="Willowvine"> 
<meta property="og:image" content="http://www.willowvine.co.za/images/logo.jpg"> 
<meta property="og:url" content="http://www.willowvine.co.za">
<meta property="og:site_name" content="Willowvine">
<meta property="og:type" content="website">
<meta property="og:description" content="Willowvine - {$careerData.career_name}">
<link rel="icon" type="image/x-icon" href="favicon.ico" />
{include_php file='includes/css.php'}
</head>
<body>
{include_php file='includes/header.php'}
{include_php file='includes/menu.php'}
<section class="container">
	<div class="row">
    	<div class="col-xs-12 col-md-8 db-gutter-right">
			<div class="newsbox eachbox no-gutter-left">
				<div class="titles htitle">
					<h1>{$careerData.career_name}</h1>
				</div>				
			</div>		
        	<!-- /// LISTINGS BOX /// -->
			<div class="tenderboxe eachbox">
					<dd class="iconbox">
						<span class="fl redhighlight " style="margin-right: 5px;"  data-toggle="tooltip" title="Career Category">{$careerData.category_name}</span>						
						<span class="fl" data-toggle="tooltip" title="Facebook Share">
							<a href='javascript:void(0);' onclick="openWindow_fb_share('http://www.facebook.com/share.php?u=http://www.willowvine.co.za/career/{$careerData.career_url}/{$careerData.career_code}');" title="Share this career on facebook: {$careerData.career_name|normal_text} by {$careerData.career_company}">
							<img src="/images/facebook_share_up.png" title="Share this tender on facebook: {$careerData.career_name|normal_text}" />
							</a>							
						</span>
						<span class="fl" style="margin-left: 5px;" data-toggle="tooltip" title="Twitter Share">
							<a href="https://twitter.com/share" class="twitter-share-button" data-text="@willowvine career - {$careerData.career_name|normal_text} by {$careerData.career_company}" data-related="willowvine" data-count="none">Twitter Share</a>
							{literal}
							<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
							{/literal}
						</span>
						<span class="fl" style="margin-left: 5px;" data-toggle="tooltip" title="Email to my friend">
							<a data-related="willowvine" data-count="none" class="small_blue_bg_dark_btn fl" title="Share career with a friend" alt="Share career with a friend" href='#' onclick="showCareerShare('{$careerData.career_name|normal_text}', '{$careerData.career_code}'); return false;">
								<span id="share_career">Share with a friend</span>								
							</a>
						</span>										
					</dd>												
					<div class="clearboth"></div>		
				{$careerData.career_page}
				<div class="clearboth"></div>
				<p class="bissubhead">Education</p>
				{$careerData.career_education}				
				<div class="clearboth"></div>
				<p class="bissubhead">Contact for assistance</p>
				{$careerData.career_contact}						
            </div>

        </div>
        <div class="col-xs-12 col-md-4 no-gutter-left">		
			{include_php file='includes/register.php'}
        </div>	
    </div>
</section>
{include_php file='includes/footer.php'}
</body>
</html>