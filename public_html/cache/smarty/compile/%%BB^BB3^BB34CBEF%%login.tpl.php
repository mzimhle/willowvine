<?php /* Smarty version 2.6.20, created on 2015-06-29 15:00:52
         compiled from participants/view/login.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Participants</title>
<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'includes/css.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'includes/javascript.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

<script type="text/javascript" language="javascript" src="default.js"></script>
</head>
<body>
<!-- Start Main Container -->
<div id="container">
    <!-- Start Content recruiter -->
  <div id="content">
    <?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'includes/header.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

  	<br />
	<div id="breadcrumb">
        <ul>
            <li><a href="/" title="Home">Home</a></li>
			<li><a href="/participants/" title="Jobs">Participants</a></li>
			<li><a href="/participants/view/" title="Jobs">View</a></li>
			<li><a href="/participants/view/details.php?code=<?php echo $this->_tpl_vars['participantData']['participant_code']; ?>
" title="Jobs"><?php echo $this->_tpl_vars['participantData']['participant_name']; ?>
 <?php echo $this->_tpl_vars['participantData']['participant_surname']; ?>
</a></li>
			<li>Logins</li>
        </ul>
	</div><!--breadcrumb-->
	<div class="inner">
		  <div class="clearer"><!-- --></div>
		  <br /><h2>Manage Logins</h2><br />
    <div id="sidetabs">
        <ul > 
            <li><a href="/participants/view/details.php?code=<?php echo $this->_tpl_vars['participantData']['participant_code']; ?>
" title="Details">Details</a></li>
			<li><a href="/participants/view/cv.php?code=<?php echo $this->_tpl_vars['participantData']['participant_code']; ?>
" title="CV">CV's</a></li>
			<li class="active"><a href="" title="Login">Login</a></li>
        </ul>
    </div><!--tabs-->		  
		  <div class="detail_box">  
		  <form name="loginForm" id="loginForm" action="/participants/view/login.php?code=<?php echo $this->_tpl_vars['participantData']['participant_code']; ?>
" method="post">
			  <table id="dataTable" border="0" cellspacing="0" cellpadding="0" width="100%">			  
			  <thead>
			  <tr>				
				<th valign="top">Type</th>
				<th valign="top">ID</th>
				<th valign="top">Username</th>
				<th valign="top">Password</th>
				<th valign="top">Fullname</th>				
				<th valign="top">Image</th>				
				<th valign="top">View</th>				
				<th valign="top"></th>	
			  </tr>
			  </thead>
			  <?php $_from = $this->_tpl_vars['participantloginData']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
			  <tr>
				<td valign="top"><?php echo $this->_tpl_vars['item']['participantlogin_type']; ?>
</td>		
				<td valign="top"><?php echo $this->_tpl_vars['item']['participantlogin_id']; ?>
</td>	
				<td valign="top"><?php echo $this->_tpl_vars['item']['participantlogin_username']; ?>
</td>	
				<td valign="top"><?php echo $this->_tpl_vars['item']['participantlogin_password']; ?>
</td>				
				<td valign="top"><?php echo $this->_tpl_vars['item']['participantlogin_name']; ?>
 <?php echo $this->_tpl_vars['item']['participantlogin_surname']; ?>
</td>		
				<td valign="top"><?php if ($this->_tpl_vars['item']['participantlogin_image'] != ''): ?><img src="<?php echo $this->_tpl_vars['item']['participantlogin_image']; ?>
" /><?php else: ?>N/A<?php endif; ?></td>			
				<td valign="top"><?php if ($this->_tpl_vars['item']['participantlogin_url'] != ''): ?><a href="<?php echo $this->_tpl_vars['item']['participantlogin_url']; ?>
" target="_blank">View</a><?php else: ?>N/A<?php endif; ?></td>			
				<td valign="top"><?php if ($this->_tpl_vars['item']['participantlogin_active'] == '1'): ?><button type="button" onclick="actionitem('<?php echo $this->_tpl_vars['item']['participantlogin_code']; ?>
', '0'); return false;">Deactivate</button><?php else: ?><button type="button" onclick="actionitem('<?php echo $this->_tpl_vars['item']['participantlogin_code']; ?>
', '1'); return false;">Activate</button><?php endif; ?></td>	
			  </tr>
			  <?php endforeach; endif; unset($_from); ?>			
			</table>
			<?php if (isset ( $this->_tpl_vars['errorArray']['error'] )): ?><span style="color: red; font-weight: bold;"><?php echo $this->_tpl_vars['errorArray']['error']; ?>
</span><?php endif; ?>
			</form>
		</div>		
	<div class="clearer"><!-- --></div>
    </div><!--inner-->
 </div> 	
<!-- End Content recruiter -->
 </div><!-- End Content recruiter -->
 <?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'includes/footer.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

</div>
<?php echo '
<script type="text/javascript">
function actionitem(code, status) {
	if(confirm(\'Are you sure you want to change status of this item?\')) {
		$.ajax({
				type: "GET",
				url: "login.php?code='; ?>
<?php echo $this->_tpl_vars['participantData']['participant_code']; ?>
<?php echo '",
				data: "actioncode="+code+"&status="+status,
				dataType: "json",
				success: function(data){
						if(data.result == 1) {
							alert(\'Status Changed\');
							window.location.href = \'/participants/view/login.php?code='; ?>
<?php echo $this->_tpl_vars['participantData']['participant_code']; ?>
<?php echo '\';
						} else {
							alert(data.message);
						}
				}
		});		
	}
	return false;	
}			
</script>
'; ?>
	
<!-- End Main Container -->
</body>
</html>