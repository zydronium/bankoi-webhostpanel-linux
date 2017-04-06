<?$ACCESS_LEVEL=3;?>
<?include "../inc/connection.php"?>
<?include "../inc/params.php"?>
<?include "../inc/functions.php"?>
<?include "../inc/security.php"?>


<?
	$minute = $_POST["minute"];
	$day = $_POST["day"];
	$month = $_POST["month"];
	$week = $_POST["week"];
	$command = addslashes ($_POST["command"]);
	$cronhour = $_POST["hour"];
	$domainid=$_SESSION["domainid"];
	$DomainName = $_SESSION["domainname"];

	if($command=="" || $domainid=="")
		{
			//myLog("ERROR-->While adding the command to the crontab.Either the command was not proper or the domain id was empty");
?>
			<Script>
				alert("Sorry there were errors adding the command to crontab");
				history.go(-1);
			</script>
<?
			die();
		}
	else
		{
			
						
			addCron($domainid,$DomainName,$minute,$cronhour,$day,$month,$week,$command);
			myLog("The command " . $command . "was successfully added to the crontab");
			$query="insert into tblcron (domainid,cronminute,cronday,cronmonth,cronweek,croncommand,cronhour) values('$domainid','$minute','$day','$month','$week','$command','$cronhour')";
			//echo $query;
			mysql_query($query) or die(errorCatch(mysql_error()));
			
		}
?>
<Script>
		alert("The command was successfully added to the crontab!");
		window.location='crontabmanager.php';
</script>