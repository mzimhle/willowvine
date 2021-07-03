<!-- Start Content Table -->
<div class="content_table">
    <form name="enquiriesForm" id="enquiriesForm" action="/admin/sections/sectionsHtml.php" method="post">
    
    <table id="grid_table" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <th>Added</th>
        <th>Name</th>
        <th>Email</th>
		<th>Type</th>		
		<th>Last sent</th>
		<th>Sent token</th>
       </tr>
      {foreach from=$emailItems item=emailItem}
     
      <tr>
        <td align="left">{$emailItem.email_added}</td>
		<td align="left"><a href="/admin/resources/emails/details.php?emailId={$emailItem.pk_email_id}">{$emailItem.email_name}</a></td>
		<td align="left">{$emailItem.email_email}</td>
		<td align="left">{$emailItem.email_type}</td>
		<td align="left">{$emailItem.email_sentDate}</td>
        <td align="left">{if $emailItem.email_sent eq '1'}<span style="color: green">Sent</span>{else}<span style="color: red">Not Sent</span>{/if}</td>		
       </tr>
      {foreachelse}
    	<tr>
        	<td colspan="9">There are no current Emails in the system. </td>
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