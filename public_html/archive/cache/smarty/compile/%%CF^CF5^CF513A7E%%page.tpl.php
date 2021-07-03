<?php /* Smarty version 2.6.20, created on 2014-09-18 11:21:37
         compiled from admin/jobs/view/page.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $this->_tpl_vars['siteName']; ?>
 | Resources | jobs | Page Details<?php if (isset ( $this->_tpl_vars['jobData']['pk_job_id'] )): ?>Edit job<?php else: ?>Add a job<?php endif; ?></title>
<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'admin/includes/css.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'admin/includes/javascript.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

<script type="text/javascript" language="javascript" src="/library/javascript/nicedit/nicEdit.js"></script>
</head>
<body>
<!-- Start Main Container -->
<div id="container">
    <!-- Start Content job -->
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
			<li><a href="/admin/jobs/view/" title="jobs">jobs</a></li>
			<li><?php if (isset ( $this->_tpl_vars['jobData']['pk_job_id'] )): ?>Edit job<?php else: ?>Add a job<?php endif; ?></li>
        </ul>
	</div><!--breadcrumb--> 
  
	<div class="inner"> 
      <h2><?php if (isset ( $this->_tpl_vars['jobData']['pk_job_id'] )): ?>Edit job: <?php echo $this->_tpl_vars['jobData']['job_name']; ?>
<?php else: ?>Add a new job<?php endif; ?></h2>
    <div id="sidetabs">
        <ul > 
            <li><a href="/admin/jobs/view/details.php?pk_job_id=<?php echo $this->_tpl_vars['jobData']['pk_job_id']; ?>
" title="Details">Details</a></li>
			<li class="active"><a href="#" title="Details">Page</a></li>
        </ul>
    </div><!--tabs-->

	<div class="detail_box">
      <form id="pageForm" name="pageForm" action="/admin/jobs/view/page.php<?php if (isset ( $this->_tpl_vars['jobData']['pk_job_id'] )): ?>?pk_job_id=<?php echo $this->_tpl_vars['jobData']['pk_job_id']; ?>
<?php endif; ?>" method="post">
        <table width="700" border="0" align="center" cellpadding="0" cellspacing="0" class="form">
           <tr>
            <td class="left_col"><h4>job Active?</h4></td>
            <td><input type="checkbox" name="job_active" id="job_active" value="1" <?php if ($this->_tpl_vars['jobData']['job_active'] == 1): ?> checked="checked" <?php endif; ?> /></td>
          </tr>	  	  
          <tr>
            <td class="left_col"><h4>View Job on Site:</h4></td>
            <td>
				<a href="/jobs/search/<?php echo $this->_tpl_vars['jobData']['section_urlName']; ?>
/details/<?php echo $this->_tpl_vars['jobData']['job_link']; ?>
/<?php echo $this->_tpl_vars['jobData']['job_reference']; ?>
/" target="_blank">View job On site</a>
          </tr>	
		  <tr>
            <td class="left_col"><h4>View Job on Site:</h4></td>
            <td>
				<textarea name="job_page" id="job_page" style="width: 450px; height: 700px;"><?php echo $this->_tpl_vars['jobData']['job_page']; ?>
</textarea>
          </tr>	
		  
        </table>
      </form>
	</div>
    <div class="clearer"><!-- --></div>
        <div class="mrg_top_10">
          <a href="/admin/resources/jobs/" class="button cancel mrg_left_147 fl"><span>Cancel</span></a>
          <a href="javascript:submitForm();" class="blue_button mrg_left_20 fl"><span>Save &amp; Complete</span></a>   
        </div>
    <div class="clearer"><!-- --></div>
    </div><!--inner-->
 </div> 	
<!-- End Content job -->
 </div><!-- End Content job -->
 <?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'admin/includes/footer.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

</div>
<?php echo '
<script type="text/javascript" language="javascript">
function submitForm() {
	nicEditors.findEditor(\'job_page\').saveContent();
	document.forms.pageForm.submit();					 
}
$(document).ready(function(){
		new nicEditor({
			iconsPath : \'/library/javascript/nicedit/nicEditorIcons.gif\',
			maxHeight : \'800\'
		}).panelInstance(\'job_page\');
});
</script>
'; ?>

<!-- End Main Container -->
</body>
</html>