<?php /* Smarty version 2.6.20, created on 2015-07-21 08:38:32
         compiled from jobs/application/default.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'jobs/application/default.tpl', 43, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Job Applications</title>
<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'includes/css.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'includes/javascript.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

<script type="text/javascript" language="javascript" src="/jobs/application/default.js"></script>
</head>

<body>
<!-- Start Main Container -->
<div id="container">
    <!-- Start Content Section -->
  <div id="content">
    <?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'includes/header.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

	<div id="breadcrumb">
        <ul>
            <li><a href="/default.php" title="Home">Home</a></li>
            <li><a href="/jobs/" title="Jobs">Jobs</a></li>
			<li><a href="/jobs/applications/" title="Job Applications">Job Applications</a></li>
        </ul>
	</div><!--breadcrumb-->  
	<div class="inner">     
    <h2>Manage Job Applications</h2>
	<!-- Start Content Table -->
	<div class="content_table">
		<form name="enquiriesForm" id="enquiriesForm" action="#" method="post">
		<table id="dataTable" border="0" cellspacing="0" cellpadding="0">
		  <thead>
			<tr>
			<th>Added</th>
			<th>Name</th>
			<th>Job Title</th>
			 <th>Applicant Email</th>
			 <th>Job Email</th>
			 <th>Mail</th>
			 </tr>
		   </thead>
		   </tbody>
		  <?php $_from = $this->_tpl_vars['enquiryData']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
		  <tr>
			<td><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['enquiry_added'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
</td>
			<td align="left"><a href="/jobs/application/details.php?code=<?php echo $this->_tpl_vars['item']['enquiry_code']; ?>
"><?php echo $this->_tpl_vars['item']['enquiry_name']; ?>
</a></td>
			<td align="left"><?php echo $this->_tpl_vars['item']['job_title']; ?>
</td>
			<td align="left"><?php echo $this->_tpl_vars['item']['enquiry_email']; ?>
</td>
			<td align="left"><?php echo $this->_tpl_vars['item']['job_poster_email']; ?>
</td>
			<td align="left"><a href="/mailer/view/<?php echo $this->_tpl_vars['item']['_comm_code']; ?>
" target="_blank" class="<?php if ($this->_tpl_vars['item']['_comm_sent'] == 1): ?>success<?php else: ?>error<?php endif; ?>"><?php echo $this->_tpl_vars['item']['_comm_output']; ?>
</a></td>
		   </tr>
		  <?php endforeach; endif; unset($_from); ?>
		  </tbody>
		</table>
		 </form>
	 </div>
	<!-- End Content Table -->
      <div class="clear"></div>
    <div class="clearer"><!-- --></div>
    </div><!--inner-->
  </div><!-- End Content Section -->
 <?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'includes/footer.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

</div>
<!-- End Main Container -->
</body>
</html>