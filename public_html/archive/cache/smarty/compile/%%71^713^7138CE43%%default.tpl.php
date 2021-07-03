<?php /* Smarty version 2.6.20, created on 2014-12-17 19:26:41
         compiled from admin/jobs/scrape/merge/default.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $this->_tpl_vars['siteName']; ?>
 | Jobs | Scrape | Merge</title>
<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'admin/includes/css.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'admin/includes/javascript.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

<script type="text/javascript" language="javascript" src="/admin/jobs/scrape/merge/default.js"></script>
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
			<li><a href="/admin/jobs/scrape/merge/" title="Jobs">merge</a></li>
        </ul>
	</div><!--breadcrumb-->  
	<div class="inner">     
    <h2>merge Jobs</h2>
    <div class="clearer"><!-- --></div>
    <div id="tableContent" align="center">
	
<!-- Start Content Table -->
<div class="content_table">
    <form name="enquiriesForm" id="enquiriesForm" action="/admin/sections/sectionsHtml.php" method="post">
    
    <table id="grid_table" border="0" cellspacing="0" cellpadding="0">
      <tr>
		<th>Category</th>
        <th>Page</th>
		<th>Get Jobs</th>
       </tr>     
      <tr>	
		<td align="left">
			<select id="category" name="category">
				<option value="48">Analysis / Consulting</option>
				<option value="54">Business Intelligence / Data Warehousing</option>
				<option value="53">C / C++</option>
				<option value="42">C# / Dot Net</option>
				<option value="59">Delphi Developers/Perl/Phyton</option>
				<option value="50">ERP Platforms</option>
				<option value="52">Integration</option>
				<option value="14">Java / J2ee</option>
				<option value="60">Oracle/SQL</option>
				<option value="38">Other Opportunities</option>
				<option value="58">PHP/Linux Developers</option>
				<option value="33">Project Management</option>
				<option value="55">Quality Assurance</option>
				<option value="57">RDBMS</option>
				<option value="49">SAP</option>
				<option value="56">Win / Unix Infrastructure and Support</option>
			</select>
		</td>
		<td align="left"><input type="text" size="3" id="page" name="page" /></td>
        <td><a class="button" href="javascript: getmergeJobs();"><span>Get Jobs</span></a></td>
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