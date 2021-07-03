<?php /* Smarty version 2.6.20, created on 2015-01-01 14:58:46
         compiled from job_seeker/account/applied.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'job_seeker/account/applied.tpl', 4, false),)), $this); ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <?php $_from = $this->_tpl_vars['jobAppliedItems']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['foo'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['foo']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['item']):
        $this->_foreach['foo']['iteration']++;
?>
	<tr>			  
		<td style="font-size: 12px; border-bottom: 1px solid #E9E6E0;padding: 5px;"><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['jobApplication_added'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
, <?php echo $this->_tpl_vars['item']['job_title']; ?>
 in <?php echo $this->_tpl_vars['item']['job_area']; ?>
</td>		
	 </tr>
	<?php endforeach; else: ?>
	<tr>
		<td width="auto" style="color: red; border-bottom: 1px solid #E9E6E0;padding: 5px;">	
			You do not have any jobs you recently applied to.
		</td>
	</tr>
	<?php endif; unset($_from); ?>	
	<tr>
		<td style="font-size: 10px; border-bottom: 1px solid #E9E6E0;padding: 5px;">
		<div class="clear"></div>
		<p class="pagination fr">
			<?php if ($this->_tpl_vars['paginator']->current > 1): ?>
				<a class="prev-page" href="Javascript:fetchApplied(<?php echo $this->_tpl_vars['paginator']->previous; ?>
)">Previous</a>
			<?php endif; ?>	
				<?php $_from = $this->_tpl_vars['paginator']->pagesInRange; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['page']):
?>
				<?php if ($this->_tpl_vars['page'] != $this->_tpl_vars['paginator']->current): ?>		
				<a class="page-num" href="Javascript:fetchApplied(<?php echo $this->_tpl_vars['page']; ?>
)"><?php echo $this->_tpl_vars['page']; ?>
</a>
				<?php else: ?>
				<strong class="current-page"><?php echo $this->_tpl_vars['page']; ?>
</strong>
				<?php endif; ?>
			<?php endforeach; endif; unset($_from); ?>
			<?php if ($this->_tpl_vars['paginator']->current < $this->_tpl_vars['paginator']->lastPageInRange): ?>
				<a class="next-page" href="Javascript:fetchApplied(<?php echo $this->_tpl_vars['paginator']->next; ?>
)">Next</a>
			<?php endif; ?>	
		</p>	
		</td>
	</tr>
</table>