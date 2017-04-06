<?$ACCESS_LEVEL=1;?>
<?include "../inc/connection.php"?>
<?include "../inc/params.php"?>
<?include "../inc/functions.php"?>
<?include "../inc/security.php"?>
<html>
<head>
<title>Manage Mail</title>
</head>
<link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/general.css">
<link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/custom.css">
<link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/layout.css">
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=ISO-8859-1">
<META HTTP-EQUIV="EXPIRES" CONTENT="0">
<body topmargin="0">
<?
	include "../inc/mainheader.php";
?>
<!--  <table width="80%" border="0" align="center" cellspacing="0" cellpadding="0">
    <?
	if(strtoupper($_SESSION["type"])=="A")
		{
?>
    <tr> 
      <td align="left" class="navigation">Administrator &gt; Servers &gt;Manage Mails</td>
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
  </table>-->
  <body>
  <form name="mainform" action="deletepostfixmsg.php" method="post">
  <table width="80%" border="0" align="center">
    <tr> 
      <td colspan="3" class="clientheading"><div align="center">Manage Mails</div></td>
    </tr>
    <tr> 
      <td colspan="3" class="clientheading"><div align="center"></div></td>
    </tr>
    <tr> 
      <td width="48%" class="headings"><div align="right">POSTFIX queue status</div></td>
      <td width="4%" class="headings">&nbsp;</td>
      <td width="48%" class="headings"><input type="button" class="commonbutton" name="Add22" value="Get Queue Status" onClick="window.location='../server/postfixqueue.php'"></td>
    </tr>
    <tr> 
      <td class="headings"><div align="right">Delete message:- 
          <select name="msgtype" class="dropdown" id="msgtype">
            <option value="ALL">ALL</option>
            <option value="incoming">Incoming</option>
            <option value="active">Active</option>
            <option value="deferred">Deferred</option>
            <option value="bounce">Bounce</option>
            <option value="defer">Defer</option>
            <option value="trace">Trace</option>
            <option value="flush">Flush</option>
          </select>
        </div></td>
      <td class="headings">&nbsp;</td>
      <td class="headings"><input type="submit" class="commonbutton" name="Add2" value="Delete Messages" ></td>
    </tr>
    <tr> 
      <td height="22" colspan="3"><div align="center"> </div></td>
    </tr>
    <tr> 
      <td colspan="3"><div align="center"> 
          <input type="button" class="commonbutton" name="Add2" value="Back" onClick="window.location='../server/server.php'">
        </div></td>
    </tr>
  </table>
</form>
</body>
</html>
<br>
<?include "../inc/footer.php"?>
