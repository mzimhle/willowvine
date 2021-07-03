<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Recruiter</title>
{include_php file='includes/css.php'}
{include_php file='includes/javascript.php'}
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
			<li><a href="/resources/recruiters/" title="Recruiter">Recruiter</a></li>
			<li><a href="/resources/recruiters/details.php{if isset($recruiterData.recruiter_code)}?code={$recruiterData.recruiter_code}{/if}" title="Details">Details</a></li>
        </ul>
	</div><!--breadcrumb--> 
	<div class="inner"> 
      <h2>Recruiter</h2>
    <div id="sidetabs">
        <ul >
            <li class="active"><a href="#" title="Details">Details</a></li>
        </ul>
    </div>
	<div class="detail_box">
      <form id="detailsForm" name="detailsForm" action="/resources/recruiters/details.php{if isset($recruiterData.recruiter_code)}?code={$recruiterData.recruiter_code}{/if}" method="post">
        <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="form">
           <tr>
            <td>
				<h4 class="error">Name:</h4><br />
				<input type="text" name="recruiter_name" id="recruiter_name" value="{$recruiterData.recruiter_name}" size="30"/>
				{if isset($errorArray.recruiter_name)}<br /><span class="error">{$errorArray.recruiter_name}</span>{/if}
			</td>
            <td>
				<h4 class="error">Email:</h4><br />
				<input type="text" name="recruiter_email" id="recruiter_email" value="{$recruiterData.recruiter_email}" size="30"/>
				{if isset($errorArray.recruiter_email)}<br /><span class="error">{$errorArray.recruiter_email}</span>{/if}
			</td>
            <td>
				<h4>Number:</h4><br />
				<input type="text" name="recruiter_number" id="recruiter_number" value="{$recruiterData.recruiter_number}" size="30"/>
				{if isset($errorArray.recruiter_number)}<br /><span class="error">{$errorArray.recruiter_number}</span>{/if}
			</td>			
          </tr>
		  <tr>
            <td>
				<h4 class="error">Website:</h4><br />
				<input type="text" name="recruiter_website" id="recruiter_website" value="{$recruiterData.recruiter_website}" size="30"/>
				{if isset($errorArray.recruiter_website)}<br /><span class="error">{$errorArray.recruiter_website}</span>{/if}
			</td>		  
            <td colspan="2">
				<h4>Address:</h4><br />
				<input type="text" name="recruiter_address" id="recruiter_address" value="{$recruiterData.recruiter_address}" size="90"/>
				{if isset($errorArray.recruiter_address)}<br /><span class="error">{$errorArray.recruiter_address}</span>{/if}
			</td>			
		  </tr>		  
		  <tr>
            <td colspan="3">
				<h4 class="error">Area:</h4><br />
				<input type="text" name="areapost_name" id="areapost_name" value="{$recruiterData.areapost_name}" size="90"/>
				<input type="hidden" name="areapost_code" id="areapost_code" value="{$recruiterData.areapost_code}" />
				{if isset($errorArray.areapost_code)}<br /><span class="error">{$errorArray.areapost_code}</span>{/if}
			</td>		  
		  </tr>
		  <tr> 
            <td>
				{if isset($recruiterData.recruiter_logo_path) && trim($recruiterData.recruiter_logo_path) neq ''}
					<img src="{$recruiterData.recruiter_logo_path}" width="160" />
				{else}
					<img src="/images/avatar.jpg"  width="160" />
				{/if}			
			</td>		  
            <td colspan="3" valign="top">
				<h4>Image Path:</h4><br />
				<input type="text" name="recruiter_logo_path" id="recruiter_logo_path" value="{$recruiterData.recruiter_logo_path}" size="90"/>
			</td>		  
		  </tr>
        </table>
      </form>
    <div class="clearer"><!-- --></div>
        <div class="mrg_top_10">
          <a href="javascript:submitForm();" class="blue_button mrg_left_20 fl"><span>Save &amp; Complete</span></a>   
        </div>	
    <div class="clearer"><!-- --></div>	  
	</div>
    <div class="clearer"><!-- --></div>
    </div><!--inner-->
 </div> 	
<!-- End Content Section -->
 </div><!-- End Content Section -->
 {include_php file='includes/footer.php'}
</div>
<!-- End Main Container -->
{literal}
<script type="text/javascript" language="javascript">
function submitForm() {
	document.forms.detailsForm.submit();					 
}

$(document).ready(function(){
		
		$( "#areapost_name" ).autocomplete({
			source: "/feeds/areaparents.php",
			minLength: 2,
			select: function( event, ui ) {
			
				if(ui.item.id == '') {
					$('#areapost_name').html('');
					$('#areapost_code').val('');					
				} else {
					$('#areapost_name').html('<b>' + ui.item.value + '</b>');
					$('#areapost_code').val(ui.item.id);	
				}
				$('#areapost_name').val('');										
			}
		});			
});
</script>
{/literal}
</body>
</html>
