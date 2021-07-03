<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>{$siteName} | Section | Areas | {if isset($areaData)}Edit area{else}Add a area{/if}</title>
{include_php file='admin/includes/css.php'}
{include_php file='admin/includes/javascript.php'}
<script type="text/javascript" language="javascript" src="/admin/resources/areas/default.js"></script>
{literal}
<script type="text/javascript" language="javascript">
$(document).ready(function(){
	getParentArea();					
});
</script>
{/literal}
</head>
<body>
<!-- Start Main Container -->
<div id="container">
    <!-- Start Content Section -->
  <div id="content">
    {include_php file='admin/includes/header.php'}
    <div class="logged_in">
        <ul>
            <li><a href="/admin/help/users.php" title="Get Help" class="help_icon"> Help</a></li>
            <li>|<a href="/admin/logout.php" title="Logout">Logout</a></li>
        </ul>
    </div><!--logged_in-->
  	<br />
	<div id="breadcrumb">
        <ul>
            <li><a href="/admin/default.php" title="Home">Home</a></li>
            <li><a href="/admin/resources/" title="Areas">Resources</a></li>
			<li><a href="/admin/resources/areas/" title="Areas">Areas</a></li>
			<li>{if isset($areaData)}Edit an area polygon: {$areaData.areaMap_name}{else}Error!{/if}</li>
        </ul>
	</div><!--breadcrumb--> 
	<div class="inner"> 
      <h2>{if isset($areaData)}Edit area polygon: {$areaData.areaMap_name}{else}Error!{/if}</h2>
    <div id="sidetabs">
        <ul >
            <li><a href="/admin/resources/areas/details.php?fkAreaId={$areaData.fkAreaId}" title="Details">Details</a></li>
        </ul>
        <ul >
            <li class="active"> <a href="#" title="Details">Polygon</a></li>
        </ul>		
    </div><!--tabs-->

	<div class="detail_box">
      <form id="detailsForm" name="detailsForm" action="/admin/resources/areas/polygon.php?fkAreaId={$areaData.fkAreaId}" method="post">
        <table width="700" border="0" align="center" cellpadding="0" cellspacing="0" class="form">	
          <tr>
            <td valign="top"><h4>File Name:</h4></td>
				<td><input type="text" name="areaMap_codePath" id="areaMap_codePath" class="small_field" size="60" value="{$areaData.areaMap_codePath}"/></td>
          </tr>			
          <tr>
            <td valign="top"><h4>Polygon Code:</h4></td>
				<td>
					<textarea cols="80" rows="60" id="polygon_code" name="polygon_code">{$areaData.polygon_code}</textarea>
				</td>
          </tr>				    
        </table>
		<input type="hidden" name="fkAreaId" id="fkAreaId" value="{$areaData.fkAreaId}" /> 
      </form>
	</div>
    <div class="clearer"><!-- --></div>
        <div class="mrg_top_10">
          <a href="/admin/resources/areas/" class="button cancel mrg_left_147 fl"><span>Cancel</span></a>
          <a href="javascript:submitForm();" class="blue_button mrg_left_20 fl"><span>Save &amp; Complete</span></a>   
        </div>
    <div class="clearer"><!-- --></div>
    </div><!--inner-->
 </div> 
<!-- End Content Section -->
{literal}
<script type="text/javascript" language="javascript">
function submitForm() {	
	document.forms.detailsForm.submit();					 
}
</script>
{/literal}
 </div><!-- End Content Section -->
 {include_php file='admin/includes/footer.php'}
</div>
<!-- End Main Container -->
</body>
</html>
