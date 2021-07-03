<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>WillowVine | Recruiter | Register with added benefits | </title>
<meta name="description" content="Register for jobs, search find, Only jobs and careers in your area, city or town." />
<meta name="keywords" content="south african jobs,south africa careers,jobs south africa,willowvine,willowvine,jobs,careers, Cape Town, East London, Port Elizabeth, Johannesburg, Durban, Polokwane, Bloemfontein, Pretoria" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
{include_php file="includes/css.php"}
{include_php file="includes/javascript.php"}
</head>
<body>
<div id="home">
	<div id="main">
<!-- Start Header -->
{include_php file="includes/header.php"}
<!-- End Header -->
<!-- Start Navigation -->
{include_php file="includes/navigation.php"}
<!-- End Navigation -->
<!-- Start Navigation -->
<div id="contnav">
	<p>
	<a href="/">Home</a> &nbsp; 
	<span class="dash">|</span> &nbsp; 
	<a href="/recruiter/">Recruiter</a> &nbsp; 	
	<span class="dash">|</span> &nbsp; 
	<a href="/recruiter/">Become a member</a> &nbsp; 	
	<span class="dash">|</span> &nbsp; 	
	</p>
</div>
<!-- End Navigation -->
		<div id="content">
			<div class="inleft">
				<p class="ptitle">Become a member</p><br clear="all" />
				<p>By joining you will get unlimited access to our CV database and get the best that we have to offer for free, we will send it to your straight to your email address when you register, first month is free. You will also be able to view how many times your posts have been viewed and also who applied for them.</p>
			</div><!-- ending of inleft -->
			<div class="clear"></div>
			<div class="leftboxbiggy">
				<img src="/images/leftboxbig_top.jpg" alt="" width="484" height="23" /><div class="clear"></div>
				<div class="leftboxbig">
					<h3>Recruiters - Sign up here</h3><br clear="all" />
					<div class="stat_row" style="clear:both;">
						<strong>Sign up as a Willowvine Recruiter and get:</strong><br clear="all" /><br clear="all" />
                        <ul style="clear:both;">
                            <li style="clear:both;">Unlimited Job Postings</li>
                            <li style="clear:both;">Access to more than 1000 recruiters daily</li>
                            <li style="clear:both;">Job Alert sent out informing job seekers of new jobs posted</li>
                            <li style="clear:both;">Applications with CV Attached directly to your inbox</li>
                            <li style="clear:both;">NO COMMISSION as we’re not an agent</li>
                        </ul>
					</div><div class="clear"></div><br clear="all" /><!-- ending of row -->
                    <span class="success_orange_text"><strong>Get unlimited access to our CV database after you register and confirm you email address.</strong></span>
			  </div><!-- ending of leftboxbig -->
			  <img src="/images/leftboxbig_bottom.jpg" alt="" width="484" height="28" /><div class="clear"></div>
			</div><!-- ending of leftboxbiggy -->
			<div class="mboxarear">
				<img src="/images/mbox_top.jpg" alt="" /><div class="clear"></div>
				<div class="inmbox">
					<form action="/recruiter/register/" method="post" id="recruiterForm" name="recruiterForm">
						<div class="inmbox">
							<div class="irow">
								<p class="ltext"{if isset($errorMessages.recruiter_name)}style="color: red; font-weight: bold;"{/if}>Full Name / Company Name :</p><input type="text" size="30" maxlength="50" value="{$data.recruiter_name}" name="recruiter_name" id="recruiter_name" class="ininput" /> <span class="content">*</span>{if isset($errorMessages.recruiter_name)}<br /><br /><span class="fr" style="color: red">({$errorMessages.recruiter_name})</span>{/if}
							</div>
							<div class="irow">
								<p class="ltext"{if isset($errorMessages.fkAreaId)}style="color: red; font-weight: bold;"{/if}>City / Town :</p>
								<select name="fkAreaId" id="fkAreaId" class="ininput selectfix">
									<option value="">- City / Town -</option>{html_options options=$areaMapOptions selected=$data.fkAreaId}
								</select> <span class="content">*</span>{if isset($errorMessages.fkAreaId)}<br /><br /><span class="fr" style="color: red">({$errorMessages.fkAreaId})</span>{/if}
							</div>
							<div class="irow">
								<p class="ltext">Number :</p><input type="text" size="30" maxlength="50" value="{$data.recruiter_number}" name="recruiter_number" id="recruiter_number" class="ininput" />
							</div>
							<div class="irow">
								<p class="ltext"{if isset($errorMessages.recruiter_email)}style="color: red; font-weight: bold;"{/if}>Email : </p><input type="text" size="30" maxlength="100" value="{$data.recruiter_email}" name="recruiter_email" id="recruiter_email" class="ininput" /> <span class="content">*</span>{if isset($errorMessages.recruiter_email)}<br /><br /><span class="fr" style="color: red">({$errorMessages.recruiter_email})</span>{/if}
							</div>
							<div class="irow">
								<p class="ltext"{if isset($errorMessages.recruiter_password)}style="color: red; font-weight: bold;"{/if}>Select a password : </p><input type="password" size="30" maxlength="50" value="{$data.recruiter_password}" name="recruiter_password" id="recruiter_password" class="ininput" /> <span class="content">*</span>{if isset($errorMessages.recruiter_password)}<br /><br /><span class="fr" style="color: red">({$errorMessages.recruiter_password})</span>{/if}
							</div>
							<div class="irow">
								<p class="ltext"{if isset($errorMessages.recruiter_password)}style="color: red; font-weight: bold;"{/if}>Re-enter password :</p><input type="password" size="30" maxlength="50" value="{$data.recruiter_password_2}" name="recruiter_password_2" id="recruiter_password_2" class="ininput" /> <span class="content">*</span>
							</div>		
							<div class="irow">
								<p class="ltext">Address :</p><input type="text" name="recruiter_address" id="recruiter_address" class="ininput" value="{$data.recruiter_address}"/>
							</div>	
						</div>
						<br />
						<br />
						<a href="JavaScript:submitform();"><img src="/images/submit_cta.gif" class="marg_left203" style="cursor:pointer;" border="0" alt="Click to submit your details." title="Click to submit your details." /></a>
					</form>
				</div><!-- ending of inmbox -->
				<img src="/images/mbox_bottom.jpg" alt="" /><div class="clear"></div>
			</div><!-- ending of mboxarear -->
		</div><!-- ending of content -->
	</div><!-- main -->
</div><!-- home -->
<div class="clear"></div>
<div id="footerarea">
	<div id="footer">
{include_php file='includes/footer.php'}
	</div><!-- footer -->
</div><!-- footerarea -->
{literal}
<script type="text/javascript" language="javascript">
function submitform() {
	document.forms.recruiterForm.submit();
}
</script>
{/literal}
</body>
</html>