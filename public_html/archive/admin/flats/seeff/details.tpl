<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>{$siteName} | Flats | Seeff | {if isset($propertyData.pk_property_id)}Edit property{else}Add a property{/if}</title>
{include_php file='admin/includes/css.php'}
{include_php file='admin/includes/javascript.php'}
</head>
<body>
<!-- Start Main Container -->
<div id="container">
    <!-- Start Content property -->
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
			<li><a href="/admin/flats/" title="propertys">Flats</a></li>
			<li><a href="/admin/flats/seeff/" title="propertys">Seeff</a></li>
			<li>{if isset($propertyData.property_reference)}Edit property{else}Add a property{/if}</li>
        </ul>
	</div><!--breadcrumb--> 
  
	<div class="inner"> 
      <h2>{if isset($propertyData.property_reference)}Edit property: {$propertyData.property_name}{else}Add a new property{/if}</h2>
    <div id="sidetabs">
        <ul > 
            <li class="active"><a href="#" title="Details">Details</a></li>
        </ul>
    </div><!--tabs-->

	<div class="detail_box">
      <form id="detailsForm" name="detailsForm" action="/admin/flats/seeff/details.php{if isset($propertyData.property_reference)}?property_reference={$propertyData.property_reference}{/if}" method="post">
        <table width="700" border="0" align="center" cellpadding="0" cellspacing="0" class="form">
           <tr>
            <td class="left_col"><h4>property Active?</h4></td>
            <td><input type="checkbox" name="property_active" id="property_active" value="1" {if $propertyData.property_active eq 1} checked="checked" {/if} /></td>
          </tr>
          <tr>
            <td class="left_col"><h4>property Created:</h4></td>
            <td>{$propertyData.property_created}</td>
          </tr>			  
          <tr>
            <td class="left_col"><h4>property Reference:</h4></td>
            <td>{$propertyData.property_reference}</td>
          </tr>	
		   <tr>
            <td class="left_col"><h4>property Price:</h4></td>
            <td>{$propertyData.property_price}</td>
          </tr>			
		  		   <tr>
            <td class="left_col"><h4>property Term:</h4></td>
            <td>{$propertyData.property_rentalTerm}</td>
          </tr>	
          <tr>
            <td class="left_col"><h4>property Address:</h4></td>
            <td>{$propertyData.property_address}</td>
          </tr>		
		   <tr>
            <td class="left_col"><h4>property Area:</h4></td>
            <td>{$propertyData.areaMap_path}</td>
          </tr>	
		   <tr>
            <td class="left_col"><h4>Features;</h4></td>
            <td>bedrooms ({$propertyData.property_bedrooms}), bathrooms ({$propertyData.property_bathrooms}), garages ({$propertyData.property_garages}), parking ({$propertyData.property_parking})</td>
          </tr>	
		   <tr>
            <td class="left_col"><h4>Contact Email:</h4></td>
            <td>{$propertyData.property_contactEmail}</td>
          </tr>	
		  		   <tr>
            <td class="left_col"><h4>Contact Number:</h4></td>
            <td>{$propertyData.property_contactNumber}</td>
          </tr>	
		  		   <tr>
            <td class="left_col"><h4>Property short description:</h4></td>
            <td>{$propertyData.property_shortDescription}</td>
          </tr>		
		  		  		   <tr>
            <td class="left_col"><h4>Property full description:</h4></td>
            <td>{$propertyData.property_FullDescription}</td>
          </tr>	
		  		  		   <tr>
            <td class="left_col"><h4>Image:</h4></td>
            <td><img src="http://images1.seeff.com/images/property/{$propertyData.property_reference}/lg_{$propertyData.property_image}_384.jpg" /></td>
          </tr>			  
        </table>
      </form>
	</div>
    <div class="clearer"><!-- --></div>
        <div class="mrg_top_10">
          <a href="/admin/propertys/" class="button cancel mrg_left_147 fl"><span>Cancel</span></a>
          <a href="javascript:submitForm();" class="blue_button mrg_left_20 fl"><span>Save &amp; Complete</span></a>   
        </div>
    <div class="clearer"><!-- --></div>
    </div><!--inner-->
 </div> 	
<!-- End Content property -->
{literal}
<script type="text/javascript" language="javascript">
function submitForm() {
	document.forms.detailsForm.submit();					 
}
</script>
{/literal}
 </div><!-- End Content property -->
 {include_php file='admin/includes/footer.php'}
</div>
<!-- End Main Container -->
</body>
</html>
