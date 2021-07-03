<?php /* Smarty version 2.6.20, created on 2015-07-27 19:43:20
         compiled from includes/javascript.tpl */ ?>
<script type="text/javascript" src="/library/javascript/jquery-1.10.1.min.js"></script>
<script type="text/javascript" src="/library/javascript/jquery-ui.js"></script>
<script type="text/javascript" src="/library/javascript/bootstrap.min.js"></script>
<script type="text/javascript" src="/library/javascript/jquery.validate.js"></script>
<script type="text/javascript" src="/library/javascript/validation-init.js"></script>
<script type="text/javascript" src="/default.js"></script>
<script type="text/javascript" src="/library/javascript/equal.js"></script>
<script type="text/javascript" src="/library/javascript/responsive-nav.min.js"></script>
<script src="/library/javascript/jquery.gritter.js" type="text/javascript"></script>
<?php echo '
<script type="text/javascript">
	function actionNotify(title, message) {
        $.gritter.add({
            // (string | mandatory) the heading of the notification
            title: title,
            // (string | mandatory) the text inside the notification
            text: message
        });
		
        return false;
	}
</script>
'; ?>