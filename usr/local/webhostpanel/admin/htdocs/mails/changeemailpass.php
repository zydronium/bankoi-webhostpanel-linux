<? $ACCESS_LEVEL=3 ?>
<? include "../inc/connection.php"; ?>
<? include "../inc/params.php"; ?>
<? include "../inc/functions.php"; ?>
<? include "../inc/security.php"; ?>

<html>
<head>
<script language="JavaScript">
function chk_frm()
	{

			if(document.form1.oldpass.value=="")
				{
					alert("Old password can not be empty");
					document.form1.oldpass.focus();
					return false;
				}
		
			if(document.form1.newpass.value=="")
				{
					alert("New password can not be blank");
					document.form1.newpass.focus();
					return false;
				}
			
			if(document.form1.newpass.value!=document.form1.newpassconfirm.value)
				{
					alert("Confirm password does not match");
					document.form1.newpass.value="";
					document.form1.newpassconfirm.value="";
					document.form1.newpass.focus();
					return false;
				}

			return true;
	}


</script>
<title>Change Mail Password</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head><link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/general.css">
<link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/custom.css">
<link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/layout.css">
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=ISO-8859-1">
<META HTTP-EQUIV="EXPIRES" CONTENT="0">
</head>
<body leftmargin=0 topmargin=0>
<? include "../inc/mainheader.php"; ?>

<?
	if(strtoupper($_SESSION["type"])!="D")
		include "../clients/clientheader.php";	
	include "../domains/domainheader.php";

	$domainid=$_SESSION["domainid"];
	$domainname=$_SESSION["domainname"];
	$mailadd=$_SESSION["mailnm"];

	$query="select * from mail_mailbox where domain='$domainname' and username='$mailadd'";
	$arrmail=mysql_query($query) or die(errorCatch(mysql_error()));
	if(mysql_num_rows($arrmail) <= 0)
		{
?>
<script>
	alert("Sorry the mail address was not found!It may have been deleted.");
	window.location="../mails/newmail.php";
</script>
<?			die();	
		}
?>

<form name="form1" method="post" action="changemailpass1.php" onSubmit="return chk_frm()">
  
<table width="47%" border="0" align="center" cellspacing="0" cellpadding="0">
  <?
	if(strtoupper($_SESSION["type"])=="A")
		{
?>
  <tr> 
    <td colspan="3" align="left" class="navigation">Administrator &gt; 
      <?=$_SESSION["clientname"]?>
      &gt; 
      <?=$domainname?>
      &gt; Change Mail Pass</td>
  </tr>
  <?
		}
	elseif(strtoupper($_SESSION["type"])=="C")
		{
?>
  <tr> 
    <td colspan="3" align="left" class="navigation"> 
      <?=$_SESSION["clientname"]?>
      &gt; 
      <?=$domainname?>
      &gt;Change Mail Pass</td>
  </tr>
  <?
		}
	elseif(strtoupper($_SESSION["type"])=="D")
		{
?>
  <tr> 
    <td colspan="3" align="left" class="navigation"> 
      <?=$domainname?>
      &gt; Change Mail Pass</td>
  </tr>
  <?
		}
?>
  <tr> 
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr> 
    <th height="21" colspan="3"><div align="center" class="clientheading">Change Mail Password</div></tr>
  <tr> 
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr> 
    <td width="48%"><div align="right" class="headings"> Old Password</div></td>
    <td width="4%"><font color="#FF0000">*</font></td>
    <td width="48%"><input name="oldpass" value="" type="password"></td>
  </tr>
  <tr> 
    <td><div align="right" class="headings">New Password</div></td>
    <td><font color="#FF0000">*</font></td>
    <td><input name="newpass" value="" type="password"></td>
  </tr>
  <tr> 
    <td><div align="right" class="headings">Conform New Password</div></td>
    <td><font color="#FF0000">*</font></td>
    <td><input name="newpassconfirm" value="" type="password"></td>
  </tr>
  <tr> 
    <td height="22" colspan="3"><div align="center"><img src="/skins/default/elements/line.gif" width=500 height=1 border=0></div></td>
  </tr>
  <tr> 
    <td colspan="3"> <div align="center"> 
        <input name="Submit" type="submit" class="commonButton"  value="Change Pass">
        <input name="button" type="button" class="commonButton" onClick="window.location='/mails/newmail.php'" value="Cancel">
      </div></td>
  </tr>
</table>
<input type="hidden" name="mailnm" value="<?=$mailadd?>">
</form>
</body>
</html>
<br>
<?include "../inc/footer.php"?>
