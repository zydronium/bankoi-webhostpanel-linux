<?$ACCESS_LEVEL=1;?>
<?include "../inc/connection.php"?>
<?include "../inc/params.php"?>
<?include "../inc/functions.php"?>
<?include "../inc/security.php"?>
<link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/general.css">
<link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/custom.css">
<link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/layout.css">
<body leftmargin=0 topmargin=0>
<?
//echo "The ip id is " . $_POST["ips"];
$clientid=$_SESSION["clientid"];
if(isset($_POST["ips"]))
	{
		for($i=0;$i<count($_POST["ips"]);$i++)
			{
				$ips=$_POST["ips"][$i];
				$query="insert into tblresellerip(resellerid,ipaddress) values ('$clientid','$ips')";
				//myLog($query);
				mysql_query($query) or die(errorCatch(mysql_error()));
				$query="update tblserverip set isavailable='N' where Id='$ips' and Ucase(iptype)='EXCLUSIVE'";
				//myLog($query);
				mysql_query($query) or die(errorCatch(mysql_error()));
			}
	}
else
	{
		myLog("Sorry there were some problems in assigining IP address.Contact your administrator");
?>
<script>
	alert("There were problems assigining IP's to client");
	window.location='../domains/clientdomains.php';
</script>

<?
	}
?>
<script>
	alert("IP address successfully assigned to client");
	window.location='../domains/clientdomains.php';
</script>
