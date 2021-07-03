<!-- Start Content Table -->
<div class="content_table">
    <form name="enquiriesForm" id="enquiriesForm" action="/admin/sections/sectionsHtml.php" method="post">
    
    <table id="grid_table" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <th>Section Name</th>
        <th>Query</th>
        <th>Page</th>
		<th>Location</th>
		<th>Get Jobs</th>
       </tr>
      {foreach from=$sectionItems item=sectionItem}
     
      <tr>
        <td align="left">{$sectionItem.section_name}</td>
        <td align="left"><input type="text" size="10" id="query_{$sectionItem.pk_section_id}" name="query_{$sectionItem.pk_section_id}" /></td>		
		<td align="left"><input type="text" size="3" id="page_{$sectionItem.pk_section_id}" name="page_{$sectionItem.pk_section_id}" /></td>
		<td align="left"><input type="text" size="10" id="location_{$sectionItem.pk_section_id}" name="location_{$sectionItem.pk_section_id}" /></td>
        <td><a class="button" href="javascript: getIndeedJobs({$sectionItem.pk_section_id});"><span>Get</span></a></td>
       </tr>
      {foreachelse}
    	<tr>
        	<td colspan="9">There are no current Enquiries in the system. </td>
        </tr>
      {/foreach}
     
    </table>
     </form>
 </div>
 <!-- End Content Table -->

{if $paginator->firstPageInRange neq $paginator->lastPageInRange}
 <!-- Start Pagination -->
<div class="paging">
	
     <ul class="pagination">
		  
		   {if $paginator->current gt 1 }
			<li class="paginate_prev"><a href="javascript:void(0);" onclick="send_filter({$paginator->previous});">&laquo; Previous</a></li>
			{/if}
			
			 {foreach from=$paginator->pagesInRange item=page}
        		<li {if $page eq $paginator->current} class="active" {/if}><a href="javascript:void(0);" onclick="send_filter({$page});">{$page}</a></li>
       		{/foreach}
			
			{if $paginator->current lt $paginator->lastPageInRange}
			<li class="paginate_next"><a href="javascript:void(0);" onclick="send_filter({$paginator->next});">Next &raquo;</a></li>
			{/if}
			
	</ul>
    
</div>      
{/if}
<div class="clear"></div>