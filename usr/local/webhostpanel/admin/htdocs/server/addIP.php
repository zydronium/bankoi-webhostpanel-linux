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
$interface=$_POST["interface"];
$ip1=$_POST["ip1"];
$ip2=$_POST["ip2"];
$ip3=$_POST["ip3"];
$ip4=$_POST["ip4"];
$ipaddress=$ip1.".".$ip2.".".$ip3.".".$ip4;
$sn1=$_POST["sn1"];
$sn2=$_POST["sn2"];
$sn3=$_POST["sn3"];
$sn4=$_POST["sn4"];
$subnet=$sn1.".".$sn2.".".$sn3.".".$sn4;
$iptype=$_POST["iptype"];
$certificate=$_POST["certificate"];
//echo "The type of IP is " . $iptype;

myLog($ipaddress);
myLog($iptype);

if($ipaddress=="" || $iptype=="")
	{
		echo "Sorry there were problems adding new IP address.Contact your anministrator";
?>
<script>
	history.go(-1);	
</script>
<?
		die();
	}
else
	{
	
		$query="select * from tblserverip where ipaddress='$ipaddress'";
		//myLog($query);
		$result=mysql_query($query) or die(errorCatch(mysql_error()));
		$num=@mysql_num_rows($result) ;//or die("Can not get the number of effected rows") ;

		if($num > 0)
			{
				echo "<script>alert('Sorry this IP address already exist');</script>";
			}
		else
			{
				$query="insert into tblserverip(ipaddress,subnet,interface,iptype) values ('$ipaddress','$subnet','$interface','$iptype')";
				@mysql_query($query) or die(errorCatch(mysql_error()));

				$query="select * from tblserverip where ipaddress='$ipaddress'";
				$resultip=mysql_query($query) or die(errorCatch(mysql_error()));
				$ip=@mysql_fetch_object($resultip);
				$id=$ip->Id;
				
	AddIP($interface,$ipaddress,$subnet,$id);
			}
	}
?>
<?echo  "<script>location.replace('/server/serverip.php');</script>"?>
