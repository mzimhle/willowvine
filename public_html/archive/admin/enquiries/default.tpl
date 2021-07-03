<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>{$siteName} | Enquiries</title>
{include_php file='admin/includes/css.php'}
{include_php file='admin/includes/javascript.php'}
{include_php file='admin/includes/calendar.php'}
<script type="text/javascript" language="javascript" src="/admin/enquiries/default.js"></script>
</head>

<body>
<!-- Start Main Container -->
<div id="container">
    <!-- Start Content Section -->
  <div id="content">
    {include_php file='admin/includes/header.php'}
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
                <option value="99999" {if $perPageSelect eq '99999'} selected="selected"{/if}>All</option>
                <option value="5" {if $perPageSelect eq '5'} selected="selected"{/if}>5</option>
                <option value="10" {if $perPageSelect eq '10'} selected="selected"{/if}>10</option>
                <option value="20" {if $perPageSelect eq '20'} selected="selected"{/if}>20</option>
                <option value="30" {if $perPageSelect eq '30'} selected="selected"{/if}>30</option>
                <option value="40" {if $perPageSelect eq '40'} selected="selected"{/if}>40</option>
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
 {include_php file='admin/includes/footer.php'}
 {literal}
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
{/literal}
</div>
<!-- End Main Container -->
</body>
</html>
