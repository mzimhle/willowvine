<?php /* Smarty version 2.6.20, created on 2015-02-01 12:45:40
         compiled from includes/filter_jobs_right.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'includes/filter_jobs_right.tpl', 2, false),)), $this); ?>
<div class="job_filter">
<form id="job_filterFrm" name="job_filterFrm" method="POST" action="<?php echo ((is_array($_tmp=@$this->_tpl_vars['currentLink'])) ? $this->_run_mod_handler('default', true, $_tmp, "/") : smarty_modifier_default($_tmp, "/")); ?>
">
<h1>Search Results (<?php echo ((is_array($_tmp=@$this->_tpl_vars['paginator']->totalItemCount)) ? $this->_run_mod_handler('default', true, $_tmp, '0') : smarty_modifier_default($_tmp, '0')); ?>
)</h1>
<p></p>
<?php if (isset ( $this->_tpl_vars['jobByTypeData'] )): ?>
<h2><a href="/jobs/search/<?php if ($this->_tpl_vars['searchJob'] != ''): ?>?searchJob=<?php echo $this->_tpl_vars['searchJob']; ?>
<?php endif; ?>">Type</a></h2>
<ul>
	<?php $_from = $this->_tpl_vars['jobByTypeData']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['job']):
?>
	<li><a href="/jobs/search/?type=<?php echo $this->_tpl_vars['job']['job_area_link']; ?>
<?php echo $this->_tpl_vars['job']['job_type']; ?>
<?php if ($this->_tpl_vars['searchJob'] != ''): ?>&searchJob=<?php echo $this->_tpl_vars['searchJob']; ?>
<?php endif; ?><?php if ($this->_tpl_vars['area'] != ''): ?>&area=<?php echo $this->_tpl_vars['area']; ?>
<?php endif; ?>"><?php echo $this->_tpl_vars['job']['job_type']; ?>
 (<?php echo $this->_tpl_vars['job']['job_count']; ?>
)</a></li>
	<?php endforeach; endif; unset($_from); ?>
</ul>
<div class="spacer"></div>
<?php endif; ?>
<?php if (isset ( $this->_tpl_vars['jobByAreaData'] )): ?>
<h2><a href="/jobs/search/<?php if ($this->_tpl_vars['searchJob'] != ''): ?>?searchJob=<?php echo $this->_tpl_vars['searchJob']; ?>
<?php endif; ?>"><?php echo ((is_array($_tmp=@$this->_tpl_vars['location'])) ? $this->_run_mod_handler('default', true, $_tmp, 'South Africa') : smarty_modifier_default($_tmp, 'South Africa')); ?>
</a></h2>
<ul>
	<?php $_from = $this->_tpl_vars['jobByAreaData']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['job']):
?>
	<li><a href="/jobs/search/?area=<?php echo $this->_tpl_vars['job']['job_area_link']; ?>
<?php if ($this->_tpl_vars['searchJob'] != ''): ?>&searchJob=<?php echo $this->_tpl_vars['searchJob']; ?>
<?php endif; ?><?php if ($this->_tpl_vars['type'] != ''): ?>&type=<?php echo $this->_tpl_vars['type']; ?>
<?php endif; ?>"><?php echo $this->_tpl_vars['job']['job_area']; ?>
 (<?php echo $this->_tpl_vars['job']['job_count']; ?>
)</a></li>
	<?php endforeach; endif; unset($_from); ?>
</ul>
<div class="spacer"></div>
<?php endif; ?>
</form>
</div>	
<div class="clear"></div>