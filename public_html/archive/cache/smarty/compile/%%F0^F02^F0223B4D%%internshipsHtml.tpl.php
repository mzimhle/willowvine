<?php /* Smarty version 2.6.20, created on 2013-11-21 09:12:17
         compiled from admin/resources/internships/internshipsHtml.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'admin/resources/internships/internshipsHtml.tpl', 15, false),)), $this); ?>
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
      <?php $_from = $this->_tpl_vars['internshipItems']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['internshipItem']):
?>
      <tr>
        <td><?php echo ((is_array($_tmp=$this->_tpl_vars['internshipItem']['internship_added'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
</td>
        <td align="left"><a href="/admin/resources/internships/details.php?pk_internship_id=<?php echo $this->_tpl_vars['internshipItem']['pk_internship_id']; ?>
"><?php echo $this->_tpl_vars['internshipItem']['internship_title']; ?>
</a></td>	
		<td align="left"><?php echo $this->_tpl_vars['internshipItem']['section_name']; ?>
</td>
		<td align="left"><?php echo $this->_tpl_vars['internshipItem']['internship_area']; ?>
</td>
		<td align="left"><?php if ($this->_tpl_vars['internshipItem']['internship_active'] == 1): ?><span style="color: green;">Active</span><?php else: ?><span style="color: red;">Not Active</span><?php endif; ?></td>
      </tr>
      <?php endforeach; else: ?>
    	<tr>
        	<td colspan="9">There are no current Enquiries in the system.</td>
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