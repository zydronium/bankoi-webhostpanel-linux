<?$ACCESS_LEVEL=3;?>
<?include "../inc/security.php"?>
<html>
<head>
<title>Change Domain Password</title>
<link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/general.css">
<link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/custom.css">
<link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/layout.css">
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=ISO-8859-1">
<META HTTP-EQUIV="EXPIRES" CONTENT="0">

<script language="JavaScript"> 
function validate()
{
regExp = /\w{1,}/;
 if (!regExp.test(document.form1.opassword.value)){ 
   alert("Old Password Cann't Be Empty ");
   document.form1.opassword.focus();
   return false;  
 }
else if (!regExp.test(document.form1.npassword.value)){ 
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

<body leftmargin="0" topmargin="0">
<? 

include "../inc/mainheader.php"; 

if(strtoupper($_SESSION["type"])=="A" || strtoupper($_SESSION["type"])=="C")
{
include "../clients/clientheader.php";
}
include "domainheader.php";
?>
<form name="form1" method="post" action="changepasswordproceed.php">
  <!--<table width="58%" border="0" align="center" cellspacing="0" cellpadding="0">
    <?
	if(strtoupper($_SESSION["type"])=="A")
		{
?>
    <tr> 
      <td align="left" class="navigation">Administrator &gt; 
        <?=$_SESSION["clientname"]?>
        &gt; 
        <?=$_SESSION["domainname"]?>
        &gt; Change Password</td>
    </tr>
    <?
		}
	elseif(strtoupper($_SESSION["type"])=="C")
		{
?>
    <tr> 
      <td align="left" class="navigation"> 
        <?=$_SESSION["clientname"]?>
        &gt; 
        <?=$_SESSION["domainname"]?>
        &gt; Change Password</td>
    </tr>
    <?
		}
	elseif(strtoupper($_SESSION["type"])=="D")
		{
?>
    <tr> 
      <td align="left" class="navigation"> 
        <?=$_SESSION["domainname"]?>
        &gt; Change Password</td>
    </tr>
    <?
		}
?>
    <tr> 
      <td>&nbsp;</td>
    </tr>
  </table>-->
  <table width="34%" border="0" align="center" cellspacing="2">
    <tr> 
      <td height="14" colspan="3"><div align="center" class="headings"></font></div></td>
    </tr>
    <tr> 
      <th colspan="3"><div align="center"><strong><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Change 
          Passoword</font></strong></div></td>
    </tr>
    <tr> 
      <td width="35%">&nbsp;</td>
      <td width="7%">&nbsp;</td>
      <td width="58%">&nbsp;</td>
    </tr>
    <tr> 
      <td><div align="right" class="headings">Old Password</div></td>
      <td>&nbsp;</td>
      <td><input name="opassword" type="password" id="opassword" class="textboxclass"></td>
    </tr>
    <tr> 
      <td><div align="right" class="headings">New Password</font></div></td>
      <td>&nbsp;</td>
      <td><input name="npassword" type="password" id="npassword" class="textboxclass"></td>
    </tr>
    <tr> 
      <td><div align="right" class="headings">Confirm Password</font></div></td>
      <td>&nbsp;</td>
      <td><input name="cpassword" type="password" id="cpassword" class="textboxclass"></td>
    </tr>
    <tr> 
      <td height="11" colspan="3"><div align="center"><font color="#006666"><img src="/skins/<?=$_SESSION["skin"]?>/elements/line.gif" width=500 height=1 border=0></font></div></td>
    </tr>
    <tr> 
      <td colspan="3"><div align="center"> 
          <input class="commonButton" type="submit" name="Submit" value="Change" onClick="return validate();">
          <input class="commonButton" type="button" name="cancle" value="Cancel" onClick="goback()">
        </div></td>
    </tr>
  </table>
</form>
<?include "../inc/footer.php"?>
</body>
</html>