<script type="text/javascript" src="/library/javascript/jquery-1.10.1.min.js"></script>
<script type="text/javascript" src="/library/javascript/jquery-ui.js"></script>
<script type="text/javascript" src="/library/javascript/bootstrap.min.js"></script>
<script type="text/javascript" src="/library/javascript/jquery.validate.js"></script>
<script type="text/javascript" src="/library/javascript/validation-init.js"></script>
<script type="text/javascript" src="/default.js"></script>
<script type="text/javascript" src="/library/javascript/equal.js"></script>
<script type="text/javascript" src="/library/javascript/responsive-nav.min.js"></script>
<script src="/library/javascript/jquery.gritter.js" type="text/javascript"></script>
{literal}
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
{/literal}