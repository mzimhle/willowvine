<?php /* Smarty version 2.6.20, created on 2014-09-18 11:29:08
         compiled from admin/jobs/view/details.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'admin/jobs/view/details.tpl', 78, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $this->_tpl_vars['siteName']; ?>
 | Resources | jobs | <?php if (isset ( $this->_tpl_vars['jobData']['pk_job_id'] )): ?>Edit job<?php else: ?>Add a job<?php endif; ?></title>
<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'admin/includes/css.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'admin/includes/javascript.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "includes/auto_complete.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

<script language="javascript" type="text/javascript" src="/library/javascript/calendar/jquery.datepick.package/jquery.datepick.js"></script>
<link rel="stylesheet" type="text/css" href="/library/javascript/calendar/jquery.datepick.package/jquery.datepick.css" />
<?php echo '
<script type="text/javascript">
$().ready(function() {

$(\'#job_added\').datepick({dateFormat: \'yyyy-mm-dd\'});
	
$("#areaName").autocomplete(areas);
});
</script>
'; ?>

</head>
<body>
<!-- Start Main Container -->
<div id="container">
    <!-- Start Content job -->
  <div id="content">
    <?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'admin/includes/header.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

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
			<li><?php if (isset ( $this->_tpl_vars['jobData']['pk_job_id'] )): ?>Edit job<?php else: ?>Add a job<?php endif; ?></li>
        </ul>
	</div><!--breadcrumb--> 
  
	<div class="inner"> 
      <h2><?php if (isset ( $this->_tpl_vars['jobData']['pk_job_id'] )): ?>Edit job: <?php echo $this->_tpl_vars['jobData']['job_name']; ?>
<?php else: ?>Add a new job<?php endif; ?></h2>
    <div id="sidetabs">
        <ul > 
            <li class="active"><a href="#" title="Details">Details</a></li>
			<li><a href="<?php if (isset ( $this->_tpl_vars['jobData']['pk_job_id'] )): ?>/admin/jobs/view/page.php?pk_job_id=<?php echo $this->_tpl_vars['jobData']['pk_job_id']; ?>
<?php else: ?>#<?php endif; ?>" title="Details">Page</a></li>
        </ul>
    </div><!--tabs-->

	<div class="detail_box">
      <form id="detailsForm" name="detailsForm" action="/admin/jobs/view/details.php<?php if (isset ( $this->_tpl_vars['jobData']['pk_job_id'] )): ?>?pk_job_id=<?php echo $this->_tpl_vars['jobData']['pk_job_id']; ?>
<?php endif; ?>" method="post">
        <table width="700" border="0" align="center" cellpadding="0" cellspacing="0" class="form">
           <tr>
            <td class="left_col"><h4>job Active?</h4></td>
            <td><input type="checkbox" name="job_active" id="job_active" value="1" <?php if ($this->_tpl_vars['jobData']['job_active'] == 1): ?> checked="checked" <?php endif; ?> /></td>
          </tr>	
          <tr>
            <td class="left_col"><h4>View Job on Site:</h4></td>
            <td>
				<a href="/jobs/search/<?php echo $this->_tpl_vars['jobData']['section_urlName']; ?>
/details/<?php echo $this->_tpl_vars['jobData']['job_link']; ?>
/<?php echo $this->_tpl_vars['jobData']['job_reference']; ?>
/" target="_blank">View job On site</a>
          </tr>	
          <tr>
            <td class="left_col" <?php if (isset ( $this->_tpl_vars['errorArray']['job_title'] )): ?>style="color: red"<?php endif; ?>><h4>job title:</h4></td>
			<td><input type="text" name="job_title" id="job_title" value="<?php echo $this->_tpl_vars['jobData']['job_title']; ?>
" size="60"/></td>
          </tr>			  
          <tr>
            <td class="left_col" <?php if (isset ( $this->_tpl_vars['errorArray']['job_added'] )): ?>style="color: red"<?php endif; ?>><h4>Job Added:</h4></td>
			<td><input type="text" name="job_added" id="job_added" value="<?php echo $this->_tpl_vars['jobData']['job_added']; ?>
" size="60"/></td>
          </tr>		  
		 	  
          <tr>
            <td class="left_col" <?php if (isset ( $this->_tpl_vars['errorArray']['fk_section_id'] )): ?>style="color: red"<?php endif; ?>><h4>Section:</h4></td>
            <td>
				<select id="fk_section_id" name="fk_section_id">
					<option value=""> ---- </option>
					<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['sectionPairs'],'selected' => $this->_tpl_vars['jobData']['fk_section_id']), $this);?>
</td>
				</select>
			</td>
          </tr>	
          <tr>
            <td class="left_col" <?php if (isset ( $this->_tpl_vars['errorArray']['job_type'] )): ?>style="color: red"<?php endif; ?>><h4>Job Type:</h4></td>
            <td>
				<select name="job_type" id="job_type" class="frm">
					<option value="" <?php if ($this->_tpl_vars['jobData']['job_type'] == ''): ?>SELECTED<?php endif; ?>>- Employer type -</option>
					<option value="casual" <?php if ($this->_tpl_vars['jobData']['job_type'] == 'casual'): ?>SELECTED<?php endif; ?>>Casual</option>
					<option value="temp" <?php if ($this->_tpl_vars['jobData']['job_type'] == 'temp'): ?>SELECTED<?php endif; ?>>Temporary</option>
					<option value="contract" <?php if ($this->_tpl_vars['jobData']['job_type'] == 'contract'): ?>SELECTED<?php endif; ?>>Contract</option>
					<option value="parttime" <?php if ($this->_tpl_vars['jobData']['job_type'] == 'parttime'): ?>SELECTED<?php endif; ?>>Part-Time</option>
					<option value="permanent" <?php if ($this->_tpl_vars['jobData']['job_type'] == 'permanent'): ?>SELECTED<?php endif; ?>>Permanent</option>
					<option value="graduate" <?php if ($this->_tpl_vars['jobData']['job_type'] == 'graduate'): ?>SELECTED<?php endif; ?>>Graduate</option>
					<option value="internship" <?php if ($this->_tpl_vars['jobData']['job_type'] == 'internship'): ?>SELECTED<?php endif; ?>>Internship</option>
					<option value="volunteer" <?php if ($this->_tpl_vars['jobData']['job_type'] == 'volunteer'): ?>SELECTED<?php endif; ?>>Volunteer</option>
				</select>
			</td>
          </tr>	
          <tr>
            <td class="left_col" <?php if (isset ( $this->_tpl_vars['errorArray']['areaName'] )): ?>style="color: red"<?php endif; ?>><h4>Willowvine Area:</h4></td>
            <td><input type="text" name="areaName" id="areaName" value="<?php echo $this->_tpl_vars['jobData']['areaMap_path']; ?>
" size="60"/></td>
          </tr>			  
          <tr>
            <td class="left_col"><h4>Affilliate Reference:</h4></td>
			<td><input type="text" name="job_affiliateReference" id="job_affiliateReference" value="<?php echo $this->_tpl_vars['jobData']['job_affiliateReference']; ?>
" size="60"/></td>
          </tr>			  		  
          <tr>
            <td class="left_col" <?php if (isset ( $this->_tpl_vars['errorArray']['job_poster_name'] )): ?>style="color: red"<?php endif; ?>><h4>Posted By:</h4></td>
            <td><input type="text" name="job_poster_name" id="job_poster_name" value="<?php echo $this->_tpl_vars['jobData']['job_poster_name']; ?>
" size="60"/></td>
          </tr>	
          <tr>
            <td class="left_col" <?php if (isset ( $this->_tpl_vars['errorArray']['job_poster_email'] )): ?>style="color: red"<?php endif; ?>><h4>Posted By Email:</h4></td>
            <td><input type="text" name="job_poster_email" id="job_poster_email" value="<?php echo $this->_tpl_vars['jobData']['job_poster_email']; ?>
" size="60"/></td>
          </tr>	
          <tr>
            <td class="left_col" <?php if (isset ( $this->_tpl_vars['errorArray']['job_poster_number'] )): ?>style="color: red"<?php endif; ?>><h4>Posted By Number:</h4></td>
            <td><input type="text" name="job_poster_number" id="job_poster_number" value="<?php echo $this->_tpl_vars['jobData']['job_poster_number']; ?>
" size="60"/></td>
          </tr>	
          <tr>
            <td class="left_col"><h4>Advert by:</h4></td>
            <td><input type="text" name="job_advertBy" id="job_advertBy" value="<?php echo $this->_tpl_vars['jobData']['job_advertBy']; ?>
" size="60"/></td>
          </tr>			  
          <tr>
            <td class="left_col"><h4>Ad Type:</h4></td>
            <td>
				<select name="job_AdType" id="job_AdType" class="frm">
					<option value="" <?php if ($this->_tpl_vars['jobData']['job_AdType'] == ''): ?>SELECTED<?php endif; ?>>- Employer type -</option>
					<option value="offered" <?php if ($this->_tpl_vars['jobData']['job_AdType'] == 'offered'): ?>SELECTED<?php endif; ?>>Offer</option>
					<option value="wanted" <?php if ($this->_tpl_vars['jobData']['job_AdType'] == 'wanted'): ?>SELECTED<?php endif; ?>>Looking</option>
				</select>
			</td>			
          </tr>	
          <tr>
            <td class="left_col"><h4>Affilliate name:</h4></td>
			<td><input type="text" name="jobs_affiliate" id="jobs_affiliate" value="<?php echo $this->_tpl_vars['jobData']['jobs_affiliate']; ?>
" size="60"/></td>
          </tr>	
          <tr>
            <td class="left_col"><h4>Affilliate link:</h4></td>
            <td><input type="text" name="job_affiliateLink" id="job_affiliateLink" value="<?php echo $this->_tpl_vars['jobData']['job_affiliateLink']; ?>
" size="60"/></td>
          </tr>				  
          <tr>
            <td class="left_col"><h4>Address:</h4></td>
            <td><input type="text" name="job_address" id="job_address" value="<?php echo $this->_tpl_vars['jobData']['job_address']; ?>
" size="60"/></td>
          </tr>	
          <tr>
            <td class="left_col"><h4>Latitude:</h4></td>
            <td><input type="text" name="job_latitude" id="job_latitude" value="<?php echo $this->_tpl_vars['jobData']['job_latitude']; ?>
" size="60"/></td>
          </tr>		
          <tr>
            <td class="left_col"><h4>Longitude:</h4></td>
            <td><input type="text" name="job_longitude" id="job_longitude" value="<?php echo $this->_tpl_vars['jobData']['job_longitude']; ?>
" size="60"/></td>
          </tr>		  
          <tr>
            <td class="left_col"><h4>Job Area:</h4></td>
            <td><?php echo $this->_tpl_vars['jobData']['job_area']; ?>
</td>
          </tr>		
          <tr>
            <td class="left_col"><h4>job Url Name:</h4></td>
            <td><?php echo $this->_tpl_vars['jobData']['job_link']; ?>
</td>
          </tr>	
          <tr>
            <td class="left_col"><h4>Reference:</h4></td>
            <td><?php echo $this->_tpl_vars['jobData']['job_reference']; ?>
</td>
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
 <?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'admin/includes/footer.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

</div>
<?php echo '
<script type="text/javascript" language="javascript">
function submitForm() {
	document.forms.detailsForm.submit();					 
}
$(document).ready(function(){
	$(\'#job_added\').datepick({
		   showOn: \'both\', 
		   buttonImageOnly: true, 	   
		   dateFormat: \'yy-mm-dd\',	
		   buttonImage: \'/images/calendar-blue.gif\',	   
		   onSelect: function(value, date) { 
			   if (value != \'\')
				  $(\'#\'+this.id+\'Span\').html(value);
			   else    
				  $(\'#\'+this.id+\'Span\').html(\'Not Set\');
			   }
	}); 
});
</script>
'; ?>

<!-- End Main Container -->
</body>
</html>