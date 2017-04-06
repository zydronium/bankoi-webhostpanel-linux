<?$ACCESS_LEVEL=1;?>
<?
include "../inc/connection.php";
?>
<?include "../inc/security.php"?>
<html>
<head>

<title>New Client</title>
<script>
<!--
function err_pass(key)
{
	var login	= "Use only alphanumeric, dash, dot and underscore symbols in the login.";
	var passwd	= "Do not use quotes, space and national alphabet characters in a password.\nThe password should be between 5 and 14 characters and should not be the same as login name.";
	switch (key) {
		case "login":
			alert("Enter login name.\n" + login);
			break;
		case "passwd":
			alert("Enter password.\n" + passwd);
			break;
		default:
			alert("Enter login name and password.\n" + login + "\n" + passwd);
			break;
	}
}

function chk_name(usr)
{
	re = /^[a-zA-Z0-9]{1}[A-Za-z0-9_.-]{0,19}$/;
	return usr.search(re) != -1;
}

function chk_sys_passwd(username, passwd)
{
	if ((passwd.length < 5) || (passwd.length > 16))
		return false;

	if (passwd.length >= username.length) {
		if (passwd.indexOf(username, 0) != -1)
			return false;
	}

	if ((passwd.indexOf('\'') != -1) || (passwd.indexOf(' ') != -1))
		return false;	
	for (i = passwd.length; i-- > 0;) {
		if (passwd.charCodeAt(i) > 127)
	 		return false;
	}	
	return true;
}

function chk_form_data(f)
{
    
	if (f.passwd0.value && (f.passwd0.value != f.passwd1.value)) {
		alert('Passwords do not match!');
		f.passwd0.focus();
		f.passwd0.select();
		return false;
	}

	if (f.email.value=="") {
		alert('Email is blank!');
		f.email.focus();
		return false;
	}

    
	if (!chk_sys_passwd(f.login.value, f.passwd0.value)) {
		f.passwd0.focus();
		f.passwd0.select();
		err_pass();
		return false;
	}

	if(!chk_name(f.login.value))
		{
			alert("Login Name is not proper");
			return false;
		}
	if(f.country.value=="Select Country")
          {
				alert("Select Country");
				f.country.focus();
				return false;
		  }

	f.submit();
	return false;
}
//-->
</script>
<link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/general.css">
<link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/custom.css">
<link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/layout.css">
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=ISO-8859-1">
<META HTTP-EQUIV="EXPIRES" CONTENT="0">
</head>
<body leftmargin=0 topmargin=0>
<?include "../inc/mainheader.php"?>
<form action='addclient.php' method='post' name="mainform">
 <!-- <table width="80%" border="0" align="center" cellspacing="0" cellpadding="0">
    <?
	if(strtoupper($_SESSION["type"])=="A")
		{
?>
    <tr> 
      <td align="left" class="navigation">Administrator 
        &gt; Add New Client</td>
    </tr>
    <?
		}
	elseif(strtoupper($_SESSION["type"])=="C")
		{
?>
    <tr> 
      <td align="left" class="headings"></td>
    </tr>
    <?
		}
	elseif(strtoupper($_SESSION["type"])=="D")
		{
?>
    <tr> 
      <td align="left" class="headings"></td>
    </tr>
    <?
		}
