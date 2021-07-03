<?php /* Smarty version 2.6.20, created on 2013-11-21 09:54:04
         compiled from default.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>WillowVine | Home | Online Job Classified Adverts - Jobs, Careers, holiday or weekend work in your town or city and near you.</title>
<meta name="description" content="Register our CV with us and let the recruiters and employers come to you. Look for work, jobs or careers as well as internships, bursaries or scholarships" />
<meta name="keywords" content="south african jobs,south africa careers,jobs south africa,willowvine,willowvine,jobs,careers, Cape Town, East London, Port Elizabeth, Johannesburg, Durban, Polokwane, Bloemfontein, Pretoria" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "includes/css.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "includes/javascript.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "includes/auto_complete.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

<?php echo '
<script type="text/javascript">
$().ready(function() {
$("#areaName").autocomplete(areas);
});
</script>
'; ?>

</head>
<body OnLoad="document.search_for_jobs.searchJob.focus();">
<div id="container">
	<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "includes/navigation.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

	<div class="clear"></div><br>
	<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "includes/search_jobs.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

	<div class="clear"></div><br>
	<?php if ($this->_tpl_vars['jobShareCount'] > 0): ?>	
	<a class="standard_blue_btn fr" style="margin-top: 5px;" title="View my shortlisted jobs" href="/jobs/shortlist/">
		<span id="Login">View my Shortlist (<?php echo $this->_tpl_vars['jobShareCount']; ?>
)</span>								
	</a>		
	<?php endif; ?>
	<div class="left_content width760">
	<h2 class="font_25">Jobs</h2>
	<ul class="category_section fl">
	<?php $_from = $this->_tpl_vars['sectionData']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['jobName'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['jobName']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['data']):
        $this->_foreach['jobName']['iteration']++;
?>
		<li><a href="/jobs/search/<?php echo $this->_tpl_vars['data']['section_urlName']; ?>
/"><?php echo $this->_tpl_vars['data']['section_name']; ?>
</a></li>
		<?php if ($this->_foreach['jobName']['iteration'] == $this->_tpl_vars['sectionHalf']): ?>
			</ul><ul class="category_section fr">
		<?php endif; ?>
	<?php endforeach; endif; unset($_from); ?>
	</ul>
	<div class="clear"></div>
	<h2 class="font_25">Internships / Bursaries / Scholarships</h2>
	<ul class="category_section fl">
	<?php $_from = $this->_tpl_vars['sectionInternshipData']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['internshipName'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['internshipName']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['data']):
        $this->_foreach['internshipName']['iteration']++;
?>
		<li><a href="/internships/<?php echo $this->_tpl_vars['data']['section_urlName']; ?>
/"><?php echo $this->_tpl_vars['data']['section_name']; ?>
</a></li>
		<?php if ($this->_foreach['internshipName']['iteration'] == $this->_tpl_vars['sectionInternshipHalf']): ?>
			</ul><ul class="category_section fr">
		<?php endif; ?>
	<?php endforeach; endif; unset($_from); ?>
	</ul>	
	</div>
	<div class="right_content">
		<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "includes/social_plugin_login.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

		<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "includes/registration_box.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>
	
		<?php if (isset ( $this->_tpl_vars['userData'] )): ?>
		<br><br>
			<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "includes/internships_side.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>
	
		<?php endif; ?>
	</div>
	<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "includes/footer.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

</div>

</body>
</html>