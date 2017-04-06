<?$ACCESS_LEVEL=2 ;?>
<?include "../inc/connection.php"?>
<?include "../inc/params.php"?>
<?include "../inc/functions.php"?>
<?include "../inc/security.php"?>

<html>
<head>
<title>Change Client Password</title>
<link rel="stylesheet" type="text/css" href="/skins/default/css/general.css">
<link rel="stylesheet" type="text/css" href="/skins/default/css/custom.css">
<link rel="stylesheet" type="text/css" href="/skins/default/css/layout.css">
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=ISO-8859-1">
<META HTTP-EQUIV="EXPIRES" CONTENT="0">
</head>
<body leftmargin=0 topmargin=0 >

<?
  $opassword=$_POST["opassword"];
  $npassword=$_POST["npassword"];
  $clientname=$_SESSION["clientname"];
  
  //------------------------------------------------------------------

$password=getFieldValue("tblloginmaster","username",$clientname,"password");
if($password==$opassword)
{
$query="update tblloginmaster set password='".$npassword."' where username='".$clientname."'";
//($query);
mysql_query($query) or die(errorCatch(mysql_error()));
		  
		  ?>
		  <script>
		  alert("Password changed Successfully of <?=$clientname?>");
		  window.location.replace("../domains/clientdomains.php");
		  </script>
<?}
else
 {?>
		  <script>
		  alert("Old Password does not match");
		  window.history.go(-1);
		  </script>
 <?}?>
</body>
</html>
