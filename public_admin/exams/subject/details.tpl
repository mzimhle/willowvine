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
            <li><a href="/exams/" title="Exam">Exams</a></li>
			<li><a href="/exams/subject/" title="Subject">Subject</a></li>
			<li>Details</li>
        </ul>
	</div><!--breadcrumb--> 
	<div class="inner"> 
      <h2>Subject Details</h2>
    <div id="sidetabs">
        <ul >
            <li class="active"><a href="#" title="Details">Details</a></li>
        </ul>
    </div>
	<div class="detail_box">
      <form id="detailsForm" name="detailsForm" action="/exams/subject/details.php{if isset($subjectData.subject_code)}?code={$subjectData.subject_code}{/if}" method="post">
        <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="form">
           <tr>
            <td>
				<h4 class="error">Name:</h4><br />
				<input type="text" name="subject_name" id="subject_name" value="{$subjectData.subject_name}" size="80"/>
				{if isset($errorArray.subject_name)}<br /><span class="error">{$errorArray.subject_name}</span>{/if}
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
</script>
{/literal}
</body>
</html>
