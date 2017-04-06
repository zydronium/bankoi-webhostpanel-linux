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

function chk_name(usr)
{
	re = /^[a-zA-Z0-9]{1}[A-Za-z0-9_.-]{0,19}$/;
	return usr.search(re) != -1;
}

function chk_form_data(f)
{
    
	if (f.email.value=="") {
		alert('Email is blank!');
		f.email.focus();
		return false;
	}

	if(f.country.value=="Select Country")
          {
				alert("Select Country");
				f.country.focus();
				return false;
		  }

	f.submit();
	return true;

}
//-->
</script>

<?
	   $query="select * from tbladmincontact where adminid='0'";
	   //myLog($query);
	   $rs=mysql_query($query) or die(errorCatch(mysql_error()));;
	   $res=mysql_fetch_array($rs);
?>

<link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/general.css">
<link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/custom.css">
<link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/layout.css">
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=ISO-8859-1">
<META HTTP-EQUIV="EXPIRES" CONTENT="0">
</head>
<body leftmargin=0 topmargin=0>
<?include "../inc/mainheader.php"?>
<form action='editadmincontact.php' method='post' name="mainform">
  <!--<table width="80%" border="0" align="center" cellspacing="0" cellpadding="0">
    <?
	if(strtoupper($_SESSION["type"])=="A")
		{
?>
    <tr> 
      <td align="left" class="navigation">Administrator &gt; Contact Information</td>
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

  <table border="0" cellpadding=0 cellspacing=0 width="564" align="center">
    <tr> 
      <td colspan="1"><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="3" height="1" border="0"></td>
      <td colspan="1"><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="436" height="1" border="0"></td>
      <td colspan="1"><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="7" height="1" border="0"></td>
      <td colspan="1"><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="115" height="1" border="0"></td>
      <td colspan="1"><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="3" height="1" border="0"></td>
    </tr>
    <tr> 
      <td colspan=1><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="1" height="7" border="0"></td>
    </tr>
    <tr> 
      <td rowspan="2"></td>
      <td colspan="3"><div align="center"><font color="#006666"><img src="/skins/<?=$_SESSION["skin"]?>/elements/line.gif" width=560 height=1 border=0></font></div></td>
    </tr>
    <tr> 
      <td><font color="#FF0000">Update Admin Contact</font></td>
      <td></td>
      <td class="verttop"><input name="button" type="button" class="commonbutton" id="bid-up-level" title="Up Level"  onClick="window.location='server.php';" value="Up Level"></td>
    </tr>
    <tr> 
      <td colspan=1><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="1" height="15" border="0"></td>
    </tr>
    <tr> 
      <td></td>

      <td colspan=3>
	  <table border="0" cellpadding=0 cellspacing=0 width="558" align="left">
          <tr> 
            <td width="141" colspan="1"><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="140" height="1" border="0"></td>
            <td width="18" colspan="1"><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="17" height="1" border="0"></td>
            <td width="401" colspan="1"><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="401" height="1" border="0"></td>
          </tr>
          <tr> 
            <td align='right'>Company name:</td>
            <td align='center'></td>
            <td><input name='companyname' type='text' id="companyname" value="<?=$res["companyname"]?>" size=25 maxlength=255 class="textboxclass"></td>
          </tr>
          <tr> 
            <td colspan=1><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="1" height="8" border="0"></td>
          </tr>
          <tr> 
            <td align='right'>Contact name:</td>
            <td align='center'><font color="#FF0000"><span class="requiredfield">*</span></font></td>
            <td><input name='contactname' type='text' id="contactname" value="<?=$res["contactname"]?>" size=25 maxlength=60 class="textboxclass"></td>
          </tr>
          <tr> 
            <td colspan=1><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="1" height="8" border="0"></td>
          </tr>
           
          <tr> 
            <td align='right'>Phone:</td>
            <td align='center'></td>
            <td><input type='text' name='phone' size=25 maxlength=30 value="<?=$res["phone"]?>" class="textboxclass"></td>
          </tr>
          <tr> 
            <td colspan=1><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="1" height="8" border="0"></td>
          </tr>
          <tr> 
            <td align='right'>Fax:</td>
            <td align='center'></td>
            <td><input type='text' name='fax' size=25 maxlength=30 value="<?=$res["fax"]?>" class="textboxclass"></td>
          </tr>
          <tr> 
            <td colspan=1><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="1" height="8" border="0"></td>
          </tr>
          <tr> 
            <td align='right'>E-mail:</td>
            <td align='center'><font color="#FF0000">*</font></td>
            <td><input type='text' name='email' size=25 maxlength=255 value="<?=$res["email"]?>" class="textboxclass"></td>
          </tr>
          <tr> 
            <td colspan=1><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="1" height="8" border="0"></td>
          </tr>
          <tr> 
            <td align='right'>Address:</td>
            <td align='center'></td>
            <td><input type='text' name='address' size=25 maxlength=255 value="<?=$res["address"]?>" class="textboxclass"></td>
          </tr>
          <tr> 
            <td colspan=1><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="1" height="8" border="0"></td>
          </tr>
          <tr> 
            <td align='right'>City:</td>
            <td align='center'></td>
            <td><input type='text' name='city' size=25 maxlength=50 value="<?=$res["city"]?>" class="textboxclass"></td>
          </tr>
          <tr> 
            <td colspan=1><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="1" height="8" border="0"></td>
          </tr>
          <tr> 
            <td align='right'>State/Province:</td>
            <td align='center'></td>
            <td><input type='text' name='state' size=25 maxlength=255 value="<?=$res["state"]?>" class="textboxclass"></td>
          </tr>
          <tr> 
            <td colspan=1><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="1" height="8" border="0"></td>
          </tr>
          <tr> 
            <td align='right'>Postal/ZIP code:</td>
            <td align='center'></td>
            <td><input type='text' name='pcode' size=25 maxlength=10 value="<?=$res["pcode"]?>" class="textboxclass"></td>
          </tr>
          <tr> 
            <td colspan=1><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="1" height="8" border="0"></td>
          </tr>
          <tr> 
            <td align='right'>Country:</td>
            <td></td>
            <?
//--------------------------------------------------------------------------------------------------
	//Here we are getting the name of the countries with there codes
    
	$query = "select * from tblcountry";
	//myLog($query);
	$array=Mysql_query($query) or die(errorCatch(mysql_error()));
?>
            <td><select name="country" style="color: #000080; font-family: Verdana" >
                <option value="Select Country">Select Country</Option>
                <? 
					while($country=mysql_fetch_array($array, MYSQL_ASSOC))
					{
				?>
                <?if($country["code"]==$res["country"]){?>
				<option value="<?=$country["code"]?>" selected> 
                <?=$country["countryname"]?>
				<?}else{?>
				<option value="<?=$country["code"]?>" > 
                <?=$country["countryname"]?>
				<?}?>				
                </option>
                <?}?>
              </select> </td>
          </tr>
          <tr> 
            <td colspan=1><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="1" height="8" border="0"></td>
          </tr>
          <tr> 
            <td align='right'>Interface language:</td>
            <td></td>
            <td><select name="language" id="language" >
                <option value="en" SELECTED>English 
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
      <td colspan=2 align="right"> <input type="button" class="commonButton" id="bid-update" value="Update" title="Update"  onClick="return chk_form_data(document.mainform);" > 
      </td>
    </tr>
    <tr> 
      <td colspan=1><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="1" height="8" border="0"></td>
    </tr>
  </table>
  <input type=hidden name=cmd value="update">
</form>
<br>
<br>
<? include "../inc/footer.php" ?>
</body>
</html>
