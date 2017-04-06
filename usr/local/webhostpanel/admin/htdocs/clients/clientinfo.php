<?$ACCESS_LEVEL=2;?>
<?
include "../inc/connection.php";
include "../inc/functions.php";
?>
<?include "../inc/security.php"?>
<html>
<head>

<title>Client Info</title>
<link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/general.css">
<link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/custom.css">
<link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/layout.css">
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=ISO-8859-1">
<META HTTP-EQUIV="EXPIRES" CONTENT="0">
</head>
<body leftmargin=0 topmargin=0>
<?include "../inc/mainheader.php"?>
<?include "../clients/clientheader.php"?>
<form action='updateclient.php' method='post' name="mainform">
 
  <table border="0" cellpadding=0 cellspacing=0 width="564" align="center">
    <tr> 
      <td colspan="1"><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="3" height="1" border="0"></td>
      <td colspan="1"><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="436" height="1" border="0"></td>
      <td colspan="1"><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="7" height="1" border="0"></td>
      <td colspan="1"><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="115" height="1" border="0"></td>
      <td colspan="1"><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="3" height="1" border="0"></td>
    </tr>
    <tr> 
      <td colspan=1><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="1" height="7" border="0"></td>
    </tr>
    <tr> 
      <td></td>
      <td colspan="3">&nbsp;</td>
    </tr>
    <?
	$resellername=$_SESSION["clientname"];
	$resellerid=$_SESSION["clientid"];
	$query="select * from tblclientcontact where resellerid=$resellerid";
	//myLog($query);
	$array=mysql_query($query)or die(errorCatch(mysql_error()));
	$clientinfo=@mysql_fetch_object($array);

	//Information from the table tblloginmaster
	$query="select * from tblloginmaster where ucase(usertype)=ucase('c') and typeid=$resellerid";
	//myLog($query);
	$array=mysql_query($query)or die(errorCatch(mysql_error()));
	$clientpass=@mysql_fetch_object($array);
?>
  </table>
  <!--  <table width="60%" border="0" align="center" cellspacing="0" cellpadding="0">
    <?
	if(strtoupper($_SESSION["type"])=="A")
		{
?>
    <tr> 
      <td align="left" class="navigation">Administrator 
        &gt; 
        <?=$_SESSION["clientname"]?>
        &gt; Contact Information </td>
    </tr>
    <?
		}
	elseif(strtoupper($_SESSION["type"])=="C")
		{
?>
    <tr> 
      <td align="left" class="navigation"> 
        <?=$_SESSION["clientname"]?>
        &gt; Contact Information </td>
    </tr>
    <?
		}
	elseif(strtoupper($_SESSION["type"])=="D")
		{
?>
    <tr> 
      <td align="left" ><strong><font color="#000000"> </font></strong></td>
    </tr>
    <?
		}
