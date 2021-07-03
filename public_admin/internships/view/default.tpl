<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Internship</title>
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
            <li><a href="/internships/" title="Internship">Internship</a></li>
			<li><a href="/internships/view/" title="View">View</a></li>
        </ul>
	</div><!--breadcrumb-->  
	<div class="inner">     
    <h2>Manage Internship</h2>		
	<a href="/internships/view/details.php" title="Click to Add a new Internshiip" class="blue_button fr mrg_bot_10"><span style="float:right;">Add a new Internshiip</span></a> <br />
    <div class="clearer"><!-- --></div>
	<!-- Start Content Table -->
	<div class="content_table">
		<form name="listForm" id="listForm" action="#" method="post">		
			<table id="dataTable" border="0" cellspacing="0" cellpadding="0">
			  <thead>
					<th>Added</th>
					<th>Name</th>
					<th>Company</th>
					<th>Opening Date</th>
					<th>Closing Date</th>
					<th></th>
			   </thead>
			   <tbody>
			  {foreach from=$internshipData item=item}
			  <tr>
				<td align="left">{$item.internship_added|date_format}</td>
				<td align="left">
					<a href="/internships/view/details.php?code={$item.internship_code}" class="{if $item.internship_active eq 1}success{else}error{/if}">
						{$item.internship_name}
					</a>
				</td>
				<td align="left">
					<a href="{$item.internship_link}" target="_blank">
						{$item.internship_company}
					</a>
				</td>
				<td align="left">{$item.internship_date_opening|date_format}</td>
				<td align="left">{$item.internship_date_closing|date_format}</td>
				<td align="left"><button onclick="deleteitem('{$item.internship_code}'); return false;">Delete</button></td>
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
