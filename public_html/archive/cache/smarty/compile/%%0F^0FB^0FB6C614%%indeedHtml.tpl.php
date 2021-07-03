<?php /* Smarty version 2.6.20, created on 2014-12-17 19:26:20
         compiled from admin/jobs/scrape/indeed/indeedHtml.tpl */ ?>
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
      <?php $_from = $this->_tpl_vars['sectionItems']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['sectionItem']):
?>
     
      <tr>
        <td align="left"><?php echo $this->_tpl_vars['sectionItem']['section_name']; ?>
</td>
        <td align="left"><input type="text" size="10" id="query_<?php echo $this->_tpl_vars['sectionItem']['pk_section_id']; ?>
" name="query_<?php echo $this->_tpl_vars['sectionItem']['pk_section_id']; ?>
" /></td>		
		<td align="left"><input type="text" size="3" id="page_<?php echo $this->_tpl_vars['sectionItem']['pk_section_id']; ?>
" name="page_<?php echo $this->_tpl_vars['sectionItem']['pk_section_id']; ?>
" /></td>
		<td align="left"><input type="text" size="10" id="location_<?php echo $this->_tpl_vars['sectionItem']['pk_section_id']; ?>
" name="location_<?php echo $this->_tpl_vars['sectionItem']['pk_section_id']; ?>
" /></td>
        <td><a class="button" href="javascript: getIndeedJobs(<?php echo $this->_tpl_vars['sectionItem']['pk_section_id']; ?>
);"><span>Get</span></a></td>
       </tr>
      <?php endforeach; else: ?>
    	<tr>
        	<td colspan="9">There are no current Enquiries in the system. </td>
        </tr>
      <?php endif; unset($_from); ?>
     
    </table>
     </form>
 </div>
 <!-- End Content Table -->

<?php if ($this->_tpl_vars['paginator']->firstPageInRange != $this->_tpl_vars['paginator']->lastPageInRange): ?>
 <!-- Start Pagination -->
<div class="paging">
	
     <ul class="pagination">
		  
		   <?php if ($this->_tpl_vars['paginator']->current > 1): ?>
			<li class="paginate_prev"><a href="javascript:void(0);" onclick="send_filter(<?php echo $this->_tpl_vars['paginator']->previous; ?>
);">&laquo; Previous</a></li>
			<?php endif; ?>
			
			 <?php $_from = $this->_tpl_vars['paginator']->pagesInRange; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['page']):
?>
        		<li <?php if ($this->_tpl_vars['page'] == $this->_tpl_vars['paginator']->current): ?> class="active" <?php endif; ?>><a href="javascript:void(0);" onclick="send_filter(<?php echo $this->_tpl_vars['page']; ?>
);"><?php echo $this->_tpl_vars['page']; ?>
</a></li>
       		<?php endforeach; endif; unset($_from); ?>
			
			<?php if ($this->_tpl_vars['paginator']->current < $this->_tpl_vars['paginator']->lastPageInRange): ?>
			<li class="paginate_next"><a href="javascript:void(0);" onclick="send_filter(<?php echo $this->_tpl_vars['paginator']->next; ?>
);">Next &raquo;</a></li>
			<?php endif; ?>
			
	</ul>
    
</div>      
<?php endif; ?>
<div class="clear"></div>