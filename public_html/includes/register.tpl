<div class="eachbox visible-md visible-lg">
    <a href="http://www.willow-nettica.com/" target="_blank"><img src="/images/willow_ad.jpg" title="Willow-Nettica" alt="Web Design"></a>
</div>
<div class="newsbox eachbox  {if isset($participantloginData)}adbox{/if} no-gutter-left">
	{if !isset($participantloginData)}
	<div class="titles stitle">
		<h2>Register with us</h2>
	</div>
	<div class="bigform bisform green-bck" id="registrationform">
		<form action="/" method="POST" role="form" name="bismsg" id="bismsg">
			<label>Name:</label>
			<input type="text" value="" class="form-control" id="participant_name" name="participant_name" />
			<label>Surname:</label>
			<input type="text" value="" class="form-control" id="participant_surname" name="participant_surname" />
			<label>Email:</label>
			<input type="text" value="" class="form-control" id="participant_email" name="participant_email" />
			<label>Your area:</label>
			<input type="text" value="" class="form-control" id="areapost_name" name="areapost_name" />						
			<input id="areapost_code" type="hidden" value="" name="areapost_code" />
			<button class="btn btn-md btn-save" name="submitRegistrationForm" id="submitRegistrationForm">Register</button>
			<div class="clearboth"></div>
			Or you can register using either Facebook, LinkedIn or your gmail account by clicking one of the buttons below.
			<p style="text-align: center;">
				<button class="btn btn-md btn-view fb-bck" onclick="fb_login(); return false;">
					<span style="font-size: 18px;" class="fa fa-facebook-square"></span>&nbsp;&nbsp; Facebook
				</button>&nbsp;&nbsp;
				<button class="btn btn-md btn-view in-bck" onclick="link('/registration/includes/linkedin/'); return false;">
					<span style="font-size: 18px;" class="fa fa-linkedin-square"></span>&nbsp;&nbsp; LinkedIn
				</button>&nbsp;&nbsp;
				<button class="btn btn-md btn-view g-bck" onclick="link('/registration/includes/google/'); return false;">
					<span style="font-size: 18px;" class="fa fa-google-plus-square"></span>&nbsp;&nbsp; Google+
				</button>
			</p>						
		</form>
	</div>
	{else}
		<div class="titles stitle">
			<h2>My CVs</h2>
		</div>
			<div class="catlist infolist cf">
				<ul>
				 {foreach from=$cvData item=item}
					<li id="cv_{$item.cv_code}"><a href="/download/cv/{$item.cv_code}" target="_blank">{$item.cv_name}</a><button class="fr" onclick="deleteCVModal('{$item.cv_code}'); return false;">delete</button></li> 
				  {foreachelse}			  
				  <li><span class="fa fa-file-word-o"></span>No CVs uploaded yet.</li>
				  {/foreach}
				</ul>
			</div>
			<div class="clearboth"></div>			
			<form action="/" method="POST" role="form" name="bismsg" id="bismsg" enctype="multipart/form-data">
				<label>Upload a CV:</label>
				<input type="file" value="" class="form-control" id="documentfile" name="documentfile" />	
				<button class="btn btn-md btn-save" name="submitCVForm" id="submitCVForm">Upload CV</button><br />
				{if isset($errorArray) && !empty($errorArray)}<p class="error">{$errorArray}</p>{/if}
				{if isset($success) && !empty($success)}<p class="success">{$success}</p>{/if}
				<div class="clearboth"></div>				
			</form>	
	{/if}
</div>
	<!--
<div class="eachbox visible-md visible-lg">
    {literal}
        <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
        <ins class="adsbygoogle"
             style="display:block"
             data-ad-client="ca-pub-3167387384914043"
             data-ad-slot="7295705524"
             data-ad-format="auto"></ins>
        <script>
        (adsbygoogle = window.adsbygoogle || []).push({});
        </script>
    {/literal}
</div>
-->