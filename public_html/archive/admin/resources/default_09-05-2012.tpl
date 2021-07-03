<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>{$siteName} | Home | Resources</title>

{include_php file='admin/includes/css.php'}
{include_php file='admin/includes/javascript.php'} 

</head>

<body>
<!-- Start Main Container -->
<div id="container">

    <!-- Start Content Section -->
  <div id="content">
    {include_php file='admin/includes/header.php'}
    <div class="logged_in">
        <ul>
            <li><a href="/admin/help/" title="Get Help" class="help_icon"> Help</a></li>
            <li>|<a href="/admin/logout.php" title="Logout">Logout</a></li>
        </ul>
    </div><!--logged_in-->
  	<br />
		<div id="breadcrumb">
        <ul>
            <li><a href="/admin/default.php" title="Home">Home</a></li>
            <li><a href="/admin/resources/" title="Resources">Resources</a></li>
        </ul>
	</div><!--breadcrumb-->  
  <div class="inner">  
   <h2>Manage Resources</h2>	
	  <p>Welcome back {$admin.administrator_name|capitalize} {$admin.administrator_surname|capitalize}! Please select one of the options below to proceed.</p>
	  <div class="section">
		<a href="/admin/resources/areas/" title="Manage Areas"><img src="/admin/images/users.gif" alt="Manage Areas" height="50" width="50" /></a>
		<a href="/admin/resources/areas/" title="Manage Areas" class="title">Manage Areas</a>
	  </div>
	  <div class="section mrg_left_50">
		<a href="/admin/resources/scrape/" title="Manage Scraping"><img src="/admin/images/users.gif" alt="Manage Website Scraping" height="50" width="50" /></a>
		<a href="/admin/resources/scrape/" title="Manage Scraping" class="title">Manage Website Scraping</a>
	  </div>
	  <div class="clearer"><!-- --></div> 
    </div><!--inner-->
  	
    
  </div><!-- End Content Section -->
	
 {include_php file='admin/includes/footer.php'}


</div>
<!-- End Main Container -->
</body>
</html>
