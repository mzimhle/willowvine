<?php /* Smarty version 2.6.20, created on 2015-02-02 07:15:35
         compiled from careers/view/details.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'careers/view/details.tpl', 43, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Participants</title>
<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'includes/css.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'includes/javascript.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

<script type="text/javascript" language="javascript" src="/library/javascript/nicedit/nicEdit.js"></script>
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
            <li><a href="/careers/" title="Career">Career</a></li>
			<li><a href="/careers/view/" title="View">View</a></li>
        </ul>
	</div><!--breadcrumb--> 
	<div class="inner"> 
      <h2>Career Details</h2>
    <div id="sidetabs">
        <ul >
            <li class="active"><a href="#" title="Details">Details</a></li>
        </ul>
    </div>
	<div class="detail_box">
      <form id="detailsForm" name="detailsForm" action="/careers/view/details.php<?php if (isset ( $this->_tpl_vars['careerData']['career_code'] )): ?>?code=<?php echo $this->_tpl_vars['careerData']['career_code']; ?>
<?php endif; ?>" method="post">
        <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="form">
           <tr>
            <td>
				<h4 class="error">Name:</h4><br />
				<input type="text" name="career_name" id="career_name" value="<?php echo $this->_tpl_vars['careerData']['career_name']; ?>
" size="40"/>
				<?php if (isset ( $this->_tpl_vars['errorArray']['career_name'] )): ?><br /><span class="error"><?php echo $this->_tpl_vars['errorArray']['career_name']; ?>
</span><?php endif; ?>
			</td>
            <td>
				<h4 class="error">Category:</h4><br />
				<select id="category_code" name="category_code">
					<option value=""> ---- </option>
					<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['categoryPairs'],'selected' => $this->_tpl_vars['careerData']['category_code']), $this);?>

				</select>
				<?php if (isset ( $this->_tpl_vars['errorArray']['category_code'] )): ?><br /><span class="error"><?php echo $this->_tpl_vars['errorArray']['category_code']; ?>
</span><?php endif; ?>
			</td>		
          </tr>	
			<tr>
				<td colspan="2">
					<h4 class="error">Description:</h4><br />
					<textarea name="career_page" id="career_page" style="width: 850px; height: 400px;"><?php echo $this->_tpl_vars['careerData']['career_page']; ?>
</textarea>
					<?php if (isset ( $this->_tpl_vars['errorArray']['career_page'] )): ?><br /><span class="error"><?php echo $this->_tpl_vars['errorArray']['career_page']; ?>
</span><?php endif; ?>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<h4 class="error">Education:</h4><br />
					<textarea name="career_education" id="career_education" style="width: 850px; height: 400px;"><?php echo $this->_tpl_vars['careerData']['career_education']; ?>
</textarea>
					<?php if (isset ( $this->_tpl_vars['errorArray']['career_education'] )): ?><br /><span class="error"><?php echo $this->_tpl_vars['errorArray']['career_education']; ?>
</span><?php endif; ?>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<h4 class="error">Contact:</h4><br />
					<textarea name="career_contact" id="career_contact" style="width: 850px; height: 400px;"><?php echo $this->_tpl_vars['careerData']['career_contact']; ?>
</textarea>
					<?php if (isset ( $this->_tpl_vars['errorArray']['career_contact'] )): ?><br /><span class="error"><?php echo $this->_tpl_vars['errorArray']['career_contact']; ?>
</span><?php endif; ?>
				</td>
			</tr>			
        </table>
      </form>
    <div class="clearer"><!-- --></div>
        <div class="mrg_top_10">
          <a href="javascript:submitForm();" class="blue_button mrg_left_20 fl"><span>Save &amp; Complete</span></a>   
        </div>	
    <div class="clearer"><!-- --></div>	  
	</div>
    <div class="clearer"><!-- --></div>
    </div><!--inner-->
 </div> 	
<!-- End Content Section -->
 </div><!-- End Content Section -->
 <?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'includes/footer.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

</div>
<!-- End Main Container -->
<?php echo '
<script type="text/javascript" language="javascript">
function submitForm() {
	nicEditors.findEditor(\'career_page\').saveContent();
	nicEditors.findEditor(\'career_education\').saveContent();
	nicEditors.findEditor(\'career_contact\').saveContent();
	document.forms.detailsForm.submit();					 
}

$(document).ready(function(){
		new nicEditor({
			iconsPath : \'/library/javascript/nicedit/nicEditorIcons.gif\',
			maxHeight : \'800\'
		}).panelInstance(\'career_page\').panelInstance(\'career_education\').panelInstance(\'career_contact\');			
});
</script>
'; ?>

</body>
</html>