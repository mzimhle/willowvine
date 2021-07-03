<?php /* Smarty version 2.6.20, created on 2015-02-01 15:58:57
         compiled from communication/messages/details.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Communication</title>
<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'includes/css.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'includes/javascript.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

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
			<li><a href="/communication/" title="Communication">Communication</a></li>
			<li><a href="/communication/messages/" title="Messaages">Messaages</a></li>
			<li>Details</li>
        </ul>
	</div><!--breadcrumb--> 
  
	<div class="inner"> 
      <h2>Details</h2>
    <div id="sidetabs">
        <ul > 
            <li class="active"><a href="#" title="Details">Details</a></li>
			<li><a href="<?php if (isset ( $this->_tpl_vars['messageData'] )): ?>/communication/messages/comms.php?code=<?php echo $this->_tpl_vars['messageData']['_message_code']; ?>
<?php else: ?>#<?php endif; ?>" title="Comms">Comms</a></li>
        </ul>
    </div><!--tabs-->
	<div class="detail_box">
      <form id="detailsForm" name="detailsForm" action="/communication/messages/details.php<?php if (isset ( $this->_tpl_vars['messageData'] )): ?>?code=<?php echo $this->_tpl_vars['messageData']['_message_code']; ?>
<?php endif; ?>" method="post" enctype="multipart/form-data">
        <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="form">
          <tr>
			<td>
				<h4 class="error">Name:</h4><br />
				<input type="text" name="_message_name" id="_message_name" value="<?php echo $this->_tpl_vars['messageData']['_message_name']; ?>
" size="60" />
				<?php if (isset ( $this->_tpl_vars['errorArray']['_message_name'] )): ?><br /><span class="error"><?php echo $this->_tpl_vars['errorArray']['_message_name']; ?>
</span><?php else: ?><br /><em>Name of this message</em><?php endif; ?>
			</td>				
          </tr>
		  <tr>
			<td>
				<h4 class="error">Type:</h4><br />
				<?php if (! isset ( $this->_tpl_vars['messageData'] )): ?>
				<select name="_message_type" id="_message_type">
					<option value=""> ----- </option>
					<option value="EMAIL"> EMAIL </option>
					<option value="SMS"> SMS </option>
				</select>
				<?php if (isset ( $this->_tpl_vars['errorArray']['_message_type'] )): ?><br /><span class="error"><?php echo $this->_tpl_vars['errorArray']['_message_type']; ?>
</span><?php else: ?><br /><em>type of this message</em><?php endif; ?>
				<?php else: ?>
					<p class="success"><?php echo $this->_tpl_vars['messageData']['_message_type']; ?>
 message type</p>
					<input type="hidden" name="_message_type" id="_message_type" value="<?php echo $this->_tpl_vars['messageData']['_message_type']; ?>
"/>
				<?php endif; ?>
			</td>		  
		  </tr>
		  <?php if (isset ( $this->_tpl_vars['messageData'] )): ?>
			<?php if ($this->_tpl_vars['messageData']['_message_type'] == 'EMAIL'): ?>
          <tr>
			<td>
				<h4 class="error">Subject:</h4><br />
				<input type="text" name="_message_subject" id="_message_subject" value="<?php echo $this->_tpl_vars['messageData']['_message_subject']; ?>
" size="60" />
				<?php if (isset ( $this->_tpl_vars['errorArray']['_message_subject'] )): ?><br /><span class="error"><?php echo $this->_tpl_vars['errorArray']['_message_subject']; ?>
</span><?php else: ?><br /><em>Subject on email</em><?php endif; ?>
			</td>					
          </tr>
          <tr>
			<td>
				<h4>Note:</h4><br />
				To add peoples names on the mailer please add the following variables on the mailer: <br /><br />
					<table>					
						<tr><td>[fullname]</td><td>=</td><td>Member Name and Surname</td></tr>
						<tr><td>[email]</td><td>=</td><td>Client email</td></tr>
						<tr><td>[domain]</td><td>=</td><td>Current domain</td></tr>
						<tr><td>[tracking]</td><td>=</td><td>Code for tracking email opened by client</td></tr>
						<tr><td>[date]</td><td>=</td><td>Date sent out to client</td></tr>
						<?php if (isset ( $this->_tpl_vars['messageData'] )): ?><tr><td>Image paths</td><td>=</td><td>http://<?php echo $_SERVER['HTTP_HOST']; ?>
/messages/<?php echo $this->_tpl_vars['messageData']['_message_code']; ?>
/images/imagename.jpg</td></tr>
						<?php endif; ?>
						<?php if (isset ( $this->_tpl_vars['messageData'] ) && $this->_tpl_vars['messageData']['_message_file'] != ''): ?><tr><td>View file</td><td>=</td><td><a href="http://<?php echo $_SERVER['HTTP_HOST']; ?>
<?php echo $this->_tpl_vars['messageData']['_message_file']; ?>
" target="_blank" >http://<?php echo $_SERVER['HTTP_HOST']; ?>
<?php echo $this->_tpl_vars['messageData']['_message_file']; ?>
</a></td></tr>
					<?php endif; ?>						
					</table><br />					
				<h4>Upload HTML File:</h4><br />
				<input type="file" name="htmlfile" id="htmlfile" />
				<?php if (isset ( $this->_tpl_vars['errorArray']['htmlfile'] )): ?><br /><span class="error"><?php echo $this->_tpl_vars['errorArray']['htmlfile']; ?>
</span><?php else: ?><br /><em>Only .html and .htm allowed</em><?php endif; ?>					
			</td>
          </tr>
          <tr>
			<td>				
				<h4>Upload image files:</h4><br />
				<input type="file" name="imagefiles[]" id="imagefiles[]" multiple />
				<?php if (isset ( $this->_tpl_vars['errorArray']['imagefiles'] )): ?><br /><span class="error"><?php echo $this->_tpl_vars['errorArray']['imagefiles']; ?>
</span><?php else: ?><br /><em>Only .png, .jpeg, .gif and .jpg allowed</em><?php endif; ?>					
			</td>
          </tr>		  
		  <?php else: ?>
          <tr> 
			<td>
				<h4 class="error">Message:</h4><br />
				<textarea id="_message_text" name="_message_text" cols="60" rows="3"><?php echo $this->_tpl_vars['campaignData']['_message_text']; ?>
</textarea>
				<br /><em id="charcount" class="error">0 characters entered.</em>
				<?php if (isset ( $this->_tpl_vars['errorArray']['_message_text'] )): ?><br /><span class="error"><?php echo $this->_tpl_vars['errorArray']['_message_text']; ?>
</span><?php endif; ?>
			</td>
          </tr>		  
		  <?php endif; ?>
		<?php endif; ?>		  
        </table>
      </form>
	</div>
    <div class="clearer"><!-- --></div>
	<div class="mrg_top_10">
	  <a class="button cancel mrg_left_147 fl" href="/communication/messages/"><span>Cancel</span></a>
	  <a class="blue_button mrg_left_20 fl" href="javascript:submitForm();"><span>Save &amp; Complete</span></a>   
	</div>
    <div class="clearer"><!-- --></div>
	<br /><br />	
    </div><!--inner-->
<!-- End Content recruiter -->
 </div><!-- End Content recruiter -->
 <?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'includes/footer.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

</div>
<?php echo '
<script type="text/javascript" language="javascript">
'; ?>
<?php if (isset ( $this->_tpl_vars['messageData'] ) && $this->_tpl_vars['messageData']['_message_type'] == 'SMS'): ?><?php echo '
	$("#_message_text").keyup(function () {
		var i = $("#_message_text").val().length;
		$("#charcount").html(i+\' characters entered.\');
		if (i > 160) {
			$(\'#charcount\').removeClass(\'success\');
			$(\'#charcount\').addClass(\'error\');
		} else if(i == 0) {
			$(\'#charcount\').removeClass(\'success\');
			$(\'#charcount\').addClass(\'error\');
		} else {
			$(\'#charcount\').removeClass(\'error\');
			$(\'#charcount\').addClass(\'success\');
		} 
	});
'; ?>
<?php endif; ?><?php echo '
function submitForm() {
	document.forms.detailsForm.submit();					 
}
</script>
'; ?>

<!-- End Main Container -->
</body>
</html>