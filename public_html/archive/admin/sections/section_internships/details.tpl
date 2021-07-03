<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>{$siteName} | Resources | Sections | {if isset($sectionData.pk_section_id)}Edit section{else}Add a section{/if}</title>
{include_php file='admin/includes/css.php'}
{include_php file='admin/includes/javascript.php'}
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
			<li><a href="/admin/sections/" title="Jobs">Sections</a></li>
			<li><a href="/admin/sections/section_internships/" title="Internship">Internship Sections</a></li>
			<li>{if isset($sectionData.pk_section_id)}Edit Section{else}Add a Section{/if}</li>
        </ul>
	</div><!--breadcrumb--> 
  
	<div class="inner"> 
      <h2>{if isset($sectionData.pk_section_id)}Edit section: {$sectionData.section_name}{else}Add a new Section{/if}</h2>
    <div id="sidetabs">
        <ul > 
            <li class="active"><a href="#" title="Details">Details</a></li>
        </ul>
    </div><!--tabs-->

	<div class="detail_box">
      <form id="detailsForm" name="detailsForm" action="/admin/sections/section_internships/details.php{if isset($sectionData.pk_section_id)}?sectionId={$sectionData.pk_section_id}{/if}" method="post">
        <table width="700" border="0" align="center" cellpadding="0" cellspacing="0" class="form">
           <tr>
            <td class="left_col"><h4>Section Active?</h4></td>
            <td><input type="checkbox" name="section_active" id="section_active" value="1" {if $sectionData.section_active eq 1} checked="checked" {/if} /></td>
          </tr>
          <tr>
            <td class="left_col"><h4>Section Url Name:</h4></td>
            <td><input type="text" name="section_urlName" id="section_urlName" value="{$sectionData.section_urlName}" size="60" DISABLED /></td>
          </tr>		  
          <tr>
            <td class="left_col"><h4>Section Name:</h4></td>
            <td><input type="text" name="section_name" id="section_name" value="{$sectionData.section_name}" size="60"/></td>
          </tr>		  		  						  
        </table>
      </form>
	</div>
    <div class="clearer"><!-- --></div>
        <div class="mrg_top_10">
          <a href="/admin/sections/" class="button cancel mrg_left_147 fl"><span>Cancel</span></a>
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
