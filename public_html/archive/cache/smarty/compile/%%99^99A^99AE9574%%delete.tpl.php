<?php /* Smarty version 2.6.20, created on 2014-11-10 10:01:35
         compiled from recruiter/jobs/delete.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>WillowVine | Delete Job Post - <?php echo $this->_tpl_vars['jobData']['job_title']; ?>
</title>
<meta name="description" content="Job Classified Adverts - Post a free job advert. Delete a job Post here - <?php echo $this->_tpl_vars['jobData']['job_title']; ?>
 with job Reference <?php echo $this->_tpl_vars['jobData']['job_reference']; ?>
">
<meta name="keywords" content="south african jobs,south africa careers,jobs south africa,willowvine,willowvine,jobs,careers, post a free job advert.">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "includes/css.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "includes/javascript.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

</head>
<body OnLoad="document.jobForm.job_title.focus();">
<div id="home">
	<div id="main">
<!-- Start Header -->
<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "includes/header.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

<!-- End Header -->
<!-- Start Navigation -->
<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "includes/navigation.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

<!-- End Navigation -->
<!-- Start Navigation -->
<div id="contnav">
	<p>
	<a href="/">Home</a> &nbsp; 
	<span class="dash">|</span> &nbsp; 
	<a href="/recruiter/">Recruiters</a> &nbsp; 	
	<span class="dash">|</span> &nbsp; 
	<a href="/jobs/post/">Post a free job</a>
	<span class="dash">|</span> &nbsp; 	
	<a href="#">Delete job post: <?php echo $this->_tpl_vars['jobData']['job_title']; ?>
</a>
	<span class="dash">|</span> &nbsp; 		
	</p>
</div>
<!-- End Navigation -->
		<div id="content">
			<p class="ptitle">Are you sure you want to delete this post, <br /><?php echo $this->_tpl_vars['jobData']['job_title']; ?>
 ?</p>
			<p><span class="orange_text"><?php echo $this->_tpl_vars['jobData']['section_name']; ?>
</span></p>
			<p><span><?php echo $this->_tpl_vars['jobData']['job_area']; ?>
</span></p>		<br /><br />	
			<div class="clear"></div>	
			<?php if (! isset ( $this->_tpl_vars['success'] )): ?>
			<div class="complex_back" style="float: left;"><a href="/recruiter/jobs/delete.php?post=<?php echo $this->_tpl_vars['jobData']['job_reference']; ?>
&job=<?php echo $this->_tpl_vars['jobData']['job_hashcode']; ?>
&delete=yes">Yes, Delete this post</a></div>			
			<?php else: ?>
			<span style="color: red; font-size: 20px; font-weight: bold;">This job post has been deleted.</span>
			<?php endif; ?>
		</div><!-- content -->
	</div><!-- main -->
</div><!-- home --><div class="clear"></div>
<div id="footerarea">
	<div id="footer">
<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'includes/footer.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

	</div><!-- footer -->
</div><!-- footerarea -->
</body>
</html>