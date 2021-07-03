<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>WillowVine | Home | Admin</title>

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
  <div class="inner">  
   <h2>WillowVine Content Management System</h2>	
  <p>Welcome back {$admin.administrator_name|capitalize} {$admin.administrator_surname|capitalize}! Please select one of the options below to proceed.   </p>
  <div class="section">
  	<a href="/admin/jobs/" title="Manage Jobs"><img src="/admin/images/users.gif" alt="Manage Jobs" height="50" width="50" /></a>
  	<a href="/admin/jobs/" title="Manage Jobs" class="title">Manage Jobs</a>
  </div>
  
  <div class="section mrg_left_50">
  	<a href="/admin/users/" title="Manage Users"><img src="/admin/images/projects.gif" alt="Manage Users" height="50" width="50" /></a>
  	<a href="/admin/users/" title="Manage Users" class="title">Manage Users</a>
  </div>
  
  <div class="clearer"><!-- --></div>
  <div class="section">
  	<a href="/admin/sections/" title="Manage sections"><img src="/admin/images/users.gif" alt="Manage sections" height="50" width="50" /></a>
  	<a href="/admin/sections/" title="Manage sections" class="title">Manage sections</a>
  </div>
  
  <div class="section mrg_left_50">
  	<a href="/admin/enquiries/" title="Manage Enquiries"><img src="/admin/images/projects.gif" alt="Manage Enquiries" height="50" width="50" /></a>
  	<a href="/admin/enquiries/" title="Manage Enquiries" class="title">Manage Enquiries</a>
  </div>  
  
   <div class="clearer"><!-- --></div>
  <div class="section">
  	<a href="/admin/resources/" title="Manage Resources"><img src="/admin/images/users.gif" alt="Manage Resources" height="50" width="50" /></a>
  	<a href="/admin/resources/" title="Manage Resources" class="title">Manage Resources</a>
  </div>
  <div class="clearer"><!-- --></div>
    </div><!--inner-->
  	
    
  </div><!-- End Content Section -->
	
 {include_php file='admin/includes/footer.php'}


</div>
<!-- End Main Container -->
</body>
</html>
