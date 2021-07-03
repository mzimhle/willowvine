<?php /* Smarty version 2.6.20, created on 2015-01-01 14:58:46
         compiled from job_seeker/account/shortlist.tpl */ ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <?php $_from = $this->_tpl_vars['shortListeItems']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['foo'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['foo']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['item']):
        $this->_foreach['foo']['iteration']++;
?>
	<tr>			  
		<td style="font-size: 12px; border-bottom: 1px solid #E9E6E0;">
			<a href="/jobs/search/<?php echo $this->_tpl_vars['item']['section_urlName']; ?>
/details/<?php echo $this->_tpl_vars['item']['job_link']; ?>
/<?php echo $this->_tpl_vars['item']['job_reference']; ?>
/">
				<?php echo $this->_tpl_vars['item']['job_title']; ?>
 in <?php echo $this->_tpl_vars['item']['job_area']; ?>
			
			</a>
			<br><br>
			<a href="Javascript:shortListRemove(<?php echo $this->_tpl_vars['item']['job_reference']; ?>
);" alt="Share job or career with a friend" title="Share job or career with a friend" class="small_blue_bg_dark_btn fr">
				<span id="share_job">Remove from shortlist</span>								
			</a></td>		
	 </tr>
	<?php endforeach; else: ?>
	<tr>
		<td width="auto" style="color: red; border-bottom: 1px solid #E9E6E0;padding: 5px;">	
			You do not have any shortlisted jobs.
		</td>
	</tr>
	<?php endif; unset($_from); ?>	
	<tr>
		<td style="font-size: 10px; border-bottom: 1px solid #E9E6E0;padding: 5px;">
		<div class="clear"></div>
		<p class="pagination fr">
			<?php if ($this->_tpl_vars['paginator']->current > 1): ?>
				<a class="prev-page" href="Javascript:fetchShortList(<?php echo $this->_tpl_vars['paginator']->previous; ?>
)">Previous</a>
			<?php endif; ?>	
				<?php $_from = $this->_tpl_vars['paginator']->pagesInRange; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['page']):
?>
				<?php if ($this->_tpl_vars['page'] != $this->_tpl_vars['paginator']->current): ?>		
				<a class="page-num" href="Javascript:fetchShortList(<?php echo $this->_tpl_vars['page']; ?>
)"><?php echo $this->_tpl_vars['page']; ?>
</a>
				<?php else: ?>
				<strong class="current-page"><?php echo $this->_tpl_vars['page']; ?>
</strong>
				<?php endif; ?>
			<?php endforeach; endif; unset($_from); ?>
			<?php if ($this->_tpl_vars['paginator']->current < $this->_tpl_vars['paginator']->lastPageInRange): ?>
				<a class="next-page" href="Javascript:fetchShortList(<?php echo $this->_tpl_vars['paginator']->next; ?>
)">Next</a>
			<?php endif; ?>	
		</p>	
		</td>
	</tr>
</table>