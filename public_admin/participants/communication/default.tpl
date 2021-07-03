<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Participants</title>
{include_php file='includes/css.php'}
{include_php file='includes/javascript.php'}
<script type="text/javascript" language="javascript" src="default.js"></script>
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
            <li><a href="/participants/" title="Participants">Participants</a></li>
			<li><a href="/participants/communication/" title="Communication">Communication</a></li>
        </ul>
	</div><!--breadcrumb-->  
	<div class="inner">     
    <h2>Manage Communication</h2>		
    <div class="clearer"><!-- --></div>
	<!-- Start Content Table -->
	<div class="content_table">
		<form name="listForm" id="listForm" action="#" method="post">		
			<table id="dataTable" border="0" cellspacing="0" cellpadding="0">
			  <thead>
					<th>Sent</th>
					<th>Participant</th>
					<th>Email</th>
					<th>Type</th>
					<th>Subject</th>
					<th></th>
					<th></th>
			   </thead>
			   <tbody>
			  {foreach from=$participantData item=item}
			  <tr>
				<td align="left">{$item._comm_added|date_format}</td>
				<td align="left">{$item.participant_name} {$item.participant_surname}</td>
				<td align="left">{$item._comm_email}</td>
				<td align="left">{$item._comm_reference}</td>
				<td align="left">{$item._comm_name}</td>
				<td align="left">{$item._comm_output}</td>
				<td align="left"><a href="/mailer/view/{$item._comm_code}" class="{if $item._comm_sent eq 1}success{else}error{/if}" target="_blank">View</a></td>				
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
