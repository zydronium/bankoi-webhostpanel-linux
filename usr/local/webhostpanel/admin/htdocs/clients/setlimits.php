<?$ACCESS_LEVEL=1;?>
<?include "../inc/connection.php"?>
<?include "../inc/params.php"?>
<?include "../inc/functions.php"?>
<?include "../inc/security.php"?>
<html>
<head>
<title>
Set Client Limits
</title>
</head>

<?
$popmail=$_POST["popmail"];
$sql=$_POST["sql"];
$email=$_POST["email"];
$diskspace=$_POST["diskspace"];
$domains=$_POST["domains"];
$traffic=$_POST["traffic"];
?>

<link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/general.css">
<link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/custom.css">
<link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/layout.css">
<body leftmargin=0 topmargin=0>
<form name="form1" action="/clients/setlimitsfinal.php" method="post">
  <?include "../inc/mainheader.php"?>
  <?include "../clients/clientheader.php"?>
  <!--<table width="80%" border="0" align="center" cellspacing="0" cellpadding="0">
    <?
	if(strtoupper($_SESSION["type"])=="A")
		{
?>
    <tr> 
      <td align="left" class="navigation">Administrator 
        &gt;  
        <?=$_SESSION["clientname"]?>
        &gt; Limits </td>
    </tr>
    <?
		}
	elseif(strtoupper($_SESSION["type"])=="C")
		{
?>
    <tr> 
      <td align="left" class="navigation"> 
        <?=$_SESSION["clientname"]?>
        &gt; Limits </td>
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

  <table align="center" cellspacing="2">
    <tr> 
      <td colspan=3 class="headings">Please Confirm Limits For <font color="red"><strong><?=$_SESSION["clientname"]?></strong></font>
      </td>
    </tr>
    <tr> 
      <td colspan="3" class="headings"><img src="/skins/<?=$_SESSION["skin"]?>/elements/line.gif" width=564 height=1 border=0></td>
    </tr>
    <tr> 
      <td align="right" width="45%" class="headings">Pop mail Accounts </td>
      <td width="6%" align="center"><font color="#FF0000" size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
        </strong></font></td>
      <td width="49%" align="center"><div align="left"> 
          <input name="popmail" type="hidden" id="popmail" value="<?=$popmail?>">
          <font color="#FF0000" size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
          <strong> 
          <?
	  if(trim($popmail)=="")
	  	echo "Unlimited";
	else
		echo $popmail;
	  ?>
          </strong></font></div></td>
    </tr>
	<input name="popmail" type="hidden" id="popmail" value="<?=$popmail?>">
    <tr> 
      <td align="right" width="50%" class="headings">Sql Databases: </td>
      <td width="2%" align="center">&nbsp;</td>
      <td width="48%" align="center"><div align="left"> 
          <input name="sql" type="hidden" id="sql2" value="<?=$sql?>">
          <font color="#FF0000" size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
          <strong> 
          <?
	  if(trim($sql)=="")
	  	echo "Unlimited";
	else
		echo $sql;
	  ?>
          </strong></font></div></td>
    </tr>
    <tr> 
      <td align="right" width="45%" class="headings">Email Alias </td>
      <td align="center">&nbsp;</td>
      <td align="center"><div align="left"> 
          <input name="email" type="hidden" id="email2" value="<?=$email?>">
          <font color="#FF0000" size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
          <strong> 
          <?
	  if(trim($email)=="")
	  	echo "Unlimited";
	else
		echo $email;
	  ?>
          </strong></font></div></td>
    </tr>
	<input name="email" type="hidden" id="email2" value="<?=$email?>">
    <tr> 
      <td align="right" class="headings">Disk Space: </td>
      <td align="center">&nbsp; </td>
      <td align="center"><div align="left"> 
          <input name="diskspace" type="hidden" value="<?=$diskspace?>">
          <font color="#FF0000" size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
          <strong> 
          <?
	  if(trim($diskspace)=="")
	  	echo "Unlimited";
	else
		echo $diskspace;
	  ?>
          <font color="#003333">MB</font> </strong></font></div></td>
    </tr>
    <tr> 
      <td align="right" class="headings">Domains: </td>
      <td align="center">&nbsp; </td>
      <td align="center"><div align="left"> 
          <input name="domains" type="hidden" value="<?=$domains?>">
          <font color="#FF0000" size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
          <strong> 
          <?
	  if(trim($domains)=="")
	  	echo "Unlimited";
	else
		echo $domains;
	  ?>
          </strong></font></div></td>
    </tr>
    <tr> 
      <td align="right" class="headings">Traffic: </td>
      <td align="center">&nbsp; </td>
      <td align="center"><div align="left"> 
	  
	  <input name="traffic" type="hidden" value="<?=$traffic?>">
          <?
	
	if($traffic == "")
			$traffic = "Unlimited";
?>
          <font color="#FF0000" size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
          <strong> 
          <?
	  echo $traffic;
?>
          <font color="#003333">MB </font></strong></font></div></td>
    </tr>
    <tr> 
      <td align="right">&nbsp;</td>
      <td align="center">&nbsp;</td>
      <td align="center">&nbsp;</td>
    </tr>
    <tr> 
      <td colspan="3">
	  <img src="/skins/<?=$_SESSION["skin"]?>/elements/line.gif" width=564 height=1 border=0></td>
    </tr>
  </table>
<div align="center">
<?
	if(strtoupper($_SESSION["type"])=="A")
		{
?>
	<input class="commonButton" type="submit" value="Proceed" > 
<?
		}
?>
	<input class="commonButton" type="button" value="Cancel" onclick="javascript:history.back()">
</div>
</form>
</head>
</html>
<br><? include "../inc/footer.php" ?>
