<?php
include "inc/MyLogger.php";
include "inc/constants.php";

$message="";
if( isset($_GET['mode']) )
{
	if($_GET['mode']==$SESSION_EXPIRE)
		$message=$MESG_SESSION_EXPIRE;
	else if($_GET['mode']==$ACCESS_DENIED)
		$message=$MESG_INVALID_USERNAME;
	else if($_GET['mode']==$USERNAME_NOT_EXIST)
		$message=$MESG_USERNAME_NOT_EXIST;
	else if($_GET['mode']==$MAIL_TRANS_SUCCESS)
		$message=$MESG_MAIL_TRANS_SUCCESS;
	else if($_GET['mode']==$MAIL_TRANS_FAILURE)
		$message=$MESG_MAIL_TRANS_FAILURE;
	else if($_GET['mode']==$PASSWORD_SENT)
		$message=$MESG_PASSWORD_SENT;
	else
		$message="Failure due to Invalid Data";
}
?>
<html>		
<head>
<title>TEK NETWORKS EASY HOST MANAGER</title>		
<script>
		<!--
		function login_oC(f1,f2)
		{
			if ((f1.login_name.value == "") || (f2.passwd.value == "")) {
				alert("Enter Login name and password to enter.");
				f1.login_name.focus();
				f1.login_name.select();
				return false;
			}
			f2.login_name.value=f1.login_name.value;
			f2.submit();
			return false;
		}
		function setFocus()
		{
			if (document.forms[0].login_name) {
				document.forms[0].login_name.focus();
				document.forms[0].login_name.select();
			}
		}
		function get_password_oC(f1, f2)
		{
			f1.login_name.value = f2.login_name.value;
			f1.submit();
		}
		//-->
		</script>
<link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/general.css">
<link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/custom.css">
<link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/layout.css">
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=ISO-8859-1">
<META HTTP-EQUIV="EXPIRES" CONTENT="0">
</head>
<body leftmargin=0 topmargin=0 >
<table border="0" cellpadding=0 cellspacing=0 width="564" align="center">
  <tr>
    <td colspan="1"><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="3" height="1" border="0"></td>
	<td colspan="1"><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="247" height="1" border="0"></td>
	<td colspan="1"><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="7" height="1" border="0"></td>
	<td colspan="1"><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="304" height="1" border="0"></td>
	<td colspan="1"><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="3" height="1" border="0"></td>
  </tr>
  <tr>
	<td colspan=1><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="1" height="6" border="0"></td>
  </tr>
  <tr>
    <td></td>
	<td colspan=3><div align="center"><img src="skins/default/images/def_logo.gif" width="100" height="100"></div></td>
  </tr>
  <tr>
	<td colspan=5><img src="/skins/<?=$_SESSION["skin"]?>/elements/line.gif" width=564 height=1 border=0></td>
  </tr>
  <tr>
	<td colspan=1><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="1" height="32" border="0"></td>
  </tr>
  <form name='form1' onSubmit='if ((document.forms[1]) && (!document.forms[1].passwd.value)) document.forms[1].passwd.focus(); return false;'>
 
<tr>
	  <td colspan=4 align="center" valign="middle" height="35"><?=$message?></td>	
	</tr>

	<tr>
	  <td></td>
	  <td align=right> Login:</td>
	  <td></td>
	  <td><input type='text' name='login_name' value='' size=25 maxlength=255></td>
	</tr>
  </form>
  <tr>
	<td colspan=1><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="1" height="8" border="0"></td>
  </tr>
  <form name='form2' action='/validateuser.php' method='post' onSubmit='return login_oC(document.forms[0], document.forms[1])'>
    <tr>
	  <td></td>
	  <td align=right> Password:</td>
	  <td></td>
	  <td><input type='password' name='passwd' size=25 ></td>
	</tr>
    <tr>
	  <td colspan=1><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="1" height="16" border="0"></td>
	</tr>
    <tr>
	  <td colspan="3"><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="2" height="1" border="0"></td>
	  <td><input type="button" class="commonButton" id="bid-login" value="Login" title="Login" onClick="return login_oC(document.forms[0], document.forms[1]);"  ></td>
	</tr>
	<input type="hidden" name="login_name" value=>
  </form>
  <tr>
	<td colspan=1><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="1" height="16" border="0"></td>
  </tr>
  <tr>
	<td colspan=5><img src="/skins/<?=$_SESSION["skin"]?>/elements/line.gif" width=564 height=1 border=0></td>
  </tr>
  <tr>
	<td colspan=1><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="1" height="16" border="0"></td>
  </tr>
  <form name='form2' action='/get_password.php' method='post'>
	<tr>
	  <td colspan="5"><b>Forgot your password?</b><br>
		If you forgot you password we will try to help you by sending it out to your email.</td>
	</tr>
	<tr>
	  <td colspan=1><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="1" height="16" border="0"></td>
	</tr>
    <tr>
	  <td colspan="3"><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="2" height="1" border="0"></td>
	  <td><input type="button" class="commonButton" id="bid-get-password" value="Get Password" title="Get Password" onClick="return get_password_oC(document.forms[2], document.forms[0]);"></td>
	</tr>
	<input type="hidden" name="login_name" value=>
  </form>
  <tr>
	<td colspan=1><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="1" height="8" border="0"></td>
  </tr>
</table>
</body>
		
</html>
<br>
<br>
<? include "inc/footer.php" ?>
