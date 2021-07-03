<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Willowvine - {$internshipData.internship_name}</title>
<meta name="keywords" content="{$internshipData.internship_name}">
<meta name="description" content="Willowvine has a range of internships and bursaries that students can apply for. {$internshipData.internship_name}">          
<meta name="robots" content="index, follow">
<meta name="revisit-after" content="21 days">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta property="og:title" content="Willowvine"> 
<meta property="og:image" content="http://www.willowvine.co.za/images/logo.jpg"> 
<meta property="og:url" content="http://www.willowvine.co.za">
<meta property="og:site_name" content="Willowvine">
<meta property="og:type" content="website">
<meta property="og:description" content="Willowvine - {$internshipData.internship_name}">
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
					<h1>{$internshipData.internship_name}</h1>
				</div>
					<div class="clearboth"></div>
					<dd class="iconbox">
						<span class="fl redhighlight" style="margin-right: 5px;" data-toggle="tooltip" title="Category">{$internshipData.category_name}</span>						
						<span class="fl" data-toggle="tooltip" title="Facebook Share">
							<a href='javascript:void(0);' onclick="openWindow_fb_share('http://www.facebook.com/share.php?u=http://www.willowvine.co.za/internship/{$internshipData.internship_url}/{$internshipData.internship_code}');" title="Share this internship on facebook: {$internshipData.internship_name|normal_text} by {$internshipData.internship_company}">
							<img src="/images/facebook_share_up.png" title="Share this tender on facebook: {$internshipData.internship_name|normal_text}" />
							</a>							
						</span>
						<span class="fl" style="margin-left: 5px;" data-toggle="tooltip" title="Twitter Share">
							<a href="https://twitter.com/share" class="twitter-share-button" data-text="@willowvine internship - {$internshipData.internship_name|normal_text} by {$internshipData.internship_company}" data-related="willowvine" data-count="none">Twitter Share</a>
							{literal}
							<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
							{/literal}
						</span>
						<span class="fl" style="margin-left: 5px;" data-toggle="tooltip" title="Email to my friend">
							<a data-related="willowvine" data-count="none" class="small_blue_bg_dark_btn fl" title="Share internship with a friend" alt="Share internship with a friend" href='#' onclick="showInternShare('{$internshipData.internship_name|normal_text} by {$internshipData.internship_company}', '{$internshipData.internship_code}'); return false;">
								<span id="share_internship">Share with a friend</span>								
							</a>
						</span>										
					</dd>	
				<div class="clearboth"></div>					
				<div class="catlist infolist cf">
					<ul>
						{if $internshipData.internship_company neq ''}<li><em>Company:</em> {$internshipData.internship_company}</li>{/if}
						{if $internshipData.internship_contact_name neq ''}<li><em>Contact Person:</em> {$internshipData.internship_contact_name|default:"N/A"}</li>{/if}
						{if $internshipData.internship_contact_email neq ''}<li><em>Contact Email:</em> {$internshipData.internship_contact_email|default:"N/A"}</li>{/if}
						{if $internshipData.internship_contact_number neq ''}<li><em>Contact Number:</em> {$internshipData.internship_contact_number|default:"N/A"}</li>{/if}
						{if $internshipData.internship_date_opening neq ''}<li><em>Opening of Applications Date:</em> {$internshipData.internship_date_opening|date_format}</li>{/if}
						{if $internshipData.internship_date_closing neq ''}<li><em>Closing of Applications Date:</em> {$internshipData.internship_date_closing|date_format}</li>{/if}
						{if $internshipData.internship_area neq ''}<li><em>Areas affected:</em> {$internshipData.internship_area|date_format}</li>{/if}
					</ul>
				</div>
			</div>		
        	<!-- /// LISTINGS BOX /// -->
			<div class="tenderboxe eachbox">
				{$internshipData.internship_page}
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