?>
    <tr> 
      <td height="19">&nbsp;</td>
    </tr>
  </table>-->

  <table border="0" cellpadding=0 cellspacing=0 width="564" align="center">
    <tr> 
      <td colspan="1"><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="3" height="1" border="0"></td>
      <td colspan="1"><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="436" height="1" border="0"></td>
      <td colspan="1"><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="7" height="1" border="0"></td>
      <td colspan="1"><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="115" height="1" border="0"></td>
      <td colspan="1"><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="3" height="1" border="0"></td>
    </tr>
    <tr> 
      <td rowspan="2"></td>
      <td colspan="3"><div align="center"> <img src="/skins/<?=$_SESSION["skin"]?>/elements/line.gif" width=564 height=1 border=0>	
        </div></td>
    </tr>
    <tr> 
      <td class="mainheading"><font color="#FF0000">Enter new client data:</font></td>
      <td></td>
      <td class="verttop"><input name="button" type="button" class="commonButton" id="bid-up-level" title="Up Level"  onClick="window.history.go(-1);" value="Up Level"  ></td>
    </tr>
    <tr> 
      <td colspan=4><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="1" height="15" border="0"> 
        <img src="/skins/<?=$_SESSION["skin"]?>/elements/line.gif" width=564 height=1 border=0>	
      </td>
    </tr>
    <tr> 
      <td></td>
      <td colspan=3> <table border="0" cellpadding=0 cellspacing=0 width="558" align="left">
          <tr> 
            <td width="141" colspan="1"><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="140" height="1" border="0"></td>
            <td width="18" colspan="1"><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="17" height="1" border="0"></td>
            <td width="401" colspan="1"><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="401" height="1" border="0"></td>
          </tr>
          <tr> 
            <td align='right' class="headings"><strong>Company name:</strong></td>
            <td align='center' class="headings"></td>
            <td><input type='text' name='cname' size=25 maxlength=255 value="" class="textboxclass"></td>
          </tr>
          <tr> 
            <td colspan=3 class="headings"><strong><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="1" height="8" border="0"></strong></td>
          </tr>
          <tr> 
            <td align='right' class="headings"><strong>Contact name:</strong></td>
            <td align='center'><font color="#FF0000"><span class="requiredfield">*</span></font></td>
            <td><input type='text' name='pname' size=25 maxlength=60 value="" class="textboxclass"></td>
          </tr>
          <tr> 
            <td colspan=3><strong><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="1" height="8" border="0"></strong></td>
          </tr>
          <tr> 
            <td align='right' class="headings"><strong>Control Panel login name:</strong></td>
            <td align='center'><font color="#FF0000"><span class="requiredfield">*</span></font></td>
            <td><input type='text' name='login' size=25 maxlength=20 value="" class="textboxclass"></td>
          </tr>
          <tr> 
            <td colspan=3><strong><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="1" height="8" border="0"></strong></td>
          </tr>
          <tr> 
            <td align='right' class="headings"><strong>Control Panel Password:</strong></td>
            <td align='center'><font color="#FF0000"><span class="requiredfield">*</span></font></td>
            <td><input type='password' name='passwd0' size=25 maxlength=14 value="" class="textboxclass"></td>
          </tr>
          <tr> 
            <td colspan=3><strong><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="1" height="8" border="0"></strong></td>
          </tr>
          <tr> 
            <td align='right' class="headings"><strong>Confirm Password:</strong></td>
            <td align='center'><span class="requiredfield"><font color="#FF0000">*</font></span></td>
            <td><input type='password' name='passwd1' size=25 maxlength=14 value="" class="textboxclass"></td>
          </tr>
          <tr> 
            <td colspan=3><strong><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="1" height="8" border="0"></strong></td>
          </tr>
          <tr> 
            <td align='right' class="headings"><strong>Phone:</strong></td>
            <td align='center'></td>
            <td><input type='text' name='phone' size=25 maxlength=30 value="" class="textboxclass"></td>
          </tr>
          <tr> 
            <td colspan=3><strong><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="1" height="8" border="0"></strong></td>
          </tr>
          <tr> 
            <td align='right' class="headings"><strong>Fax:</strong></td>
            <td align='center'></td>
            <td><input type='text' name='fax' size=25 maxlength=30 value="" class="textboxclass"></td>
          </tr>
          <tr> 
            <td colspan=3><strong><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="1" height="8" border="0"></strong></td>
          </tr>
          <tr> 
            <td align='right' class="headings"><strong>E-mail:</strong></td>
            <td align='center'><font color="#FF0000">*</font></td>
            <td><input type='text' name='email' size=25 maxlength=255 value="" class="textboxclass"></td>
          </tr>
          <tr> 
            <td colspan=3><strong><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="1" height="8" border="0"></strong></td>
          </tr>
          <tr> 
            <td align='right' class="headings"><strong>Address:</strong></td>
            <td align='center'></td>
            <td><input type='text' name='address' size=25 maxlength=255 value="" class="textboxclass"></td>
          </tr>
          <tr> 
            <td colspan=3><strong><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="1" height="8" border="0"></strong></td>
          </tr>
          <tr> 
            <td align='right' class="headings"><strong>City:</strong></td>
            <td align='center'></td>
            <td><input type='text' name='city' size=25 maxlength=50 value="" class="textboxclass"></td>
          </tr>
          <tr> 
            <td colspan=3><strong><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="1" height="8" border="0"></strong></td>
          </tr>
          <tr> 
            <td align='right' class="headings"><strong>State/Province:</strong></td>
            <td align='center'></td>
            <td><input type='text' name='state' size=25 maxlength=255 value="" class="textboxclass"></td>
          </tr>
          <tr> 
            <td colspan=3><strong><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="1" height="8" border="0"></strong></td>
          </tr>
          <tr> 
            <td align='right' class="headings"><strong>Postal/ZIP code:</strong></td>
            <td align='center'></td>
            <td><input type='text' name='pcode' size=25 maxlength=10 value="" class="textboxclass"></td>
          </tr>
          <tr> 
            <td colspan=3><strong><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="1" height="8" border="0"></strong></td>
          </tr>
          <tr> 
            <td align='right' class="headings"><strong>Country:</strong></td>
            <td><div align="center"><font color="#FF0000">*</font></div></td>
            <?
//--------------------------------------------------------------------------------------------------
	//Here we are getting the name of the countries with there codes
    
	$query = "select * from tblcountry";
	//myLog($query);
	$array=Mysql_query($query) or die(errorCatch(mysql_error()));
?>
            <td><select name="country"  class="dropdown">
                <option value="Select Country">Select Country</option>
                <? 
					while($country=mysql_fetch_array($array, MYSQL_ASSOC))
					{
				?>
                <option value="<?=$country["code"]?>"> 
                <?=$country["countryname"]?>
                </option>
                <?}?>
              </select> </td>
          </tr>
          <tr> 
            <td colspan=3><strong><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="1" height="8" border="0"></strong></td>
          </tr>
          <tr> 
            <td align='right' class="headings"><strong>Interface language:</strong></td>
            <td></td>
            <td><select name="locale_var" class="dropdown">
                <option value="en" selected>English 
                <option value="es">Spanish </select> </td>
          </tr>
          <tr> 
            <td colspan="3" align='right'><div align="center"><font color="#006666"><img src="/skins/<?=$_SESSION["skin"]?>/elements/line.gif" width=560 height=1 border=0></font></div></td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td colspan=1> <img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="1" height="16" border="0"></td>
    </tr>
    <tr> 
      <td></td>
      <td><span class="requiredfield">*</span>&nbsp;Required fields.</td>
      <td colspan=3 align="right"> <input name="button" type="button" class="commonButton" id="bid-update" title="Update"  onClick="return chk_form_data(document.mainform);" value="Create" > 
      </td>
    </tr>
    <tr> 
      <td colspan=3><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="1" height="8" border="0"></td>
    </tr>
  </table>
  <input type=hidden name=cmd value="update">
</form>
<br>
<br>
<? include "../inc/footer.php" ?>
</body>
</html>
