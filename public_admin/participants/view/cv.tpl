<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Participants</title>
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
            <li><a href="/participants/" title="Participants">Participants</a></li>
			<li><a href="/participants/view/" title="View">View</a></li>
			<li><a href="/participants/view/details.php?code={$participantData.participant_code}" title="Jobs">{$participantData.participant_name} {$participantData.participant_surname}</a></li>
			<li>CVs</li>
        </ul>
	</div><!--breadcrumb--> 
  
	<div class="inner"> 
      <h2>{$participantData.participant_name} {$participantData.participant_surname}</h2>
    <div id="sidetabs">
        <ul >
            <li><a href="/participants/view/details.php?code={$participantData.participant_code}" title="Details">Details</a></li>
			<li class="active"><a href="#" title="CV">CV's</a></li>
			<li><a href="/participants/view/login.php?code={$participantData.participant_code}" title="Login">Login</a></li>
        </ul>
    </div><!--tabs-->
	<div class="detail_box">
      <form id="detailsForm" name="detailsForm" action="/participants/view/cv.php?code={$participantData.participant_code}" method="post" enctype="multipart/form-data">
        <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="form">
		 <tr>
			<td>Added</td>
			<td>File name</td>
			<td>Download file</td>
		   </tr>		 
          <tr>
		 {foreach from=$cvData item=item}
			<tr>
            <td align="left">{$item.cv_added}</td>
			<td align="left">{$item.cv_name}</td>
			<td align="left"><a href="{$item.cv_path}" target="_blank">Download</a></td>
          </tr>			  
		  {foreachelse}
          <tr>
            <td colspan="3"><h4>No CV uploaded.</h4></td>        
          </tr>				  
		  {/foreach}
		  <tr>
			<td colspan="3">
				<input type="file" id="documentfile" name="documentfile" />
				{if isset($errorArray)}<br />{$errorArray}{/if}
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
 </div><!-- End Content Section -->
 {include_php file='includes/footer.php'}
</div>
<!-- End Main Container -->
{literal}
<script type="text/javascript" language="javascript">
function submitForm() {
	document.forms.detailsForm.submit();					 
}
</script>
{/literal}
</body>
</html>
