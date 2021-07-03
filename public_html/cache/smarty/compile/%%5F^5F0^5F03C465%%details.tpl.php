<?php /* Smarty version 2.6.20, created on 2015-06-29 15:07:12
         compiled from account/details.tpl */ ?>
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
<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'includes/css.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

</head>
<body>
<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'includes/header.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'includes/menu.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

<section class="container">
	<div class="row">
    	<div class="col-xs-12 col-md-9 db-gutter-right">
			<div class="tenderbox eachbox">
                <div class="titles htitle">
                    <h1>Account Settings</h1>
                </div>
                <?php if (isset ( $this->_tpl_vars['success'] )): ?><p class="subhead">Update of your details was successful.</p><?php endif; ?>
				<form class="edit-form" id="detailsForm" name="detailsForm" action="/account/edit" method="post" enctype="multipart/form-data">
                     <div class="row">
                        <div class="col-sm-6">
                            <label>Name(s):</label>
							<input type="text" name="participant_name" id="participant_name"  value="<?php echo $this->_tpl_vars['participantloginData']['participant_name']; ?>
" />
							<?php if (isset ( $this->_tpl_vars['errorArray']['participant_name'] )): ?><em class="error"><?php echo $this->_tpl_vars['errorArray']['participant_name']; ?>
</em><?php endif; ?>		
                        </div>
                        <div class="col-sm-6">
                            <label>Surname:</label>
							<input type="text" name="participant_surname" id="participant_surname"  value="<?php echo $this->_tpl_vars['participantloginData']['participant_surname']; ?>
"/>
							<?php if (isset ( $this->_tpl_vars['errorArray']['participant_surname'] )): ?><em class="error"><?php echo $this->_tpl_vars['errorArray']['participant_surname']; ?>
</em><?php endif; ?>		
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <label>Gender:</label>
							<select id="participant_gender" name="participant_gender">
								<option value=""> --- </option>
								<option value="female" <?php if ($this->_tpl_vars['participantloginData']['participant_gender'] == 'female'): ?>selected<?php endif; ?>> Female </option>
								<option value="male" <?php if ($this->_tpl_vars['participantloginData']['participant_gender'] == 'male'): ?>selected<?php endif; ?>> Male </option>
							</select>
							<?php if (isset ( $this->_tpl_vars['errorArray']['participant_gender'] )): ?><em class="error"><?php echo $this->_tpl_vars['errorArray']['participant_gender']; ?>
</em><?php endif; ?>
                        </div>
                        <div class="col-sm-6">
                            <label>Date of birth:</label>
							<input type="text" name="participant_birthdate" id="participant_birthdate" value="<?php echo $this->_tpl_vars['participantloginData']['participant_birthdate']; ?>
" size="30" />
							<?php if (isset ( $this->_tpl_vars['errorArray']['participant_birthdate'] )): ?><em class="error"><?php echo $this->_tpl_vars['errorArray']['participant_birthdate']; ?>
</em><?php endif; ?>							
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <label>Area / Location:</label>
							<input type="text" name="areapost_name" id="areapost_name" value="<?php echo $this->_tpl_vars['participantloginData']['areapost_name']; ?>
" size="30" />
							<input type="hidden" name="areapost_code" id="areapost_code" value="<?php echo $this->_tpl_vars['participantloginData']['areapost_code']; ?>
" />                    
							<?php if (isset ( $this->_tpl_vars['errorArray']['areapost_code'] )): ?><em class="error"><?php echo $this->_tpl_vars['errorArray']['areapost_code']; ?>
</em><?php endif; ?>
                        </div>
                        <div class="col-sm-6">
                            <label>Email:</label>
							<input type="text" readonly disabled value="<?php echo $this->_tpl_vars['participantloginData']['participant_email']; ?>
" size="30" />					
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <label>Upload Profile Picture</label>
							<input type="file" name="profileimage" id="profileimage" />               
							<?php if (isset ( $this->_tpl_vars['errorArray']['profileimage'] )): ?><em class="error"><?php echo $this->_tpl_vars['errorArray']['profileimage']; ?>
</em><?php endif; ?>
                        </div>
                        <div class="col-sm-6">
                            <label>Profile Picture:</label>
							<?php if ($this->_tpl_vars['participantloginData']['participant_image_name'] != ''): ?>
								<br /><img src="/download/profileimage/<?php echo $this->_tpl_vars['participantloginData']['participant_code']; ?>
/thumb" />
							<?php else: ?>
								<img src="/media/avatar.jpg" />
							<?php endif; ?>			
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
				  <?php $_from = $this->_tpl_vars['loginData']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
				  <tr>
					<td valign="top"><?php echo $this->_tpl_vars['item']['participantlogin_type']; ?>
</td>		
					<td valign="top"><?php echo $this->_tpl_vars['item']['participantlogin_username']; ?>
</td>			
					<td valign="top"><?php echo $this->_tpl_vars['item']['participantlogin_name']; ?>
 <?php echo $this->_tpl_vars['item']['participantlogin_surname']; ?>
</td>		
					<td valign="top"><?php if ($this->_tpl_vars['item']['participantlogin_image'] != ''): ?><img src="<?php echo $this->_tpl_vars['item']['participantlogin_image']; ?>
" /><?php else: ?>N/A<?php endif; ?></td>			
					<td valign="top"><?php if ($this->_tpl_vars['item']['participantlogin_url'] != ''): ?><a href="<?php echo $this->_tpl_vars['item']['participantlogin_url']; ?>
" target="_blank">View</a><?php else: ?>N/A<?php endif; ?></td>			
				  </tr>
				  <?php endforeach; endif; unset($_from); ?>			
				</table>				
            </div>
        </div>
    </div>
</section>
<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'includes/footer.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

<?php echo '
<script src="/library/javascript/jquery-ui.js"></script>
<script type="text/javascript" language="javascript">
function submitForm() {
	document.forms.detailsForm.submit();					 
}

$( document ).ready(function() {
	
	$( "#participant_birthdate" ).datepicker({ dateFormat: \'yy-mm-dd\', changeYear: true, changeMonth: true});

});
</script>
'; ?>

</body>
</html>