<?$ACCESS_LEVEL=1;?>
<?include "../inc/connection.php"?>
<?include "../inc/params.php"?>
<?include "../inc/functions.php"?>
<?include "../inc/security.php"?>
<html>
<head>
<title>Server Shutdown</title>
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
<p align="center"><strong><font size="4" face="Verdana, Arial, Helvetica, sans-serif">Server 
  is shutting down..!</font></strong></p>
<?
myLog("Shut down System at ".date("Y/m/d h:i:s", mktime()));
shutdown();
?>
</body>
</html>
