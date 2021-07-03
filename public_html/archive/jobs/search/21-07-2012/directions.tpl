<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Ref. {$jobData.job_reference}, directions for {$jobData.job_title}, {$jobData.section_name}, jobs in {$jobData.job_area}</title>
<meta name="description" content="Directions for {$jobData.job_title}, {$jobData.section_name}, jobs in {$jobData.job_area}, reference: {$jobData.job_reference}">
<meta name="keywords" content="south african jobs,south africa careers,jobs south africa,willowvine,willowvine,jobs,careers, {$jobData.job_title}, {$jobData.section_name},  {$jobData.job_area}">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
{include_php file="includes/css.php"}
{include_php file="includes/javascript.php"}
<script src="https://maps.googleapis.com/maps/api/js?sensor=false&libraries=places" type="text/javascript"></script>
{literal}
<script type="text/javascript">
  var directionDisplay;
  var directionsService = new google.maps.DirectionsService();

  function initialize() {
	directionsDisplay = new google.maps.DirectionsRenderer();
	
	var geocoder = new google.maps.Geocoder();
	var centerItem; 
	geocoder.geocode({'address':{/literal}'{if $jobData.job_address neq ''}{$jobData.job_address}{else}{$jobData.job_area}{/if}'{literal}}, function(results, status){
		if (status == google.maps.GeocoderStatus.OK) {
			centerItem = results[0].geometry.location
		
			var myOptions = {
				zoom: 10, 
				center: centerItem,
				mapTypeId: google.maps.MapTypeId.ROADMAP
			}			

			var map = new google.maps.Map(document.getElementById('map_canvas'), myOptions);
			var marker = new google.maps.Marker({
				map: map,
				position: centerItem
			});	
			
			directionsDisplay.setMap(map);
			directionsDisplay.setPanel(document.getElementById('directions-panel'));				
		}
	});
  }

  function calcRoute() {
	var start = document.getElementById('location').value;
	var end = {/literal}'{if $jobData.job_address neq ''}{$jobData.job_address}{else}{$jobData.job_area}{/if}'{literal};
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
	google.maps.event.addDomListener(window, 'load', initialize);
</script>
{/literal}
</head>
<body OnLoad="document.search_for_jobs.searchJob.focus();">
<div id="container">
	{include_php file="includes/navigation.php"}
	<div id="contnav" class="fl">
		<p class="fl">
			<a href="/">Home</a> &nbsp; 	
			<span>|</span> &nbsp; 
			<span>Search for jobs</span>
			<span>|</span> &nbsp; 
			<span>Searching for <span class="green_text">"{$searchJob|default:"All jobs"}"</span> in <span class="green_text">"{$jobData.job_area}"</span>			
			<span>|</span> &nbsp; 
			<span>Job Directions for <span class="green_text">{$jobData.job_title}</span> in <span class="green_text">{$jobData.job_area}</span></span>					
		</p>
	</div>
	{include_php file="includes/search_jobs.php"}
	<h1>{$jobData.job_title}</h1>
	<a class="standard_blue_btn fr" title="Go back to your search results" href="/jobs/search/{$jobData.section_urlName}/details/{$jobData.job_link}/{$jobData.job_reference}/?searchJob={$searchJob}&page={$page}">
		<span id="Login">Back to your job</span>								
	</a><br />
	<span class="blue_text">{$jobData.section_name}</span><br />
	<span>{$jobData.job_area}</span ><br /><br />
	<div class="clear"></div>
	<div class="left_content">
		<div class="blue_box">		
		<a class="standard_blue_btn fr" title="Go back to your search results" href="Javascript: calcRoute();">
			<span id="Login">Get Directions</span>								
		</a><br><b>From:</b>
		<br><br><input type="text" id="location" name="location" size="84" onchange="" /><br><br>		
		<!-- <b>Are you :</b> <input type="radio" name="transport"  id="WALKING" /> Walking  &nbsp; &nbsp; <input type="radio" name="transport" CHECKED id="DRIVING" /> Driving 	<br><br> -->
		<b>To:</b><br><br>{if $jobData.job_address neq ''}{$jobData.job_address}{elseif isset($areaData) AND $areaData.polygon_code neq ''}{$areaData.areaMap_shortPath}{elseif $jobData.job_longitude neq '' and $jobData.job_latitude neq ''}{$jobData.job_area}{else}{$jobData.job_area}{/if}<br>
		<br><br>
		<div id="map_canvas" style="height: 400px; width: 540px;" align="center"></div>	
		<div class="clear"></div><br>		
		<div id="directions-panel"></div>	
		</div>	
		<div class="clear"></div>			
	</div>			

	<div class="right_content">
		{include_php file="includes/job_application_box.php"}	
		{include_php file="includes/side_ad_container.php"}
	</div>
	{include_php file="includes/footer.php"}
</div>
	{literal}
<script language="JavaScript" type="text/javascript">
jQuery(document).ready(function() {
	function init() {

		var input = document.getElementById('location');
		var autocomplete = new google.maps.places.Autocomplete(input);
		autocomplete.setTypes([]);
		
		/* Get reference of the selected area. */
		google.maps.event.addListener(autocomplete, 'place_changed', function() {
			var place = autocomplete.getPlace();			
		});
	}
	google.maps.event.addDomListener(window, 'load', init);
		
    var input = document.getElementById('location');
    var autocomplete = new google.maps.places.Autocomplete(input);
	
});
</script>
{/literal}
</body>
</html>