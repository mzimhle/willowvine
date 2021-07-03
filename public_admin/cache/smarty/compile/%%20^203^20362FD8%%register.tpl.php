<?php /* Smarty version 2.6.20, created on 2015-02-01 14:49:01
         compiled from includes/register.tpl */ ?>
<div class="newsbox eachbox  <?php if (isset ( $this->_tpl_vars['participantloginData'] )): ?>adbox<?php endif; ?> no-gutter-left">
	<?php if (! isset ( $this->_tpl_vars['participantloginData'] )): ?>
	<div class="titles stitle">
		<h2>Register with us</h2>
	</div>
	<div class="bigform bisform" id="registrationform">
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
				<button class="btn btn-md btn-view bluebox1" onclick="fb_login(); return false;">
					<span style="font-size: 18px;" class="fa fa-facebook-square"></span>&nbsp;&nbsp; Facebook
				</button>&nbsp;&nbsp;
				<button class="btn btn-md btn-view bluebox2" onclick="link('/registration/includes/linkedin/'); return false;">
					<span style="font-size: 18px;" class="fa fa-linkedin-square"></span>&nbsp;&nbsp; LinkedIn
				</button>&nbsp;&nbsp;
				<button class="btn btn-md btn-view bluebox3" onclick="link('/registration/includes/google/'); return false;">
					<span style="font-size: 18px;" class="fa fa-google-plus-square"></span>&nbsp;&nbsp; Google+
				</button>
			</p>						
		</form>
	</div>
	<?php else: ?>
		<div class="titles stitle">
			<h2>My CVs</h2>
		</div>
			<div class="catlist infolist cf">
				<ul>
				 <?php $_from = $this->_tpl_vars['cvData']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
					<li id="cv_<?php echo $this->_tpl_vars['item']['cv_code']; ?>
"><a href="/download/cv/<?php echo $this->_tpl_vars['item']['cv_code']; ?>
" target="_blank"><?php echo $this->_tpl_vars['item']['cv_name']; ?>
</a><button class="fr" onclick="deleteCVModal('<?php echo $this->_tpl_vars['item']['cv_code']; ?>
'); return false;">delete</button></li> 
				  <?php endforeach; else: ?>			  
				  <li><span class="fa fa-file-word-o"></span>No CVs uploaded yet.</li>
				  <?php endif; unset($_from); ?>
				</ul>
			</div>
			<div class="clearboth"></div>			
			<form action="/" method="POST" role="form" name="bismsg" id="bismsg" enctype="multipart/form-data">
				<label>Upload a CV:</label>
				<input type="file" value="" class="form-control" id="documentfile" name="documentfile" />	
				<button class="btn btn-md btn-save" name="submitCVForm" id="submitCVForm">Upload CV</button><br />
				<?php if (isset ( $this->_tpl_vars['errorArray'] ) && ! empty ( $this->_tpl_vars['errorArray'] )): ?><p class="error"><?php echo $this->_tpl_vars['errorArray']; ?>
</p><?php endif; ?>
				<?php if (isset ( $this->_tpl_vars['success'] ) && ! empty ( $this->_tpl_vars['success'] )): ?><p class="success"><?php echo $this->_tpl_vars['success']; ?>
</p><?php endif; ?>
				<div class="clearboth"></div>				
			</form>	
	<?php endif; ?>
</div>