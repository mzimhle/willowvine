<!-- Start Content Table -->
<div class="content_table">
    <form name="enquiriesForm" id="enquiriesForm" action="/admin/propertys/propertysHtml.php" method="post">
    
    <table id="grid_table" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <th>Reference</th>
        <th>Address</th>
        <th>Price</th>
		<th>Term</th>
		<th>Area Path</th>
       </tr>
      {foreach from=$propertyItems item=propertyItem}
     
      <tr {if $propertyItem.property_active neq '1'}style="color: red;"{/if}>
        <td align="left">{$propertyItem.property_reference}</td>
		<td align="left"><a href="/admin/flats/seeff/details.php?propertyReference={$propertyItem.property_reference}">{$propertyItem.property_address}</a></td>
		<td align="left">R {$propertyItem.property_price}</td>
		<td align="left">{$propertyItem.property_rentalTerm}</td>
		<td align="left">({$propertyItem.areaMap_name}) - {$propertyItem.areaMap_path}</td>	
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