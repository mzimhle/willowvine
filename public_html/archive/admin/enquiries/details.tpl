<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>{$siteName} | Enquiries | View Enquiry</title>
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
            <li><a href="/admin/enquiries/" title="Users">Enquiries</a></li>
			<li>View Enquiry</li>
        </ul>
	</div><!--breadcrumb--> 
  
	<div class="inner"> 
      <h2>Edit enquiry for: {$enquiryData.enquiry_name}</h2>
    <div id="sidetabs">
        <ul >
            <li class="active"><a href="#" title="Details">Details</a></li>
        </ul>
    </div><!--tabs-->
	<div class="detail_box">
      <form id="detailsForm" name="detailsForm" action="/admin/enquiries/details.php?pk_enquiry_id={$enquiryData.pk_enquiry_id}" method="post">
        <table width="700" border="0" align="center" cellpadding="0" cellspacing="0" class="form">
          <tr>
            <td><h4>Full Name:</h4></td>
            <td>{$enquiryData.enquiry_name}</td>
          </tr>
          <tr>
            <td><h4>Number:</h4></td>
            <td>{$enquiryData.enquiry_number}</td>
          </tr>          
           <tr>
            <td class="left_col"><h4>Email:</h4></td>
            <td>{$enquiryData.enquiry_email}</td>
          </tr>		  	   		   	   		   		   
          <tr>
            <td><h4>Area:</h4></td>
            <td>{$enquiryData.areaMap_shortPath}</td>
           </tr>		  				  
		<tr>
            <td class="left_col" valign="top"><h4>Message:</h4></td>
            <td>{$enquiryData.enquiry_comments}</td>
          </tr>	
           <tr>
            <td class="left_col" {if isset($success)}style="color: green; font-weight: bold;"{/if}><h4>Message enquirier:</h4></td>
             <td><textarea cols="50" rows="10" id="enquiry_message" name="enquiry_message"></textarea></td>
          </tr>	
           <tr>
				<td  colspan="2" class="left_col">
					<a href="javascript: document.forms.detailsForm.submit();" title="Send Mail" class="blue_button fr mrg_bot_10">
						<span style="float:right;">Send Mail</span>
					</a>
				</td>
          </tr>			  
        </table>
      </form>
	</div>
    <div class="clearer"><!-- --></div>
    </div><!--inner-->
 </div> 	
<!-- End Content Section -->
 </div><!-- End Content Section -->
 {include_php file='admin/includes/footer.php'}
</div>
<!-- End Main Container -->
</body>
</html>