?>
  </table>-->
  <table width="56%" border="0" align="center">
    <tr>
      <td>Information for client <strong><font color="#FF0000"><?=$resellername?></font></strong></td>
      <td><div align="right">
          <input name="button22" type="button" class="commonbutton" id="button22" title="Up Level" onClick="window.location='../domains/clientdomains.php'" value="Up Level" >
        </div></td>
    </tr>
  </table>
  <table width="57%" border="0" align="center">
    <tr> 
      <td colspan="3"><div align="left"></div></td>
    </tr>
    <tr> 
      <td colspan="3"><div align="center"><img src="/skins/<?=$_SESSION["skin"]?>/elements/line.gif" width=560 height=1 border=0></div></td>
    </tr>
    <tr> 
      <td width="47%" class="headings"><div align="right"><font color="#336600"> 
          Company name: </font></div></td>
      <td width="3%">&nbsp;</td>
      <td width="50%"> <font color="#663300" size="2" face="Verdana"> 
        <?=$clientinfo->companyname?>
        </font></td>
    </tr>
    <tr> 
      <td><div align="right" class="headings"><font color="#336600">Contact name 
          </font></div></td>
      <td>&nbsp;</td>
      <td> <font color="#663300" size="2" face="Verdana"> 
        <?=$clientinfo->contactname?>
        </font></td>
    </tr>
    <tr> 
      <td class="headings"><div align="right"><font color="#336600"> Control Panel 
          login name: </font></div></td>
      <td>&nbsp;</td>
      <td> <font color="#663300" size="2" face="Verdana"> 
        <?=$clientpass->username?>
        </font></td>
    </tr>
    <tr> 
      <td class="headings"><div align="right"><font color="#336600"> Control Panel 
          Password </font></div></td>
      <td>&nbsp;</td>
      <td> <font color="#663300" size="2" face="Verdana"> 
        <?=$clientpass->password?>
        </font></td>
    </tr>
    <tr> 
      <td><div align="right" class="headings"><font color="#336600">Phone </font></div></td>
      <td>&nbsp;</td>
      <td> <font color="#663300" size="2" face="Verdana"> 
        <?=$clientinfo->phone?>
        </font></td>
    </tr>
    <!--  <tr> 
      <td><div align="right"><font color="#003366" size="2" face="Verdana"><strong>Fax:</strong></font></div></td>
      <td>&nbsp;</td>
      <td> <font color="#CC0000" size="2" face="Verdana"> 
        <?=$clientinfo->
    fax?> <font color="#336600"></font></font><font color="#336600"></td></font> 
    <font color="#336600"></tr></font>--> 
    <tr> 
      <td><div align="right" class="headings"><font color="#336600">E-mail: </font></div></td>
      <td>&nbsp;</td>
      <td> <font color="#663300" size="2" face="Verdana"> 
        <?=$clientinfo->email?>
        </font></td>
    </tr>
    <tr> 
      <td><div align="right" class="headings"><font color="#336600">Address </font></div></td>
      <td>&nbsp;</td>
      <td> <font color="#663300" size="2" face="Verdana"> 
        <?=$clientinfo->address?>
        </font></td>
    </tr>
    <tr> 
      <td><div align="right" class="headings"><font color="#336600">City: </font></div></td>
      <td>&nbsp;</td>
      <td> <font color="#663300" size="2" face="Verdana"> 
        <?=$clientinfo->city?>
        </font></td>
    </tr>
    <tr> 
      <td><div align="right" class="headings"><font color="#336600">State/Province: 
          </font></div></td>
      <td>&nbsp;</td>
      <td> <font color="#663300" size="2" face="Verdana"> 
        <?=$clientinfo->state?>
        </font></td>
    </tr>
    <tr> 
      <td><div align="right" class="headings"><font color="#336600">Postal/ZIP 
          code </font></div></td>
      <td>&nbsp;</td>
      <td> <font color="#663300" size="2" face="Verdana"> 
        <?=$clientinfo->zipcode?>
        </font></td>
    </tr>
    <tr> 
      <td><div align="right" class="headings"><font color="#336600">Country </font></div></td>
      <td>&nbsp;</td>
      <td> <font color="#663300" size="2" face="Verdana"> 
        <?
//--------------------------------------------------------------------------------------------------
	//Here we are getting the name of the countries with there codes
    
	$query = "select * from tblcountry where code='$clientinfo->country'";
	//myLog($query);
	$array=mysql_query($query) or die(errorCatch(mysql_error()));
	$country=mysql_fetch_object($array)
?>
        <?=$country->countryname?>
        </font></td>
    </tr>
    <tr> 
      <td colspan="3" class="headings"><img src="/skins/<?=$_SESSION["skin"]?>/elements/line.gif" width=560 height=1 border=0></font></td>
    </tr>
    <tr align="center"> 
      <td height="29" colspan="3" class="headings"> <div align="right"> 
          <input class="commonButton" type="submit" name="Submit" value="Update">
          <input name="button222" type="button" class="commonbutton" id="button222" title="Ok" onClick="window.location='../domains/clientdomains.php'" value="Ok" >
        </div></td>
    </tr>
  </table>
  </center>
  <p><input type=hidden name=cmd value="update">
</p></form>
<br>

<? include "../inc/footer.php" ?>
</body>
</html>
