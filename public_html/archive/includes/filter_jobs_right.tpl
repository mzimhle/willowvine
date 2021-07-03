<div class="job_filter">
<form id="job_filterFrm" name="job_filterFrm" method="POST" action="{$currentLink|default:"/"}">
<h1>Search Results ({$paginator->totalItemCount|default:"0"})</h1>
<p></p>
{if isset($jobByTypeData)}
<h2><a href="/jobs/search/{if $searchJob neq ''}?searchJob={$searchJob}{/if}">Type</a></h2>
<ul>
	{foreach from=$jobByTypeData item=job}
	<li><a href="/jobs/search/?type={$job.job_area_link}{$job.job_type}{if $searchJob neq ''}&searchJob={$searchJob}{/if}{if $area neq ''}&area={$area}{/if}">{$job.job_type} ({$job.job_count})</a></li>
	{/foreach}
</ul>
<div class="spacer"></div>
{/if}
{if isset($jobByAreaData)}
<h2><a href="/jobs/search/{if $searchJob neq ''}?searchJob={$searchJob}{/if}">{$location|default:'South Africa'}</a></h2>
<ul>
	{foreach from=$jobByAreaData item=job}
	<li><a href="/jobs/search/?area={$job.job_area_link}{if $searchJob neq ''}&searchJob={$searchJob}{/if}{if $type neq ''}&type={$type}{/if}">{$job.job_area} ({$job.job_count})</a></li>
	{/foreach}
</ul>
<div class="spacer"></div>
{/if}
</form>
</div>	
<div class="clear"></div>