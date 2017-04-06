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
	if(strlen($_POST["idd"])==0)
	{
?>
	<script>
		alert("<?=$lbl261?>");
		window.location="newserver.php";
	</script>
<?
}
else{
	$delIP=split(",",$_POST["idd"]);
	for($i=0; $i<=count($delIP)-1; $i++)
		{
			$id=$delIP[$i];
			$query="select * from tbldomain where ipaddress='".$id."'";
			//echo $query;
			myLog($query);
			$rs=mysql_query($query) or die(errorCatch(mysql_error()));
			$n=mysql_affected_rows();
			if($n>0){
			
			?>
			
			<script>
			alert("<?=$msg121?>");
			location.replace('serverip.php');
			</script>
			
			<?
				die();
			}
			else{
			
			$query="select * from tblserverip where Id='".$id."'";
			myLog($query);
			$rsip=mysql_query($query) or die(errorCatch(mysql_error()));
			$dataip=@mysql_fetch_object($rsip);
			
			
			RemoveIP($dataip->interface,$id);
			//system("ifconfig ".$dataip->interface.":".$id." del ".$dataip->ipaddress);
			
			$query="delete from tblserverip where Id='".$id."'";
			myLog($query);
			mysql_query($query) or die(errorCatch(mysql_error()));;
			
			
			}
		}
}

?>
<script>
	alert("IP address deleted successfully");
	location.replace('serverip.php');
</script>
