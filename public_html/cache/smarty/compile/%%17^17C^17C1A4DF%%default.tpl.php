<?php /* Smarty version 2.6.20, created on 2015-02-01 16:04:14
         compiled from resources/recruiters/default.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'resources/recruiters/default.tpl', 45, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Recruiter</title>
<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'includes/css.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'includes/javascript.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

<script type="text/javascript" language="javascript" src="default.js"></script>
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
            <li><a href="/" title="Home">Home</a></li>
            <li><a href="/recruiters/" title="Recruiter">Recruiter</a></li>
			<li><a href="/resources/recruiters/" title="View">View</a></li>
        </ul>
	</div><!--breadcrumb-->  
	<div class="inner">     
    <h2>Manage Recruiter</h2>		
	<a href="/resources/recruiters/details.php" title="Click to Add a new Internshiip" class="blue_button fr mrg_bot_10"><span style="float:right;">Add a new Internshiip</span></a> <br />
    <div class="clearer"><!-- --></div>
	<!-- Start Content Table -->
	<div class="content_table">
		<form name="listForm" id="listForm" action="#" method="post">		
			<table id="dataTable" border="0" cellspacing="0" cellpadding="0">
			  <thead>
					<th>Added</th>
					<th>Name</th>
					<th>Area</th>
					<th>Email</th>
					<th>Number</th>
					<th>Address</th>
					<th>Logo</th>
					<th></th>
			   </thead>
			   <tbody>
			  <?php $_from = $this->_tpl_vars['recruiterData']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
			  <tr>
				<td align="left"><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['recruiter_added'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
</td>
				<td align="left">
					<a href="/resources/recruiters/details.php?code=<?php echo $this->_tpl_vars['item']['recruiter_code']; ?>
" class="<?php if ($this->_tpl_vars['item']['recruiter_active'] == 1): ?>success<?php else: ?>error<?php endif; ?>">
						<?php echo $this->_tpl_vars['item']['recruiter_name']; ?>

					</a>
				</td>
				<td align="left"><?php echo $this->_tpl_vars['item']['areapost_name']; ?>
</td>
				<td align="left"><?php echo $this->_tpl_vars['item']['recruiter_email']; ?>
</td>
				<td align="left"><?php echo $this->_tpl_vars['item']['recruiter_number']; ?>
</td>
				<td align="left"><?php echo $this->_tpl_vars['item']['recruiter_address']; ?>
</td>
				<td align="left">
					<a href="<?php echo $this->_tpl_vars['item']['recruiter_website']; ?>
" target="_blank">
						<img src="<?php echo $this->_tpl_vars['item']['recruiter_logo_path']; ?>
" width="90" />
					</a>
				</td>
				<td align="left"><button onclick="deleteitem('<?php echo $this->_tpl_vars['item']['recruiter_code']; ?>
'); return false;">Delete</button></td>
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