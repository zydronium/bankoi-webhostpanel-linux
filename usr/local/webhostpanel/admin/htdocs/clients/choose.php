<? $ACCESS_LEVEL=1; ?>
<?include "../inc/connection.php"?>
<?include "../inc/security.php"?>
<?
	$clientid=$_GET["clid"];
	$_SESSION["clientid"] = $clientid;
	//echo "the client id is " . $_SESSION["clientid"];
	//$_SESSION["type"] = 'c';
	$query="select resellername from tblreseller where resellerid=$clientid";
	//myLog($query);
	$array=mysql_query($query) or die(errorCatch(mysql_error()));
	$clname=mysql_fetch_object($array);
	$clientname=$clname->resellername;
	mysql_free_result($array);
	$_SESSION["clientname"] =  $clientname;
	//echo "The client name is ".$clientname;
	//header("Location: ../domains/clientdomains.php",TRUE);
?>
<SCRIPT>
location.replace("../domains/clientdomains.php");
</SCRIPT>