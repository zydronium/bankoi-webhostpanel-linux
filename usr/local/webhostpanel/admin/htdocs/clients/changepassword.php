<?$ACCESS_LEVEL=2;?>
<?include "../inc/security.php"?>

<html>
<head>
<title>Change Client Password</title>
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

<body leftmargin=0 topmargin=0>
<?include "../inc/mainheader.php"?>
<?include "clientheader.php"?>
<form name="form1" method="post" action="changepasswordproceed.php">
  <!--<table width="69%" border="0" align="center" cellspacing="0" cellpadding="0">
    <?
	if(strtoupper($_SESSION["type"])=="A")
		{
?>
    <tr> 
      <td align="left" class="navigation">Administrator 
        &gt; 
        <?=$_SESSION["clientname"]?>
        &gt; 
        <?=$domainname?>
         &gt; Change Password </td>
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
        Change Password </td>
    </tr>
    <?
		}
	elseif(strtoupper($_SESSION["type"])=="D")
		{
?>
    <tr> 
      <td align="left" class="navigation">
        <?=$domainname?>
       &gt; Change Password </td>
    </tr>
    <?
		}
?>
    <tr> 
      <td>&nbsp;</td>
    </tr>
  </table>-->
  <table width="59%" border="0" align="center" cellspacing="2">
    <tr>
	<td colspan="3"><div align="center"  class="headings"><img src="/skins/<?=$_SESSION["skin"]?>/elements/line.gif" width=560 height=1 border=0></font></div></td></tr>
	<tr> 
      <td colspan="3" class="headings">Change 
        Passoword  </td>
    </tr>
    <tr> 
      <td width="35%" class="headings">&nbsp;</td>
      <td width="7%" class="headings">&nbsp;</td>
      <td width="58%" class="headings">&nbsp;</td>
    </tr>
    <tr> 
      <td><div align="right" class="headings">Old 
          Password </div></td>
      <td class="headings">&nbsp;</td>
      <td><input name="opassword" type="password" id="opassword"></td>
    </tr>
    <tr> 
      <td><div align="right" class="headings">New 
          Password </div></td>
      <td class="headings">&nbsp;</td>
      <td><input name="npassword" type="password" id="npassword"></td>
    </tr>
    <tr> 
      <td><div align="right" class="headings">Confirm 
          Password </div></td>
      <td class="headings">&nbsp;</td>
      <td><input name="cpassword" type="password" id="cpassword"></td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
      <td><div align="right"></div></td>
      <td><div align="right"> 
          <input class="commonButton" type="submit" name="Submit" value="Change" onClick="return validate(document.form1);">
          <input class="commonButton" type="button" name="cancle" value="Cancel" onClick="goback()">
        </div></td>
    </tr>
	<tr>
	<td colspan="3"><div align="center"><font color="#006666"><img src="/skins/<?=$_SESSION["skin"]?>/elements/line.gif" width=560 height=1 border=0></font></div></td></tr>
  </table>
</form>
</body>
</html>
<br>
<?include "../inc/footer.php"?>
