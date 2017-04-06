<?$ACCESS_LEVEL=3;?>
<?include "../inc/connection.php"?>
<?include "../inc/params.php"?>
<?include "../inc/functions.php"?>
<?include "../inc/security.php"?>

<?
	$username = $_POST["username"];
	$pass = $_POST["pass1"];
	$usershell = $_POST["usershell"];
	$resellername = $_SESSION["clientname"];
	$doaminname = $_SESSION["domainname"];
	$domainid = $_SESSION["domainid"];
	$DomainDir=$sHostingDir . "/" . $resellername . "/" . $doaminname;
	
	AddSystemUser($DomainDir,$usershell,$username,$pass);

	$query="insert into manageusers (domainid,username,password,usershell) values ($domainid,'$username','$pass','$usershell')";
	//myLog($query);
	mysql_query($query) or die(errorCatch(mysql_error()));
?>
<script>
	alert("One user successfully added");
	window.location="../domains/clientdomains.php";
</script>
