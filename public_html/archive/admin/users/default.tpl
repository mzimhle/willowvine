<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>{$siteName} | Home | Users</title>

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
            <li><a href="/admin/users/" title="users">users</a></li>
        </ul>
	</div><!--breadcrumb-->  
  <div class="inner">  
   <h2>Manage users</h2>	
	  <p>Welcome back {$admin.administrator_name|capitalize} {$admin.administrator_surname|capitalize}! Please select one of the options below to proceed.</p>
	  <div class="section">
		<a href="/admin/users/jobSeekers/" title="Manage jobSeekers"><img src="/admin/images/users.gif" alt="Manage jobSeekers" height="50" width="50" /></a>
		<a href="/admin/users/jobSeekers/" title="Manage jobSeekers" class="title">Manage JobSeekers</a>
	  </div>
	  <!--
	  <div class="section mrg_left_50">
		<a href="/admin/users/recruiters/" title="Manage recruiters"><img src="/admin/images/users.gif" alt="Manage recruiters" height="50" width="50" /></a>
		<a href="/admin/users/recruiters/" title="Manage recruiters" class="title">Manage Recruiters</a>
	  </div>
	  -->
	  <div class="clearer"><!-- --></div> 
    </div><!--inner-->
  	
    
  </div><!-- End Content Section -->
	
 {include_php file='admin/includes/footer.php'}


</div>
<!-- End Main Container -->
</body>
</html>
