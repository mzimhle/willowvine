<?php /* Smarty version 2.6.20, created on 2015-02-01 15:57:39
         compiled from communication/messages/default.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'communication/messages/default.tpl', 45, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Communication</title>
<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'includes/css.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'includes/javascript.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

<script type="text/javascript" language="javascript" src="default.js?v1"></script>
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
			<li><a href="/communication/" title="Communication">Communication</a></li>
			<li><a href="/communication/messages/" title="Messages">Messages</a></li>
        </ul>
	</div><!--breadcrumb-->  
	<div class="inner">     
    <h2>Manage Messages</h2>
	<a href="/communication/messages/details.php" title="Click to Add a new Messages" class="blue_button fr mrg_bot_10"><span style="float:right;">Add a new Messages</span></a>  <br /> 
    <div class="clearer"><!-- --></div>
    <div id="tableContent" align="center">
		<!-- Start Content Table -->
		<div class="content_table">
			<table id="dataTable" border="0" cellspacing="0" cellpadding="0">
				<thead>
				<tr>
				<th>Added</th>
				<th>Name</th>
				<th>Type</th>
				<th>Subject</th>
				<th></th>
				<th></th>
				</tr>
			   </thead>
			   <tbody> 
			  <?php $_from = $this->_tpl_vars['messageData']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
			  <tr >
				<td><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['_message_added'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
</td>
				<td align="left">
					<a href="/communication/messages/details.php?code=<?php echo $this->_tpl_vars['item']['_message_code']; ?>
" class="<?php if ($this->_tpl_vars['item']['_message_active'] == '0'): ?>error<?php else: ?>success<?php endif; ?>">
						<?php echo $this->_tpl_vars['item']['_message_name']; ?>

					</a>
				</td>
				<td align="left"><?php echo $this->_tpl_vars['item']['_message_type']; ?>
</td>				
				<td align="left"><?php echo $this->_tpl_vars['item']['_message_subject']; ?>
</td>
				<td align="left"><button onclick="javascript:changestatus('<?php echo $this->_tpl_vars['item']['_message_code']; ?>
', '<?php if ($this->_tpl_vars['item']['_message_active'] == '0'): ?>1<?php else: ?>0<?php endif; ?>');">Change Status</button></td>
				<td align="right"><button onclick="deleteitem('<?php echo $this->_tpl_vars['item']['_message_code']; ?>
')">Delete</button></td>
			  </tr>
			  <?php endforeach; endif; unset($_from); ?>     
			  </tbody>
			</table>
		 </div>
		 <!-- End Content Table -->	
	</div>
    <div class="clearer"><!-- --></div>
    </div><!--inner-->
  </div><!-- End Content Section -->
 <?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'includes/footer.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

</div>
<!-- End Main Container -->
</body>
</html>