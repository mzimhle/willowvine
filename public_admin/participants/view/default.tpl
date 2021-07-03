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
            <li><a href="/default.php" title="Home">Home</a></li>
            <li><a href="/participants/" title="Participants">Participants</a></li>
			<li><a href="/participants/view/" title="View">View</a></li>
        </ul>
	</div><!--breadcrumb-->  
	<div class="inner">     
    <h2>Manage Participants</h2>		
    <div class="clearer"><!-- --></div>
	<!-- Start Content Table -->
	<div class="content_table">
		<form name="listForm" id="listForm" action="#" method="post">		
			<table id="dataTable" border="0" cellspacing="0" cellpadding="0">
			  <thead>
					<th>Added</th>
					<th>Fullname</th>
					<th>Email</th>
					<th>Login Type</th>
					<th>Area</th>
					<th></th>
					<th></th>
			   </thead>
			   <tbody>
			  {foreach from=$participantData item=item}
			  <tr>
				<td>{$item.participant_added|date_format}</td>
				<td align="left">
					<a href="/participants/view/details.php?code={$item.participant_code}" class="{if $item.participant_active eq 1}success{else}error{/if}">
						{$item.participant_name} {$item.participant_surname}
					</a>
				</td>
				<td align="left">{$item.participant_email}</td>
				<td align="left">{$item.participantlogin_type}</td>
				<td align="left">{$item.areapost_name}</td>						
				<td align="left"><button onclick="changestatus('{$item.participant_code}', '{$item.participant_active}'); return false;">Change Status</button></td>
				<td align="left"><button onclick="deleteitem('{$item.participant_code}'); return false;">Delete</button></td>
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
