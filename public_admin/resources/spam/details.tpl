<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Spam</title>
{include_php file='includes/css.php'}
{include_php file='includes/javascript.php'}
<script type="text/javascript" language="javascript" src="/library/javascript/nicedit/nicEdit.js"></script>
</head>
<body>
<!-- Start Main Container -->
<div id="container">
    <!-- Start Content spam -->
  <div id="content">
    {include_php file='includes/header.php'}
  	<br />
	<div id="breadcrumb">
        <ul>
            <li><a href="/" title="Home">Home</a></li>
            <li><a href="/resources/" title="Resources">Resources</a></li>
			<li><a href="/resources/spam/" title="Spam">Spam</a></li>
			<li>Details</li>
        </ul>
	</div><!--breadcrumb--> 
  
	<div class="inner"> 
      <h2>{if isset($spamData.spam_code)}Edit spam: {$spamData.spam_name}{else}Add a new spam{/if}</h2>
    <div id="sidetabs">
        <ul > 
            <li class="active"><a href="#" title="Details">Details</a></li>
        </ul>
    </div><!--tabs-->

	<div class="detail_box">
      <form id="detailsForm" name="detailsForm" action="/resources/spam/details.php{if isset($spamData.spam_code)}?code={$spamData.spam_code}{/if}" method="post">
        <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="form">
           <tr>
            <td>
				<h4 class="error">Name:</h4><br />
				<input type="text" name="spam_name" id="spam_name" value="{$spamData.spam_name}" size="30"/>
				{if isset($errorArray.spam_name)}<br /><span class="error">{$errorArray.spam_name}</span>{/if}
			</td>
            <td>
				<h4>Email:</h4><br />
				<input type="text" name="spam_email" id="spam_email" value="{$spamData.spam_email}" size="30"/>
				{if isset($errorArray.spam_email)}<br /><span class="error">{$errorArray.spam_email}</span>{/if}
			</td>
            <td>
				<h4>Cellphone:</h4><br />
				<input type="text" name="spam_cellphone" id="spam_cellphone" value="{$spamData.spam_cellphone}" size="30"/>
				{if isset($errorArray.spam_cellphone)}<br /><span class="error">{$errorArray.spam_cellphone}</span>{/if}
			</td>			
          </tr>	
          <tr>
            <td colspan="3">
				<h4>Area:</h4><br />
				<input type="text" name="areapost_name" id="areapost_name" value="{$spamData.areapost_name}" size="80"/>
				<input type="hidden" name="areapost_code" id="areapost_code" value="{$spamData.areapost_code}" />
				{if isset($errorArray.areapost_code)}<br /><span class="error">{$errorArray.areapost_code}</span>{/if}
			</td>
          </tr>	
          <tr>
            <td colspan="3">
				<h4>Address:</h4><br />
				<input type="text" name="spam_address" id="spam_address" value="{$spamData.spam_address}" size="80"/>
			</td>
          </tr>
        </table>
      </form>
	</div>
    <div class="clearer"><!-- --></div>
        <div class="mrg_top_10">
          <a href="/resources/spam/" class="button cancel mrg_left_147 fl"><span>Cancel</span></a>
          <a href="javascript:submitForm();" class="blue_button mrg_left_20 fl"><span>Save &amp; Complete</span></a>   
        </div>
    <div class="clearer"><!-- --></div>
    </div><!--inner-->
 </div> 	
<!-- End Content spam -->
 </div><!-- End Content spam -->
 {include_php file='includes/footer.php'}
</div>
{literal}
<script type="text/javascript" language="javascript">
function submitForm() {
	document.forms.detailsForm.submit();					 
}

$(document).ready(function(){
		
		$( "#areapost_name" ).autocomplete({
			source: "/feeds/areaparents.php",
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
<!-- End Main Container -->
</body>
</html>
