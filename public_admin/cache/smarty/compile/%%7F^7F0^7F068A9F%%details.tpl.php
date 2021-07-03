<?php /* Smarty version 2.6.20, created on 2015-01-12 09:44:58
         compiled from administration/jobs/view/details.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'administration/jobs/view/details.tpl', 50, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Jobs</title>
<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'administration/includes/css.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'administration/includes/javascript.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

<script type="text/javascript" language="javascript" src="/library/javascript/nicedit/nicEdit.js"></script>
</head>
<body>
<!-- Start Main Container -->
<div id="container">
    <!-- Start Content job -->
  <div id="content">
    <?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'administration/includes/header.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

  	<br />
	<div id="breadcrumb">
        <ul>
            <li><a href="/administration/default.php" title="Home">Home</a></li>
			<li><a href="/administration/jobs/view/" title="jobs">Jobs</a></li>
			<li><?php if (isset ( $this->_tpl_vars['jobData']['job_code'] )): ?>Edit job<?php else: ?>Add a job<?php endif; ?></li>
        </ul>
	</div><!--breadcrumb--> 
  
	<div class="inner"> 
      <h2><?php if (isset ( $this->_tpl_vars['jobData']['job_code'] )): ?>Edit job: <?php echo $this->_tpl_vars['jobData']['job_name']; ?>
<?php else: ?>Add a new job<?php endif; ?></h2>
    <div id="sidetabs">
        <ul > 
            <li class="active"><a href="#" title="Details">Details</a></li>
        </ul>
    </div><!--tabs-->

	<div class="detail_box">
      <form id="detailsForm" name="detailsForm" action="/administration/jobs/view/details.php<?php if (isset ( $this->_tpl_vars['jobData']['job_code'] )): ?>?code=<?php echo $this->_tpl_vars['jobData']['job_code']; ?>
<?php endif; ?>" method="post">
        <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="form">
           <tr>
            <td>
				<h4>Active ?</h4><br />
				<input type="checkbox" name="job_active" id="job_active" value="1" <?php if ($this->_tpl_vars['jobData']['job_active'] == 1): ?> checked="checked" <?php endif; ?> />
			</td>
            <td>
				<h4 class="error">Title:</h4><br />
				<input type="text" name="job_title" id="job_title" value="<?php echo $this->_tpl_vars['jobData']['job_title']; ?>
" size="40"/>
				<?php if (isset ( $this->_tpl_vars['errorArray']['job_title'] )): ?><br /><span class="error"><?php echo $this->_tpl_vars['errorArray']['job_title']; ?>
</span><?php endif; ?>
			</td>
            <td>
				<h4 class="error">Category:</h4><br />
				<select id="category_code" name="category_code">
					<option value=""> ---- </option>
					<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['categoryPairs'],'selected' => $this->_tpl_vars['jobData']['category_code']), $this);?>

				</select>
				<?php if (isset ( $this->_tpl_vars['errorArray']['category_code'] )): ?><br /><span class="error"><?php echo $this->_tpl_vars['errorArray']['category_code']; ?>
</span><?php endif; ?>
			</td>			
          </tr>	
          <tr>
            <td>
				<h4 class="error">Job Type:</h4><br />
				<select name="job_type" id="job_type" class="frm">
					<option value="" <?php if ($this->_tpl_vars['jobData']['job_type'] == ''): ?>SELECTED<?php endif; ?>>- Employer type -</option>
					<option value="casual" <?php if ($this->_tpl_vars['jobData']['job_type'] == 'casual'): ?>SELECTED<?php endif; ?>>Casual</option>
					<option value="temp" <?php if ($this->_tpl_vars['jobData']['job_type'] == 'temp'): ?>SELECTED<?php endif; ?>>Temporary</option>
					<option value="contract" <?php if ($this->_tpl_vars['jobData']['job_type'] == 'contract'): ?>SELECTED<?php endif; ?>>Contract</option>
					<option value="parttime" <?php if ($this->_tpl_vars['jobData']['job_type'] == 'parttime'): ?>SELECTED<?php endif; ?>>Part-Time</option>
					<option value="permanent" <?php if ($this->_tpl_vars['jobData']['job_type'] == 'permanent'): ?>SELECTED<?php endif; ?>>Permanent</option>
					<option value="graduate" <?php if ($this->_tpl_vars['jobData']['job_type'] == 'graduate'): ?>SELECTED<?php endif; ?>>Graduate</option>
					<option value="internship" <?php if ($this->_tpl_vars['jobData']['job_type'] == 'internship'): ?>SELECTED<?php endif; ?>>Internship</option>
					<option value="volunteer" <?php if ($this->_tpl_vars['jobData']['job_type'] == 'volunteer'): ?>SELECTED<?php endif; ?>>Volunteer</option>
				</select>
				<?php if (isset ( $this->_tpl_vars['errorArray']['job_type'] )): ?><br /><span class="error"><?php echo $this->_tpl_vars['errorArray']['job_type']; ?>
</span><?php endif; ?>
			</td>
            <td colspan="2">
				<h4 class="error">Area:</h4><br />
				<input type="text" name="areapost_name" id="areapost_name" value="<?php echo $this->_tpl_vars['jobData']['areapost_name']; ?>
" size="60"/>
				<input type="hidden" name="areapost_code" id="areapost_code" value="<?php echo $this->_tpl_vars['jobData']['areapost_code']; ?>
" />
				<?php if (isset ( $this->_tpl_vars['errorArray']['areapost_code'] )): ?><br /><span class="error"><?php echo $this->_tpl_vars['errorArray']['areapost_code']; ?>
</span><?php endif; ?>
			</td>
          </tr>	
          <tr>
            <td>
				<h4 class="error">Posted By:</h4><br />
				<input type="text" name="job_poster_name" id="job_poster_name" value="<?php echo $this->_tpl_vars['jobData']['job_poster_name']; ?>
" size="40"/>
				<?php if (isset ( $this->_tpl_vars['errorArray']['job_poster_name'] )): ?><br /><span class="error"><?php echo $this->_tpl_vars['errorArray']['job_poster_name']; ?>
</span><?php endif; ?>
			</td>		  
            <td>
				<h4 class="error">Posted By Email:</h4><br />
				<input type="text" name="job_poster_email" id="job_poster_email" value="<?php echo $this->_tpl_vars['jobData']['job_poster_email']; ?>
" size="40"/>
				<?php if (isset ( $this->_tpl_vars['errorArray']['job_poster_email'] )): ?><br /><span class="error"><?php echo $this->_tpl_vars['errorArray']['job_poster_email']; ?>
</span><?php endif; ?>
			</td>
            <td>
				<h4>Posted By Number:</h4><br />
				<input type="text" name="job_poster_number" id="job_poster_number" value="<?php echo $this->_tpl_vars['jobData']['job_poster_number']; ?>
" size="40"/>
				<?php if (isset ( $this->_tpl_vars['errorArray']['job_poster_number'] )): ?><br /><span class="error"><?php echo $this->_tpl_vars['errorArray']['job_poster_number']; ?>
</span><?php endif; ?>
			</td>			
          </tr>		  
          <tr>
            <td>
				<h4>Reference:</h4><br />
				<input type="text" name="job_reference" id="job_reference" value="<?php echo $this->_tpl_vars['jobData']['job_reference']; ?>
" size="40"/>
			</td>		  
            <td colspan="2">
				<h4>Address:</h4><br />
				<input type="text" name="job_address" id="job_address" value="<?php echo $this->_tpl_vars['jobData']['job_address']; ?>
" size="80"/>
			</td>
          </tr>	
			<tr>
				<td colspan="3">
					<h4 class="error">Description:</h4><br />
					<textarea name="job_page" id="job_page" style="width: 850px; height: 700px;"><?php echo $this->_tpl_vars['jobData']['job_page']; ?>
</textarea>
					<?php if (isset ( $this->_tpl_vars['errorArray']['job_page'] )): ?><br /><span class="error"><?php echo $this->_tpl_vars['errorArray']['job_page']; ?>
</span><?php endif; ?>
				</td>
			</tr>			
        </table>
      </form>
	</div>
    <div class="clearer"><!-- --></div>
        <div class="mrg_top_10">
          <a href="/administration/resources/jobs/" class="button cancel mrg_left_147 fl"><span>Cancel</span></a>
          <a href="javascript:submitForm();" class="blue_button mrg_left_20 fl"><span>Save &amp; Complete</span></a>   
        </div>
    <div class="clearer"><!-- --></div>
    </div><!--inner-->
 </div> 	
<!-- End Content job -->
 </div><!-- End Content job -->
 <?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'administration/includes/footer.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

</div>
<?php echo '
<script type="text/javascript" language="javascript">
function submitForm() {
	nicEditors.findEditor(\'job_page\').saveContent();
	document.forms.detailsForm.submit();					 
}

$(document).ready(function(){
		new nicEditor({
			iconsPath : \'/library/javascript/nicedit/nicEditorIcons.gif\',
			maxHeight : \'800\'
		}).panelInstance(\'job_page\');
		
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