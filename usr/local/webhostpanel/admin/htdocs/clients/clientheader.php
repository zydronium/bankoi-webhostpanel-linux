<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body>
<table width="56%" border="0" align="center">
  <tr>
    <td><div align="center"><font color="#FF0000" size="2" face="Verdana, Arial, Helvetica, sans-serif">
        <?=strtoupper($_SESSION["clientname"])?></font> Menu 
      </div></td>
  </tr>
</table>
<table width="44%" border="0" align="center">
  <tr> 
    <td width="96"  align="center"> <div align="left"> 
        <input type="button" name="Button" value="Client Home" onClick="window.location='../domains/clientdomains.php'" class="commonbutton" title="Client Home">
      </div></td>
    <td width="129"  align="center"> <div align="left"> 
        <input type="button" name="Button2" value="New Domain" onClick="window.location='../domains/domainnew.php'" class="commonbutton" title="New Domain">
      </div></td>
    <?
	if(strtoupper($_SESSION["type"])=="A")
		{
?>
    <td width="64" align="center"><div align="left"> 
        <input type="button" name="Button22" value="Limits" onClick="window.location='../clients/limits.php'" class="commonbutton" title="Limits">
      </div></td>
    <?
		}
	if(strtoupper($_SESSION["type"])=="C")
		{
?>
    <td width="79" align="center"><div align="left"> 
        <input type="button" name="Button222" value="Limits" onClick="window.location='../clients/viewclientlimits.php'" class="commonbutton" title="Limits">
      </div></td>
    <?
		}
?>
    <td width="98" align="center"><div align="left"> 
        <input type="button" name="Button25" value="Contact Info" onClick="window.location='../clients/clientinfo.php'" class="commonbutton" title="Client Contact">
      </div></td>
    <td width="122" align="center"><input type="button" name="Button26" value="Preferences" onClick="window.location='../clients/clientpreferences.php'" class="commonbutton" title="Client Preferences"></td>
  </tr>
  <tr> 
    <td width="96" height="31" align="center" valign="top"><div align="left">
        <input type="button" name="Button27" value="IP Pool" onClick="window.location='../server/assign.php'" class="commonbutton" title="Manage IP">
      </div></td>
    <td width="129" align="center" valign="top"><div align="left">
        <input type="button" name="Button28" value="Change Password" onClick="window.location='../clients/changepassword.php'" class="commonbutton" title="Change Password">
      </div></td>
    <td width="64" align="center" valign="top"><div align="left">
       <input type="button" name="Button24" value="DNS" onClick="window.location='../clients/dnsEntry.php'" class="commonbutton" title="DNS">
      </div></td>
    <?
		
	if(strtoupper($_SESSION["type"])=="C")
		{
?>
    <td width="79" align="center" valign="top"><div align="left"></div></td>
    <?
		}
?>
    <td colspan="2" align="center" valign="top"><div align="left"> 
        <p>&nbsp; </p>
      </div></td>
  </tr>
</table>
</body>
</html>
