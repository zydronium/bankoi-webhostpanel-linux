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
  $id=$_POST["clientid"];
  $usertype=$_POST["usertype"];
  $npassword=$_POST["npassword"];
  
  //------------------------------------------------------------------
$query="update tblloginmaster set password='".$npassword."' where typeid='".$id."' and usertype='".$usertype."'";
//myLog($query);
mysql_query($query) or die(errorCatch(mysql_error()));
$updated=mysql_affected_rows();
if($updated!=0){
?>
		  <script>
		  alert("Password reset successfully");
		  window.location.replace("../clients/clients.php");
		  </script>
<?}
else{?>
		  <script>
		  alert("Password reset failed");
		  window.location.replace("../clients/clients.php");
		  </script>
<?}?>
</body>
</html>
