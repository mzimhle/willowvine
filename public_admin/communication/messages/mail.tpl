<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>The Maverick</title>
{include_php file='includes/css.php'}
{include_php file='includes/javascript.php'}
</head>
<body>
<!-- Start Main Container -->
<div id="container">
    <!-- Start Content recruiter -->
  <div id="content">
    {include_php file='includes/header.php'}
  	<br />
	<div id="breadcrumb">
        <ul>
            <li><a href="/" title="Home">Home</a></li>
			<li><a href="/campaign/" title="Campaign">Campaign</a></li>
			<li><a href="/communication/message/" title="Campaign">Newsletter</a></li>
			<li>{$campaignData.campaign_name}</li>
			<li>Mail to members</li>
        </ul>
	</div><!--breadcrumb--> 
  
	<div class="inner"> 
      <h2>{$campaignData.campaign_name}</h2>
    <div class="clearer"><!-- --></div>	
    <div id="sidetabs">
        <ul >             
            <li><a href="/communication/message/details.php?code={$campaignData.campaign_code}" title="Details">Details</a></li>
			<li class="active"><a href="#" title="Mail">Mail</a></li>
			<li><a href="/communication/message/comms.php?code={$campaignData.campaign_code}" title="Details">Comms</a></li>
        </ul>
    </div><!--tabs-->	
	<div class="detail_box">
	<h4>Members sent the mailer</h4><br />
	<form id="detailsForm" name="detailsForm" action="/communication/message/mail.php?code={$campaignData.campaign_code}" method="post">
	<table width="100%" class="innertable" border="0" cellspacing="0" cellpadding="0">
		<thead>
		<tr>			
			<th>Name</th>
			<th>Email</th>
			<th>Cellphone</th>
			<th>Area / Town</th>
			<th></th>
		</tr>
		</thead>
		<tbody id="contacts" name="contacts"></tbody>						
	</table>
	<br />
	<button onclick="sendEmail(); return false;">Send Newsletters</button>
	<input type="hidden" id="sendnewsletter" name="sendnewsletter" value="1" />
	</form>
	</div>
	<div class="clearer"><!-- --></div>	

    </div><!--inner-->	
<!-- End Content recruiter -->
 </div><!-- End Content recruiter -->
 {include_php file='includes/footer.php'}
</div>
{literal}
<script type="text/javascript">
function sendEmail() {
	if(confirm('Are you sure you want to send this to all members?')) {
		document.forms.detailsForm.submit();					 
	}
}
</script>
{/literal}
<!-- End Main Container -->
</body>
</html>
