<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Willowvine - Previous Exam Papers for grade 12 students</title>
<meta name="keywords" content="South Africa, Exam, papers, previous year exam, grade 12, standard 10">
<meta name="description" content="Willowvine has a range of previous year exams for grade 12 students">          
<meta name="robots" content="index, follow">
<meta name="revisit-after" content="21 days">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta property="og:title" content="Willowvine"> 
<meta property="og:image" content="http://www.willowvine.co.za/images/logo.jpg"> 
<meta property="og:url" content="http://www.willowvine.co.za">
<meta property="og:site_name" content="Willowvine">
<meta property="og:type" content="website">
<meta property="og:description" content="Willowvine - Previous Exam Papers for grade 12 students">
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
					<form action="/exams/" method="POST" role="form" name="formExamFilter" id="formExamFilter">
					   <label>By Name:</label>
					   <input type="text" class="form-control" id="filter_exam_name" name="filter_exam_name" value="{$filters.filter_exam_name}" />
					   <div class="clearboth"></div>
					   <label>By Subject:</label>
					   <select class="form-control" id="filter_exam_subject" name="filter_exam_subject">
							<option value=""> --- </option>
							{html_options options=$subjectpairs selected=$filters.filter_exam_subject}
					   </select>					   
					   <div class="clearboth"></div>
					   <button onclick="submitExamFilter();" class="btn" name="btnExamFilter" id="btnExamFilter">Filter</button>
					</form>
				</div>
			</div>
			{include_php file='includes/ad_long_horizontal.php'}			
        </div>	
    	<div class="col-xs-12 col-md-5 db-gutter-right">
			<!-- /// TENDER BOX /// -->
			<div class="tenderbox eachbox">
				<p style="font-size: 14px !important;">There are <span class="redhighlight">{$paginator->totalItemCount}</span> exams in <span class="redhighlight">{$paginator->pageCount}</span> pages that have been found. {if isset($filters.filter_exam_name)}Searching for <i><span class="redhighlight">"{$filters.filter_exam_name}"</span></i>.{/if}{if isset($filters.exam_subject.subject_name)}Category being searched for is the <i><span class="redhighlight">"{$filters.exam_subject.subject_name}</span></i>.{/if}</p>
				{capture name="pagination"}				
				{if $paginator->firstPageInRange neq $paginator->lastPageInRange}
				<div class="pagibox">
					<ul class="pagination pagination-sm">
						{if $paginator->current gt 1 }
						  <li><a href="/exams/{$paginator->previous}"><span class="fa fa-chevron-left"></span></a></li>
						  {/if}
						  {foreach from=$paginator->pagesInRange item=page}
						  <li {if $page eq $paginator->current} class="active" {/if}><a href="/exams/{$page}">{$page}</a></li>
						  {/foreach}
						  {if $paginator->current lt $paginator->lastPageInRange}
						  <li><a href="/exams/{$paginator->next}"><span class="fa fa-chevron-right"></span></a></li>
						  {/if}
					</ul>
				</div>
				{/if}
				{/capture}
				{$smarty.capture.pagination|replace:'?&amp;':'?'}
				{foreach from=$examItems item=item name=foo}
				<dl class="cf {if $smarty.foreach.foo.index is even}dldark{else}dllight{/if}">
					<dt>{if isset($participantloginData)}<a href="/download/exam/{$item.exam_code}" target="blank">{$item.subject_name|lower|ucfirst} - {$item.exam_name} - ( download )</a>{else}<a data-target="#loginbox" data-toggle="modal" href="#">{$item.subject_name|lower|ucfirst} - {$item.exam_name} - ( download )</a>{/if}</dt>
					<dd><span class="bluehighlight">{$item.subject_name|lower|ucfirst}</span> exam in {$item.exam_language|lower|ucfirst}. Exam date was in {$item.exam_date|date_format:"%B, %Y"}.</dd>
					<dd class="iconbox">
						<span class="minicons pdate" data-toggle="tooltip" title="Date Exam">{$item.exam_date|date_format:"%B, %Y"}</span>						
						<span class="fl" data-toggle="tooltip" title="Facebook Share">
							<a href='javascript:void(0);' onclick="openWindow_fb_share('http://www.facebook.com/share.php?u=http://www.willowvine.co.za/exams/');" title="Share this exam on facebook: {$item.subject_name|lower|ucfirst} - {$item.exam_name} - ( download )">
							<img src="/images/facebook_share_up.png" title="Share this exam on facebook: {$item.subject_name|lower|ucfirst} - {$item.exam_name} - ( download )" />
							</a>							
						</span>
						<span class="fl" style="margin-left: 5px;" data-toggle="tooltip" title="Twitter Share">
							<a href="https://twitter.com/share" class="twitter-share-button" data-text="@willowvine exam - {$item.subject_name|lower|ucfirst} - {$item.exam_name} - ( download )" data-related="willowvine" data-count="none">Twitter Share</a>
							{literal}
							<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
							{/literal}
						</span>
						<span class="fl" style="margin-left: 5px;" data-toggle="tooltip" title="Email to my friend">
							<a data-related="willowvine" data-count="none" class="small_blue_bg_dark_btn fl" title="Share exam with a friend" alt="Share exam with a friend" href='#' onclick="showExamShare('{$item.subject_name|lower|ucfirst} - {$item.exam_name} - ( download )', '{$item.exam_code}'); return false;">
								<span id="share_exam">Share with a friend</span>								
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