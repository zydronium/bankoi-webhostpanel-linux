<? $ACCESS_LEVEL=3 ?>
<? include "../inc/connection.php"; ?>
<? include "../inc/params.php"; ?>
<? include "../inc/functions.php"; ?>
<? include "../inc/security.php"; ?>
<?

	$domainid=$_SESSION["domainid"];
	$domainname=$_SESSION["domainname"];
	$mailadd=$_POST["mailnm"];
	$oldpass=$_POST["oldpass"];
	$newpass=$_POST["newpass"];
	
	$query="select * from mail_mailbox where domain='$domainname' and username='$mailadd'";
	$arrmail=mysql_query($query) or die(errorCatch(mysql_error()));
	if(mysql_num_rows($arrmail) <= 0)
		{
?>
<script>
	alert("Sorry the mail address was not found!It may have been deleted.");
	window.location="../mails/newmail.php";
</script>
<?			die();	
		}
		$resultmailarr = mysql_fetch_array($arrmail);
		if(crypt($oldpass,"\$1\$9") != $resultmailarr["password"])
			{
?>
<script>
	alert("Sorry the old password is incorrect");
	window.location="../mails/changeemailpass.php?mailnm=<?=$mailadd?>";
</script>
<?			die();	
		}
		$cppass = crypt($newpass,"\$1\$9");
	$query = "update mail_mailbox set password = '$cppass' where  domain='$domainname' and username='$mailadd'";
	mysql_query($query);
?>
<script>
	alert("Thwe email password has been changed");
	window.location="../mails/newmail.php";
</script>
