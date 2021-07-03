<table width="100%" border="0" cellspacing="0" cellpadding="0">
  {foreach from=$jobAppliedItems item=item name=foo}
	<tr>			  
		<td style="font-size: 12px; border-bottom: 1px solid #E9E6E0;padding: 5px;">{$item.jobApplication_added|date_format}, {$item.job_title} in {$item.job_area}</td>		
	 </tr>
	{foreachelse}
	<tr>
		<td width="auto" style="color: red; border-bottom: 1px solid #E9E6E0;padding: 5px;">	
			You do not have any jobs you recently applied to.
		</td>
	</tr>
	{/foreach}	
	<tr>
		<td style="font-size: 10px; border-bottom: 1px solid #E9E6E0;padding: 5px;">
		<div class="clear"></div>
		<p class="pagination fr">
			{if $paginator->current gt 1}
				<a class="prev-page" href="Javascript:fetchApplied({$paginator->previous})">Previous</a>
			{/if}	
				{foreach from=$paginator->pagesInRange item=page}
				{if $page neq $paginator->current}		
				<a class="page-num" href="Javascript:fetchApplied({$page})">{$page}</a>
				{else}
				<strong class="current-page">{$page}</strong>
				{/if}
			{/foreach}
			{if $paginator->current lt $paginator->lastPageInRange}
				<a class="next-page" href="Javascript:fetchApplied({$paginator->next})">Next</a>
			{/if}	
		</p>	
		</td>
	</tr>
</table>