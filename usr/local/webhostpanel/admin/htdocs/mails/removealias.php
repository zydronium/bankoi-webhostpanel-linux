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
	if(count($_POST["emails"])==0)
		{
?>
			<script>
				alert("Sorry there are no email aliases to delete");
				history.go();
			</script>
<?
			die();
		}
	else
		{
			for($i=0; $i < count($_POST["emails"]); $i++)	
					{
						$id=$_POST["emails"][$i];
						$query="select * from mail_alias where id=$id";
						$arr4alias=mysql_query($query) or die(errorCatch("28 removealias.php " . mysql_error()));
						if(mysql_num_rows($arr4alias) <> 0)
							{
								$query="delete from mail_alias where id=$id";
								//myLog($query);
								mysql_query($query) or die(errorcatch("33: ERROR while deleting the aliases in mails/removealias.php"));
							}

					}
		}
	
?>
<script>
				alert("<?=$i?> aliases deleted!");
				window.location="listmail.php";
</script>