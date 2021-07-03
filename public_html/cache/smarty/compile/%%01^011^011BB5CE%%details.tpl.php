<?php /* Smarty version 2.6.20, created on 2014-12-28 14:04:06
         compiled from administration/resources/spam/details.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Spam</title>
<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'administration/includes/css.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'administration/includes/javascript.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

<script type="text/javascript" language="javascript" src="/library/javascript/nicedit/nicEdit.js"></script>
</head>
<body>
<!-- Start Main Container -->
<div id="container">
    <!-- Start Content spam -->
  <div id="content">
    <?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'administration/includes/header.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

  	<br />
	<div id="breadcrumb">
        <ul>
            <li><a href="/administration/" title="Home">Home</a></li>
            <li><a href="/administration/resources/" title="Resources">Resources</a></li>
			<li><a href="/administration/resources/spam/" title="Spam">Spam</a></li>
			<li>Details</li>
        </ul>
	</div><!--breadcrumb--> 
  
	<div class="inner"> 
      <h2><?php if (isset ( $this->_tpl_vars['spamData']['spam_code'] )): ?>Edit spam: <?php echo $this->_tpl_vars['spamData']['spam_name']; ?>
<?php else: ?>Add a new spam<?php endif; ?></h2>
    <div id="sidetabs">
        <ul > 
            <li class="active"><a href="#" title="Details">Details</a></li>
        </ul>
    </div><!--tabs-->

	<div class="detail_box">
      <form id="detailsForm" name="detailsForm" action="/administration/resources/spam/details.php<?php if (isset ( $this->_tpl_vars['spamData']['spam_code'] )): ?>?code=<?php echo $this->_tpl_vars['spamData']['spam_code']; ?>
<?php endif; ?>" method="post">
        <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="form">
           <tr>
            <td>
				<h4 class="error">Name:</h4><br />
				<input type="text" name="spam_name" id="spam_name" value="<?php echo $this->_tpl_vars['spamData']['spam_name']; ?>
" size="30"/>
				<?php if (isset ( $this->_tpl_vars['errorArray']['spam_name'] )): ?><br /><span class="error"><?php echo $this->_tpl_vars['errorArray']['spam_name']; ?>
</span><?php endif; ?>
			</td>
            <td>
				<h4>Email:</h4><br />
				<input type="text" name="spam_email" id="spam_email" value="<?php echo $this->_tpl_vars['spamData']['spam_email']; ?>
" size="30"/>
				<?php if (isset ( $this->_tpl_vars['errorArray']['spam_email'] )): ?><br /><span class="error"><?php echo $this->_tpl_vars['errorArray']['spam_email']; ?>
</span><?php endif; ?>
			</td>
            <td>
				<h4>Cellphone:</h4><br />
				<input type="text" name="spam_cellphone" id="spam_cellphone" value="<?php echo $this->_tpl_vars['spamData']['spam_cellphone']; ?>
" size="30"/>
				<?php if (isset ( $this->_tpl_vars['errorArray']['spam_cellphone'] )): ?><br /><span class="error"><?php echo $this->_tpl_vars['errorArray']['spam_cellphone']; ?>
</span><?php endif; ?>
			</td>			
          </tr>	
          <tr>
            <td colspan="3">
				<h4>Area:</h4><br />
				<input type="text" name="areapost_name" id="areapost_name" value="<?php echo $this->_tpl_vars['spamData']['areapost_name']; ?>
" size="80"/>
				<input type="hidden" name="areapost_code" id="areapost_code" value="<?php echo $this->_tpl_vars['spamData']['areapost_code']; ?>
" />
				<?php if (isset ( $this->_tpl_vars['errorArray']['areapost_code'] )): ?><br /><span class="error"><?php echo $this->_tpl_vars['errorArray']['areapost_code']; ?>
</span><?php endif; ?>
			</td>
          </tr>	
          <tr>
            <td colspan="3">
				<h4>Address:</h4><br />
				<input type="text" name="spam_address" id="spam_address" value="<?php echo $this->_tpl_vars['spamData']['spam_address']; ?>
" size="80"/>
			</td>
          </tr>
        </table>
      </form>
	</div>
    <div class="clearer"><!-- --></div>
        <div class="mrg_top_10">
          <a href="/administration/resources/spam/" class="button cancel mrg_left_147 fl"><span>Cancel</span></a>
          <a href="javascript:submitForm();" class="blue_button mrg_left_20 fl"><span>Save &amp; Complete</span></a>   
        </div>
    <div class="clearer"><!-- --></div>
    </div><!--inner-->
 </div> 	
<!-- End Content spam -->
 </div><!-- End Content spam -->
 <?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'administration/includes/footer.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

</div>
<?php echo '
<script type="text/javascript" language="javascript">
function submitForm() {
	document.forms.detailsForm.submit();					 
}

$(document).ready(function(){
		
		$( "#areapost_name" ).autocomplete({
			source: "/feeds/areaparents.php",
			minLength: 2,
			select: function( event, ui ) {
			
				if(ui.item.id == \'\') {
					$(\'#areapost_name\').html(\'\');
					$(\'#areapost_code\').val(\'\');					
				} else {
					$(\'#areapost_name\').html(\'<b>\' + ui.item.value + \'</b>\');
					$(\'#areapost_code\').val(ui.item.id);	
				}
				$(\'#areapost_name\').val(\'\');										
			}
		});			
});
</script>
'; ?>

<!-- End Main Container -->
</body>
</html>