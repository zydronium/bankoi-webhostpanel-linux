<?$ACCESS_LEVEL=1;?>
<?include "../inc/connection.php"?>
<?include "../inc/params.php"?>
<?include "../inc/functions.php"?>
<?include "../inc/security.php"?>

<html>
<head>
<title>Control Panel Reboot</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body>

<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p align="center"><font size="4" face="Verdana, Arial, Helvetica, sans-serif"><strong>Server 
  is Rebooting Please <a href="../login.php">Login</a> after some time..!</strong></font></p>
<?
myLog("Rebooting System at ".date("Y/m/d h:i:s",mktime()));
reboot();
?>
</body>
</html>
<script>
	location.replace("../login.php");
</script>
