<?php /* Smarty version 2.6.20, created on 2014-12-03 18:43:36
         compiled from admin/resources/careers/details.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'admin/resources/careers/details.tpl', 82, false),)), $this); ?>
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
            <li class="active"><a href="#" title="Details">Details</a></li>
			<li><a href="<?php if (isset ( $this->_tpl_vars['careerData']['pk_career_id'] )): ?>/admin/resources/careers/education.php?pk_career_id=<?php echo $this->_tpl_vars['careerData']['pk_career_id']; ?>
<?php else: ?>#<?php endif; ?>" title="Education">Education</a></li>
			<li><a href="<?php if (isset ( $this->_tpl_vars['careerData']['pk_career_id'] )): ?>/admin/resources/careers/contact.php?pk_career_id=<?php echo $this->_tpl_vars['careerData']['pk_career_id']; ?>
<?php else: ?>#<?php endif; ?>" title="Contact">Contact</a></li>			
        </ul>
    </div><!--tabs-->

	<div class="detail_box">
      <form id="detailsForm" name="detailsForm" action="/admin/resources/careers/details.php<?php if (isset ( $this->_tpl_vars['careerData']['pk_career_id'] )): ?>?pk_career_id=<?php echo $this->_tpl_vars['careerData']['pk_career_id']; ?>
<?php endif; ?>" method="post">
        <?php if (isset ( $this->_tpl_vars['careerData']['pk_career_id'] )): ?><input type="hidden" name="pk_career_id" id="pk_career_id" value="<?php echo $this->_tpl_vars['careerData']['pk_career_id']; ?>
" /><?php endif; ?>
		<table width="700" border="0" align="center" cellpadding="0" cellspacing="0" class="form">
          <?php if (isset ( $this->_tpl_vars['careerData'] ) && $this->_tpl_vars['careerData']['career_active'] == 1): ?>
		  <tr>
            <td class="left_col"><h4>View career on Site:</h4></td>
            <td>
				<a href="/careers/<?php echo $this->_tpl_vars['careerData']['section_urlName']; ?>
/details/<?php echo $this->_tpl_vars['careerData']['career_link']; ?>
/<?php echo $this->_tpl_vars['careerData']['pk_career_id']; ?>
/" target="_blank">View career On site</a>
          </tr>	
		<?php endif; ?>		  
           <tr>
            <td class="left_col"><h4>Career Active?</h4></td>
            <td><input type="checkbox" name="career_active" id="career_active" value="1" <?php if ($this->_tpl_vars['careerData']['career_active'] == 1): ?> checked="checked" <?php endif; ?> /></td>
          </tr>	 
		<?php if (isset ( $this->_tpl_vars['careerData']['career_added'] )): ?>		  
          <tr>
            <td class="left_col"><h4>Career Added:</h4></td>
			<td><?php echo $this->_tpl_vars['careerData']['career_added']; ?>
</td>
          </tr>
		<?php endif; ?>		  
          <tr>
            <td class="left_col" <?php if (isset ( $this->_tpl_vars['errorArray']['career_title'] )): ?>style="color: red"<?php endif; ?>><h4>Career title:</h4></td>
			<td><input type="text" name="career_title" id="career_title" value="<?php echo $this->_tpl_vars['careerData']['career_title']; ?>
" size="60"/></td>
          </tr>	
          <tr>
            <td class="left_col"><h4>External link:</h4></td>
			<td><input type="text" name="career_extLink" id="career_extLink" value="<?php echo $this->_tpl_vars['careerData']['career_extLink']; ?>
" size="60"/></td>
          </tr>			  
		<?php if (isset ( $this->_tpl_vars['careerData']['career_link'] )): ?>		  
          <tr>
            <td class="left_col"><h4>career Url Name:</h4></td>
            <td><?php echo $this->_tpl_vars['careerData']['career_link']; ?>
</td>
          </tr>		
		<?php endif; ?>		  
          <tr>
            <td class="left_col" <?php if (isset ( $this->_tpl_vars['errorArray']['fk_section_id'] )): ?>style="color: red"<?php endif; ?>><h4>Section:</h4></td>
            <td>
				<select id="fk_section_id" name="fk_section_id">
					<option value=""> ---- </option>
					<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['sectionPairs'],'selected' => $this->_tpl_vars['careerData']['fk_section_id']), $this);?>
</td>
				</select>
			</td>
          </tr>	
		  <tr>
            <td class="left_col" valign="top" <?php if (isset ( $this->_tpl_vars['errorArray']['career_page'] )): ?>style="color: red"<?php endif; ?>><h4>Page:</h4></td>
            <td>
				<textarea name="career_page" id="career_page" style="width: 450px; height: 800px;"><?php echo $this->_tpl_vars['careerData']['career_page']; ?>
</textarea>
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
	nicEditors.findEditor(\'career_page\').saveContent();
	document.forms.detailsForm.submit();					 
}

$(document).ready(function(){

		new nicEditor({
			iconsPath : \'/library/javascript/nicedit/nicEditorIcons.gif\',
			buttonList : [\'bold\',\'italic\',\'underline\',\'ol\',\'ul\',\'indent\',\'outdent\',\'center\', \'right\',\'left\',\'upload\',\'link\',\'unlink\',\'fontFormat\',\'xhtml\'],
			maxHeight : \'800\'
		}).panelInstance(\'career_page\');			
});

</script>
'; ?>

<!-- End Main Container -->
</body>
</html>