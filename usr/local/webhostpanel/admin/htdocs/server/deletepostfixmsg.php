<?$ACCESS_LEVEL=1;?>
<?include "../inc/connection.php"?>
<?include "../inc/params.php"?>
<?include "../inc/functions.php"?>
<?include "../inc/security.php"?>
<?
	$msgtype = $_POST["msgtype"];
	if(strtoupper($msgtype) == "ALL")
		{
			$msgtype1 = "";
			PostfixDelMails($msgtype1);
		}
	else
		{
			PostfixDelMails($msgtype);
		}
?>

<script>
		alert("The POSTFIX messages deleted");
		window.location="../server/managemail.php";
</script>
