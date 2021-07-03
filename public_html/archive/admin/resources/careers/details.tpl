<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>{$siteName} | Resources | Careers | {if isset($careerData.pk_career_id)}Edit career{else}Add a career{/if}</title>
{include_php file='admin/includes/css.php'}
{include_php file='admin/includes/javascript.php'}
<script type="text/javascript" language="javascript" src="/library/javascript/nicedit/nicEdit.js"></script>
</head>
<body>
<!-- Start Main Container -->
<div id="container">
    <!-- Start Content career -->
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
			<li><a href="/admin/resources/careers/" title="Careers">Careers</a></li>
			<li>{if isset($careerData.pk_career_id)}Edit career{else}Add a career{/if}</li>
        </ul>
	</div><!--breadcrumb--> 
  
	<div class="inner"> 
      <h2>{if isset($careerData.pk_career_id)}Edit career: {$careerData.career_title}{else}Add a new career{/if}</h2>
    <div id="sidetabs">
        <ul > 
            <li class="active"><a href="#" title="Details">Details</a></li>
			<li><a href="{if isset($careerData.pk_career_id)}/admin/resources/careers/education.php?pk_career_id={$careerData.pk_career_id}{else}#{/if}" title="Education">Education</a></li>
			<li><a href="{if isset($careerData.pk_career_id)}/admin/resources/careers/contact.php?pk_career_id={$careerData.pk_career_id}{else}#{/if}" title="Contact">Contact</a></li>			
        </ul>
    </div><!--tabs-->

	<div class="detail_box">
      <form id="detailsForm" name="detailsForm" action="/admin/resources/careers/details.php{if isset($careerData.pk_career_id)}?pk_career_id={$careerData.pk_career_id}{/if}" method="post">
        {if isset($careerData.pk_career_id)}<input type="hidden" name="pk_career_id" id="pk_career_id" value="{$careerData.pk_career_id}" />{/if}
		<table width="700" border="0" align="center" cellpadding="0" cellspacing="0" class="form">
          {if isset($careerData) && $careerData.career_active eq 1}
		  <tr>
            <td class="left_col"><h4>View career on Site:</h4></td>
            <td>
				<a href="/careers/{$careerData.section_urlName}/details/{$careerData.career_link}/{$careerData.pk_career_id}/" target="_blank">View career On site</a>
          </tr>	
		{/if}		  
           <tr>
            <td class="left_col"><h4>Career Active?</h4></td>
            <td><input type="checkbox" name="career_active" id="career_active" value="1" {if $careerData.career_active eq 1} checked="checked" {/if} /></td>
          </tr>	 
		{if isset($careerData.career_added)}		  
          <tr>
            <td class="left_col"><h4>Career Added:</h4></td>
			<td>{$careerData.career_added}</td>
          </tr>
		{/if}		  
          <tr>
            <td class="left_col" {if isset($errorArray.career_title)}style="color: red"{/if}><h4>Career title:</h4></td>
			<td><input type="text" name="career_title" id="career_title" value="{$careerData.career_title}" size="60"/></td>
          </tr>	
          <tr>
            <td class="left_col"><h4>External link:</h4></td>
			<td><input type="text" name="career_extLink" id="career_extLink" value="{$careerData.career_extLink}" size="60"/></td>
          </tr>			  
		{if isset($careerData.career_link)}		  
          <tr>
            <td class="left_col"><h4>career Url Name:</h4></td>
            <td>{$careerData.career_link}</td>
          </tr>		
		{/if}		  
          <tr>
            <td class="left_col" {if isset($errorArray.fk_section_id)}style="color: red"{/if}><h4>Section:</h4></td>
            <td>
				<select id="fk_section_id" name="fk_section_id">
					<option value=""> ---- </option>
					{html_options options=$sectionPairs selected=$careerData.fk_section_id}</td>
				</select>
			</td>
          </tr>	
		  <tr>
            <td class="left_col" valign="top" {if isset($errorArray.career_page)}style="color: red"{/if}><h4>Page:</h4></td>
            <td>
				<textarea name="career_page" id="career_page" style="width: 450px; height: 800px;">{$careerData.career_page}</textarea>
          </tr>			  
        </table>
      </form>
	</div>
    <div class="clearer"><!-- --></div>
        <div class="mrg_top_10">
          <a href="/admin/resources/careers/" class="button cancel mrg_left_147 fl"><span>Cancel</span></a>
          <a href="javascript:submitForm();" class="blue_button mrg_left_20 fl"><span>Save &amp; Complete</span></a>   
        </div>
    <div class="clearer"><!-- --></div>
    </div><!--inner-->
 </div> 	
<!-- End Content career -->
 </div><!-- End Content career -->
 {include_php file='admin/includes/footer.php'}
</div>
{literal}
<script type="text/javascript" language="javascript">
function submitForm() {
	nicEditors.findEditor('career_page').saveContent();
	document.forms.detailsForm.submit();					 
}

$(document).ready(function(){

		new nicEditor({
			iconsPath : '/library/javascript/nicedit/nicEditorIcons.gif',
			buttonList : ['bold','italic','underline','ol','ul','indent','outdent','center', 'right','left','upload','link','unlink','fontFormat','xhtml'],
			maxHeight : '800'
		}).panelInstance('career_page');			
});

</script>
{/literal}
<!-- End Main Container -->
</body>
</html>
