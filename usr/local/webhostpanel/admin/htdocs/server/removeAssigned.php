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
	$cnt=0;
	if(strlen($_POST["idd"])==0)
	{
?>
	<script>
		alert("No IPs to Delete");
		window.location="newserver.php";
	</script>
<?
}
else{
	
	$delIP=split(",",$_POST["idd"]);
	for($i=0; $i <=count($delIP)-2; $i++)
		{
			$id=$delIP[$i];
			$query="select * from tbldomain where ipaddress='".$id."' and resellerid='".$_SESSION["clientid"]."'";
			//myLog($query);
			$rs=mysql_query($query) or die(errorCatch(mysql_error()));;
			$n=mysql_num_rows($rs);
			
			if($n > 0)
				{
				
				}
			else
				{
					$query="delete from tblresellerip where ipaddress='".$id."' and resellerid='".$_SESSION["clientid"]."'";
					//myLog($query);
					mysql_query($query) or die(errorCatch(mysql_error()));
					$query="update tblserverip set isavailable='Y' where Id='".$id."'";
					//myLog($query) or myLog(mysql_error());
					mysql_query($query) or myLog(mysql_error());
					$cnt += 1;
				}
		}
}

if($cnt == 0)
	{
?>
<script>
	alert("IP addresses not deleted for the client.It may be assigned to some domains");
	window.location='assign.php';
</script>
<?
	}
else
	{
?>
<script>
	alert("IP addresses deleted successfully for the client");
	window.location='assign.php';
</script>
<?
	}
?>