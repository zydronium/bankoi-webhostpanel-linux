<?$ACCESS_LEVEL=2;?>
<?
include "../inc/connection.php";
?>
<?include "../inc/security.php"?>
<html>
<head>
<title>Update Client</title>

<?		$resellername=$_SESSION["clientname"];
		$resellerid=$_SESSION["clientid"];
	   $query="select * from tblclientcontact where resellerid=$resellerid";
	   $array=mysql_query($query)or die(errorCatch(mysql_error()));
		$clientinfo=@mysql_fetch_object($array);
?>

<script>


function chk_form_data(f)
{
 emailExp= /^\w+(\-\w+)*(\.\w+(\-\w+)*)*@\w+(\-\w+)*(\.\w+(\-\w+)*)+$/;
regExp = /\w{1,}/;

if (!regExp.test(f.contactname.value))
{ 
   alert("Contact Name Cann't Be Empty ");
   f.contactname.focus();
   return false;  
}

if (!(emailExp.test(f.email.value)))
{ 
   alert("Email Address is not proper");
   f.email.value="";
   f.email.focus();
   return false;  
}

if(f.country.value=="Select Country")
          {
				alert("Select Country");
				f.country.focus();
				return false;
		  }
	
	return true;

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
<?include "../clients/clientheader.php"?>
<form action='updateclientproceed.php' method='post' name="mainform" onSubmit="return chk_form_data(document.mainform)" >
  <!--<table width="58%" border="0" align="center" cellspacing="0" cellpadding="0">
    <?
	if(strtoupper($_SESSION["type"])=="A")
		{
?>
    <tr> 
      <td align="left" class="navigation">Administrator 
        &gt; 
        <?=$_SESSION["clientname"]?>
        &gt;  Update Contact 
        Information  </td>
    </tr>
    <?
		}
	elseif(strtoupper($_SESSION["type"])=="C")
		{
?>
    <tr> 
      <td align="left" class="headings">
        <?=$_SESSION["clientname"]?>
        &gt; Update Contact 
        Information </td>
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
  </table>-->

  <table width="61%" border="0" align="center">
    <tr> 
      <td width="40%"><div align="right">Information for client <strong><font color="#FF0000"> 
          <?=$resellername?>
          </font></strong></div></td>
      <td width="5%">&nbsp;</td>
      <td width="55%"><div align="right"> 
          <input name="button" type="button" class="commonbutton" id="bid-up-level" title="Up Level"  onClick="window.location='../clients/clientinfo.php';" value="Up Level"  >
        </div></td>
    </tr>
    <tr> 
      <td height="13" colspan="3"><div align="center"><img src="/skins/<?=$_SESSION["skin"]?>/elements/line.gif" width=600 height=1 border=0></div></td>
    </tr>
    <tr>
      <td><div align="right"><font color="#009900">Company Name:</font></div></td>
      <td>&nbsp;</td>
      <td><input name='companyname' type='text' id="contactname" value="<?=$clientinfo->companyname?>" size=25 maxlength=60 class="textboxclass"></td>
    </tr>
    <tr> 
      <td><div align="right"><font color="#009900">Contact Name:</font></div></td>
      <td><font color="#FF0000"><span class="requiredfield">*</span></font></td>
      <td><input name='contactname' type='text' id="contactname2" value="<?=$clientinfo->contactname?>" size=25 maxlength=60 class="textboxclass"></td>
    </tr>
    <tr> 
      <td><div align="right"><font color="#009900">Phone</font></div></td>
      <td>&nbsp;</td>
      <td><input type='text' name='phone' size=25 maxlength=30 value="<?=$clientinfo->phone?>" class="textboxclass"></td>
    </tr>
    <tr> 
      <td><div align="right"><font color="#009900">E-mail</font></div></td>
      <td><font color="#FF0000">*</font></td>
      <td><input type='text' name='email' size=25 maxlength=255 value="<?=$clientinfo->email?>" class="textboxclass"></td>
    </tr>
    <tr> 
      <td><div align="right"><font color="#009900">Address</font></div></td>
      <td>&nbsp;</td>
      <td><input type='text' name='address' size=25 maxlength=255 value="<?=$clientinfo->address?>" class="textboxclass"></td>
    </tr>
    <tr> 
      <td><div align="right"><font color="#009900">City</font></div></td>
      <td>&nbsp;</td>
      <td><input type='text' name='city' size=25 maxlength=50 value="<?=$clientinfo->city?>" class="textboxclass"></td>
    </tr>
    <tr> 
      <td><div align="right"><font color="#009900">State/Province</font></div></td>
      <td>&nbsp;</td>
      <td><input type='text' name='state' size=25 maxlength=255 value="<?=$clientinfo->state?>" class="textboxclass"></td>
    </tr>
    <tr> 
      <td><div align="right"><font color="#009900">Postal/ZIP code:</font></div></td>
      <td>&nbsp;</td>
      <td><input type='text' name='pcode' size=25 maxlength=10 value="<?=$clientinfo->zipcode?>" class="textboxclass"></td>
    </tr>
    <tr> 
      <td><div align="right"><font color="#009900">Country</font></div></td>
      <td>&nbsp;</td>
      <td colspan="2"> 
        <?
//--------------------------------------------------------------------------------------------------
	//Here we are getting the name of the countries with there codes
    
	$query = "select * from tblcountry";
	//myLog($query);
	$array=Mysql_query($query) or die(errorCatch(mysql_error()));
?>
        <select name="country" class="dropdown">
          <option value="Select Country">Select Country</option>
          <? 
					while($country=mysql_fetch_array($array, MYSQL_ASSOC))
					{
				?>
          <?			   if($clientinfo->country==$country["code"]) {?>
          <option value="<?=$country["code"]?>" selected> 
          <?=$country["countryname"]?>
          </option>
          <?}else{?>
          <option value="<?=$country["code"]?>"> 
          <?=$country["countryname"]?>
          </option>
          <?}?>
          <?}?>
        </select> </tr>
    <tr> 
      <td height="13" colspan="4"><div align="center"><img src="/skins/<?=$_SESSION["skin"]?>/elements/line.gif" width=600 height=1 border=0></div></td>
    </tr>
    <tr> 
      <td height="26" colspan="4"> <div align="right"> 
          <input name="button22" type="submit" class="commonButton" id="button2" title="Update"  onClick="window.location='../clients/clientinfo.php';" value="Update"  >
          <input name="button2" type="button" class="commonButton" id="button" title="Ok"  onClick="window.location='../clients/clientinfo.php';" value="Ok"  >
        </div></td>
    </tr>
  </table>
  <p>&nbsp;</p>
  </form>
<br>
<br>
<? include "../inc/footer.php" ?>
</body>
</html>
