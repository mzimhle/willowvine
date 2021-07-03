<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>{$siteName} | Users | jobSeekers</title>
{include_php file='admin/includes/css.php'}
{include_php file='admin/includes/javascript.php'}
<script type="text/javascript" language="javascript" src="default.js"></script>
</head>

<body>
<!-- Start Main Container -->
<div id="container">
    <!-- Start Content Section -->
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
            <li><a href="/admin/users/" title="Users">Users</a></li>
			<li><a href="/admin/users/jobSeekers/" title="Users">jobSeekers</a></li>
        </ul>
	</div><!--breadcrumb-->  
	<div class="inner">     
    <h2>Manage jobSeekers</h2>		
	<h4>Manage all the jobSeekers in the database, view and edit them at will.</h4><br /><br />
    <div class="clearer"><!-- --></div>
    <div id="tableContent" align="center">
	<!-- Start Content Table -->
	<div class="content_table">
		<form name="listForm" id="listForm" action="#" method="post">		
		<table id="dataTable" border="0" cellspacing="0" cellpadding="0">
		  <thead>
			<th>Added</th>
			<th>name</th>
			<th>Area</th>
			 <th>email</th>
			 <th>last login</th>
			<th>active</th>
		   </thead>
		   <tbody>
		  {foreach from=$jobSeekerData item=item}
		  <tr>
			<td>{$item.jobSeeker_added|date_format}</td>
			<td align="left"><a href="/admin/users/jobSeekers/details.php?reference={$item.jobSeeker_reference}" class="view_icon">{$item.jobSeeker_name} {$item.jobSeeker_surname}</a></td>
			<td align="left">{$item.areaMap_path}</td>
			<td align="left">{$item.jobSeeker_email}</td>
			<td align="left">{$item.jobSeeker_lastLogin|date_format}</td>
			<td align="left">{if $item.jobSeeker_active eq 1}<span style="color: green;">Active</span>{else}<span style="color: red;">Not Active</span>{/if}</td>
		   </tr>
		  {/foreach}
		  </tbody>
		</table>
		 </form>
	 </div>
	 <!-- End Content Table -->
      <div class="clear"></div>	
	</div>
    <div class="clearer"><!-- --></div>
    </div><!--inner-->
  </div><!-- End Content Section -->
 {include_php file='admin/includes/footer.php'}
</div>
<!-- End Main Container -->
</body>
</html>
