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
			<li>{if isset($areaData)}Edit an area: {$areaData.areaMap_name}{else}Add an area{/if}</li>
        </ul>
	</div><!--breadcrumb--> 
	<div class="inner"> 
      <h2>{if isset($areaData)}Edit area: {$areaData.areaMap_name}{else}Add a new area{/if}</h2>
    <div id="sidetabs">
        <ul >
            <li class="active"><a href="#" title="Details">Details</a></li>
        </ul>
        <ul >
            <li><a href="{if isset($areaData)}/admin/resources/areas/polygon.php?fkAreaId={$areaData.fkAreaId}{else}#{/if}" title="Details">Polygon</a></li>
        </ul>		
    </div><!--tabs-->

	<div class="detail_box">
      <form id="detailsForm" name="detailsForm" action="/admin/resources/areas/details.php{if isset($areaData.fkAreaId)}?fkAreaId={$areaData.fkAreaId}{/if}" method="post">
        <table width="700" border="0" align="center" cellpadding="0" cellspacing="0" class="form">
           <tr>
            <td class="left_col"><h4>Area Active?</h4></td>
            <td><input type="checkbox" name="areaMap_active" id="areaMap_active" value="1" {if $areaData.areaMap_active eq 1} checked="checked" {/if} /></td>
          </tr>
          <tr>
            <td><h4>Area Name:</h4></td>
            <td><input type="text" name="areaMap_name" id="areaMap_name" class="small_field" size="60" value="{$areaData.areaMap_name}"/></td>
          </tr>
          <tr>
            <td><h4>Area Type:</h4></td>
				<td>
					{html_options options=$areaTypePairs selected=$areaData.fkAreaTypeId id="fkAreaTypeId" name="fkAreaTypeId" onchange="getParentArea()"}
				</td>
          </tr> 		  
          <tr>
            <td><h4>Parent Area:</h4></td>
				<td id="parentArea" name="parentArea"></td>
          </tr>	
		  <tr>
            <td><h4>Short Path:</h4></td>
            <td><input type="text" name="areaMap_shortPath" id="areaMap_shortPath" class="small_field" size="60" value="{$areaData.areaMap_shortPath}"/></td>
          </tr>	
          <tr>
            <td><h4>Full Path:</h4></td>
            <td><input type="text" name="areaMap_path" id="areaMap_path" class="small_field" size="60" value="{$areaData.areaMap_path}"/></td>
          </tr>			  
          <tr>
            <td><h4>Longitude:</h4></td>
            <td><input type="text" name="areaMap_longitude" id="areaMap_longitude" class="small_field" size="60" value="{$areaData.areaMap_longitude}"/></td>
          </tr>
          <tr>
            <td><h4>Latitude:</h4></td>
            <td><input type="text" name="areaMap_latitude" id="areaMap_latitude" class="small_field" size="60" value="{$areaData.areaMap_latitude}"/></td>
          </tr>		  
        </table>
		<input type="hidden" name="fkAreaParentId" id="fkAreaParentId" value="{$areaData.fkAreaParentId}" /> 
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
