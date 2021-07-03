<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>{$siteName} | Resources | jobs | {if isset($jobData.pk_job_id)}Edit job{else}Add a job{/if}</title>
{include_php file='admin/includes/css.php'}
{include_php file='admin/includes/javascript.php'}
{include_php file="includes/auto_complete.php"}
<script language="javascript" type="text/javascript" src="/library/javascript/calendar/jquery.datepick.package/jquery.datepick.js"></script>
<link rel="stylesheet" type="text/css" href="/library/javascript/calendar/jquery.datepick.package/jquery.datepick.css" />
{literal}
<script type="text/javascript">
$().ready(function() {

$('#job_added').datepick({dateFormat: 'yyyy-mm-dd'});
	
$("#areaName").autocomplete(areas);
});
</script>
{/literal}
</head>
<body>
<!-- Start Main Container -->
<div id="container">
    <!-- Start Content job -->
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
			<li><a href="/admin/jobs/view/" title="jobs">jobs</a></li>
			<li>{if isset($jobData.pk_job_id)}Edit job{else}Add a job{/if}</li>
        </ul>
	</div><!--breadcrumb--> 
  
	<div class="inner"> 
      <h2>{if isset($jobData.pk_job_id)}Edit job: {$jobData.job_name}{else}Add a new job{/if}</h2>
    <div id="sidetabs">
        <ul > 
            <li class="active"><a href="#" title="Details">Details</a></li>
			<li><a href="{if isset($jobData.pk_job_id)}/admin/jobs/view/page.php?pk_job_id={$jobData.pk_job_id}{else}#{/if}" title="Details">Page</a></li>
        </ul>
    </div><!--tabs-->

	<div class="detail_box">
      <form id="detailsForm" name="detailsForm" action="/admin/jobs/view/details.php{if isset($jobData.pk_job_id)}?pk_job_id={$jobData.pk_job_id}{/if}" method="post">
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
            <td class="left_col" {if isset($errorArray.job_title)}style="color: red"{/if}><h4>job title:</h4></td>
			<td><input type="text" name="job_title" id="job_title" value="{$jobData.job_title}" size="60"/></td>
          </tr>			  
          <tr>
            <td class="left_col" {if isset($errorArray.job_added)}style="color: red"{/if}><h4>Job Added:</h4></td>
			<td><input type="text" name="job_added" id="job_added" value="{$jobData.job_added}" size="60"/></td>
          </tr>		  
		 	  
          <tr>
            <td class="left_col" {if isset($errorArray.fk_section_id)}style="color: red"{/if}><h4>Section:</h4></td>
            <td>
				<select id="fk_section_id" name="fk_section_id">
					<option value=""> ---- </option>
					{html_options options=$sectionPairs selected=$jobData.fk_section_id}</td>
				</select>
			</td>
          </tr>	
          <tr>
            <td class="left_col" {if isset($errorArray.job_type)}style="color: red"{/if}><h4>Job Type:</h4></td>
            <td>
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
			</td>
          </tr>	
          <tr>
            <td class="left_col" {if isset($errorArray.areaName)}style="color: red"{/if}><h4>Willowvine Area:</h4></td>
            <td><input type="text" name="areaName" id="areaName" value="{$jobData.areaMap_path}" size="60"/></td>
          </tr>			  
          <tr>
            <td class="left_col"><h4>Affilliate Reference:</h4></td>
			<td><input type="text" name="job_affiliateReference" id="job_affiliateReference" value="{$jobData.job_affiliateReference}" size="60"/></td>
          </tr>			  		  
          <tr>
            <td class="left_col" {if isset($errorArray.job_poster_name)}style="color: red"{/if}><h4>Posted By:</h4></td>
            <td><input type="text" name="job_poster_name" id="job_poster_name" value="{$jobData.job_poster_name}" size="60"/></td>
          </tr>	
          <tr>
            <td class="left_col" {if isset($errorArray.job_poster_email)}style="color: red"{/if}><h4>Posted By Email:</h4></td>
            <td><input type="text" name="job_poster_email" id="job_poster_email" value="{$jobData.job_poster_email}" size="60"/></td>
          </tr>	
          <tr>
            <td class="left_col" {if isset($errorArray.job_poster_number)}style="color: red"{/if}><h4>Posted By Number:</h4></td>
            <td><input type="text" name="job_poster_number" id="job_poster_number" value="{$jobData.job_poster_number}" size="60"/></td>
          </tr>	
          <tr>
            <td class="left_col"><h4>Advert by:</h4></td>
            <td><input type="text" name="job_advertBy" id="job_advertBy" value="{$jobData.job_advertBy}" size="60"/></td>
          </tr>			  
          <tr>
            <td class="left_col"><h4>Ad Type:</h4></td>
            <td>
				<select name="job_AdType" id="job_AdType" class="frm">
					<option value="" {if $jobData.job_AdType eq ''}SELECTED{/if}>- Employer type -</option>
					<option value="offered" {if $jobData.job_AdType eq 'offered'}SELECTED{/if}>Offer</option>
					<option value="wanted" {if $jobData.job_AdType eq 'wanted'}SELECTED{/if}>Looking</option>
				</select>
			</td>			
          </tr>	
          <tr>
            <td class="left_col"><h4>Affilliate name:</h4></td>
			<td><input type="text" name="jobs_affiliate" id="jobs_affiliate" value="{$jobData.jobs_affiliate}" size="60"/></td>
          </tr>	
          <tr>
            <td class="left_col"><h4>Affilliate link:</h4></td>
            <td><input type="text" name="job_affiliateLink" id="job_affiliateLink" value="{$jobData.job_affiliateLink}" size="60"/></td>
          </tr>				  
          <tr>
            <td class="left_col"><h4>Address:</h4></td>
            <td><input type="text" name="job_address" id="job_address" value="{$jobData.job_address}" size="60"/></td>
          </tr>	
          <tr>
            <td class="left_col"><h4>Latitude:</h4></td>
            <td><input type="text" name="job_latitude" id="job_latitude" value="{$jobData.job_latitude}" size="60"/></td>
          </tr>		
          <tr>
            <td class="left_col"><h4>Longitude:</h4></td>
            <td><input type="text" name="job_longitude" id="job_longitude" value="{$jobData.job_longitude}" size="60"/></td>
          </tr>		  
          <tr>
            <td class="left_col"><h4>Job Area:</h4></td>
            <td>{$jobData.job_area}</td>
          </tr>		
          <tr>
            <td class="left_col"><h4>job Url Name:</h4></td>
            <td>{$jobData.job_link}</td>
          </tr>	
          <tr>
            <td class="left_col"><h4>Reference:</h4></td>
            <td>{$jobData.job_reference}</td>
          </tr>			  	  		  
        </table>
      </form>
	</div>
    <div class="clearer"><!-- --></div>
        <div class="mrg_top_10">
          <a href="/admin/resources/jobs/" class="button cancel mrg_left_147 fl"><span>Cancel</span></a>
          <a href="javascript:submitForm();" class="blue_button mrg_left_20 fl"><span>Save &amp; Complete</span></a>   
        </div>
    <div class="clearer"><!-- --></div>
    </div><!--inner-->
 </div> 	
<!-- End Content job -->
 </div><!-- End Content job -->
 {include_php file='admin/includes/footer.php'}
</div>
{literal}
<script type="text/javascript" language="javascript">
function submitForm() {
	document.forms.detailsForm.submit();					 
}
$(document).ready(function(){
	$('#job_added').datepick({
		   showOn: 'both', 
		   buttonImageOnly: true, 	   
		   dateFormat: 'yy-mm-dd',	
		   buttonImage: '/images/calendar-blue.gif',	   
		   onSelect: function(value, date) { 
			   if (value != '')
				  $('#'+this.id+'Span').html(value);
			   else    
				  $('#'+this.id+'Span').html('Not Set');
			   }
	}); 
});
</script>
{/literal}
<!-- End Main Container -->
</body>
</html>
