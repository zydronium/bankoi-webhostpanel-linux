<? $ACCESS_LEVEL=3 ?>
<? include "../inc/connection.php"?>
<? include "../inc/params.php"?>
<? include "../inc/functions.php"?>
<? include "../inc/security.php"?>
<html>
<head>
<title>Clients Listing</title>
</head>
<body leftmargin=0 topmargin=0>
<?
$domainid=$_SESSION["domainid"];
$domainname=$_SESSION["domainname"];
if(isset($_POST["mailid"]))	{
	$uid=split("@",$_POST["mailid"]);
	$query="select * from mail_mailbox where username='".$uid[0]."@".$uid[1]."' and domain='".$uid[1]."'";
//	myLog($query);
	$rs=mysql_query($query) or die(errorCatch(mysql_error()));
	$n=mysql_affected_rows();
	if($n>0){
	if(isset($_POST["ismail"])){	
		$pass=$_POST["pass"];
		$pass2=$_POST["pass2"];
		if($pass!=$pass2){
?>
					<script>
						alert("password does not match");
						history.back();
					</script>
<?
		}else{
			if($pass!="")	{
				$query="update mail_mailbox set password='".$pass."' where username='".$uid[0]."@".$uid[1]."' and domain='".$uid[1]."'";
				//myLog($query);
				mysql_query($query) or die(errorCatch(mysql_error()));
			}
		}	
	}
	else
		{
			$query="delete from mail_mailbox where username='".$uid[0]."@".$uid[1]."' and domain='".$uid[1]."'";
			mysql_query($query);
			@unlink($maildomainpath.$domainname."/".$uid[0]."@".$domainname."/*.*");
			@unlink($maildomainpath.$domainname."/".$uid[0]."@".$domainname."/cur/*.*");
			@unlink($maildomainpath.$domainname."/".$uid[0]."@".$domainname."/new/*.*");
			@unlink($maildomainpath.$domainname."/".$uid[0]."@".$domainname."/tmp/*.*");

			rmdir($maildomainpath.$domainname."/".$uid[0]."@".$domainname."/cur");
			rmdir($maildomainpath.$domainname."/".$uid[0]."@".$domainname."/new");
			rmdir($maildomainpath.$domainname."/".$uid[0]."@".$domainname."/tmp");
			rmdir($maildomainpath.$domainname."/".$uid[0]."@".$domainname);
		}
	}
	$query="select * from mail_alias where address='".$uid[0]."@".$uid[1]."' and domain='".$domainname."'";

	$rs=mysql_query($query) or die(errorCatch(mysql_error()));
	$n=mysql_affected_rows();
	if($n>0){
		if(isset($_POST["isalias"])){
		$redir=$_POST["redir"];
		$query="update mail_alias set goto='".$redir."' where address='".$uid[0]."@".$uid[1]."' and domain='".$uid[1]."'";
		//myLog($query);
		mysql_query($query) or die(errorCatch(mysql_error()));
		}
		else{
			$query ="delete from mail_alias where address='".$uid[0]."@".$uid[1]."' and domain='".$uid[1]."'";
			//myLog($query);
			mysql_query($query) or die(errorCatch(mysql_error()));
		}
	}

	mysql_query($query) or die(errorCatch(mysql_error()));

		}
?>
<br>
<br>
<script>
	window.location="listmail.php";
</script>
</body>
</html>