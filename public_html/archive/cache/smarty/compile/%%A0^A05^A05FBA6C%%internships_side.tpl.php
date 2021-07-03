<?php /* Smarty version 2.6.20, created on 2015-02-01 12:45:40
         compiled from includes/internships_side.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'normal_text', 'includes/internships_side.tpl', 7, false),array('modifier', 'strip_tags', 'includes/internships_side.tpl', 7, false),array('modifier', 'truncate', 'includes/internships_side.tpl', 7, false),array('modifier', 'date_format', 'includes/internships_side.tpl', 8, false),)), $this); ?>
<div id="side_box" class="myform">
	<h1><strong>Internships / Bursaries</strong></h1>
	<?php $_from = $this->_tpl_vars['topinternships']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['foo'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['foo']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['item']):
        $this->_foreach['foo']['iteration']++;
?>
	<div class="internships">
		<div class="right_internships" style="font-size: 13px;margin-top: 20px;">
			<strong><a style="text-decoration: none; color: #063166;" href="/internships/<?php echo $this->_tpl_vars['item']['section_urlName']; ?>
/details/<?php echo $this->_tpl_vars['item']['internship_link']; ?>
/<?php echo $this->_tpl_vars['item']['pk_internship_id']; ?>
/" title="View this internship, <?php echo $this->_tpl_vars['item']['internship_title']; ?>
's details"><?php echo $this->_tpl_vars['item']['internship_title']; ?>
</a></strong>
			<p style="margin: 0px"><?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['item']['internship_page'])) ? $this->_run_mod_handler('normal_text', true, $_tmp) : smarty_modifier_normal_text($_tmp)))) ? $this->_run_mod_handler('strip_tags', true, $_tmp) : smarty_modifier_strip_tags($_tmp)))) ? $this->_run_mod_handler('truncate', true, $_tmp, 100) : smarty_modifier_truncate($_tmp, 100)); ?>
<br>			
			<span><strong>Posted: <?php echo ((is_array($_tmp=$this->_tpl_vars['item']['internship_added'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d %b %Y") : smarty_modifier_date_format($_tmp, "%d %b %Y")); ?>
</strong> - <a href="/internships/<?php echo $this->_tpl_vars['item']['section_urlName']; ?>
/details/<?php echo $this->_tpl_vars['item']['internship_link']; ?>
/<?php echo $this->_tpl_vars['item']['pk_internship_id']; ?>
/" title="click to view this internship.">View</a></span>
			</p>
		</div>
	</div>
	<?php endforeach; endif; unset($_from); ?>
	<br>
	<div class="internships">
		<h1>
			<a href="/internships/" style="color: #0D2C52"><strong>Search for more internships and bursaries</strong></a>
		</h1>
	</div>
</div>