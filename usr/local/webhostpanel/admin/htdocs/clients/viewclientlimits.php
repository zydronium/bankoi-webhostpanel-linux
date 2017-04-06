<?$ACCESS_LEVEL=2;?>
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
$reselid=$_SESSION["clientid"];
$query="Select * from tblclientrights where resellerid=$reselid";
//echo $query;
$arr4clients=mysql_query($query);
if(mysql_num_rows($arr4clients) == 0)
	{
?>
		<script>
			alert("Sorry there is some problem.The client limits will not be visible");
			window.location="../domains/clientdomains.php";
		</script>
<?	
		die();
	}
$ClientPref=mysql_fetch_array($arr4clients);

$popmail=$ClientPref["popmailaccount"];
$sql=$ClientPref["sqldatabase"];
$email=$ClientPref["emailalias"];
$diskspace=$ClientPref["diskspace"];
$domains=$ClientPref["domains"];
$pwdprotectdir=$ClientPref["pwdprotectdir"];

if($pwdprotectdir!="Y" || $pwdprotectdir=="")
	$pwdprotectdir="N";

$frontpageext=$ClientPref["frontpageext"];
if($frontpageext!="Y" || $frontpageext=="")
	$frontpageext="N";

$webstart=$ClientPref["webstart"];
if($webstart!="Y" || $webstart=="")
	$webstart="N";

$traffic=$ClientPref["traffic"];
?>

<link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/general.css">
<link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/custom.css">
<link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/layout.css">
<body leftmargin=0 topmargin=0>
<form name="form1" action="/clients/setlimitsfinal.php" method="post">
  <?include "../inc/mainheader.php"?>
  <?include "../clients/clientheader.php"?>
  <!--<table width="58%" border="0" align="center" cellspacing="0" cellpadding="0">
    <?
	if(strtoupper($_SESSION["type"])=="A")
		{
?>
    <tr> 
      <td align="left" class="navigation">Administrator 
        &gt; 
        <?=$_SESSION["clientname"]?>
        &gt; Clients Limits </td>
    </tr>
    <?
		}
	elseif(strtoupper($_SESSION["type"])=="C")
		{
?>
    <tr> 
      <td align="left" class="navigation">
        <?=$_SESSION["clientname"]?>
        &gt; Clients Limits </td>
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
      <td colspan=3 class="headings">Limits 
        For 
        <?=$_SESSION["clientname"]?>
        </td>
    </tr>
    <tr> 
      <td colspan="3"><img src="/skins/<?=$_SESSION["skin"]?>/elements/line.gif" width=564 height=1 border=0></td>
    </tr>
    <tr> 
      <td align="right" width="45%" class="headings">Pop 
        mail Accounts </td>
      <td width="5%" align="center">&nbsp;</td>
      <td width="50%" align="center"><div align="left"> 
          <input name="popmail" type="hidden" id="popmail" value="<?=$popmail?>">
          <font color="#FF0000" size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
          <strong> 
          <?
	  if(trim($popmail)=="" || trim($popmail)=="-1")
	  	echo "Unlimited";
	else
		echo $popmail;
	  ?>
          </strong></font></div></td>
    </tr>
    <tr> 
      <td align="right" width="45%" class="headings">Sql Databases: </td>
      <td align="center">&nbsp;</td>
      <td align="center"><div align="left"> 
          <input name="sql" type="hidden" id="sql2" value="<?=$sql?>">
          <font color="#FF0000" size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
          <strong> 
          <?
	  if(trim($sql)=="" || trim($sql)=="-1")
	  	echo "Unlimited";
	else
		echo $sql;
	  ?>
          </strong></font></div></td>
    </tr>
    <tr> 
      <td align="right" width="45%" class="headings">Email 
        Alias </td>
      <td align="center">&nbsp;</td>
      <td align="center"><div align="left"> 
          <input name="email" type="hidden" id="email2" value="<?=$email?>">
          <font color="#FF0000" size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
          <strong> 
          <?
	  if(trim($email)=="" || trim($email)=="-1")
	  	echo "Unlimited";
	else
		echo $email;
	  ?>
          </strong></font></div></td>
    </tr>
    <tr> 
      <td align="right" class="headings">Disk Space: </td>
      <td align="center">&nbsp; </td>
      <td align="center"><div align="left"> 
          <input name="diskspace" type="hidden" value="<?=$diskspace?>">
          <font color="#FF0000" size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
          <strong> 
          <?
	  if(trim($diskspace)=="" || trim($diskspace)=="-1")
	  	echo "Unlimited";
	else
		echo $diskspace;
	  ?>
          <font color="#003366"> MB</font> </strong></font></div></td>
    </tr>
    <tr> 
      <td align="right" class="headings">Domains: </td>
      <td align="center">&nbsp; </td>
      <td align="center"><div align="left"> 
          <input name="domains" type="hidden" value="<?=$domains?>">
          <font color="#FF0000" size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
          <strong> 
          <?
	  if(trim($domains)=="" || trim($domains)=="-1")
	  	echo "Unlimited";
	else
		echo $domains;
	  ?>
          </strong></font></div></td>
    </tr>
    <tr> 
      <td align="right" class="headings">Password Protect Directory: </td>
      <td align="center">&nbsp; </td>
      <td align="center"><div align="left"> 
          <input name="pwdprotectdir" type="hidden" value="<?=$pwdprotectdir?>">
          <font color="#FF0000" size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
          <strong> 
          <?
	  if(trim($pwdprotectdir)=="Y")
	  	echo "Enabled";
	else
		echo "Disabled";
	  ?>
          </strong></font></div></td>
    </tr>
    <tr> 
      <td align="right" class="headings">Front Page Extention: </td>
      <td align="center">&nbsp; </td>
      <td align="center"><div align="left"> 
          <input name="frontpageext" type="hidden" value="<?=$frontpageext?>">
          <font color="#FF0000" size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
          <strong> 
          <?
	  if(trim($frontpageext)=="Y")
	  	echo "Enabled";
	else
		echo "Disabled";
	  ?>
          </strong></font></div></td>
    </tr>
    <tr> 
      <td align="right" class="headings">WebStats: </td>
      <td align="center">&nbsp; </td>
      <td align="center"><div align="left"> 
          <input name="webstart" type="hidden" value="<?=$webstart?>">
          <font color="#FF0000" size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
          <strong> 
          <?
	  if(trim($webstart)=="Y")
	  	echo "Enabled";
	else
		echo "Disabled";
	  ?>
          </strong></font></div></td>
    </tr>
    <tr> 
      <td align="right" class="headings">Traffic: </td>
      <td align="center">&nbsp; </td>
      <td align="center"><div align="left"> 
	  <font color="#FF0000" size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
      <strong>
       <?
	  if(trim($traffic)=="" || trim($traffic)=="-1")
	  	echo "Unlimited";
	else
		echo $traffic;
	  ?>
	  </strong>
	  </font>
	  <strong><font color="#003366">MB</font> </strong></font></div></td>
    </tr>
    <tr> 
      <td align="right">&nbsp;</td>
      <td colspan="2" align="center">&nbsp;</td>
    </tr>
    <tr> 
      <td colspan="3"><img src="/skins/<?=$_SESSION["skin"]?>/elements/line.gif" width=564 height=1 border=0></td>
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
	<input class="commonButton" type="button" value="Cancel" onclick="window.location='../domains/clientdomains.php'">
</div>
</form>
</head>
</html>
<br><? include "../inc/footer.php" ?>
