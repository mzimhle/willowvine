<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Internship</title>
{include_php file='includes/css.php'}
{include_php file='includes/javascript.php'}
<script type="text/javascript" language="javascript" src="/library/javascript/nicedit/nicEdit.js"></script>
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
            <li><a href="/internships/" title="Internshiip">Internshiip</a></li>
        </ul>
	</div><!--breadcrumb--> 
	<div class="inner"> 
      <h2>Internshiip Details</h2>
    <div id="sidetabs">
        <ul >
            <li class="active"><a href="#" title="Details">Details</a></li>
        </ul>
    </div>
	<div class="detail_box">
      <form id="detailsForm" name="detailsForm" action="/internships/details.php{if isset($internshipData.internship_code)}?code={$internshipData.internship_code}{/if}" method="post">
        <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="form">
           <tr>
            <td>
				<h4 class="error">Name:</h4><br />
				<input type="text" name="internship_name" id="internship_name" value="{$internshipData.internship_name}" size="30"/>
				{if isset($errorArray.internship_name)}<br /><span class="error">{$errorArray.internship_name}</span>{/if}
			</td>
            <td colspan="2">
				<h4 class="error">Category:</h4><br />
				<select id="category_code" name="category_code">
					<option value=""> ---- </option>
					{html_options options=$categoryPairs selected=$internshipData.category_code}
				</select>
				{if isset($errorArray.category_code)}<br /><span class="error">{$errorArray.category_code}</span>{/if}
			</td>			
          </tr>	
		  <tr>
            <td colspan="3">
				<h4>Link:</h4><br />
				<input type="text" name="internship_link" id="internship_link" value="{$internshipData.internship_link}" size="80"/>
				{if isset($errorArray.internship_link)}<br /><span class="error">{$errorArray.internship_link}</span>{/if}
			</td>		  
		  </tr>
           <tr>
            <td>
				<h4 class="error">Company:</h4><br />
				<input type="text" name="internship_company" id="internship_company" value="{$internshipData.internship_company}" size="30"/>
				{if isset($errorArray.internship_company)}<br /><span class="error">{$errorArray.internship_company}</span>{/if}
			</td>
            <td colspan="2">
				<h4>Areas:</h4><br />
				<input type="text" name="internship_area" id="internship_area" value="{$internshipData.internship_area}" size="60"/>
				{if isset($errorArray.internship_area)}<br /><span class="error">{$errorArray.internship_area}</span>{/if}
			</td>		
          </tr>	
           <tr>
            <td>
				<h4>Contact Person:</h4><br />
				<input type="text" name="internship_contact_name" id="internship_contact_name" value="{$internshipData.internship_contact_name}" size="30"/>
				{if isset($errorArray.internship_contact_name)}<br /><span class="error">{$errorArray.internship_contact_name}</span>{/if}
			</td>
            <td>
				<h4>Contact Email:</h4><br />
				<input type="text" name="internship_contact_email" id="internship_contact_email" value="{$internshipData.internship_contact_email}" size="30"/>
				{if isset($errorArray.internship_contact_email)}<br /><span class="error">{$errorArray.internship_contact_email}</span>{/if}
			</td>	
            <td>
				<h4>Contact Number:</h4><br />
				<input type="text" name="internship_contact_number" id="internship_contact_number" value="{$internshipData.internship_contact_number}" size="30"/>
				{if isset($errorArray.internship_contact_number)}<br /><span class="error">{$errorArray.internship_contact_number}</span>{/if}
			</td>			
          </tr>
           <tr>
            <td>
				<h4 class="error">Opening Date:</h4><br />
				<input type="text" name="internship_date_opening" id="internship_date_opening" value="{$internshipData.internship_date_opening}" size="15"/>
				{if isset($errorArray.internship_date_opening)}<br /><span class="error">{$errorArray.internship_date_opening}</span>{/if}
			</td>
            <td>
				<h4 class="error">Closing Date:</h4><br />
				<input type="text" name="internship_date_closing" id="internship_date_closing" value="{$internshipData.internship_date_closing}" size="15"/>
				{if isset($errorArray.internship_date_closing)}<br /><span class="error">{$errorArray.internship_date_closing}</span>{/if}
			</td>			
          </tr>				  
			<tr>
				<td colspan="3">
					<h4 class="error">Description:</h4><br />
					<textarea name="internship_page" id="internship_page" style="width: 850px; height: 400px;">{$internshipData.internship_page}</textarea>
					{if isset($errorArray.internship_page)}<br /><span class="error">{$errorArray.internship_page}</span>{/if}
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
	nicEditors.findEditor('internship_page').saveContent();
	document.forms.detailsForm.submit();					 
}

$(document).ready(function(){

	$( "#internship_date_opening" ).datepicker({
		dateFormat: "yy-mm-dd",
		changeMonth: true,
		numberOfMonths: 3,
		onClose: function( selectedDate ) {
			$( "#internship_date_closing" ).datepicker( "option", "minDate", selectedDate );
		}
	});
	$( "#internship_date_closing" ).datepicker({
		dateFormat: "yy-mm-dd",
		changeMonth: true,
		numberOfMonths: 3,
		onClose: function( selectedDate ) {
			$( "#internship_date_opening" ).datepicker( "option", "maxDate", selectedDate );
		}
	});

	new nicEditor({
		iconsPath : '/library/javascript/nicedit/nicEditorIcons.gif',
		maxHeight : '800'
	}).panelInstance('internship_page');		
});
</script>
{/literal}
</body>
</html>
