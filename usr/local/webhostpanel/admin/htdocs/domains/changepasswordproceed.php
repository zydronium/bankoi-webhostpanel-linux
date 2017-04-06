<?$ACCESS_LEVEL=3;?>
<?include "../inc/connection.php"?>
<?include "../inc/params.php"?>
<?include "../inc/functions.php"?>
<?include "../inc/security.php"?>

<html>
<head>
<title>Change Domain Password</title>
<link rel="stylesheet" type="text/css" href="/skins/default/css/general.css">
<link rel="stylesheet" type="text/css" href="/skins/default/css/custom.css">
<link rel="stylesheet" type="text/css" href="/skins/default/css/layout.css">
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=ISO-8859-1">
<META HTTP-EQUIV="EXPIRES" CONTENT="0">
</head>
<body leftmargin="0" topmargin="0" >

<?
  $opassword=$_POST["opassword"];
  $npassword=$_POST["npassword"];
  $domainname=$_SESSION["domainname"];
  
  
  //------------------------------------------------------------------

$password=getFieldValue("tblloginmaster","username",$domainname,"password");
if($password==$opassword)
{
$query="update tblloginmaster set password='".$npassword."' where username='".$domainname."'";
//myLog($query);
mysql_query($query) or die(errorCatch(mysql_error()));
$query="update tblftpinfo set ftppassword='".$npassword."' where domainid=".$_SESSION["domainid"];
//myLog($query);
mysql_query($query) or die(errorCatch(mysql_error()));
$ftpusername=getFieldValue("tblftpinfo","domainid",$_SESSION["domainid"],"ftpusername");
$crPassword=crypt($npassword,"\$1\$9");
$cmd="usermod -p'" . $crPassword . "' " . $ftpusername;
exec ($cmd,$output,$return_var);
		  
		  ?>
		  <script>
		  alert("Password changed Successfully of <?=$domainname?>");
		  window.location.replace("../domains/showdomaindetails.php");
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
