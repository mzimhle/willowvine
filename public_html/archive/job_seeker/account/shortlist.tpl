<table width="100%" border="0" cellspacing="0" cellpadding="0">
  {foreach from=$shortListeItems item=item name=foo}
	<tr>			  
		<td style="font-size: 12px; border-bottom: 1px solid #E9E6E0;">
			<a href="/jobs/search/{$item.section_urlName}/details/{$item.job_link}/{$item.job_reference}/">
				{$item.job_title} in {$item.job_area}			
			</a>
			<br><br>
			<a href="Javascript:shortListRemove({$item.job_reference});" alt="Share job or career with a friend" title="Share job or career with a friend" class="small_blue_bg_dark_btn fr">
				<span id="share_job">Remove from shortlist</span>								
			</a></td>		
	 </tr>
	{foreachelse}
	<tr>
		<td width="auto" style="color: red; border-bottom: 1px solid #E9E6E0;padding: 5px;">	
			You do not have any shortlisted jobs.
		</td>
	</tr>
	{/foreach}	
	<tr>
		<td style="font-size: 10px; border-bottom: 1px solid #E9E6E0;padding: 5px;">
		<div class="clear"></div>
		<p class="pagination fr">
			{if $paginator->current gt 1}
				<a class="prev-page" href="Javascript:fetchShortList({$paginator->previous})">Previous</a>
			{/if}	
				{foreach from=$paginator->pagesInRange item=page}
				{if $page neq $paginator->current}		
				<a class="page-num" href="Javascript:fetchShortList({$page})">{$page}</a>
				{else}
				<strong class="current-page">{$page}</strong>
				{/if}
			{/foreach}
			{if $paginator->current lt $paginator->lastPageInRange}
				<a class="next-page" href="Javascript:fetchShortList({$paginator->next})">Next</a>
			{/if}	
		</p>	
		</td>
	</tr>
</table>