<?php /* Smarty version 2.6.20, created on 2014-11-24 11:38:07
         compiled from admin/resources/emails/search/emailsHtml.tpl */ ?>
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
      <?php $_from = $this->_tpl_vars['emailItems']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['emailItem']):
?>
     
      <tr>
        <td align="left"><?php echo $this->_tpl_vars['emailItem']['email_added']; ?>
</td>
		<td align="left"><a href="/admin/resources/emails/details.php?emailId=<?php echo $this->_tpl_vars['emailItem']['pk_email_id']; ?>
"><?php echo $this->_tpl_vars['emailItem']['email_name']; ?>
</a></td>
		<td align="left"><?php echo $this->_tpl_vars['emailItem']['email_email']; ?>
</td>
		<td align="left"><?php echo $this->_tpl_vars['emailItem']['email_type']; ?>
</td>
		<td align="left"><?php echo $this->_tpl_vars['emailItem']['email_sentDate']; ?>
</td>
        <td align="left"><?php if ($this->_tpl_vars['emailItem']['email_sent'] == '1'): ?><span style="color: green">Sent</span><?php else: ?><span style="color: red">Not Sent</span><?php endif; ?></td>		
       </tr>
      <?php endforeach; else: ?>
    	<tr>
        	<td colspan="9">There are no current Emails in the system. </td>
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