<!-- Start Content Table -->
<div class="content_table">
    <form name="enquiriesForm" id="enquiriesForm" action="/admin/resources/areas/areasHtml.php" method="post">
    
    <table id="grid_table" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <th>Added</th>
        <th>Name</th>
        <th>Parent Area</th>
		<th>Area Type</th>
		<th>Activity</th>
       </tr>
      {foreach from=$areaItems item=areaItem}
      <tr>
        <td>{$areaItem.areaMap_added|date_format}</td>
        <td align="left"><a href="/admin/resources/areas/details.php?fkAreaId={$areaItem.fkAreaId}">{$areaItem.areaMap_name}</a></td>
        <td align="left">{$areaMapPairs[$areaItem.fkAreaParentId]}</td>
		<td align="left">{$areaTypePairs[$areaItem.fkAreaTypeId]}</td>
		<td align="left">{if $areaItem.areaMap_active eq 1}<span style="color: green;">Active</span>{else}<span style="color: red;">In-Active</span>{/if}</td>
       </tr>
      {foreachelse}
    	<tr>
        	<td colspan="9">There are no current Areas in the system. </td>
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