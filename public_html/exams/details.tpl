<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Business Lounge - Company Name Here</title>
<meta name="keywords" content="business, tenders, business listings, entrepreneurs, exams">
<meta name="description" content="Business Lounge - Jobs - {$examData.exam_title}">          
<meta name="robots" content="index, follow">
<meta name="revisit-after" content="21 days">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta property="og:title" content="Business Lounge"> 
<meta property="og:image" content="http://www.bizlounge.co.za/images/logo.png"> 
<meta property="og:url" content="http://www.bizlounge.co.za">
<meta property="og:site_name" content="Business Lounge">
<meta property="og:type" content="website">
<meta property="og:description" content="Business Lounge - Jobs - {$examData.exam_title}">
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
					<h1>{$examData.exam_name}</h1>
				</div>
					<div class="clearboth"></div>
					<dd class="iconbox">
						<span class="fl redhighlight" style="margin-right: 5px;" data-toggle="tooltip" title="Category">{$examData.category_name}</span>
						<span class="fl" data-toggle="tooltip" title="Facebook Share">
							<a href='javascript:void(0);' onclick="openWindow_fb_share('http://www.facebook.com/share.php?u=http://www.willowvine.co.za/exam/{$examData.exam_url}/{$examData.exam_code}');" title="Share this exam on facebook: {$examData.exam_name|normal_text} by {$examData.exam_company}">
							<img src="/images/facebook_share_up.png" title="Share this tender on facebook: {$examData.exam_name|normal_text}" />
							</a>							
						</span>
						<span class="fl" style="margin-left: 5px;" data-toggle="tooltip" title="Twitter Share">
							<a href="https://twitter.com/share" class="twitter-share-button" data-text="@willowvine exam - {$examData.exam_name|normal_text} by {$examData.exam_company}" data-related="willowvine" data-count="none">Twitter Share</a>
							{literal}
							<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
							{/literal}
						</span>
						<span class="fl" style="margin-left: 5px;" data-toggle="tooltip" title="Email to my friend">
							<a data-related="willowvine" data-count="none" class="small_blue_bg_dark_btn fl" title="Share exam with a friend" alt="Share exam with a friend" href='#' onclick="showInternShare('{$examData.exam_name|normal_text} by {$examData.exam_company}', '{$examData.exam_code}'); return false;">
								<span id="share_exam">Share with a friend</span>								
							</a>
						</span>										
					</dd>	
				<div class="clearboth"></div>					
				<div class="catlist infolist cf">
					<ul>
						{if $examData.exam_company neq ''}<li><em>Company:</em> {$examData.exam_company}</li>{/if}
						{if $examData.exam_contact_name neq ''}<li><em>Contact Person:</em> {$examData.exam_contact_name|default:"N/A"}</li>{/if}
						{if $examData.exam_contact_email neq ''}<li><em>Contact Email:</em> {$examData.exam_contact_email|default:"N/A"}</li>{/if}
						{if $examData.exam_contact_number neq ''}<li><em>Contact Number:</em> {$examData.exam_contact_number|default:"N/A"}</li>{/if}
						{if $examData.exam_date_opening neq ''}<li><em>Opening of Applications Date:</em> {$examData.exam_date_opening|date_format}</li>{/if}
						{if $examData.exam_date_closing neq ''}<li><em>Closing of Applications Date:</em> {$examData.exam_date_closing|date_format}</li>{/if}
						{if $examData.exam_area neq ''}<li><em>Areas affected:</em> {$examData.exam_area|date_format}</li>{/if}
					</ul>
				</div>
			</div>		
        	<!-- /// LISTINGS BOX /// -->
			<div class="tenderboxe eachbox">
				{$examData.exam_page}
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