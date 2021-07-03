<?php /* Smarty version 2.6.20, created on 2015-01-13 11:44:48
         compiled from admin/enquiries/default.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $this->_tpl_vars['siteName']; ?>
 | Enquiries</title>
<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'admin/includes/css.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'admin/includes/javascript.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'admin/includes/calendar.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

<script type="text/javascript" language="javascript" src="/admin/enquiries/default.js"></script>
</head>

<body>
<!-- Start Main Container -->
<div id="container">
    <!-- Start Content Section -->
  <div id="content">
    <?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'admin/includes/header.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

	<div class="logged_in">
            <ul>
                <li><a href="/admin/help/enquiries.php" title="Get Help" class="help_icon"> Help</a></li>
                <li>|<a href="/admin/logout.php" title="Logout">Logout</a></li>
            </ul>
        </div><!--logged_in-->
	<div id="breadcrumb">
        <ul>
            <li><a href="/admin/default.php" title="Home">Home</a></li>
            <li><a href="/admin/enquiries/" title="Enquiries">Enquiries</a></li>
        </ul>
	</div><!--breadcrumb-->  
	<div class="inner">     
    <h2>Manage Enquiries</h2>		
	<h4>Manage all the enquiries in the database, view and edit them at will.</h4>	
	<!-- <a href="/admin/enquiries/details.php" title="Click to Add a new User" class="blue_button fr mrg_bot_10"><span style="float:right;">Add a new User</span></a> <br /> -->
    <div class="clearer"><!-- --></div>
     <!-- Start Search Form -->
    <div class="filter">
 	<div id="searchBar" class="left">
    	<strong class="line fl">Filter Enquiries:</strong>
          <form action="" method="post" name="searchForm" id="searchForm" onsubmit="return false;"  >
            <input class="small_field" type="text" id="search_text" name="search_text~t" value="" size="20" maxlength="150" />                        
              <input type="hidden" id="start_date" name="job_added~sd" value="" onchange="document.getElementById('dateShow').innerHTML = this.value;" />
                <strong class="line fl"><span id="dateShow" class="fl">Select a start date</span></strong>
                <img align="left" id="startButton" name="startButton" src="/admin/images/calendar.gif" style="cursor:pointer" width="32" height="32" hspace="0" vspace="0" border="0" alt="Calendar picker" />            
            <input type="hidden" id="end_date" name="job_added~ed" value="" onchange="document.getElementById('endDateShow').innerHTML = this.value;" />
              <strong class="line fl mrg_left_20"><span id="endDateShow">Select an end date</span></strong>
              <img align="left" id="endButton" name="endButton" src="/admin/images/calendar.gif" style="cursor:pointer" width="32" height="32" hspace="0" vspace="0" border="0" alt="Calendar picker" /> 
               <strong class="line fl mrg_left_20">Entries per page:</strong>
            <select class="small_field" id="per_page" name="per_page~i">
                <option value="99999" <?php if ($this->_tpl_vars['perPageSelect'] == '99999'): ?> selected="selected"<?php endif; ?>>All</option>
                <option value="5" <?php if ($this->_tpl_vars['perPageSelect'] == '5'): ?> selected="selected"<?php endif; ?>>5</option>
                <option value="10" <?php if ($this->_tpl_vars['perPageSelect'] == '10'): ?> selected="selected"<?php endif; ?>>10</option>
                <option value="20" <?php if ($this->_tpl_vars['perPageSelect'] == '20'): ?> selected="selected"<?php endif; ?>>20</option>
                <option value="30" <?php if ($this->_tpl_vars['perPageSelect'] == '30'): ?> selected="selected"<?php endif; ?>>30</option>
                <option value="40" <?php if ($this->_tpl_vars['perPageSelect'] == '40'): ?> selected="selected"<?php endif; ?>>40</option>
            </select>
         </form>
        </div>
          <a  href="javascript:void(0);" onClick="send_filter(1);" class="button next fr"><span>Filter</span></a>
    </div>
    <div class="clearer"><!-- --></div>
    <div id="tableContent" align="center"><img align="middle" src="/admin/images/ajax-loader.gif" alt="loading" /></div>
    <div class="clearer"><!-- --></div>
    </div><!--inner-->
  </div><!-- End Content Section -->
 <?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'admin/includes/footer.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

 <?php echo '
<script type="text/javascript" language="javascript">
//setup calendar picker
Calendar.setup({
	inputField : "start_date", // ID of the input field
	ifFormat   : "%Y-%m-%d",        // the date format
	button     : "startButton"   // ID of the button
});

//setup calendar picker
Calendar.setup({
	inputField : "end_date", // ID of the input field
	ifFormat   : "%Y-%m-%d",        // the date format
	button     : "endButton"   // ID of the button
});
</script>
'; ?>

</div>
<!-- End Main Container -->
</body>
</html>