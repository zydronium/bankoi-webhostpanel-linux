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
      <td align="left" class="navigation">Administrator &gt; Servers &gt;POSTFIX Queue</td>
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
<div class="clientheading" align="center">POSTFIX Queue Status</div>
<p>
  <iframe name="postqueue" width="742" height="240" align="center" border="1" frameborder="1" src="../server/getmailq.php"> 
  </iframe>
</p>
<div class="clientheading" align="center"><input type="button" name="submit" value="<<Back" onClick="window.location='../server/managemail.php'" class="commonbutton"></div>
<br><br>
<?include "../inc/footer.php"?>
