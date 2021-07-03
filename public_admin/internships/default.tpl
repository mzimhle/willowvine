<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Internship</title>
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
            <li><a href="/default.php" title="Home">Home</a></li>
            <li><a href="/internships/" title="Internships">Internships</a></li>
        </ul>
	</div><!--breadcrumb-->  
  <div class="inner">  
   <h2>Manage internships</h2>
	  <div class="section">
		<a href="/internships/view/" title="Manage Internships"><img src="/images/projects.gif" alt="Manage Internships" height="50" width="50" /></a>
		<a href="/internships/view/" title="Manage Internships" class="title">Manage Internships</a>
	  </div>
	  <div class="section mrg_left_50">
		<a href="/internships/share/" title="Manage Share"><img src="/images/users.gif" alt="Manage Share" height="50" width="50" /></a>
		<a href="/internships/share/" title="Manage Share" class="title">Manage Share</a>
	  </div>	  
	  <div class="clearer"><!-- --></div> 	  
    </div><!--inner-->
  </div><!-- End Content Section -->
 {include_php file='includes/footer.php'}
</div>
<!-- End Main Container -->
</body>
</html>
