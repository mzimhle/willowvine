<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Internships</title>
{include_php file='includes/css.php'}
{include_php file='includes/javascript.php'}
</head>
<body>
<!-- Start Main Container -->
<div id="container">
    <!-- Start Content Section -->
  <div id="content">
    {include_php file='includes/header.php'}
	<div id="breadcrumb">
        <ul>
            <li><a href="/" title="Home">Home</a></li>
            <li><a href="/internships/" title="Internships">Internships</a></li>
			<li><a href="/internships/share/" title="Share">Share</a></li>
        </ul>
	</div><!--breadcrumb--> 
	<div class="inner"> 
      <h2>Internship Share Details</h2>
    <div id="sidetabs">
        <ul >
            <li class="active"><a href="#" title="Details">Details</a></li>
        </ul>
    </div>
	<div class="detail_box">
      <form id="detailsForm" name="detailsForm" action="/internships/share/details.php{if isset($shareData.share_code)}?code={$shareData.share_code}{/if}" method="post">
        <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="form">
           <tr>
            <td colspan="2">
				<h4 class="error">Internship Name:</h4><br />
				{$shareData.internship_name}
			</td>		
          </tr>			
           <tr>
            <td>
				<h4 class="error">Fullname:</h4><br />
				{$shareData.share_name}
			</td>
            <td>
				<h4 class="error">Email:</h4><br />
				{$shareData.share_email}
			</td>		
          </tr>	
          <tr>
            <td>
				<h4 class="error">Friend name:</h4><br />
				{$shareData.share_friendname}
			</td>
            <td>
				<h4 class="error">Friend name:</h4><br />
				{$shareData.share_friendname}
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
 {include_php file='includes/footer.php'}
</div>
<!-- End Main Container -->
{literal}
<script type="text/javascript" language="javascript">
function submitForm() {
	document.forms.detailsForm.submit();					 
}

$(document).ready(function(){
		$( "#areapost_name" ).autocomplete({
			source: "/feeds/area.php",
			minLength: 2,
			select: function( event, ui ) {
			
				if(ui.item.id == '') {
					$('#areapost_name').html('');
					$('#areapost_code').val('');					
				} else {
					$('#areapost_name').html('<b>' + ui.item.value + '</b>');
					$('#areapost_code').val(ui.item.id);	
				}
				$('#areapost_name').val('');										
			}
		});			
});
</script>
{/literal}
</body>
</html>
