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
            <li class="active"><a href="#" title="Details">Details</a></li>
			<li><a href="/admin/users/jobSeekers/cv.php?jobSeeker_reference={$jobSeekerData.jobSeeker_reference}" title="Details">CV's</a></li>
        </ul>
    </div><!--tabs-->

	<div class="detail_box">
      <form id="detailsForm" name="detailsForm" action="/admin/users/jobSeekers/details.php?reference={$jobSeekerData.jobSeeker_reference}" method="post">
        <table width="700" border="0" align="center" cellpadding="0" cellspacing="0" class="form">
           <tr>
            <td class="left_col"><h4>jobSeeker Active?</h4></td>
            <td><input type="checkbox" name="jobSeeker_active" id="jobSeeker_active" value="1" {if $jobSeekerData.jobSeeker_active eq 1} checked="checked" {/if} /></td>
          </tr>
          <tr>
            <td><h4>Added:</h4></td>
            <td>{$jobSeekerData.jobSeeker_added|date_format}</td>
          </tr>	
          <tr>
            <td><h4>Updated:</h4></td>
            <td>{$jobSeekerData.jobSeeker_updated|date_format}</td>
          </tr>	
          <tr>
            <td><h4>Last login:</h4></td>
            <td>{$jobSeekerData.jobSeeker_lastLogin|date_format}</td>
          </tr>			  
          <tr>
            <td><h4>Full Name:</h4></td>
            <td>{$jobSeekerData.jobSeeker_name} {$jobSeekerData.jobSeeker_surname}</td>
          </tr>
          <tr>
            <td><h4>Email:</h4></td>
             <td>{$jobSeekerData.jobSeeker_email}</td>
          </tr>          
           <tr>
            <td class="left_col"><h4>Password:</h4></td>
             <td>{$jobSeekerData.jobSeeker_password}</td>
          </tr>	 
           <tr>
            <td class="left_col"><h4>Area:</h4></td>
             <td>{$jobSeekerData.areaMap_path}</td>
          </tr>	
           <tr>
            <td class="left_col"><h4>Facebook Link:</h4></td>
             <td><a href="{$jobSeekerData.fb_user_link}" target="_blank">{$jobSeekerData.fb_user_link}</a></td>
          </tr>	
           <tr>
            <td class="left_col"><h4>Twitter Link:</h4></td>
             <td><a href="{$jobSeekerData.twitter_link}" target="_blank">{$jobSeekerData.twitter_link}</a></td>
          </tr>			  
           <tr>
            <td class="left_col"><h4>Message user:</h4></td>
             <td><textarea cols="50" rows="10" id="jobSeeker_message" name="jobSeeker_message"></textarea></td>
          </tr>	
           <tr>
				<td  colspan="2" class="left_col">
					<a href="javascript: document.forms.detailsForm.submit();" title="Send Mail" class="blue_button fr mrg_bot_10">
						<span style="float:right;">Send Mail</span>
					</a>
				</td>
          </tr>	
	  	  {if isset($success)}
		  <tr>
            <td colspan="2" class="left_col"><span style="color: green;">Your email has been sent.</span></td>
          </tr>	
		  {/if}
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
