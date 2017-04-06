<?$ACCESS_LEVEL=2;?>
<?
include "../inc/connection.php";
include "../inc/params.php";
include "../inc/functions.php";
?>
<?include "../inc/security.php"?>
<html>
<head>

<title>Client Preferences</title>
<link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/general.css">
<link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/custom.css">
<link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/layout.css">
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=ISO-8859-1">
<META HTTP-EQUIV="EXPIRES" CONTENT="0">
</head>
<?
	$reselid=$_SESSION["clientid"];
	$resellername=$_SESSION["clientname"];
?>
<body leftmargin=0 topmargin=0>
<?include "../inc/mainheader.php"?>
<?include "../clients/clientheader.php"?>
<form name="mainform" enctype="multipart/form-data" action="../clients/setclientpreferences.php" method="POST">
 <!-- <table width="80%" border="0" align="center" cellspacing="0" cellpadding="0">
    <?
	if(strtoupper($_SESSION["type"])=="A")
		{
?>
    <tr> 
      <td align="left" class="navigation">Administrator 
        &gt;
        <?=$_SESSION["clientname"]?>
        &gt; Preferences </td>
    </tr>
    <?
		}
	elseif(strtoupper($_SESSION["type"])=="C")
		{
?>
    <tr> 
      <td align="left" class="navigation"> 
        <?=$_SESSION["clientname"]?>
        &gt; Preferences </td>
    </tr>
    <?
		}
	elseif(strtoupper($_SESSION["type"])=="D")
		{
?>
    <tr> 
      <td align="left" class="navigation"></td>
    </tr>
<?
		}
?>
    <tr> 
      <td>&nbsp;</td>
    </tr>
  </table>-->
<?
		$query="select logo from tblreseller where resellerid=$reselid";
		$logoarray=mysql_query($query) or die(errorCatch(mysql_error()));
		$lg = mysql_fetch_array($logoarray);
		
		$logopath = "../logos/" . $lg["logo"];
		$query="select skinname from tblloginmaster where typeid=$reselid and ucase(usertype) = 'C'";
		$array=mysql_query($query) or die(errorCatch(mysql_error()));
		$res=mysql_fetch_array($array);
		$skins=$res["skinname"];
		
		
?>
  <table width="54%" border="0" align="center">
    <?		
		if($lg["logo"] != "")
			{
?>
    <tr> 
      <td height="5" colspan="2">Client <strong><font color="#FF0000">
        <?=$resellername?>
        </font></strong> Preferences</td>
      <td height="5"><div align="right"> 
          <input name="button2" type="button" class="commonbutton" id="bid-up-level" title="Up Level"  onClick="window.location='../domains/clientdomains.php';" value="Up Level"  >
        </div></td>
    </tr>
    <tr>
      <td height="5" colspan="3"><div align="center"><img src="/skins/default/elements/line.gif" width=564 height=1 border=0></div></td>
    </tr>
    <tr> 
      <td height="5" colspan="3"><div align="left" class="clientheading">Current 
          Logo</div></td>
    </tr>
    <tr> 
      <td height="6" colspan="3"><div align="left"><img src="<?=$logopath?>" alt="CLIENT LOGO"  width="88" height="86"></div></td>
    </tr>
    <?
			}
?>
    <tr> 
      <td width="47%" height="13"><div align="right" class="headings">Upload Logo</div></td>
      <td width="3%">&nbsp;</td>
      <td width="50%"><input  type="file" name="userfile[]" class="textboxclass"></td>
    </tr>
    <tr> 
      <td><div align="right" class="headings">Skins </div></td>
      <td>&nbsp;</td>
      <td><select name="skinname" id="skinname" class="dropdown">
          <?
	$skinnames=Split(",", GetSkins());
	
	for($i=0; $i < count($skinnames); $i++)
	{
?>
          <option value="<?=$skinnames[$i]?>" <?if($skins==$skinnames[$i]) echo "Selected"?>> 
          <?=strtoupper($skinnames[$i])?>
          </option>
          <?		
	}
?>
        </select></td>
    </tr>
    <tr> 
      <td colspan="3"><div align="right"><img src="/skins/default/elements/line.gif" width=564 height=1 border=0></div></td>
    </tr>
  </table>
      <p align="center"> 
  <input name="submit" type="submit" class="commonButton" value="Ok">
    <input name="button" type="button" class="commonButton" onclick="location.href='../domains/clientdomains.php'" value="Cancel">
</p>

</form>
</body>
</html>
    <br>
<?include "../inc/footer.php";?>
