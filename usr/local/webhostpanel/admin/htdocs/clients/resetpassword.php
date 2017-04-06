<?$ACCESS_LEVEL=1;?>
<?include "../inc/security.php"?>
<html>
<head>
<title>Change Passwordt</title>
<link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/general.css">
<link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/custom.css">
<link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/layout.css">
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=ISO-8859-1">
<META HTTP-EQUIV="EXPIRES" CONTENT="0">


<?
if(isset($_GET["clid"]) && isset($_GET["usertype"]))
{
$clientid=$_GET["clid"];
$usertype=$_GET["usertype"];
$name=$_GET["name"];
//$_SESSION["type"]='A';
?>


<script language="JavaScript"> 

function validate()
{
regExp = /\w{1,}/;
if (!regExp.test(document.form1.npassword.value)){ 
   alert("New Password Cann't Be Empty ");
   document.form1.npassword.focus();
   return false;  
 }
else if (!regExp.test(document.form1.cpassword.value)){ 
   alert("Confirm the Password You Entered ");
   document.form1.cpassword.focus();
   return false;  
 }
else if (document.form1.cpassword.value!=document.form1.npassword.value){ 
   alert("Confirm Password should be same as new Password ");
   document.form1.npassword.value="";
   document.form1.cpassword.value="";
   document.form1.npassword.focus();
   return false;  
 }
else
  return true;
 }// end validate()
 
function goback()
{
window.history.go(-1);
}

 
</script>

</head>

<body topmargin="0">
  <?
	include "../inc/mainheader.php";
	include "../clients/clientheader.php";
?>
<form name="form1" method="post" action="resetpasswdbyadmin.php" onSubmit="return validate()">
  <table width="80%" border="0" align="center" cellspacing="0" cellpadding="0">
    <?
	if(strtoupper($_SESSION["type"])=="A")
		{
?>
    <tr> 
      <td align="left" ><strong><font color="#000000" face="Verdana">Administrator 
        &gt; </font><font color="#FFFFFF" face="Verdana"><font color="#000000"> 
        <?=$_SESSION["clientname"]?>
        &gt;</font></font><font color="#000000" face="Verdana"> Reset Password</font></strong></td>
    </tr>
    <?
		}
	elseif(strtoupper($_SESSION["type"])=="C")
		{
?>
    <tr> 
      <td align="left" ><strong><font color="#FFFFFF" face="Verdana"> <font color="#000000"> 
        <?=$_SESSION["clientname"]?>
        &gt;</font></font><font color="#000000" face="Verdana"> Reset Password</font></strong></td>
    </tr>
    <?
		}
	elseif(strtoupper($_SESSION["type"])=="D")
		{
?>
    <tr> 
      <td align="left" ><strong></strong></td>
    </tr>
    <?
		}
?>
    <tr> 
      <td>&nbsp;</td>
    </tr>
  </table>

  <table width="59%" border="0" align="center" cellspacing="2">
    <tr> 
      <td colspan="3"><div align="center"><font color="#006666"><img src="/skins/<?=$_SESSION["skin"]?>/elements/line.gif" width=560 height=1 border=0></font></div></td>
    </tr>
    <tr> 
      <td colspan="3"><strong><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Reset 
        Passoword Client: 
        <?=$name?>
        </font></strong></td>
    </tr>
    <tr> 
      <td width="35%">&nbsp;</td>
      <td width="7%">&nbsp;</td>
      <td width="58%"><input name="clientid" type="hidden" id="clientid" value="<?=$clientid?>">
        <input name="usertype" type="hidden" id="type" value="<?=$usertype?>"></td>
    </tr>
    <tr> 
      <td><div align="right"><font color="#0000FF" size="2" face="Verdana, Arial, Helvetica, sans-serif">New 
          Password</font></div></td>
      <td>&nbsp;</td>
      <td><input name="npassword" type="password" id="npassword"></td>
    </tr>
    <tr> 
      <td><div align="right"><font color="#0000FF" size="2" face="Verdana, Arial, Helvetica, sans-serif">Confirm 
          Password</font></div></td>
      <td>&nbsp;</td>
      <td><input name="cpassword" type="password" id="cpassword"></td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
      <td><div align="right"></div></td>
      <td><div align="right"> 
          <input class="commonButton" type="submit" name="Submit" value="Change">
          <input class="commonButton" type="button" name="cancel" value="Cancel" onClick="goback()">
        </div></td>
    </tr>
    <tr> 
      <td colspan="3"><div align="center"><font color="#006666"><img src="/skins/<?=$_SESSION["skin"]?>/elements/line.gif" width=560 height=1 border=0></font></div></td>
    </tr>
  </table>
</form>
<?}
else
{
?>
<script>
 window.history.go(-1);
</script>
<?}?>
</body>
</html>

