<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>{$siteName} | Emails</title>
{include_php file='admin/includes/css.php'}
{include_php file='admin/includes/javascript.php'}
<script type="text/javascript" language="javascript" src="/admin/resources/emails/search/default.js"></script>
</head>

<body>
<!-- Start Main Container -->
<div id="container">
    <!-- Start Content Email -->
  <div id="content">
    {include_php file='admin/includes/header.php'}
	<div class="logged_in">
            <ul>
                <li><a href="/admin/help/enquiries.php" title="Get Help" class="help_icon"> Help</a></li>
                <li>|<a href="/admin/logout.php" title="Logout">Logout</a></li>
            </ul>
        </div><!--logged_in-->
	<div id="breadcrumb">
        <ul>
            <li><a href="/admin/default.php" title="Home">Home</a></li>
			<li><a href="/admin/resources/" title="Jobs">Resources</a></li>
			<li><a href="/admin/resources/emails/" title="Jobs">Emails</a></li>
			<li><a href="/admin/resources/emails/search/" title="Jobs">Search Emails</a></li>
        </ul>
	</div><!--breadcrumb-->  
	<div class="inner">     
    <h2>Manage Search Emails</h2>
	<p>Select email and add accordingly. </p>	
	<form action="/admin/resources/emails/search/" method="post" enctype="multipart/form-data" name="fetchEmailForm" id="fetchEmailForm">
		<span class="fl"><input type="file" name="searchFile" id="searchFile" /></span>
		<a href="javascript:void(0)" onclick="document.forms.fetchEmailForm.submit();" title="Click to Add Emails" class="blue_button fr mrg_bot_10"><span style="float:right;">Add Emails</span></a> <br />	
	</form>	
    <div class="clearer"><!-- --></div>
    <div id="tableContent" align="center"><img align="middle" src="/admin/images/ajax-loader.gif" alt="loading" /></div>
    <div class="clearer"><!-- --></div>
    </div><!--inner-->
  </div><!-- End Content Section -->
 {include_php file='admin/includes/footer.php'}
</div>
<!-- End Main Container -->
</body>
</html>
