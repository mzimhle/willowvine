<?php /* Smarty version 2.6.20, created on 2015-02-01 12:29:37
         compiled from internships/details.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'internships/details.tpl', 4, false),array('modifier', 'trim', 'internships/details.tpl', 80, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Ref. <?php echo $this->_tpl_vars['internshipData']['pk_internship_id']; ?>
 | <?php echo $this->_tpl_vars['internshipData']['internship_title']; ?>
 in <?php echo $this->_tpl_vars['internshipData']['section_name']; ?>
 Section, page <?php echo ((is_array($_tmp=@$this->_tpl_vars['page'])) ? $this->_run_mod_handler('default', true, $_tmp, '1') : smarty_modifier_default($_tmp, '1')); ?>
 <?php if ($this->_tpl_vars['searchInternship'] != ""): ?> while searching for "<?php echo $this->_tpl_vars['searchInternship']; ?>
"<?php endif; ?></title>
<meta name="description" content='Ref. <?php echo $this->_tpl_vars['internshipData']['pk_internship_id']; ?>
 | <?php echo $this->_tpl_vars['internshipData']['internship_title']; ?>
 in <?php echo $this->_tpl_vars['internshipData']['section_name']; ?>
 Section, page <?php echo ((is_array($_tmp=@$this->_tpl_vars['page'])) ? $this->_run_mod_handler('default', true, $_tmp, '1') : smarty_modifier_default($_tmp, '1')); ?>
 <?php if ($this->_tpl_vars['searchInternship'] != ""): ?> while searching for "<?php echo $this->_tpl_vars['searchInternship']; ?>
"<?php endif; ?>'>
<meta name="keywords" content="south african internships,south africa internships,internships south africa,willowvine,willowvine,internships,internships, <?php echo $this->_tpl_vars['internshipData']['internship_title']; ?>
, <?php echo $this->_tpl_vars['internshipData']['section_name']; ?>
">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "includes/css.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "includes/javascript.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

<?php echo '
<style type="text/css">
.left_content ul {
    line-height: 18px;
	list-style-type: none;
}	

.left_content ul li {
  background: url("/images/larrow.jpg") no-repeat scroll 0 5px transparent;
   /* color: #3F3F3F; */
    font: 12px/18px Arial,Helvetica,sans-serif;
    padding: 0 0 8px 14px;	
}

.left_content ul li a {
    color: #CA7316;
    text-decoration: none;
}

a {
    color: #CA7316;
    text-decoration: none;
}

span p {
	margin: 1px;
}
</style>
'; ?>

</head>
<body OnLoad="document.search_for_jobs.searchJob.focus();">
<div id="container">
	<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "includes/navigation.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

	<div id="contnav" class="fl">
		<p class="fl">
			<a href="/">Home</a> &nbsp; 	
			<span>|</span> &nbsp; 
			<span>Internships</span>
			<span>|</span> &nbsp; 
			<span><?php echo $this->_tpl_vars['internshipData']['section_name']; ?>
</span>			
			<span>|</span> &nbsp; 
			<span><?php echo $this->_tpl_vars['internshipData']['internship_title']; ?>
 <?php if ($this->_tpl_vars['internshipData']['internship_area'] != ''): ?>in <span class="green_text"><?php echo $this->_tpl_vars['internshipData']['internship_area']; ?>
</span><?php endif; ?></span>		
			
		</p>
	</div>
	
	<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "includes/search_internships.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

	<br>
	<a class="standard_blue_btn fr" title="Go back to your search results" href="/internships/?searchInternship=<?php echo $this->_tpl_vars['searchInternship']; ?>
&page=<?php echo $this->_tpl_vars['page']; ?>
">
		<span id="Login">Back to your search</span>								
	</a>	
	<h1>
		<?php echo $this->_tpl_vars['internshipData']['internship_title']; ?>
	
	</h1>	
	<span class="blue_text font_16"><?php echo $this->_tpl_vars['internshipData']['section_name']; ?>
</span><br>
	<span class="font_16"><?php echo $this->_tpl_vars['internshipData']['internship_area']; ?>
</span>

	<div class="clear"></div><br>
	<div class="left_content width760">
			<br>
			<div class="share_btn border_top">
			</div>
			<div class="clear"></div>
			<br>
			<p>
				<?php if ($this->_tpl_vars['internshipData']['internship_company'] != ''): ?><span class="blue_text font_16">Company/Organization:</span><br><span class="font_16"><?php echo $this->_tpl_vars['internshipData']['internship_company']; ?>
</span><br><br><?php endif; ?>
				<?php if ($this->_tpl_vars['internshipData']['internship_contact_name'] != ''): ?><span class="blue_text font_16">Contact Email:</span><br><span class="font_16"><?php echo $this->_tpl_vars['internshipData']['internship_contact_name']; ?>
</span><br><br><?php endif; ?>
				<?php if ($this->_tpl_vars['internshipData']['internship_contact_email'] != ''): ?><span class="blue_text font_16">Contact Email:</span><br><span class="font_16"><?php echo $this->_tpl_vars['internshipData']['internship_contact_email']; ?>
</span><br><br><?php endif; ?>
				<?php if ($this->_tpl_vars['internshipData']['internship_contact_number'] != ''): ?><span class="blue_text font_16">Contact Number/s:</span><br><span class="font_16"><?php echo $this->_tpl_vars['internshipData']['internship_contact_number']; ?>
</span><br><br><?php endif; ?>			
			</p>				
			<span class="default_text"><?php echo ((is_array($_tmp=$this->_tpl_vars['internshipData']['internship_page'])) ? $this->_run_mod_handler('trim', true, $_tmp) : trim($_tmp)); ?>
</span>
	</div>			
	<div class="right_content">		
			<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "includes/side_ad_container.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

		<div class="clear"></div>
		<br><br>
		<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "includes/facebook_wall.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>
 			
	</div>
	<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "includes/footer.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

</div>

</body>
</html>