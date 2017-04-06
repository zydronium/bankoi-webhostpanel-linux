<?$ACCESS_LEVEL=2;?>
<?
include "../inc/connection.php";
?>
<?include "../inc/security.php"?>
<html>
<head>

<link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/general.css">
<link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/custom.css">
<link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/layout.css">
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=ISO-8859-1">
<META HTTP-EQUIV="EXPIRES" CONTENT="0">
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<meta name="GENERATOR" content="Microsoft FrontPage 4.0">
<meta name="ProgId" content="FrontPage.Editor.Document">
<title>Add New Domain</title>
</head>
<script language="Javascript">
function chk_dom(dom_name)
{
    //alert(dom_name);
	nore = /\.$/;
	re = /^[A-Za-z0-9]([A-Za-z0-9-]*[A-Za-z0-9])*(\.[A-Za-z0-9]([A-Za-z0-9-]*[A-Za-z0-9])*)+$/;
	return (dom_name.search(nore) == -1) && (dom_name.search(re) != -1);
}

	function chk_form_data1(f)
	{
		//alert(f.domain_name);
			if(!chk_dom(f.domain_name.value))
			{
				alert("Domainname not proper");
				f.domain_name.value="";
				f.domain_name.focus();
				return false;
			}

			if(f.domain_name.value=="")
			{
				alert("Domain name missing!");
				f.domain_name.focus();
				return false;
			}

			if(f.password.value=="")
			{
				alert("Password can not be empty");
				f.password.focus();
				return false;
			}

			if(f.password1.value=="")
			{
				alert("Password can not be empty");
				f.password1.focus();
				return false;
			}

			if(f.password.value != f.password1.value)
			{
				alert("Two password do not match");
				f.password.value="";
				f.password1.value="";
				f.password.focus();
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
</Script>
<body leftmargin=0 topmargin=0>
<form action="../domains/domainsetup.php" method="post" name="mainform">
<?
	include "../inc/mainheader.php";
	include "../clients/clientheader.php";
	$username=$_SESSION["clientname"];
	$reselid=$_SESSION["clientid"];

	//---------------------------------------------------------------------------------------------------
	$query="select * from tblclientcontact where resellerid=$reselid";	
	$arraycontact=mysql_query($query) or die(errorCatch(mysql_error()));
	$resultcontact=mysql_fetch_array($arraycontact);
	$phone=$resultcontact["phone"];
	$email=$resultcontact["email"];
	$address=$resultcontact["address"];
	$city=$resultcontact["city"];
	$state=$resultcontact["state"];
	$zipcode=$resultcontact["zipcode"];
	$countrynm=$resultcontact["country"];

	//---------------------------------------------------------------------------------------------------
	//Here we are checking whether the client has been assigned an IP address
	$query="select count(*) as ipcount from tblresellerip where resellerid=$reselid";
	//myLog($query);
    $array=mysql_query($query) or die(errorCatch(mysql_error()));
	$result=mysql_fetch_array($array);
	$flag=$result["ipcount"];

	if($flag > 0)
	{
	}
	else
	{
?>
<script>
	window.location='../server/assign.php'
</script>
<?
	}
?>
<div align="center"> <center> </div>


<table width="80%" border="0" align="center" cellspacing="0" cellpadding="0">
  <?
	if(strtoupper($_SESSION["type"])=="A")
		{
?>
  <tr> 
    <td align="left" class="navigation">Administrator &gt; 
      <?=$_SESSION["clientname"]?>
      &gt; Add Domain</td>
  </tr>
  <?
		}
	elseif(strtoupper($_SESSION["type"])=="C")
		{
?>
  <tr> 
    <td align="left" class="navigation"> 
      <?=$_SESSION["clientname"]?>
      &gt; Add Domain </td>
  </tr>
  <?
		}
	elseif(strtoupper($_SESSION["type"])=="D")
		{
?>
  <tr> 
    <td align="left" class="navigation">&nbsp;</td>
  </tr>
  <?
		}
?>
  <tr> 
    <td>&nbsp;</td>
  </tr>
</table>
<table width="64%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr> 
    <td width="33%"></td>
    <td width="3%"></td>
    <td width="34%"></td>
  </tr>
  <tr> 
    <td colspan="3" align="right" class="headings">&nbsp;</td>
  </tr>
  <tr> 
    <td height="26" align="right" class="headings">Domain Name</td>
    <td width="3%" align="center"  class="headings"><font color="#FF0000">*</font></td>
    <td width="34%" class="headings"><font color="red"> WWW 
      <input type="checkbox" name="isWWW" value="1" checked>
      </font> 
      <input name="domain_name" type="text" class="textboxclass">
      </font></td>
  </tr>
  <tr> 
    <td height="26" align="right" class="headings">Contact 
      name:</td>
    <td width="3%" align="center" class="headings">&nbsp;</td>
    <td width="34%" class="headings"> 
      <input type="text" name="personalname" value="" size=25 maxlength=255 class="textboxclass">
     </td>
  </tr>
  <tr> 
    <td height="26" align="right" class="headings">Password</td>
    <td width="3%" align="center" class="headings"><font color="#FF0000">*</font></td>
    <td width="34%"><input name="password" type="password" value="" size="20" maxlength="20" class="textboxclass"></td>
  </tr>
  <tr> 
    <td height="26" align="right" class="headings">Re-type 
      Password</td>
    <td width="3%" align="center"><font color="#FF0000">*</font></td>
    <td width="34%"><input name="password1" type="password" value="" size="20" maxlength="20" class="textboxclass"></td>
  </tr>
  <tr> 
    <td width="33%" height="32" align="right" class="headings">Select 
      An IP Address</td>
    <td width="3%"></td>
    <?
		//-------------------------------------------------------------------------------------------------------
		//here we show only the ipaddress assigned to the reseller
		$query="select tblserverip.ipaddress,tblserverip.iptype,tblserverip.id from (tblresellerip inner join tblserverip on tblresellerip.ipaddress=tblserverip.id) where tblresellerip.resellerid=$reselid";
		//myLog($query);
		$array=mysql_query($query) or die(errorCatch(mysql_error()));
?>
    <td width="34%" align="left"><select name="ip_addr_id"  class="dropdown">
        <?
		   while($result=mysql_fetch_array($array))
		   {
?>
        <option value="<?=$result["id"]?>"> 
        <?=$result["ipaddress"]." -> " . $result["iptype"]?>
        <?
		   }
?>
      </select> </td>
  </tr>
  <tr> 
    <td width="33%" height="27" align="right" class="headings">Company 
      name&nbsp;</td>
    <td width="3%" class="headings">&nbsp;</td>
    <td width="30%" align="left"><p align="left"> 
        <input type="text" name="companyname" value="" size=20 maxlength=255 class="textboxclass">
    </td>
  </tr>
  <tr>
    <td width="33%" height="15" align="right" class="headings">E-mail:</td>
    <td width="3%"><div align="center"><font color="#FF0000">*</font></div></td>
    <td align="left"><input name="email" type="text" class="textboxclass" value="<?=$email?>" size=20 maxlength=255></td>
  </tr>
  <tr> 
    <td width="33%" height="28" align="right" class="headings">Phone:</td>
    <td width="3%">&nbsp;</td>
    <td align="left"><input type="text" name="phone" value="<?=$phone?>" size=20 maxlength=255 class="textboxclass"></td>
  </tr>
  <tr> 
    <td width="33%" height="24" align="right" class="headings">Address:</td>
    <td width="3%">&nbsp;</td>
    <td align="left"><input type="text" name="address" value="<?=$address?>" size=20 maxlength=255 class="textboxclass"></td>
  </tr>
  <tr> 
    <td width="33%" height="25" align="right" class="headings">City:</td>
    <td width="3%"  class="headings">&nbsp;</td>
    <td align="left"><input type="text" name="city" value="<?=$city?>" size=20 maxlength=255 class="textboxclass"></td>
  </tr>
  <tr> 
    <td width="33%" height="32" align="right" class="headings">State/Province:</td>
    <td width="3%">&nbsp;</td>
    <td align="left"><input type="text" name="state" value="<?=$state?>" size=20 maxlength=255 class="textboxclass"></td>
  </tr>
  <tr> 
    <td width="33%" height="26" align="right" class="headings">Postal/ZIP 
      code:</td>
    <td width="3%">&nbsp;</td>
    <td align="left"><input type="text" name="zipcode" value="<?=$zipcode?>" size=20 maxlength=255 class="textboxclass"></td>
  </tr>
  <tr> 
    <td width="33%" height="24" align="right" class="headings">Country:</td>
    <td width="3%"><div align="center"><font color="#FF0000">*</font></div></td>
    <td align="left"> 
      <?
//--------------------------------------------------------------------------------------------------
	//Here we are getting the name of the countries with there codes
    
	$query = "select * from tblcountry";
	//myLog($query);
	$array=Mysql_query($query) or die(errorCatch(mysql_error()));
?>
      <select name="country"  class="dropdown">
        <option value="Select Country">Select Country</Option>
        <? 
					while($country=mysql_fetch_array($array, MYSQL_ASSOC))
					{
				?>
        <option value="<?=$country["code"]?>" <?if($country["code"]==$countrynm) echo "Selected"?>> 
        <?=$country["countryname"]?>
        </option>
        <?
					}
				?>
      </select></td>
  </tr>
  <tr> 
    <td width="33%" align="right" class="headings">Proceed 
      for detailed setup</td>
    <td width="3%"><font size="2" face="Verdana">&nbsp; </font></td>
    <td align="left"><font size="2" face="Verdana"> 
      <input name="detail" type="checkbox" id="detail2" value="1">
      </font></td>
  </tr>
  <center>
    <tr> 
      <td width="33%" align="right"></td>
      <td width="3%"></td>
      <td width="34%"></td>
    </tr>
    <tr> 
      <td align="right"></td>
      <td></td>
      <td></td>
    </tr>
    <tr> 
      <td align="right"></td>
      <td></td>
      <td></td>
    </tr>
  </center>
</table>
<table width="81%" border="0" align="center">
  <tr> 
    <td align="center"><hr width=76%></td>
  </tr>
  <tr> 
    <td align="center"><input name="button" type="submit" class="commonButton" id="button2" title="Update" onClick="return chk_form_data1(document.mainform);" value="Create Domain" > 
      <?
	if(strtoupper($_SESSION["type"])=="A")
		{
?>
      <input name="button2" type="button" class="commonButton" id="buttondx" title="Cancel" onClick="window.location='../clients/clients.php'" value="Cancel" ></td>
    <?
		}
	elseif(strtoupper($_SESSION["type"])=="C")
		{
?>
    <input name="button2" type="button" class="commonButton" id="buttondx" title="Cancel" onClick="window.location='../domains/clientdomains.php'" value="Cancel" >
    <?
		}
?>
  </tr>
</table>
</body>
</form>
</html>
<br>
<?include "../inc/footer.php";?>
