<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>{$siteName} | Resources | jobs | Page Details{if isset($jobData.pk_job_id)}Edit job{else}Add a job{/if}</title>
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
    <div class="logged_in">
        <ul>
            <li><a href="/help/users.php" title="Get Help" class="help_icon"> Help</a></li>
            <li>|<a href="/logout.php" title="Logout">Logout</a></li>
        </ul>
    </div><!--logged_in-->
  	<br />
	<div id="breadcrumb">
        <ul>
            <li><a href="/default.php" title="Home">Home</a></li>
			<li><a href="/jobs/view/" title="jobs">jobs</a></li>
			<li>{if isset($jobData.pk_job_id)}Edit job{else}Add a job{/if}</li>
        </ul>
	</div><!--breadcrumb--> 
  
	<div class="inner"> 
      <h2>{if isset($jobData.pk_job_id)}Edit job: {$jobData.job_name}{else}Add a new job{/if}</h2>
    <div id="sidetabs">
        <ul > 
            <li><a href="/jobs/view/details.php?pk_job_id={$jobData.pk_job_id}" title="Details">Details</a></li>
			<li class="active"><a href="#" title="Details">Page</a></li>
        </ul>
    </div><!--tabs-->

	<div class="detail_box">
      <form id="pageForm" name="pageForm" action="/jobs/view/page.php{if isset($jobData.pk_job_id)}?pk_job_id={$jobData.pk_job_id}{/if}" method="post">
        <table width="700" border="0" align="center" cellpadding="0" cellspacing="0" class="form">
           <tr>
            <td class="left_col"><h4>job Active?</h4></td>
            <td><input type="checkbox" name="job_active" id="job_active" value="1" {if $jobData.job_active eq 1} checked="checked" {/if} /></td>
          </tr>	  	  
          <tr>
            <td class="left_col"><h4>View Job on Site:</h4></td>
            <td>
				<a href="/jobs/search/{$jobData.section_urlName}/details/{$jobData.job_link}/{$jobData.job_reference}/" target="_blank">View job On site</a>
          </tr>	
		  <tr>
            <td class="left_col"><h4>View Job on Site:</h4></td>
            <td>
				<textarea name="job_page" id="job_page" style="width: 450px; height: 700px;">{$jobData.job_page}</textarea>
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
	document.forms.pageForm.submit();					 
}
$(document).ready(function(){
		new nicEditor({
			iconsPath : '/library/javascript/nicedit/nicEditorIcons.gif',
			maxHeight : '800'
		}).panelInstance('job_page');
});
</script>
{/literal}
<!-- End Main Container -->
</body>
</html>
