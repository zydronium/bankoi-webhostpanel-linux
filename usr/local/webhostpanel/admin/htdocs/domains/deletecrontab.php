<?$ACCESS_LEVEL=3;?>
<?include "../inc/connection.php"?>
<?include "../inc/params.php"?>
<?include "../inc/functions.php"?>
<?include "../inc/security.php"?>



<?
		$domainid=$_SESSION["domainid"];
		$DomainName = $_SESSION["domainname"];
	for($i=0; $i< count($_POST["delcron"]); $i++)
		{
				
					$ids=$_POST["delcron"][$i];
					
					deleteCron($domainid,$DomainName,$ids);
					$query="delete from tblcron where id=$ids";
					//myLog($query);
	mysql_query($query) or die(errorCatch("There was error while deleting the crontab entry " .mysql_error()));

					
		}
			
?>
<Script>
		alert("The command was successfully deleted from the crontab!");
		window.location='crontabmanager.php';
</script>