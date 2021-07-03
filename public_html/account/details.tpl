<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Business Lounge - Tenders, Trade Leads, Business Listings and participants</title>
<meta name="keywords" content="business, tenders, business listings, entrepreneurs, participants">
<meta name="description" content="Business Lounge offers business opportunities to corporates, entrepreneurs and SME’s from South Africa. Covering tenders, trade leads, business listings, participants and more prospects to grow your business...">          
<meta name="robots" content="index, follow">
<meta name="revisit-after" content="21 days">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta property="og:title" content="Business Lounge"> 
<meta property="og:image" content="http://www.bizlounge.co.za/images/logo.png"> 
<meta property="og:url" content="http://www.bizlounge.co.za">
<meta property="og:site_name" content="Business Lounge">
<meta property="og:type" content="website">
<meta property="og:description" content="Business Lounge offers business opportunities to corporates, entrepreneurs and SME’s from South Africa. Covering tenders, trade leads, business listings, participants and more prospects to grow your business.">
<link rel="icon" type="image/x-icon" href="favicon.ico" />
{include_php file='includes/css.php'}
</head>
<body>
{include_php file='includes/header.php'}
{include_php file='includes/menu.php'}
<section class="container">
	<div class="row">
    	<div class="col-xs-12 col-md-9 db-gutter-right">
			<div class="tenderbox eachbox">
                <div class="titles htitle">
                    <h1>Account Settings</h1>
                </div>
                {if isset($success)}<p class="subhead">Update of your details was successful.</p>{/if}
				<form class="edit-form" id="detailsForm" name="detailsForm" action="/account/edit" method="post" enctype="multipart/form-data">
                     <div class="row">
                        <div class="col-sm-6">
                            <label>Name(s):</label>
							<input type="text" name="participant_name" id="participant_name"  value="{$participantloginData.participant_name}" />
							{if isset($errorArray.participant_name)}<em class="error">{$errorArray.participant_name}</em>{/if}		
                        </div>
                        <div class="col-sm-6">
                            <label>Surname:</label>
							<input type="text" name="participant_surname" id="participant_surname"  value="{$participantloginData.participant_surname}"/>
							{if isset($errorArray.participant_surname)}<em class="error">{$errorArray.participant_surname}</em>{/if}		
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <label>Gender:</label>
							<select id="participant_gender" name="participant_gender">
								<option value=""> --- </option>
								<option value="female" {if $participantloginData.participant_gender eq 'female'}selected{/if}> Female </option>
								<option value="male" {if $participantloginData.participant_gender eq 'male'}selected{/if}> Male </option>
							</select>
							{if isset($errorArray.participant_gender)}<em class="error">{$errorArray.participant_gender}</em>{/if}
                        </div>
                        <div class="col-sm-6">
                            <label>Date of birth:</label>
							<input type="text" name="participant_birthdate" id="participant_birthdate" value="{$participantloginData.participant_birthdate}" size="30" />
							{if isset($errorArray.participant_birthdate)}<em class="error">{$errorArray.participant_birthdate}</em>{/if}							
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <label>Area / Location:</label>
							<input type="text" name="areapost_name" id="areapost_name" value="{$participantloginData.areapost_name}" size="30" />
							<input type="hidden" name="areapost_code" id="areapost_code" value="{$participantloginData.areapost_code}" />                    
							{if isset($errorArray.areapost_code)}<em class="error">{$errorArray.areapost_code}</em>{/if}
                        </div>
                        <div class="col-sm-6">
                            <label>Email:</label>
							<input type="text" readonly disabled value="{$participantloginData.participant_email}" size="30" />					
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <label>Upload Profile Picture</label>
							<input type="file" name="profileimage" id="profileimage" />               
							{if isset($errorArray.profileimage)}<em class="error">{$errorArray.profileimage}</em>{/if}
                        </div>
                        <div class="col-sm-6">
                            <label>Profile Picture:</label>
							{if $participantloginData.participant_image_name neq ''}
								<br /><img src="/download/profileimage/{$participantloginData.participant_code}/thumb" />
							{else}
								<img src="/media/avatar.jpg" />
							{/if}			
                        </div>
                    </div>					
					<br />
                    <button type="submit" class="btn btn-md btn-save">Save participant</button>
                </form>
				<br /><br />
                <div class="titles htitle">
                    <h1>Your current login options</h1>
                </div>
				<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="innertable"> 				  
				  <thead>
				  <tr>				
					<th valign="top">Type</th>
					<th valign="top">Username</th>
					<th valign="top">Fullname</th>				
					<th valign="top">Image</th>				
					<th valign="top">View</th>				
				  </tr>
				  </thead>
				  {foreach from=$loginData item=item}
				  <tr>
					<td valign="top">{$item.participantlogin_type}</td>		
					<td valign="top">{$item.participantlogin_username}</td>			
					<td valign="top">{$item.participantlogin_name} {$item.participantlogin_surname}</td>		
					<td valign="top">{if $item.participantlogin_image neq ''}<img src="{$item.participantlogin_image}" />{else}N/A{/if}</td>			
					<td valign="top">{if $item.participantlogin_url neq ''}<a href="{$item.participantlogin_url}" target="_blank">View</a>{else}N/A{/if}</td>			
				  </tr>
				  {/foreach}			
				</table>				
            </div>
        </div>
    </div>
</section>
{include_php file='includes/footer.php'}
{literal}
<script src="/library/javascript/jquery-ui.js"></script>
<script type="text/javascript" language="javascript">
function submitForm() {
	document.forms.detailsForm.submit();					 
}

$( document ).ready(function() {
	
	$( "#participant_birthdate" ).datepicker({ dateFormat: 'yy-mm-dd', changeYear: true, changeMonth: true});

});
</script>
{/literal}
</body>
</html>