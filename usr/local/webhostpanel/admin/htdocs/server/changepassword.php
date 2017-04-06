<?$ACCESS_LEVEL=1;?>
<?include "../inc/connection.php"?>
<?include "../inc/params.php"?>
<?include "../inc/functions.php"?>
<?include "../inc/security.php"?>
<?include "../inc/constants.php"?>

<html>
<head>
<title>Add Client</title>
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
  
  //------------------------------------------------------------------

$password=getFieldValue("tblloginmaster","username","admin","password");
if($password==$opassword)
{
$query="update tblloginmaster set password='".$npassword."' where username='admin'";
//myLog($query);
mysql_query($query) or die(errorCatch(mysql_error()));
		  
		  ?>
		  <script>
		  alert("Admin Password changed Successfully");
		  window.location.replace("server.php");
		  </script>
<?}
else
 {?>
		  <script>
		  alert("Old Password does not match");
		  window.location.replace("adminpassword.php");
		  </script>
 <?}?>
</body>
</html>
