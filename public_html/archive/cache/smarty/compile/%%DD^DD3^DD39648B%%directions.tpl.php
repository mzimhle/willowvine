<?php /* Smarty version 2.6.20, created on 2015-02-01 12:49:39
         compiled from jobs/search/directions.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Ref. <?php echo $this->_tpl_vars['jobData']['job_reference']; ?>
, directions for <?php echo $this->_tpl_vars['jobData']['job_title']; ?>
, <?php echo $this->_tpl_vars['jobData']['section_name']; ?>
, jobs in <?php echo $this->_tpl_vars['jobData']['job_area']; ?>
</title>
<meta name="description" content="Directions for <?php echo $this->_tpl_vars['jobData']['job_title']; ?>
, <?php echo $this->_tpl_vars['jobData']['section_name']; ?>
, jobs in <?php echo $this->_tpl_vars['jobData']['job_area']; ?>
, reference: <?php echo $this->_tpl_vars['jobData']['job_reference']; ?>
">
<meta name="keywords" content="south african jobs,south africa careers,jobs south africa,willowvine,willowvine,jobs,careers, <?php echo $this->_tpl_vars['jobData']['job_title']; ?>
, <?php echo $this->_tpl_vars['jobData']['section_name']; ?>
,  <?php echo $this->_tpl_vars['jobData']['job_area']; ?>
">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "includes/css.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "includes/javascript.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

<script src="https://maps.googleapis.com/maps/api/js?sensor=false&libraries=places" type="text/javascript"></script>
<?php echo '
<script type="text/javascript">
  var directionDisplay;
  var directionsService = new google.maps.DirectionsService();

  function initialize() {
	directionsDisplay = new google.maps.DirectionsRenderer();
	
	var geocoder = new google.maps.Geocoder();
	var centerItem; 
	geocoder.geocode({\'address\':'; ?>
'<?php if ($this->_tpl_vars['jobData']['job_address'] != ''): ?><?php echo $this->_tpl_vars['jobData']['job_address']; ?>
<?php else: ?><?php echo $this->_tpl_vars['jobData']['job_area']; ?>
<?php endif; ?>'<?php echo '}, function(results, status){
		if (status == google.maps.GeocoderStatus.OK) {
			centerItem = results[0].geometry.location
		
			var myOptions = {
				zoom: 10, 
				center: centerItem,
				mapTypeId: google.maps.MapTypeId.ROADMAP
			}			

			var map = new google.maps.Map(document.getElementById(\'map_canvas\'), myOptions);
			var marker = new google.maps.Marker({
				map: map,
				position: centerItem
			});	
			
			directionsDisplay.setMap(map);
			directionsDisplay.setPanel(document.getElementById(\'directions-panel\'));				
		}
	});
  }

  function calcRoute() {
	var start = document.getElementById(\'location\').value;
	var end = '; ?>
'<?php if ($this->_tpl_vars['jobData']['job_address'] != ''): ?><?php echo $this->_tpl_vars['jobData']['job_address']; ?>
<?php else: ?><?php echo $this->_tpl_vars['jobData']['job_area']; ?>
<?php endif; ?>'<?php echo ';
	var travel = google.maps.DirectionsTravelMode.DRIVING;
	/*
	if(document.getElementById("WALKING").checked == true ) {
		travel = google.maps.DirectionsTravelMode.WALKING;
	} else {
		travel = google.maps.DirectionsTravelMode.DRIVING;
	}
	*/
	var request = {
	  origin: start,
	  destination: end,
	  travelMode: travel
	};
	directionsService.route(request, function(response, status) {
	  if (status == google.maps.DirectionsStatus.OK) {
		directionsDisplay.setDirections(response);
	  }
	});
  }
	
	/* Get User location. */
	google.maps.event.addDomListener(window, \'load\', initialize);
</script>
'; ?>

</head>
<body OnLoad="document.search_for_jobs.searchJob.focus();">
<div id="container">
	<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "includes/navigation.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

	<div class="clear"></div>
	<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "includes/search_jobs.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

	<br />
	<a class="standard_blue_btn fr" title="Go back to your search results" href="/jobs/search/<?php echo $this->_tpl_vars['jobData']['section_urlName']; ?>
/details/<?php echo $this->_tpl_vars['jobData']['job_link']; ?>
/<?php echo $this->_tpl_vars['jobData']['job_reference']; ?>
/?page=<?php echo $this->_tpl_vars['page']; ?>
<?php if ($this->_tpl_vars['searchJob'] != ''): ?>&searchJob=<?php echo $this->_tpl_vars['searchJob']; ?>
<?php endif; ?><?php if ($this->_tpl_vars['sectionId'] != ''): ?>&sectionId=<?php echo $this->_tpl_vars['sectionId']; ?>
<?php endif; ?><?php if ($this->_tpl_vars['type'] != ''): ?>&type=<?php echo $this->_tpl_vars['type']; ?>
<?php endif; ?><?php if ($this->_tpl_vars['area'] != ''): ?>&area=<?php echo $this->_tpl_vars['area']; ?>
<?php endif; ?>">
		<span id="Login">Back to your job</span>								
	</a>	
	<h1><?php echo $this->_tpl_vars['jobData']['job_title']; ?>
</h1>

	<span class="blue_text"><?php echo $this->_tpl_vars['jobData']['section_name']; ?>
</span><br />
	<span><?php echo $this->_tpl_vars['jobData']['job_area']; ?>
</span ><br /><br />
	<div class="clear"></div>
	<div class="left_content width760">
		<div class="blue_box">		
		<a class="standard_blue_btn fr" title="Go back to your search results" href="Javascript: calcRoute();">
			<span id="Login">Get Directions</span>								
		</a><br><b>From:</b>
		<br><br><input type="text" id="location" name="location" size="84" onchange="" /><br><br>		
		<!-- <b>Are you :</b> <input type="radio" name="transport"  id="WALKING" /> Walking  &nbsp; &nbsp; <input type="radio" name="transport" CHECKED id="DRIVING" /> Driving 	<br><br> -->
		<b>To:</b><br><br><?php if ($this->_tpl_vars['jobData']['job_address'] != ''): ?><?php echo $this->_tpl_vars['jobData']['job_address']; ?>
<?php elseif (isset ( $this->_tpl_vars['areaData'] ) && $this->_tpl_vars['areaData']['polygon_code'] != ''): ?><?php echo $this->_tpl_vars['areaData']['areaMap_shortPath']; ?>
<?php elseif ($this->_tpl_vars['jobData']['job_longitude'] != '' && $this->_tpl_vars['jobData']['job_latitude'] != ''): ?><?php echo $this->_tpl_vars['jobData']['job_area']; ?>
<?php else: ?><?php echo $this->_tpl_vars['jobData']['job_area']; ?>
<?php endif; ?><br>
		<br><br>
		<div id="map_canvas" style="height: 400px; width: 740px;" align="center"></div>	
		<div class="clear"></div><br>		
		<div id="directions-panel"></div>	
		</div>	
		<div class="clear"></div>			
	</div>			

	<div class="right_content">
		<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "includes/side_ad_container.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

	</div>
	<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "includes/footer.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

</div>
	<?php echo '
<script language="JavaScript" type="text/javascript">
jQuery(document).ready(function() {
	function init() {

		var input = document.getElementById(\'location\');
		var autocomplete = new google.maps.places.Autocomplete(input);
		autocomplete.setTypes([]);
		
		/* Get reference of the selected area. */
		google.maps.event.addListener(autocomplete, \'place_changed\', function() {
			var place = autocomplete.getPlace();			
		});
	}
	google.maps.event.addDomListener(window, \'load\', init);
		
    var input = document.getElementById(\'location\');
    var autocomplete = new google.maps.places.Autocomplete(input);
	
});
</script>
'; ?>

</body>
</html>