<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Jobs</title>
{include_php file='includes/css.php'}
{include_php file='includes/javascript.php'}
<script type="text/javascript" language="javascript" src="/library/javascript/nicedit/nicEdit.js"></script>
</head>
<body>
<!-- Start Main Container -->
<div id="container">
    <!-- Start Content job -->
  <div id="content">
    {include_php file='includes/header.php'}
  	<br />
	<div id="breadcrumb">
        <ul>
            <li><a href="/default.php" title="Home">Home</a></li>
			<li><a href="/jobs/view/" title="jobs">Jobs</a></li>
			<li>{if isset($jobData.job_code)}Edit job{else}Add a job{/if}</li>
        </ul>
	</div><!--breadcrumb--> 
  
	<div class="inner"> 
      <h2>{if isset($jobData.job_code)}Edit job: {$jobData.job_name}{else}Add a new job{/if}</h2>
    <div id="sidetabs">
        <ul > 
            <li class="active"><a href="#" title="Details">Details</a></li>
        </ul>
    </div><!--tabs-->

	<div class="detail_box">
      <form id="detailsForm" name="detailsForm" action="/jobs/view/details.php{if isset($jobData.job_code)}?code={$jobData.job_code}{/if}" method="post">
        <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="form">
           <tr>
            <td>
				<h4>Active ?</h4><br />
				<input type="checkbox" name="job_active" id="job_active" value="1" {if $jobData.job_active eq 1} checked="checked" {/if} />
			</td>
            <td>
				<h4 class="error">Title:</h4><br />
				<input type="text" name="job_title" id="job_title" value="{$jobData.job_title}" size="40"/>
				{if isset($errorArray.job_title)}<br /><span class="error">{$errorArray.job_title}</span>{/if}
			</td>
            <td>
				<h4 class="error">Category:</h4><br />
				<select id="category_code" name="category_code">
					<option value=""> ---- </option>
					{html_options options=$categoryPairs selected=$jobData.category_code}
				</select>
				{if isset($errorArray.category_code)}<br /><span class="error">{$errorArray.category_code}</span>{/if}
			</td>			
          </tr>	
          <tr>
            <td>
				<h4 class="error">Job Type:</h4><br />
				<select name="job_type" id="job_type" class="frm">
					<option value="" {if $jobData.job_type eq ''}SELECTED{/if}>- Employer type -</option>
					<option value="casual" {if $jobData.job_type eq 'casual'}SELECTED{/if}>Casual</option>
					<option value="temp" {if $jobData.job_type eq 'temp'}SELECTED{/if}>Temporary</option>
					<option value="contract" {if $jobData.job_type eq 'contract'}SELECTED{/if}>Contract</option>
					<option value="parttime" {if $jobData.job_type eq 'parttime'}SELECTED{/if}>Part-Time</option>
					<option value="permanent" {if $jobData.job_type eq 'permanent'}SELECTED{/if}>Permanent</option>
					<option value="graduate" {if $jobData.job_type eq 'graduate'}SELECTED{/if}>Graduate</option>
					<option value="internship" {if $jobData.job_type eq 'internship'}SELECTED{/if}>Internship</option>
					<option value="volunteer" {if $jobData.job_type eq 'volunteer'}SELECTED{/if}>Volunteer</option>
				</select>
				{if isset($errorArray.job_type)}<br /><span class="error">{$errorArray.job_type}</span>{/if}
			</td>
            <td colspan="2">
				<h4 class="error">Area:</h4><br />
				<input type="text" name="areapost_name" id="areapost_name" value="{$jobData.areapost_name}" size="60"/>
				<input type="hidden" name="areapost_code" id="areapost_code" value="{$jobData.areapost_code}" />
				{if isset($errorArray.areapost_code)}<br /><span class="error">{$errorArray.areapost_code}</span>{/if}
			</td>
          </tr>	
          <tr>
            <td>
				<h4 class="error">Posted By:</h4><br />
				<input type="text" name="job_poster_name" id="job_poster_name" value="{$jobData.job_poster_name}" size="40"/>
				{if isset($errorArray.job_poster_name)}<br /><span class="error">{$errorArray.job_poster_name}</span>{/if}
			</td>		  
            <td>
				<h4 class="error">Posted By Email:</h4><br />
				<input type="text" name="job_poster_email" id="job_poster_email" value="{$jobData.job_poster_email}" size="40"/>
				{if isset($errorArray.job_poster_email)}<br /><span class="error">{$errorArray.job_poster_email}</span>{/if}
			</td>
            <td>
				<h4>Posted By Number:</h4><br />
				<input type="text" name="job_poster_number" id="job_poster_number" value="{$jobData.job_poster_number}" size="40"/>
				{if isset($errorArray.job_poster_number)}<br /><span class="error">{$errorArray.job_poster_number}</span>{/if}
			</td>			
          </tr>		  
          <tr>
            <td>
				<h4>Reference:</h4><br />
				<input type="text" name="job_reference" id="job_reference" value="{$jobData.job_reference}" size="40"/>
			</td>		  
            <td colspan="2">
				<h4>Address:</h4><br />
				<input type="text" name="job_address" id="job_address" value="{$jobData.job_address}" size="80"/>
			</td>
          </tr>	
			<tr>
				<td colspan="3">
					<h4 class="error">Description:</h4><br />
					<textarea name="job_page" id="job_page" style="width: 850px; height: 700px;">{$jobData.job_page}</textarea>
					{if isset($errorArray.job_page)}<br /><span class="error">{$errorArray.job_page}</span>{/if}
				</td>
			</tr>			
        </table>
      </form>
	</div>
    <div class="clearer"><!-- --></div>
        <div class="mrg_top_10">
          <a href="/resources/jobs/" class="button cancel mrg_left_147 fl"><span>Cancel</span></a>
          <a href="javascript:submitForm();" class="blue_button mrg_left_20 fl"><span>Save &amp; Complete</span></a>   
        </div>
    <div class="clearer"><!-- --></div>
    </div><!--inner-->
 </div> 	
<!-- End Content job -->
 </div><!-- End Content job -->
 {include_php file='includes/footer.php'}
</div>
{literal}
<script type="text/javascript" language="javascript">
function submitForm() {
	nicEditors.findEditor('job_page').saveContent();
	document.forms.detailsForm.submit();					 
}

$(document).ready(function(){
		new nicEditor({
			iconsPath : '/library/javascript/nicedit/nicEditorIcons.gif',
			maxHeight : '800'
		}).panelInstance('job_page');
		
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
<!-- End Main Container -->
</body>
</html>
