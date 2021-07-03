<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Participants</title>
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
            <li><a href="/careers/" title="Career">Career</a></li>
			<li><a href="/careers/view/" title="View">View</a></li>
        </ul>
	</div><!--breadcrumb--> 
	<div class="inner"> 
      <h2>Career Details</h2>
    <div id="sidetabs">
        <ul >
            <li class="active"><a href="#" title="Details">Details</a></li>
        </ul>
    </div>
	<div class="detail_box">
      <form id="detailsForm" name="detailsForm" action="/careers/view/details.php{if isset($careerData.career_code)}?code={$careerData.career_code}{/if}" method="post">
        <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="form">
           <tr>
            <td>
				<h4 class="error">Name:</h4><br />
				<input type="text" name="career_name" id="career_name" value="{$careerData.career_name}" size="40"/>
				{if isset($errorArray.career_name)}<br /><span class="error">{$errorArray.career_name}</span>{/if}
			</td>
            <td>
				<h4 class="error">Category:</h4><br />
				<select id="category_code" name="category_code">
					<option value=""> ---- </option>
					{html_options options=$categoryPairs selected=$careerData.category_code}
				</select>
				{if isset($errorArray.category_code)}<br /><span class="error">{$errorArray.category_code}</span>{/if}
			</td>		
          </tr>	
			<tr>
				<td colspan="2">
					<h4 class="error">Description:</h4><br />
					<textarea name="career_page" id="career_page" style="width: 850px; height: 400px;">{$careerData.career_page}</textarea>
					{if isset($errorArray.career_page)}<br /><span class="error">{$errorArray.career_page}</span>{/if}
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<h4 class="error">Education:</h4><br />
					<textarea name="career_education" id="career_education" style="width: 850px; height: 400px;">{$careerData.career_education}</textarea>
					{if isset($errorArray.career_education)}<br /><span class="error">{$errorArray.career_education}</span>{/if}
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<h4 class="error">Contact:</h4><br />
					<textarea name="career_contact" id="career_contact" style="width: 850px; height: 400px;">{$careerData.career_contact}</textarea>
					{if isset($errorArray.career_contact)}<br /><span class="error">{$errorArray.career_contact}</span>{/if}
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
	nicEditors.findEditor('career_page').saveContent();
	nicEditors.findEditor('career_education').saveContent();
	nicEditors.findEditor('career_contact').saveContent();
	document.forms.detailsForm.submit();					 
}

$(document).ready(function(){
		new nicEditor({
			iconsPath : '/library/javascript/nicedit/nicEditorIcons.gif',
			maxHeight : '800'
		}).panelInstance('career_page').panelInstance('career_education').panelInstance('career_contact');			
});
</script>
{/literal}
</body>
</html>
