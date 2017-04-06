<?$ACCESS_LEVEL=3;?>
<?include "../inc/connection.php"?>
<?include "../inc/params.php"?>
<?include "../inc/security.php"?>
<?include "../inc/functions.php"?>
<?include "../inc/mainheader.php"?>
<html>
<head>
<title>Domains Listing</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/general.css">
<link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/custom.css">
<link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/layout.css">
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=ISO-8859-1">
<META HTTP-EQUIV="EXPIRES" CONTENT="0">
</head>

<?
	$resellername = $_SESSION["clientname"];
	$DomainName = $_SESSION["domainname"];

	if(strtoupper($_SESSION["type"])=="C" || strtoupper($_SESSION["type"])=="A")
		include "../clients/clientheader.php";
	include "../domains/domainheader.php";

	$home = $sHostingDir . "/" . $resellername . "/" . $DomainName;
	for($i=0 ; $i < count($_POST["dir_id"]);$i++)
		{
				if($ID == "")
					{
							$ID=$_POST["dir_id"][$i];		
					}
				else	
					{
							$ID = $ID . " , " . $_POST["dir_id"][$i];
					}
		}
	$query = "delete from tbldirpass where id in (" . $ID . ")";
	@mysql_query($query);	
	RemovePwdProtectDir($home,$DomainName);
	
	$query = "select * from tbldirpass where domainname ='$DomainName'";
	$exDir = @mysql_query($query);
	$num = mysql_num_rows($exDir);

	if($num != 0)
		{
				while($rsDir = @mysql_fetch_array($exDir))
					{
							$username = $rsDir["username"];
							$passwd = $rsDir["passwd"];
							$DirName = $rsDir["dirname"];
							PwdProtectDir($home,$username,$passwd,$DirName,$DomainName);
					}
		}
?>
<script>
	alert("Password from the directory deleted!!!")
	location.replace("../domains/explorer.php");
</script>
