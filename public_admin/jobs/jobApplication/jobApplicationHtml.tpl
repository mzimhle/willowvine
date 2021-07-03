<!-- Start Content Table -->
<div class="content_table">
    <form name="enquiriesForm" id="enquiriesForm" action="/admin/jobApplications/jobApplicationsHtml.php" method="post">
    
    <table id="grid_table" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <th>Added</th>
        <th>Name</th>
        <th>Job Title</th>
         <th>Applicant Email</th>
		 <th>Job Email</th>
		<th>Job Status</th>
       </tr>
      {foreach from=$jobApplicationItems item=item}
     
      <tr>
        <td>{$item.jobApplication_added|date_format}</td>
        <td align="left"><a href="/admin/jobs/jobApplication/details.php?id={$item.pk_jobApplication_id}" class="view_icon">{$item.jobApplication_name}</a></td>
        <td align="left">{$item.job_title}</td>
		<td align="left">{$item.jobApplication_email}</td>
        <td align="left">{$item.job_poster_email}</td>
		<td align="left">{if $item.job_active eq 1}<span style="color: green;">Active</span>{else}<span style="color: red;">Not Active</span>{/if}</td>
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