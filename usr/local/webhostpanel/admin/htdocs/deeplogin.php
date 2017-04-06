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
<title><?=$PAGE_TITLE?></title>

<script language="JavaScript">
		<!--
	function validate()
	{
		regExp = /\w{1,}/;
		 if (!regExp.test(document.form1.login_name.value))
		 { 
		   alert("Login Name Cann't Be Empty ");
		   document.form1.login_name.focus();
		   return false;  
		 }
		 if (!regExp.test(document.form1.password.value))
		 { 
		   alert("Password Cann't Be Empty ");
		   document.form1.password.focus();
		   return false;  
		 }
		 return true;
	 }// end validate()
  </script>
<link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/general.css">
<link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/custom.css">
<link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/layout.css">
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=ISO-8859-1">
<META HTTP-EQUIV="EXPIRES" CONTENT="0">
</head>
<body>

<table border="0" cellpadding=0 cellspacing=0 width="564" align="center">
  <tr> 
    <td><div align="center"><img src='/skins/<?=$_SESSION["skin"]?>/images/def_logo.gif' name='logo'  border=0></div></td>
  </tr>
  <tr> 
    <td><div align="center"></div></td>
  </tr>
  <tr> 
    <td><div align="center"></div></td>
  </tr>
  <tr> 
    <td><div align="center"> 
        <form name="form1" method="post" action="/validateuser.php" onSubmit="return login_oC()">
          <table width="80%" border="0" cellspacing="2">
            <tr> 
              <td width="48%"><div align="right">Login</div></td>
              <td width="52%"><input type='text' name='login_name' value='' size=25 maxlength=255></td>
            </tr>
            <br>
            <br>
            <tr> 
              <td><div align="right">Password</div></td>
              <td><input type='password' name='passwd' size=25 ></td>
            </tr>
            <tr> 
              <td colspan="2"><div align="center"> 
                  <input type="submit" name="Submit" value="Login">
                </div></td>
            </tr>
          </table>
        </form>
      </div></td>
  </tr>
  <tr> 
    <td><div align="center"></div></td>
  </tr>
  <tr> 
    <td><div align="left"><b>Forgot your password?</b><br>
        If you forgot you password we will try to help you by sending it out to 
        your email.</div></td>
  </tr>
  <tr> 
    <td><div align="center"> 
        <form name="form2" method="post" action="/get_password.php">
          <input type="submit" name="Submit2" value="Get Password">
        </form>
      </div></td>
  </tr>
  <tr> 
    <td><div align="center"></div></td>
  </tr>
</table>
<? include "inc/footer.php" ?>
</body>
</html>
