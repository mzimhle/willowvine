<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>{$siteName} | Users | jobApplication |  View details</title>
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
            <li><a href="/admin/help/jobApplications.php" title="Get Help" class="help_icon"> Help</a></li>
            <li>|<a href="/admin/logout.php" title="Logout">Logout</a></li>
        </ul>
    </div><!--logged_in-->
  	<br />
	<div id="breadcrumb">
        <ul>
            <li><a href="/admin/default.php" title="Home">Home</a></li>
            <li><a href="/admin/users/" title="Users">Users</a></li>
			<li><a href="/admin/users/jobApplication/" title="jobApplications">jobApplication</a></li>
			<li><a href="#" title="jobApplications">View jobApplication</a></li>
        </ul>
	</div><!--breadcrumb--> 
  
	<div class="inner"> 
      <h2>Edit jobApplication: {$jobApplicationData.jobApplication_name}</h2>
    <div id="sidetabs">
        <ul >
            <li class="active"><a href="#" title="Details">Details</a></li>			
        </ul>
    </div><!--tabs-->

	<div class="detail_box">
      <form id="detailsForm" name="detailsForm" action="#" method="post">
        <table width="700" border="0" align="center" cellpadding="0" cellspacing="0" class="form">
           <tr>
            <td class="left_col"><h4>jobApplication Active?</h4></td>
            <td><input type="checkbox" name="jobApplication_active" id="jobApplication_active" value="1" {if $jobApplicationData.jobApplication_active eq 1} checked="checked" {/if} /></td>
          </tr>
          <tr>
            <td><h4>Added:</h4></td>
            <td>{$jobApplicationData.jobApplication_added|date_format}</td>
          </tr>	
          <tr>
            <td><h4>Job Title:</h4></td>
            <td>{$jobApplicationData.job_title}</td>
          </tr>			  
          <tr>
            <td><h4>Job By:</h4></td>
            <td>{$jobApplicationData.job_poster_name}</td>
          </tr>
          <tr>
            <td><h4>Job Email:</h4></td>
            <td>{$jobApplicationData.job_poster_email}</td>
          </tr>	
          <tr>
            <td><h4>Job Location:</h4></td>
             <td>{$jobApplicationData.job_area}</td>
          </tr> 		  
          <tr>
            <td><h4>Email:</h4></td>
             <td>{$jobApplicationData.jobApplication_email}</td>
          </tr>          
           <tr>
            <td class="left_col"><h4>Message:</h4></td>
             <td>{$jobApplicationData.jobApplication_comments}</td>
          </tr>	 	
           <tr>
            <td class="left_col"><h4>Download CV:</h4></td>
             <td><a href="{$jobApplicationData.jobApplication_pathToCV}" target="_blank">{$jobApplicationData.jobApplication_userFilename}</a></td>
          </tr>	 			  		  
        </table>
      </form>
	</div>
    <div class="clearer"><!-- --></div>
    </div><!--inner-->
 </div> 	
<!-- End Content Section -->
 </div><!-- End Content Section -->
 {include_php file='admin/includes/footer.php'}
</div>
<!-- End Main Container -->
</body>
</html>
