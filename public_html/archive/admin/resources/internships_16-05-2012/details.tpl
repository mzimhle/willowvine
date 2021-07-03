<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>{$siteName} | Resources | internships | {if isset($internshipData.pk_internship_id)}Edit internship{else}Add a internship{/if}</title>
{include_php file='admin/includes/css.php'}
{include_php file='admin/includes/javascript.php'}
{include_php file="includes/auto_complete.php"}
<script type="text/javascript" language="javascript" src="/library/javascript/nicedit/nicEdit.js"></script>
<script language="javascript" type="text/javascript" src="/library/javascript/calendar/jquery.datepick.package/jquery.datepick.js"></script>
<link rel="stylesheet" type="text/css" href="/library/javascript/calendar/jquery.datepick.package/jquery.datepick.css" />
{literal}
<script type="text/javascript">
$().ready(function() {

$('#internship_closing_date').datepick({dateFormat: 'yyyy-mm-dd'});
$('#internship_opening_date').datepick({dateFormat: 'yyyy-mm-dd'});
	
$("#areaMap_path").autocomplete(areas);
});
</script>
{/literal}
</head>
<body>
<!-- Start Main Container -->
<div id="container">
    <!-- Start Content internship -->
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
			<li><a href="/admin/resources/" title="Resources">Resources</a></li>
			<li><a href="/admin/resources/internships/" title="internships">internships</a></li>
			<li>{if isset($internshipData.pk_internship_id)}Edit internship{else}Add a internship{/if}</li>
        </ul>
	</div><!--breadcrumb--> 
  
	<div class="inner"> 
      <h2>{if isset($internshipData.pk_internship_id)}Edit internship: {$internshipData.internship_title}{else}Add a new internship{/if}</h2>
    <div id="sidetabs">
        <ul > 
            <li class="active"><a href="#" title="Details">Details</a></li>
        </ul>
    </div><!--tabs-->

	<div class="detail_box">
      <form id="detailsForm" name="detailsForm" action="/admin/resources/internships/details.php{if isset($internshipData.pk_internship_id)}?pk_internship_id={$internshipData.pk_internship_id}{/if}" method="post">
        {if isset($internshipData.pk_internship_id)}<input type="hidden" name="pk_internship_id" id="pk_internship_id" value="{$internshipData.pk_internship_id}" />{/if}
		<table width="700" border="0" align="center" cellpadding="0" cellspacing="0" class="form">
          {if isset($internshipData) && $internshipData.internship_active eq 1}
		  <tr>
            <td class="left_col"><h4>View internship on Site:</h4></td>
            <td>
				<a href="/internships/{$internshipData.section_urlName}/details/{$internshipData.internship_link}/{$internshipData.pk_internship_id}/" target="_blank">View internship On site</a>
          </tr>	
		{/if}		  
           <tr>
            <td class="left_col"><h4>internship Active?</h4></td>
            <td><input type="checkbox" name="internship_active" id="internship_active" value="1" {if $internshipData.internship_active eq 1} checked="checked" {/if} /></td>
          </tr>	 
		{if isset($internshipData.internship_added)}		  
          <tr>
            <td class="left_col"><h4>internship Added:</h4></td>
			<td>{$internshipData.internship_added}</td>
          </tr>
		{/if}		  
          <tr>
            <td class="left_col" {if isset($errorArray.internship_title)}style="color: red"{/if}><h4>Title:</h4></td>
			<td><input type="text" name="internship_title" id="internship_title" value="{$internshipData.internship_title}" size="60"/></td>
          </tr>	
          <tr>
            <td class="left_col" {if isset($errorArray.internship_company)}style="color: red"{/if}><h4>Company:</h4></td>
			<td><input type="text" name="internship_company" id="internship_company" value="{$internshipData.internship_company}" size="60"/></td>
          </tr>		
          <tr>
            <td class="left_col" {if isset($errorArray.internship_contact_name)}style="color: red"{/if}><h4>Contact Name:</h4></td>
			<td><input type="text" name="internship_contact_name" id="internship_contact_name" value="{$internshipData.internship_contact_name}" size="60"/></td>
          </tr>	
          <tr>
            <td class="left_col" {if isset($errorArray.internship_contact_email)}style="color: red"{/if}><h4>Contact Email:</h4></td>
			<td><input type="text" name="internship_contact_email" id="internship_contact_email" value="{$internshipData.internship_contact_email}" size="60"/></td>
          </tr>		
          <tr>
            <td class="left_col" {if isset($errorArray.internship_contact_number)}style="color: red"{/if}><h4>Contact Number:</h4></td>
			<td><input type="text" name="internship_contact_number" id="internship_contact_number" value="{$internshipData.internship_contact_number}" size="60"/></td>
          </tr>	
          <tr>
            <td class="left_col" {if isset($errorArray.internship_opening_date)}style="color: red"{/if}><h4>Opening Date:</h4></td>
			<td><input type="text" name="internship_opening_date" id="internship_opening_date" value="{$internshipData.internship_opening_date}" size="60"/></td>
          </tr>	
          <tr>
            <td class="left_col" {if isset($errorArray.internship_closing_date)}style="color: red"{/if}><h4>Closing Date:</h4></td>
			<td><input type="text" name="internship_closing_date" id="internship_closing_date" value="{$internshipData.internship_closing_date}" size="60"/></td>
          </tr>		
          <tr>
            <td class="left_col" {if isset($errorArray.areaMap_path)}style="color: red"{/if}><h4>City/Town/Area:</h4></td>
			<td><input type="text" name="areaMap_path" id="areaMap_path" value="{$internshipData.areaMap_path}" size="60"/></td>
          </tr>			  
		{if isset($internshipData.internship_link)}		  
          <tr>
            <td class="left_col"><h4>internship Url Name:</h4></td>
            <td>{$internshipData.internship_link}</td>
          </tr>		
		{/if}		  
          <tr>
            <td class="left_col" {if isset($errorArray.fk_section_id)}style="color: red"{/if}><h4>Section:</h4></td>
            <td>
				<select id="fk_section_id" name="fk_section_id">
					<option value=""> ---- </option>
					{html_options options=$sectionPairs selected=$internshipData.fk_section_id}</td>
				</select>
			</td>
          </tr>	
		  <tr>
            <td class="left_col" valign="top" {if isset($errorArray.internship_page)}style="color: red"{/if}><h4>Page:</h4></td>
            <td>
				<textarea name="internship_page" id="internship_page" style="width: 590px; height: 800px;">{$internshipData.internship_page}</textarea>
          </tr>			  
        </table>
      </form>
	</div>
    <div class="clearer"><!-- --></div>
        <div class="mrg_top_10">
          <a href="/admin/resources/internships/" class="button cancel mrg_left_147 fl"><span>Cancel</span></a>
          <a href="javascript:submitForm();" class="blue_button mrg_left_20 fl"><span>Save &amp; Complete</span></a>   
        </div>
    <div class="clearer"><!-- --></div>
    </div><!--inner-->
 </div> 	
<!-- End Content internship -->
 </div><!-- End Content internship -->
 {include_php file='admin/includes/footer.php'}
</div>
{literal}
<script type="text/javascript" language="javascript">
function submitForm() {
	nicEditors.findEditor('internship_page').saveContent();
	document.forms.detailsForm.submit();					 
}

$(document).ready(function(){

		new nicEditor({
			iconsPath : '/library/javascript/nicedit/nicEditorIcons.gif',
			buttonList : ['bold','italic','underline','ol','ul','indent','outdent','center', 'right','left','upload','link','unlink','fontFormat','xhtml'],
			maxHeight : '900'
		}).panelInstance('internship_page');			
});

</script>
{/literal}
<!-- End Main Container -->
</body>
</html>
