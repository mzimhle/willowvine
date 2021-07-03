<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Resources</title>
{include_php file='includes/css.php'}
{include_php file='includes/javascript.php'} 
</head>
<body>
<!-- Start Main Container -->
<div id="container">
    <!-- Start Content Section -->
  <div id="content">
    {include_php file='includes/header.php'}
		<div id="breadcrumb">
        <ul>
            <li><a href="/" title="Home">Home</a></li>
            <li><a href="/resources/" title="Resources">Resources</a></li>
        </ul>
	</div><!--breadcrumb-->  
  <div class="inner">  
   <h2>Manage Resources</h2>	
	  <div class="section">
		<a href="/resources/category/" title="Manage Category"><img src="/images/users.gif" alt="Manage Categories" height="50" width="50" /></a>
		<a href="/resources/category/" title="Manage Category" class="title">Manage Categories</a>
	  </div>	
	  <div class="section mrg_left_50">
		<a href="/resources/recruiters/" title="Manage Recruiters"><img src="/images/users.gif" alt="Manage Recruiters" height="50" width="50" /></a>
		<a href="/resources/recruiters/" title="Manage Recruiters" class="title">Manage Recruiters</a>
	  </div>
	  <div class="section mrg_left_50">
		<a href="/resources/spam/" title="Manage Spam"><img src="/images/users.gif" alt="Manage Spam" height="50" width="50" /></a>
		<a href="/resources/spam/" title="Manage Spam" class="title">Manage Spam</a>
	  </div>	  
	  <div class="clearer"><!-- --></div> 	  
    </div><!--inner-->
  </div><!-- End Content Section -->
 {include_php file='includes/footer.php'}
</div>
<!-- End Main Container -->
</body>
</html>
