<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Communication</title>
{include_php file='includes/css.php'}
{include_php file='includes/javascript.php'}
<script type="text/javascript" language="javascript" src="default.js?v1"></script>
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
			<li><a href="/communication/" title="Communication">Communication</a></li>
			<li><a href="/communication/messages/" title="Messages">Messages</a></li>
        </ul>
	</div><!--breadcrumb-->  
	<div class="inner">     
    <h2>Manage Messages</h2>
	<a href="/communication/messages/details.php" title="Click to Add a new Messages" class="blue_button fr mrg_bot_10"><span style="float:right;">Add a new Messages</span></a>  <br /> 
    <div class="clearer"><!-- --></div>
    <div id="tableContent" align="center">
		<!-- Start Content Table -->
		<div class="content_table">
			<table id="dataTable" border="0" cellspacing="0" cellpadding="0">
				<thead>
				<tr>
				<th>Added</th>
				<th>Name</th>
				<th>Type</th>
				<th>Subject</th>
				<th></th>
				<th></th>
				</tr>
			   </thead>
			   <tbody> 
			  {foreach from=$messageData item=item}
			  <tr >
				<td>{$item._message_added|date_format}</td>
				<td align="left">
					<a href="/communication/messages/details.php?code={$item._message_code}" class="{if $item._message_active eq '0'}error{else}success{/if}">
						{$item._message_name}
					</a>
				</td>
				<td align="left">{$item._message_type}</td>				
				<td align="left">{$item._message_subject}</td>
				<td align="left"><button onclick="javascript:changestatus('{$item._message_code}', '{if $item._message_active eq '0'}1{else}0{/if}');">Change Status</button></td>
				<td align="right"><button onclick="deleteitem('{$item._message_code}')">Delete</button></td>
			  </tr>
			  {/foreach}     
			  </tbody>
			</table>
		 </div>
		 <!-- End Content Table -->	
	</div>
    <div class="clearer"><!-- --></div>
    </div><!--inner-->
  </div><!-- End Content Section -->
 {include_php file='includes/footer.php'}
</div>
<!-- End Main Container -->
</body>
</html>
