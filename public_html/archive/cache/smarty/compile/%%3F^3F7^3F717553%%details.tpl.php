<?php /* Smarty version 2.6.20, created on 2015-02-01 09:37:06
         compiled from careers/details.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'trim', 'careers/details.tpl', 68, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>WillowVine | Careers | Learn More about <?php echo $this->_tpl_vars['careerData']['career_title']; ?>
 in <?php echo $this->_tpl_vars['careerData']['section_name']; ?>
 Section</title>
<meta name="description" content="Learn More about <?php echo $this->_tpl_vars['careerData']['career_title']; ?>
 in <?php echo $this->_tpl_vars['careerData']['section_name']; ?>
 Section and Search for jobs relating to that career.">
<meta name="keywords" content="south african careers,south africa careers,careers south africa,willowvine,willowvine,careers,careers, <?php echo $this->_tpl_vars['careerData']['career_title']; ?>
, <?php echo $this->_tpl_vars['careerData']['section_name']; ?>
">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "includes/css.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "includes/javascript.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

<?php echo '
<style type="text/css">
#leftcontent_about ul {
    line-height: 18px;
	list-style-type: none;
}	

#leftcontent_about ul li {
  background: url("/images/larrow.jpg") no-repeat scroll 0 5px transparent;
    color: #3F3F3F;
    font: 12px/18px Arial,Helvetica,sans-serif;
    padding: 0 0 8px 14px;	
}

#leftcontent_about ul li a {
    color: #CA7316;
    text-decoration: none;
}

a {
    color: #CA7316;
    text-decoration: none;
}
</style>
'; ?>

</head>
<body OnLoad="document.search_for_careers.searchCareer.focus();">
<div id="container">
	<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "includes/navigation.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

	<div id="contnav" class="fl">
		<p class="fl">
			<a href="/">Home</a> &nbsp; 	
			<span>|</span> &nbsp; 
			<span>Careers</span>
			<span>|</span> &nbsp; 
			<span><?php echo $this->_tpl_vars['careerData']['section_name']; ?>
</span>			
			<span>|</span> &nbsp; 
			<span><?php echo $this->_tpl_vars['careerData']['career_title']; ?>
</span>		
			
		</p>
	</div>
	
	<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "includes/search_careers.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

	<br>
	<a class="standard_blue_btn fr" title="Go back to your search results" href="/careers/?searchCareer=<?php echo $this->_tpl_vars['searchCareer']; ?>
&page=<?php echo $this->_tpl_vars['page']; ?>
">
		<span id="Login">Back to your search</span>								
	</a>	
	<h1>
		<?php echo $this->_tpl_vars['careerData']['career_title']; ?>
	
	</h1>	
	<span class="blue_text font_16"><?php echo $this->_tpl_vars['careerData']['section_name']; ?>
</span><br>
	<span><?php echo $this->_tpl_vars['careerData']['career_area']; ?>
</span>
	<div class="clear"></div>
	<div class="left_content width760">
			<br>
			<div class="border_top"></div>
			<br>
			<div class="clear"></div>				
			<span class="default_text"><?php echo ((is_array($_tmp=$this->_tpl_vars['careerData']['career_page'])) ? $this->_run_mod_handler('trim', true, $_tmp) : trim($_tmp)); ?>
</span>
			<?php if ($this->_tpl_vars['careerData']['career_education'] != ''): ?>
				<span class="blue_text font_16">Education</span><br><br>
				<span class="default_text"><?php echo ((is_array($_tmp=$this->_tpl_vars['careerData']['career_education'])) ? $this->_run_mod_handler('trim', true, $_tmp) : trim($_tmp)); ?>
</span>
			<?php endif; ?>	
			<?php if ($this->_tpl_vars['careerData']['career_contact'] != ''): ?>
				<span class="blue_text font_16">Contact</span><br><br>
				<span class="default_text"><?php echo ((is_array($_tmp=$this->_tpl_vars['careerData']['career_contact'])) ? $this->_run_mod_handler('trim', true, $_tmp) : trim($_tmp)); ?>
</span>
			<?php endif; ?>	
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