<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Category</title>
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
            <li><a href="/resources/" title="Resources">Resources</a></li>
			<li><a href="/resources/category/" title="Category">Category</a></li>
        </ul>
	</div><!--breadcrumb-->  
	<div class="inner">     
    <h2>Manage Category</h2>		
	<a href="/resources/category/details.php" title="Click to Add a new Category" class="blue_button fr mrg_bot_10"><span style="float:right;">Add a new Category</span></a> <br />
    <div class="clearer"><!-- --></div>
	<!-- Start Content Table -->
	<div class="content_table">
		<form name="listForm" id="listForm" action="#" method="post">		
			<table id="dataTable" border="0" cellspacing="0" cellpadding="0">
			  <thead>
					<th>Added</th>
					<th>Name</th>
					<th>url</th>
					<th></th>
					<th></th>
			   </thead>
			   <tbody>
			  {foreach from=$categoryData item=item}
			  <tr>
				<td align="left">{$item.category_added|date_format}</td>
				<td align="left">
					<a href="/resources/category/details.php?code={$item.category_code}" class="{if $item.category_active eq 1}success{else}error{/if}">
						{$item.category_name}
					</a>
				</td>
				<td align="left">{$item.category_url}</td>
				<td align="left"><button onclick="javascript:changestatus('{$item.category_code}', '{$item.category_active}');return false;">Change Status</button></td>
				<td align="left"><button onclick="deleteitem('{$item.category_code}'); return false;">Delete</button></td>
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
</body>
</html>
