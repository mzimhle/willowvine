<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>{$siteName} | Users | jobSeeker |  View details</title>
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
            <li><a href="/admin/help/jobSeekers.php" title="Get Help" class="help_icon"> Help</a></li>
            <li>|<a href="/admin/logout.php" title="Logout">Logout</a></li>
        </ul>
    </div><!--logged_in-->
  	<br />
	<div id="breadcrumb">
        <ul>
            <li><a href="/admin/default.php" title="Home">Home</a></li>
            <li><a href="/admin/users/" title="Users">Users</a></li>
			<li><a href="/admin/users/jobSeekers/" title="jobSeekers">jobSeeker</a></li>
			<li><a href="#" title="jobSeekers">View jobSeeker</a></li>
        </ul>
	</div><!--breadcrumb--> 
  
	<div class="inner"> 
      <h2>Edit jobSeeker: {$jobSeekerData.jobSeeker_name} {$jobSeekerData.jobSeeker_surname}</h2>
    <div id="sidetabs">
        <ul >
            <li><a href="/admin/users/jobSeekers/details.php?reference={$jobSeekerData.jobSeeker_reference}" title="Details">Details</a></li>
			<li class="active"><a href="#" title="Details">CV's</a></li>
        </ul>
    </div><!--tabs-->

	<div class="detail_box">
      <form id="detailsForm" name="detailsForm" action="#" method="post">
        <table width="700" border="0" align="center" cellpadding="0" cellspacing="0" class="form">
		 <tr>
			<td>added</td>
			<td>file name</td>
			<td>download file</td>
		   </tr>		 
          <tr>
		 {foreach from=$jobSeekerCVData item=item}
            <td align="left">{$item.jobSeekerCV_added}</td>
			<td align="left">{$item.jobSeekerCV_userName}</td>
			<td align="left"><a href="/media/jobSeeker/cv/{$jobSeekerData.jobSeeker_reference}/{$item.jobSeekerCV_filename}" target="_blank">{$item.jobSeekerCV_filename}</a></td>
          </tr>			  
		  {foreachelse}
          <tr>
            <td><h4>No CV'S uploaded.</h4></td>        
          </tr>				  
		  {/foreach}
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
