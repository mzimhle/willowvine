<!-- Start Content Table -->
<div class="content_table">
    <form name="enquiriesForm" id="enquiriesForm" action="/admin/internships/internshipsHtml.php" method="post">
    
    <table id="grid_table" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <th>Added</th>
        <th>Internship Title</th>
		<th>Sender name</th>
		<th>Receiver name</th>
		<th>Area</th>
       </tr>
      {foreach from=$internshipShareItems item=item}
      <tr>
        <td>{$item.internshipShare_added|date_format}</td>
        <td align="left"><a href="http://www.willowvine.co.za/internships/{$item.section_urlName}/details/{$item.internship_link}/{$item.pk_internship_id}/" target="_blank">{$item.internship_title}</a></td>	
		<td align="left">{$item.internshipShare_name} ({$item.internshipShare_email})</td>
		<td align="left">{$item.internshipShare_friendName} ({$item.internshipShare_friendEmail})</td>
		<td align="left">{$item.internship_area}</td>		
      </tr>
      {foreachelse}
    	<tr>
        	<td colspan="9">There are no current Internships in the system.</td>
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