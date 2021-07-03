<?php /* Smarty version 2.6.20, created on 2014-12-03 18:43:40
         compiled from admin/resources/careers/education.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $this->_tpl_vars['siteName']; ?>
 | Resources | Careers | <?php if (isset ( $this->_tpl_vars['careerData']['pk_career_id'] )): ?>Edit career<?php else: ?>Add a career<?php endif; ?></title>
<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'admin/includes/css.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'admin/includes/javascript.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

<script type="text/javascript" language="javascript" src="/library/javascript/nicedit/nicEdit.js"></script>
</head>
<body>
<!-- Start Main Container -->
<div id="container">
    <!-- Start Content career -->
  <div id="content">
    <?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'admin/includes/header.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

    <div class="logged_in">
        <ul>
            <li><a href="/admin/help/users.php" title="Get Help" class="help_icon"> Help</a></li>
            <li>|<a href="/admin/logout.php" title="Logout">Logout</a></li>
        </ul>
    </div><!--logged_in-->
  	<br />
	<div id="breadcrumb">
        <ul>
            <li><a href="/admin/default.php" title="Home">Home</a></li>
			<li><a href="/admin/resources/" title="Resources">Resources</a></li>
			<li><a href="/admin/resources/careers/" title="Careers">Careers</a></li>
			<li><?php if (isset ( $this->_tpl_vars['careerData']['pk_career_id'] )): ?>Edit career<?php else: ?>Add a career<?php endif; ?></li>
        </ul>
	</div><!--breadcrumb--> 
  
	<div class="inner"> 
      <h2><?php if (isset ( $this->_tpl_vars['careerData']['pk_career_id'] )): ?>Edit career: <?php echo $this->_tpl_vars['careerData']['career_title']; ?>
<?php else: ?>Add a new career<?php endif; ?></h2>
    <div id="sidetabs">
        <ul > 
            <li><a href="<?php if (isset ( $this->_tpl_vars['careerData']['pk_career_id'] )): ?>/admin/resources/careers/details.php?pk_career_id=<?php echo $this->_tpl_vars['careerData']['pk_career_id']; ?>
<?php else: ?>#<?php endif; ?>" title="Details">Details</a></li>
			<li class="active"><a href="#" title="Education">Education</a></li>
			<li><a href="<?php if (isset ( $this->_tpl_vars['careerData']['pk_career_id'] )): ?>/admin/resources/careers/contact.php?pk_career_id=<?php echo $this->_tpl_vars['careerData']['pk_career_id']; ?>
<?php else: ?>#<?php endif; ?>" title="Contact">Contact</a></li>			
        </ul>
    </div><!--tabs-->

	<div class="detail_box">
      <form id="detailsForm" name="detailsForm" action="/admin/resources/careers/education.php<?php if (isset ( $this->_tpl_vars['careerData']['pk_career_id'] )): ?>?pk_career_id=<?php echo $this->_tpl_vars['careerData']['pk_career_id']; ?>
<?php endif; ?>" method="post">
        <table width="700" border="0" align="center" cellpadding="0" cellspacing="0" class="form">
          <?php if (isset ( $this->_tpl_vars['careerData'] ) && $this->_tpl_vars['careerData']['career_active'] == 1): ?>
		  <tr>
            <td class="left_col"><h4>View career on Site:</h4></td>
            <td>
				<a href="/careers/<?php echo $this->_tpl_vars['careerData']['section_urlName']; ?>
/details/<?php echo $this->_tpl_vars['careerData']['career_link']; ?>
/<?php echo $this->_tpl_vars['careerData']['career_url']; ?>
<?php echo $this->_tpl_vars['careerData']['pk_career_id']; ?>
/" target="_blank">View career On site</a>
          </tr>	
		<?php endif; ?>		  	  		  		  
		  <tr>
            <td class="left_col" valign="top" <?php if (isset ( $this->_tpl_vars['errorArray']['career_education'] )): ?>style="color: red"<?php endif; ?>><h4>Education:</h4></td>
            <td>
				<textarea name="career_education" id="career_education" style="width: 600px; height: 800px;"><?php echo $this->_tpl_vars['careerData']['career_education']; ?>
</textarea>
			</td>
          </tr>			  
        </table>
      </form>
	</div>
    <div class="clearer"><!-- --></div>
        <div class="mrg_top_10">
          <a href="/admin/resources/careers/" class="button cancel mrg_left_147 fl"><span>Cancel</span></a>
          <a href="javascript:submitForm();" class="blue_button mrg_left_20 fl"><span>Save &amp; Complete</span></a>   
        </div>
    <div class="clearer"><!-- --></div>
    </div><!--inner-->
 </div> 	
<!-- End Content career -->
 </div><!-- End Content career -->
 <?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'admin/includes/footer.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

</div>
<?php echo '
<script type="text/javascript" language="javascript">
function submitForm() {
	nicEditors.findEditor(\'career_education\').saveContent();
	document.forms.detailsForm.submit();					 
}

$(document).ready(function(){

		new nicEditor({
			iconsPath : \'/library/javascript/nicedit/nicEditorIcons.gif\',
			buttonList : [\'bold\',\'italic\',\'underline\',\'ol\',\'ul\',\'indent\',\'outdent\',\'center\', \'right\',\'left\',\'upload\',\'link\',\'unlink\',\'fontFormat\',\'xhtml\'],
			maxHeight : \'800\'
		}).panelInstance(\'career_education\');			
});

</script>
'; ?>

<!-- End Main Container -->
</body>
</html>