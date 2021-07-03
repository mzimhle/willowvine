<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Exam</title>
{include_php file='includes/css.php'}
{include_php file='includes/javascript.php'}
<script type="text/javascript" language="javascript" src="/library/javascript/nicedit/nicEdit.js"></script>
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
            <li><a href="/exams/" title="Exam">Exam</a></li>
			<li><a href="/exams/view/" title="View">View</a></li>
			<li>Details</li>
        </ul>
	</div><!--breadcrumb--> 
	<div class="inner"> 
      <h2>Exam Details</h2>
    <div id="sidetabs">
        <ul >
            <li class="active"><a href="#" title="Details">Details</a></li>
        </ul>
    </div>
	<div class="detail_box">
      <form id="detailsForm" name="detailsForm" action="/exams/view/details.php{if isset($examData.exam_code)}?code={$examData.exam_code}{/if}" method="post" enctype="multipart/form-data">
        <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="form">
           <tr>
            <td>
				<h4 class="error">Name:</h4><br />
				<input type="text" name="exam_name" id="exam_name" value="{$examData.exam_name}" size="30"/>
				{if isset($errorArray.exam_name)}<br /><span class="error">{$errorArray.exam_name}</span>{/if}
			</td>
            <td>
				<h4 class="error">Subject:</h4><br />
				<select id="subject_code" name="subject_code">
					<option value=""> ---- </option>
					{html_options options=$subjectPairs selected=$examData.subject_code}
				</select>
				{if isset($errorArray.subject_code)}<br /><span class="error">{$errorArray.subject_code}</span>{/if}
			</td>
            <td>
				<h4 class="error">Date:</h4><br />
				<input type="text" name="exam_date" id="exam_date" value="{$examData.exam_date}" size="10"/>
				{if isset($errorArray.exam_date)}<br /><span class="error">{$errorArray.exam_date}</span>{/if}
			</td>			
          </tr>	
           <tr>
            <td>
				<h4 class="error">Language:</h4><br />
				<select id="exam_language" name="exam_language">
					<option value=""> ---- </option>
					<option value="XHOSA" {if $examData.exam_language eq 'XHOSA'}selected{/if}> Xhosa </option>
					<option value="ZULU" {if $examData.exam_language eq 'ZULU'}selected{/if}> Zulu </option>
					<option value="SWATI" {if $examData.exam_language eq 'SWATI'}selected{/if}> Swati </option>
					<option value="ENGLISH" {if $examData.exam_language eq 'ENGLISH'}selected{/if}> English </option>
					<option value="AFRIKAANS" {if $examData.exam_language eq 'AFRIKAANS'}selected{/if}> Afrikaans </option>
					<option value="TSONGA" {if $examData.exam_language eq 'TSONGA'}selected{/if}> Tsonga </option>
					<option value="SOTHO" {if $examData.exam_language eq 'SOTHO'}selected{/if}> Sotho (Southern seSotho) </option>
					<option value="TSWANA" {if $examData.exam_language eq 'TSWANA'}selected{/if}> Tswana </option>
					<option value="VENDA" {if $examData.exam_language eq 'VENDA'}selected{/if}> Venda </option>
					<option value="NDEBELE" {if $examData.exam_language eq 'NDEBELE'}selected{/if}> Ndebele </option>
					<option value="PEDI" {if $examData.exam_language eq 'PEDI'}selected{/if}> Pedi (Northern Sotho) </option>
				</select>
				{if isset($errorArray.exam_language)}<br /><span class="error">{$errorArray.exam_language}</span>{/if}
			</td>
            <td colspan="2">
				<h4 class="error">Upload Document:</h4><br />
				<input type="file" name="examfile" id="examfile" />
				{if isset($errorArray.examfile)}<br /><span class="error">{$errorArray.examfile}</span>{else}<br /><em>Only .pdf, .doc, .docx allowed</em>{/if}
				{if isset($examData)}<p class="success"><a href="/download/exam/{$examData.exam_code}" target="_blank">Download</a></p>{/if}
			</td>		
          </tr>
        </table>
      </form>

    <div class="clearer"><!-- --></div>
        <div class="mrg_top_10">
          <a href="javascript:submitForm();" class="blue_button mrg_left_20 fl"><span>Save &amp; Complete</span></a>   
        </div>

    <div class="clearer"><!-- --></div>	  
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
	$( "#exam_date" ).datepicker({
		dateFormat: "yy-mm-dd",
		changeMonth: true,
		changeYear: true
	});	
});
</script>
{/literal}
</body>
</html>
