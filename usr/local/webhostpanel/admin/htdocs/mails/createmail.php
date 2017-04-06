<? $ACCESS_LEVEL=3 ?>
<?include "../inc/connection.php"?>
<?include "../inc/params.php"?>
<?include "../inc/functions.php"?>
<?include "../inc/security.php"?>
<html>
<head>
<title>Create Mail</title>
</head>
<body leftmargin=0 topmargin=0>
<?
	//---------VARIABLES----------------------------
		$domainid=$_SESSION["domainid"];
		$domainname=$_SESSION["domainname"];	
	//----------------------------------------------


	$query = "select count(*) as domainMailCount from mail_mailbox where domain = '$domainname'"; 			
				$rsDomaiMail = @mysql_query($query);
				$rsDomainMailResult = @mysql_fetch_array($rsDomaiMail);
				$usedDomainMailAccount = $rsDomainMailResult["domainMailCount"];


				$query = "select popmailaccount from tbldomainrights where domainid = '$domainid'"; 			
				$rsDomaipopMail = @mysql_query($query);
				$rsDomainpopMailResult = @mysql_fetch_array($rsDomaipopMail);
				$usedDomainPopMailAccount = $rsDomainpopMailResult["popmailaccount"];

				if($usedDomainMailAccount >= $usedDomainPopMailAccount)
				{
?>
					<script>
						alert("Domains has utilized all its popmail accounts!!!")
						window.location("newmail.php");
					</script>
<?
					die();
				}
	
	if(isset($_POST["mailname"]) && isset($_POST["pass"]))
		{
			$mailname=$_POST["mailname"];
			$pass=$_POST["pass"];
			$pass2=$_POST["pass2"];
			if($pass!=$pass2)
				{
?>
						<script>
							alert("Password does not match");
							history.back();
						</script>
<?
				}
		
		else
			{
					$query="select * from mail_domain where domain='".$domainname."'";
					$rs=mysql_query($query) or die(errorCatch(mysql_error()));
					$res=mysql_fetch_array($rs);
					$mailboxes=$res["mailboxes"];	
	
					$query="select count(*) as cnt from mail_mailbox where domain='".$domainname."'";
					$rs=mysql_query($query) or die(errorCatch(mysql_error()));
					$res=mysql_fetch_array($rs);
					$c=$res["cnt"];

					if($mailboxes==-1 || $mailboxes > $c)
						{
							$query="select * from mail_mailbox where username='".$mailname."@".$domainname."' and domain='".$domainname."'";
							
							
							$result=mysql_query($query) or die(errorCatch(mysql_error()));
							$n = mysql_num_rows($result);
							
							if($n <= 0)
								{
									$query="select * from mail_alias where address='".$mailname."@".$domainname."' and domain='".$domainname."'";
									
									$result=mysql_query($query) or die(errorCatch(mysql_error()));
									$n = mysql_num_rows($result);
						
									if($n <= 0)
										{
											$pass = crypt($pass,"\$1\$9");
											$query="insert into mail_mailbox(username,password,name,maildir,quota,domain,created,modified,active,smtpuser) values('".$mailname."@".$domainname."','".$pass."','".$mailname."','".$domainname."/".$mailname."@".$domainname."/"."',0,'".$domainname."',NOW(),NOW(),1,'".$mailname."%".$domainname."')";
											
											mysql_query($query) or die(errorCatch(mysql_error()));
											
											//Path of the mail directory where it is to be created
											//------------------------------------------------------------------
											$Path=$maildomainpath . $domainname . "/".$mailname."@".$domainname;
											CreateMailDir($Path);
										}
								else
										{
?>
											<script>
												alert("sorry this mail name already exist");
												history.back();
											</script>
<?
										}
								}
							else
								{	
?>
									<script>
										alert("sorry this mail name already exist");
										history.back();
									</script>
<?
								}
						}
					else
						{
	?>
								<script>
									alert("No sufficient mailboxes to create new");
									history.back();
								</script>
	<?
						}			
		}
	}
?>
<br>
<br>
<script>
	alert("New mail account have been created successfully")
	window.location="newmail.php";
</script>;
</body>
</html>


