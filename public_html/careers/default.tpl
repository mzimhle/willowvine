<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Willowvine - Career list</title>
<meta name="keywords" content="list careers, job, career path">
<meta name="description" content="Willowvine has a list of careers to read up on and learn about.">          
<meta name="robots" content="index, follow">
<meta name="revisit-after" content="21 days">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta property="og:title" content="Willowvine"> 
<meta property="og:image" content="http://www.willowvine.co.za/images/logo.jpg"> 
<meta property="og:url" content="http://www.willowvine.co.za">
<meta property="og:site_name" content="Willowvine">
<meta property="og:type" content="website">
<meta property="og:description" content="Willowvine has a list of careers to read up on and learn about">
<link rel="icon" type="image/x-icon" href="favicon.ico" />
{include_php file='includes/css.php'}
</head>
<body>
{include_php file='includes/header.php'}
{include_php file='includes/menu.php'}
<section class="container">
	<div class="row">
    	<div class="col-xs-12 col-md-3">
			<div class="newsbox eachbox rightdarkborder">
				<div class="titles stitle">
					<h2>Filter</h2>
				</div>
				<div class="bigform bisform">
					<form action="/careers/" method="POST" role="form" name="formCareerFilter" id="formCareerFilter">
					   <label>By Title:</label>
					   <input type="text" class="form-control" id="filter_career_name" name="filter_career_name" value="{$filters.filter_career_name}" />
					   <div class="clearboth"></div>
					   <label>By Category:</label>
					   <select class="form-control" id="filter_career_category" name="filter_career_category">
							<option value=""> --- </option>
							{html_options options=$categorypairs selected=$filters.filter_career_category}
					   </select>					   
					   <div class="clearboth"></div>
					   <button onclick="submitCareerFilter();" class="btn" name="btnCareerFilter" id="btnCareerFilter">Filter</button>
					</form>
				</div>
			</div>
			{include_php file='includes/ad_long_horizontal.php'}			
        </div>	
    	<div class="col-xs-12 col-md-5 db-gutter-right">
			<!-- /// TENDER BOX /// -->
			<div class="tenderbox eachbox">
				<p style="font-size: 14px !important;">There are <span class="redhighlight">{$paginator->totalItemCount}</span> careers in <span class="redhighlight">{$paginator->pageCount}</span> pages that have been found. {if isset($filters.filter_career_name)}Searching for <i><span class="redhighlight">"{$filters.filter_career_name}"</span></i>.{/if}{if isset($filters.career_category.category_name)}Category being searched for is the <i><span class="redhighlight">"{$filters.career_category.category_name}</span></i>.{/if}</p>
				{capture name="pagination"}				
				{if $paginator->firstPageInRange neq $paginator->lastPageInRange}
				<div class="pagibox">
					<ul class="pagination pagination-sm">
						{if $paginator->current gt 1 }
						  <li><a href="/careers/{$paginator->previous}"><span class="fa fa-chevron-left"></span></a></li>
						  {/if}
						  {foreach from=$paginator->pagesInRange item=page}
						  <li {if $page eq $paginator->current} class="active" {/if}><a href="/careers/{$page}">{$page}</a></li>
						  {/foreach}
						  {if $paginator->current lt $paginator->lastPageInRange}
						  <li><a href="/careers/{$paginator->next}"><span class="fa fa-chevron-right"></span></a></li>
						  {/if}
					</ul>
				</div>
				{/if}
				{/capture}
				{$smarty.capture.pagination|replace:'?&amp;':'?'}
				{foreach from=$careerItems item=item name=foo}
				<dl class="cf {if $smarty.foreach.foo.index is even}dldark{else}dllight{/if}">
					<dt><a href="/career/{$item.career_url}/{$item.career_code}">{$item.career_name}</a></dt>
					<dd>{$item.career_page|normal_text|strip_tags|truncate:300}</dd>
					<dd><span class="bluehighlight">{$item.career_company}</span></dd>
					<dd><b>{$item.category_name}</b></dd>
					<dd class="iconbox">
						<span class="minicons pdate" data-toggle="tooltip" title="Date Added">{$item.career_added|date_format}</span>						
						<span class="fl" data-toggle="tooltip" title="Facebook Share">
							<a href='javascript:void(0);' onclick="openWindow_fb_share('http://www.facebook.com/share.php?u=http://www.willowvine.co.za/career/{$item.career_url}/{$item.career_code}');" title="Share this career on facebook: {$item.career_name|normal_text} by {$item.career_company}">
							<img src="/images/facebook_share_up.png" title="Share this tender on facebook: {$item.career_name|normal_text}" />
							</a>							
						</span>
						<span class="fl" style="margin-left: 5px;" data-toggle="tooltip" title="Twitter Share">
							<a href="https://twitter.com/share" class="twitter-share-button" data-text="@willowvine career - {$item.career_name|normal_text} by {$item.career_company}" data-related="willowvine" data-count="none">Twitter Share</a>
							{literal}
							<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
							{/literal}
						</span>
						<span class="fl" style="margin-left: 5px;" data-toggle="tooltip" title="Email to my friend">
							<a data-related="willowvine" data-count="none" class="small_blue_bg_dark_btn fl" title="Share career with a friend" alt="Share career with a friend" href='#' onclick="showCareerShare('{$item.career_name|normal_text}', '{$item.career_code}'); return false;">
								<span id="share_career">Share with a friend</span>								
							</a>
						</span>										
					</dd>					
				</dl>
				{/foreach}
			</div>
			<div class="clearboth"></div>
			{$smarty.capture.pagination}
		</div>
        <div class="col-xs-12 col-md-4 no-gutter-left">	
			{include_php file='includes/register.php'}	
        </div>	
    </div>
</section>
{include_php file='includes/footer.php'}
</body>
</html>