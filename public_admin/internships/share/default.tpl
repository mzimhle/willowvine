<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Internships</title>
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
            <li><a href="/internships/" title="Internships">Internships</a></li>
			<li><a href="/internships/share/" title="View">Share</a></li>
        </ul>
	</div><!--breadcrumb-->  
	<div class="inner">     
    <h2>Manage Internships</h2>		
    <div class="clearer"><!-- --></div>
	<!-- Start Content Table -->
	<div class="content_table">
		<form name="listForm" id="listForm" action="#" method="post">		
			<table id="dataTable" border="0" cellspacing="0" cellpadding="0">
			  <thead>
					<th>Added</th>
					<th>Internship</th>
					<th>Fullname</th>
					<th>Email</th>
					<th>Friend Nae</th>
					<th>Friend Email</th>
					<th></th>
			   </thead>
			   <tbody>
			  {foreach from=$shareData item=item}
			  <tr>
				<td>{$item.share_added|date_format}</td>
				<td align="left"><a href="/internships/share/details.php?code={$item.share_code}" class="{if $item.share_active eq 1}success{else}error{/if}">{$item.internship_name}</a></td>
				<td align="left">{$item.share_name} {$item.share_surname}</td>				
				<td align="left">{$item.share_email}</td>
				<td align="left">{$item.share_friendname}</td>
				<td align="left">{$item.share_friendemail}</td>		
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
