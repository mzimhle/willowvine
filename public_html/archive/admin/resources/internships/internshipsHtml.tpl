<!-- Start Content Table -->
<div class="content_table">
    <form name="enquiriesForm" id="enquiriesForm" action="/admin/internships/internshipsHtml.php" method="post">
    
    <table id="grid_table" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <th>Added</th>
        <th>Title</th>
		<th>Section</th>
		<th>Area</th>
		<th>Active</th>
       </tr>
      {foreach from=$internshipItems item=internshipItem}
      <tr>
        <td>{$internshipItem.internship_added|date_format}</td>
        <td align="left"><a href="/admin/resources/internships/details.php?pk_internship_id={$internshipItem.pk_internship_id}">{$internshipItem.internship_title}</a></td>	
		<td align="left">{$internshipItem.section_name}</td>
		<td align="left">{$internshipItem.internship_area}</td>
		<td align="left">{if $internshipItem.internship_active eq 1}<span style="color: green;">Active</span>{else}<span style="color: red;">Not Active</span>{/if}</td>
      </tr>
      {foreachelse}
    	<tr>
        	<td colspan="9">There are no current Enquiries in the system.</td>
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