<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>{$jobData.job_title}</title>
<meta name="keywords" content="jobs, careers, exam papers, career advise. south african jobs, part time">
<meta name="description" content="Willowvine offers job opportunities to students like {$jobData.job_title}.">       
<meta name="robots" content="index, follow">
<meta name="revisit-after" content="21 days">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta property="og:title" content="Willowvine"> 
<meta property="og:image" content="http://www.willowvine.co.za/images/logo.jpg"> 
<meta property="og:url" content="http://www.willowvine.co.za">
<meta property="og:site_name" content="Willowvine">
<meta property="og:type" content="website">
<meta property="og:description" content="Willowvine - {$jobData.job_title}">
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
					<h1>{$jobData.job_title}</h1>
				</div>
				<div class="clearboth"></div>	
					<dd class="iconbox">				
						<span class="fl" data-toggle="tooltip" title="Facebook Share">
							<a href='javascript:void(0);' onclick="openWindow_fb_share('http://www.facebook.com/share.php?u=http://www.willowvine.co.za/job/{$jobData.job_url}/{$jobData.job_code}');" title="Share this job on facebook: {$jobData.job_title|normal_text}">
							<img src="/images/facebook_share_up.png" title="Share this tender on facebook: {$jobData.job_title|normal_text}" />
							</a>							
						</span>
						<span class="fl" style="margin-left: 5px;" data-toggle="tooltip" title="Twitter Share">
							<a href="https://twitter.com/share" class="twitter-share-button" data-text="@willowvine job - {$jobData.job_title|normal_text}" data-related="willowvine" data-count="none">Twitter Share</a>
							{literal}
							<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
							{/literal}
						</span>
						<span class="fl" style="margin-left: 5px;" data-toggle="tooltip" title="Email to my friend">
						<a data-related="willowvine" data-count="none" class="small_blue_bg_dark_btn fl" title="Share job with a friend" alt="Share job with a friend" href='#' onclick="showShare('{$jobData.job_title|normal_text} in {$jobData.areapost_name|trim}', '{$jobData.job_code}'); return false;">
							<span id="share_job">Share with a friend</span>								
						</a>
						</span>						
						<span class="fl{if in_array($jobData.job_code, $shortlist)} hide{/if}" style="margin-left: 5px;" data-toggle="tooltip" title="Add to my shortlist" id="shortjob_{$jobData.job_code}">
							<a data-related="willowvine" data-count="none" class="small_blue_bg_dark_btn fl" title="Shortlist job" alt="Shortlist job" href='#' onclick="shortlistJob('{$jobData.job_code}', '{$jobData.job_title}', '/job/{$jobData.job_url}/{$jobData.job_code}'); return false;">
								<span id="share_job">Shortlist</span>								
							</a>
						</span>											
					</dd>												
					<div class="clearboth"></div>				
				<div class="catlist infolist cf">
					<ul>
						<li><em>Industry:</em> {$jobData.category_name}</li>
						<li><em>Position Type:</em> {$jobData.job_type|capitalize}</li>
						<li><em>City:</em> {$jobData.job_area}</li>
						<li><em>Date Posted:</em> {$jobData.job_added|date_format}</li>
					</ul>
				</div>
			</div>		
        	<!-- /// LISTINGS BOX /// -->
			<div class="tenderboxe eachbox">			
				{$jobData.job_page}
				{if $jobData.job_latitude neq ''}
				<p class="bissubhead">Job Location</p><!-- //// FOR FEATURED BUSINESS LISTINGS ONLY /// -->					
				<div class="bismap eachbox">
					<img src="https://maps.googleapis.com/maps/api/staticmap?center={$jobData.job_latitude},{$jobData.job_longitude}&zoom=11&size=745x250" width="745" height="250" alt="{$jobData.areapost_name}" />
				</div>
				{/if}
            </div>
        </div>
        <div class="col-xs-12 col-md-4 no-gutter-left">		
			<div class="tenderbox eachbox rightdarkborder">
				<div class="titles">
					<h1>Job Short list</h1>
				</div>
				<div class="infolist cf">
					<ul class="remove_pad_style" id="shortlist_ul">
						{foreach from=$shortlistdata item=item name=fooshort}
							<li id="short_{$item.job_code}">
								<a href="#" onclick="removeShortlistjob('{$item.job_code}'); return false;" alt="Remove job" title="Remove job"><span class="fa fa-cog"></span></a>
								<a href="/job/{$item.job_url}/{$item.job_code}" alt="Shortlisted job - {$item.job_title}" title="Shortlisted job - {$item.job_title}">{$item.job_title}</a>
							</li>
						{foreachelse}
						<span class="redhighlight">There are currently no shortlisted jobs.</span>
						{/foreach}
					</ul>										
				</div>				
			</div>
            <div class="newsbox eachbox no-gutter-left">
                <div class="titles stitle">
                    <h2>Send Application</h2>
                </div>
                <div class="bigform bisform">
					{if isset($success)}
						<p><b>Your enquiry has been successfully sent</b></p>
						<p>You will receive an email confirmation for it as well as your reference code for this enquiry</p>
					{else}				
                    <form id="bismsg" name="bismsg" role="form" method="POST" action="/job/{$jobData.job_url}/{$jobData.job_code}" enctype="multipart/form-data">
                       <label>Full Name:</label>
                       <input type="text" name="enquiry_name" id="enquiry_name" class="form-control" value="" />
                       <label>Your Email:</label>
                       <input type="text" name="enquiry_email" id="enquiry_email" class="form-control" value="" />			   
                       <label>Your Message:</label>
                       <textarea cols="5" name="enquiry_message" id="enquiry_message" class="form-control"></textarea>
                       <label>Your CV:</label>
                       <input type="file" name="cvdocument" id="cvdocument" /><br />		   
                       <button class="btn" onclick="submitApplicationForm();">Send Application</button>
					   {if isset($errorArray)}<br />{$errorArray}{/if}
                    </form>
					{/if}
                </div><br /><br />
                <div>
                {literal}
                    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                    <!-- vine-right-bar-01 -->
                    <ins class="adsbygoogle"
                         style="display:block"
                         data-ad-client="ca-pub-3167387384914043"
                         data-ad-slot="7295705524"
                         data-ad-format="auto"></ins>
                    <script>
                    (adsbygoogle = window.adsbygoogle || []).push({});
                    </script>
                {/literal}
                </div>
            </div>
        </div>	
    </div>
</section>
{include_php file='includes/footer.php'}
{literal}
<script type="text/javascript">
function submitApplicationForm() {
	document.forms.bismsg.submit();
}
</script>
{/literal}
</body>
</html>