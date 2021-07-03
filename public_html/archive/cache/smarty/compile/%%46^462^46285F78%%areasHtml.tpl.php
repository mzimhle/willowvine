<?php /* Smarty version 2.6.20, created on 2013-08-27 11:26:43
         compiled from admin/resources/areas/areasHtml.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'admin/resources/areas/areasHtml.tpl', 15, false),)), $this); ?>
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
      <?php $_from = $this->_tpl_vars['areaItems']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['areaItem']):
?>
      <tr>
        <td><?php echo ((is_array($_tmp=$this->_tpl_vars['areaItem']['areaMap_added'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
</td>
        <td align="left"><a href="/admin/resources/areas/details.php?fkAreaId=<?php echo $this->_tpl_vars['areaItem']['fkAreaId']; ?>
"><?php echo $this->_tpl_vars['areaItem']['areaMap_name']; ?>
</a></td>
        <td align="left"><?php echo $this->_tpl_vars['areaMapPairs'][$this->_tpl_vars['areaItem']['fkAreaParentId']]; ?>
</td>
		<td align="left"><?php echo $this->_tpl_vars['areaTypePairs'][$this->_tpl_vars['areaItem']['fkAreaTypeId']]; ?>
</td>
		<td align="left"><?php if ($this->_tpl_vars['areaItem']['areaMap_active'] == 1): ?><span style="color: green;">Active</span><?php else: ?><span style="color: red;">In-Active</span><?php endif; ?></td>
       </tr>
      <?php endforeach; else: ?>
    	<tr>
        	<td colspan="9">There are no current Areas in the system. </td>
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