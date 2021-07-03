<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Job Applications</title>
{include_php file='includes/css.php'}
{include_php file='includes/javascript.php'}
<script type="text/javascript" language="javascript" src="/jobs/application/default.js"></script>
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
            <li><a href="/jobs/" title="Jobs">Jobs</a></li>
			<li><a href="/jobs/applications/" title="Job Applications">Job Applications</a></li>
        </ul>
	</div><!--breadcrumb-->  
	<div class="inner">     
    <h2>Manage Job Applications</h2>
	<!-- Start Content Table -->
	<div class="content_table">
		<form name="enquiriesForm" id="enquiriesForm" action="#" method="post">
		<table id="dataTable" border="0" cellspacing="0" cellpadding="0">
		  <thead>
			<tr>
			<th>Added</th>
			<th>Name</th>
			<th>Job Title</th>
			 <th>Applicant Email</th>
			 <th>Job Email</th>
			 <th>Mail</th>
			 </tr>
		   </thead>
		   </tbody>
		  {foreach from=$enquiryData item=item}
		  <tr>
			<td>{$item.enquiry_added|date_format}</td>
			<td align="left"><a href="/jobs/application/details.php?code={$item.enquiry_code}">{$item.enquiry_name}</a></td>
			<td align="left">{$item.job_title}</td>
			<td align="left">{$item.enquiry_email}</td>
			<td align="left">{$item.job_poster_email}</td>
			<td align="left"><a href="/mailer/view/{$item._comm_code}" target="_blank" class="{if $item._comm_sent eq 1}success{else}error{/if}">{$item._comm_output}</a></td>
		   </tr>
		  {/foreach}
		  </tbody>
		</table>
		 </form>
	 </div>
	<!-- End Content Table -->
      <div class="clear"></div>
    <div class="clearer"><!-- --></div>
    </div><!--inner-->
  </div><!-- End Content Section -->
 {include_php file='includes/footer.php'}
</div>
<!-- End Main Container -->
</body>
</html>
