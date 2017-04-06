<?$ACCESS_LEVEL=1 ;?>
<?include "../inc/connection.php"?>
<?include "../inc/params.php"?>
<?include "../inc/functions.php"?>
<?include "../inc/security.php"?>
<html>
<head>
<title>Manage Server</title>
</head>
<link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/general.css">
<link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/custom.css">
<link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/layout.css">
<body leftmargin=0 topmargin=0>
<script>
function reboot()
{
if(confirm("This will Reboot your system. You want to proceed"))
{
location.href = "../server/reboot.php";
}
}


function shutdown()
{
if(confirm("This will Shutdown your system. You want to proceed"))
{
location.href = "../server/shutdown.php";
}
}
</script>

<form name="mainform" action="" method="post">
  <?include "../inc/mainheader.php"?>
  <!--<table width="59%" border="0" align="center" cellspacing="0" cellpadding="0">
    <?
	if(strtoupper($_SESSION["type"])=="A")
		{
?>
    <tr> 
      <td align="left" class="navigation">Administrator &gt; Servers</td>
    </tr>
    <?
		}
	elseif(strtoupper($_SESSION["type"])=="C")
		{
?>
    <?
		}
	elseif(strtoupper($_SESSION["type"])=="D")
		{
?>
    <?
		}
?>
    <tr> 
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="32"><div align="center">Administrator Menu</div></td>
    </tr>
  </table>-->
  
  <table width="39%" border="0" align="center">
    <tr>
      <td><input type="button" name="Button22232" value="Change Password" onClick="window.location='adminpassword.php'" class="commonbutton" title="Change Password"></td>
      <td><input type="button" name="Button" value="ManageIP" onClick="window.location='../server/serverip.php'" class="commonbutton" title="ManageIP"></td>
      <td> 
        <input type="button" name="Button2223" value="Edit Admin Info" onClick="window.location='admincontact.php'" class="commonbutton" title="Edit Admin Info"></td>
    </tr>
    <tr>
      <td><input type="button" name="Button222322" value="Reboot" onClick="javascript:onClick=reboot();" class="rebootButton" title="Reboot"></td>
      <td><input type="button" name="Button22" value="Manage Services" onClick="window.location='../server/servicemgt.php'" class="commonbutton" title="Service Management"></td>
      <td><input type="button" name="Button2222" value="DNS" onClick="window.location='dnsTemplate.php'" class="commonbutton" title="DNS"></td>
    </tr>
    <tr>
      <td><input type="button" name="Button2223222" value="Shut Down" onClick="javascript:onClick=shutdown();" class="shutdownButton" title="Shut Down"></td>
      <td><input type="button" name="Button2" value="Date & Time" onClick="window.location='../server/setdatetime.php'" class="commonbutton" title="Manage Date & Time"></td>
     <td><input type="button" name="Button222" value="Mail" onClick="window.location='../server/managemail.php'" class="commonbutton" title="Mail"></td>
    </tr>
  </table>
  <p>&nbsp;</p>

</form>
</head>
</html>
<? include "../inc/footer.php" ?>
