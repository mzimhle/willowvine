<?php /* Smarty version 2.6.20, created on 2013-10-09 15:37:56
         compiled from admin/jobs/scrape/jobspace/default.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'admin/jobs/scrape/jobspace/default.tpl', 50, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $this->_tpl_vars['siteName']; ?>
 | Jobs | Scrape | Job Space</title>
<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'admin/includes/css.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'admin/includes/javascript.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

<script type="text/javascript" language="javascript" src="/admin/jobs/scrape/jobspace/default.js"></script>
</head>

<body>
<!-- Start Main Container -->
<div id="container">
    <!-- Start Content Section -->
  <div id="content">
    <?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'admin/includes/header.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

	<div class="logged_in">
            <ul>
                <li><a href="/admin/help/enquiries.php" title="Get Help" class="help_icon"> Help</a></li>
                <li>|<a href="/admin/logout.php" title="Logout">Logout</a></li>
            </ul>
        </div><!--logged_in-->
	<div id="breadcrumb">
        <ul>
            <li><a href="/admin/" title="Home">Home</a></li>
            <li><a href="/admin/jobs/" title="Resources">Jobs</a></li>
			<li><a href="/admin/jobs/scrape/" title="Jobs">Scrape</a></li>
			<li><a href="/admin/jobs/scrape/jobspace/" title="Jobs">Job Space</a></li>
        </ul>
	</div><!--breadcrumb-->  
	<div class="inner">     
    <h2>Job Space Jobs</h2>
    <div class="clearer"><!-- --></div>
	<p>Link: <b>http://www.jobspace.co.za/</b></p>
    <div id="tableContent" align="center">
<!-- Start Content Table -->
<div class="content_table">
    <form name="enquiriesForm" id="enquiriesForm" action="/admin/sections/sectionsHtml.php" method="post">
    
    <table id="grid_table" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <th>Link</th>
		<th>Page</th>	
		<th>Section</th>
		<th>Get Jobs</th>
       </tr>     
      <tr>	
		<td align="left"><input type="text" size="60" id="link" name="link" /></td>
		<td align="left"><input type="text" size="3" id="page" name="page" /></td>
		<td align="left"><?php echo smarty_function_html_options(array('name' => 'sectionId','id' => 'sectionId','options' => $this->_tpl_vars['sectionPairs']), $this);?>
</td>		
        <td><a class="button" href="javascript: getJobSpaceJobs();"><span>Get Jobs</span></a></td>
       </tr>
    </table>
     </form>
 </div>
 <!-- End Content Table -->
<div class="clear"></div>
	</div>
    <div class="clearer"><!-- --></div>
    </div><!--inner-->
  </div><!-- End Content Section -->
 <?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'admin/includes/footer.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

</div>
<!-- End Main Container -->
</body>
</html>