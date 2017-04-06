<? $ACCESS_LEVEL=3 ?>
<?include "../inc/connection.php"?>
<?include "../inc/params.php"?>
<?include "../inc/functions.php"?>
<?include "../inc/security.php"?>

<?
	//------------Session Variables--------------
	$domainid = $_SESSION["domainid"];	
	$domainname = $_SESSION["domainname"];
	//-------------------------------------------
	if(count($_POST["emailacc"])==0)
		{
?>
			<script>
				alert("Sorry there are no mail accounts to delete");
				history.go();
			</script>
<?
			die();
		}
	else
		{
			for($i=0; $i < count($_POST["emailacc"]); $i++)	
					{
						$id=$_POST["emailacc"][$i];
						$query="select * from mail_mailbox where id=$id";
						$arr4mail=mysql_query($query) or die(errorCatch("28 removemailacc.php " . mysql_error()));
						if(mysql_num_rows($arr4mail) <> 0)
							{
								$arrmail=mysql_fetch_array($arr4mail);
								$mailadd = $arrmail["username"];
								$query="delete from mail_mailbox where id=$id";
								
								//--------------------------------------------------------------------------------
								//Here we are deleting the mail folders for the domain that were created when the
								//domain was created
									$Path = $maildomainpath . "/" . $domainname;
									DeleteMailDir($Path . "/" .$mailadd);
								//--------------------------------------------------------------------------------
								mysql_query($query) or die(errorcatch("39: ERROR while deleting the mail account in mails/removemailacc.php"));
							}

					}
		}
	
?>
<script>
				alert("<?=$i?> mail account deleted!");
				window.location="newmail.php";
</script>