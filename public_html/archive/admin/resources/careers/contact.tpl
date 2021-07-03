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
            <li><a href="{if isset($careerData.pk_career_id)}/admin/resources/careers/details.php?pk_career_id={$careerData.pk_career_id}{else}#{/if}" title="Details">Details</a></li>
			<li><a href="{if isset($careerData.pk_career_id)}/admin/resources/careers/education.php?pk_career_id={$careerData.pk_career_id}{else}#{/if}" title="Education">Education</a></li>
			<li class="active"><a href="#" title="Contact">Contact</a></li>			
        </ul>
    </div><!--tabs-->

	<div class="detail_box">
      <form id="detailsForm" name="detailsForm" action="/admin/resources/careers/contact.php{if isset($careerData.pk_career_id)}?pk_career_id={$careerData.pk_career_id}{/if}" method="post">
        <table width="700" border="0" align="center" cellpadding="0" cellspacing="0" class="form">
          {if isset($careerData) && $careerData.career_active eq 1}
		  <tr>
            <td class="left_col"><h4>View career on Site:</h4></td>
            <td>
				<a href="/careers/{$careerData.section_urlName}/details/{$careerData.career_link}/{$careerData.career_url}/{$careerData.pk_career_id}/" target="_blank">View career On site</a>
          </tr>	
		{/if}		  	  		  		  
		  <tr>
            <td class="left_col" valign="top" {if isset($errorArray.career_contact)}style="color: red"{/if}><h4>Contact:</h4></td>
            <td>
				<textarea name="career_contact" id="career_contact" style="width: 600px; height: 300px;">{$careerData.career_contact}</textarea>
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
	nicEditors.findEditor('career_contact').saveContent();
	document.forms.detailsForm.submit();					 
}

$(document).ready(function(){

		new nicEditor({
			iconsPath : '/library/javascript/nicedit/nicEditorIcons.gif',
			buttonList : ['bold','italic','underline','ol','ul','indent','outdent','center', 'right','left','upload','link','unlink','fontFormat','xhtml'],
			maxHeight : '800'
		}).panelInstance('career_contact');			
});

</script>
{/literal}
<!-- End Main Container -->
</body>
</html>
