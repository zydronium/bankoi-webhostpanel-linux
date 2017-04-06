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

<body leftmargin=0 topmargin=0>
<form action="../domains/create_domain.php" method="post" name="mainform">
<?
	include "../inc/mainheader.php";
	include "../clients/clientheader.php";
	$username=$_SESSION["clientname"];
	$reselid=$_SESSION["clientid"];

	$query = "select * from tblclientrights where resellerid = '$reselid'";
	$rsClientRights = @mysql_query($query);
	$num = @mysql_num_rows($rsClientRights);
	$rsArrayClientRights = @mysql_fetch_array($rsClientRights);
	$numDomains = $rsArrayClientRights["domains"];
	$numPopmailaccount = $rsArrayClientRights["popmailaccount"];
	$numSqldatabase = $rsArrayClientRights["sqldatabase"];
	$numDiskspace = $rsArrayClientRights["diskspace"];
	$numTraffic = $rsArrayClientRights["traffic"];
	$numEmailalias = $rsArrayClientRights["emailalias"];
	$valPwdprotectdir = $rsArrayClientRights["pwdprotectdir"];
	$valFrontpageext = $rsArrayClientRights["frontpageext"];
	$valWebstart = $rsArrayClientRights["webstart"];

	//echo "<br>The total number of pop acc " . $numPopmailaccount;
	//echo "<br>The total number of db is " . $numSqldatabase;
	//echo "<br>The total number of disk space is " . $numDiskspace;
	//echo "<br>The total number of alisa is " . $numEmailalias;
	//echo "<br>The total number of traffic is " . $numTraffic;
	
	
	

	$query = "select domainid from tbldomain  where resellerid = '$reselid'";
	$rsDomainsID = @mysql_query($query);
	while($rsDomainsArr = @mysql_fetch_array($rsDomainsID))
			{
				if($allDomainID == "")
						$allDomainID = $rsDomainsArr["domainid"];
				else
						$allDomainID = $allDomainID . "," . $rsDomainsArr["domainid"];
			}	


	$query = "select popmailaccount,sqldatabase,diskspace,emailalias,traffic from tbldomainrights where domainid in (" . $allDomainID . ")";
	$rsAllRights = @mysql_query($query);
	while($rsAllUsedRights = @mysql_fetch_array($rsAllRights))
			{
						$usedPopmailaccount = $usedPopmailaccount + $rsAllUsedRights["popmailaccount"];
						$usedSqldatabase = $usedSqldatabase + $rsAllUsedRights["sqldatabase"];
						$usedDiskspace = $usedDiskspace + $rsAllUsedRights["diskspace"];
						$usedEmailalias = $usedEmailalias + $rsAllUsedRights["emailalias"];
						$usedTraffic = $usedTraffic + $rsAllUsedRights["traffic"];
			}

	if($usedPopmailaccount =="")
				$usedPopmailaccount  = "0";
	if($usedSqldatabase =="")
				$usedSqldatabase  = "0";
	if($usedDiskspace  =="")
				$usedDiskspace  = "0";
	if($usedEmailalias  =="")
				$usedEmailalias  = "0";
	if($usedTraffic  =="")
				$usedTraffic  = "0";

	
	//echo "<br><br>The used  number of pop acc " . $usedPopmailaccount;
	//echo "<br>The used number of db is " . $usedSqldatabase;
	//echo "<br>The used number of disk space is " . $usedDiskspace;
	//echo "<br>The used number of alisa is " . $usedEmailalias;
	//echo "<br>The used number of traffic is " . $usedTraffic;
	
	
	$query = "select count(*) as dmnCount from tbldomain where resellerid = '$reselid'";

	$rsClientDomains = @mysql_query($query);
	$rsArrayClientDomains = @mysql_fetch_array($rsClientDomains);
	$numDomainsCreated = $rsArrayClientDomains["dmnCount"];


	if($numDomains != "-1")
	  {
		if($numDomainsCreated >= $numDomains)
				{
?>
						<script>
							alert("Clients domain limits are full!!!");
						</script>
<?
						if(strtoupper($_SESSION["type"])=="A")
								{
?>
									<script>
										window.location="clientdomains.php";
									</script>
<?
								}
						else
								{
?>
									<script>
										window.location="clientdomains.php";
									</script>
<?
								}
						die();

				}
		}


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

<!--<table width="58%" border="0" align="center" cellspacing="0" cellpadding="0">
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
</table>-->
<table width="52%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr> 
    <td width="46%"></td>
    <td width="4%"></td>
    <td width="50%"></td>
  </tr>
  <tr> 
    <td colspan="3" align="right" class="headings"><input name="button22" type="button" class="commonbutton" id="button22" title="Up Level" onClick="window.location='../domains/clientdomains.php'" value="Up Level" ></td>
  </tr>
  <tr> 
    <td colspan="3" align="right" class="headings"><div align="center"> <img src="/skins/<?=$_SESSION["skin"]?>/elements/line.gif" width=564 height=1 border=0>	
      </div></td>
  </tr>
  <tr>
    <td colspan="3" align="right" class="headings"><div align="left">Create new 
        domain for <font color="red"><?=$username?></font></div></td>
  </tr>
  <tr> 
    <td height="26" align="right" class="headings">Domain Name</td>
    <td width="4%" align="center"  class="headings"><font color="#FF0000">*</font></td>
    <td width="50%" class="headings"><font color="red"> WWW 
      <input type="checkbox" name="isWWW" value="1" checked>
      </font> <input name="domain_name" type="text" class="textboxclass"> </font></td>
  </tr>
  <tr> 
    <td height="26" align="right" class="headings">Contact name:</td>
    <td width="4%" align="center" class="headings">&nbsp;</td>
    <td width="50%" class="headings"> <input type="text" name="personalname" value="" size=25 maxlength=255 class="textboxclass"> 
    </td>
 </tr>
  <!--<tr> 
    <td height="26" align="right" class="headings">Password</td>
    <td width="4%" align="center" class="headings"><font color="#FF0000">*</font></td>
    <td width="50%"><input name="password" type="password" value="" size="20" maxlength="20" class="textboxclass"></td>
  </tr> 
  <tr> 
    <td height="26" align="right" class="headings">Re-type Password</td>
    <td width="4%" align="center"><font color="#FF0000">*</font></td>
    <td width="50%"><input name="password1" type="password" value="" size="20" maxlength="20" class="textboxclass"></td>
  </tr>-->
  <tr> 
    <td width="46%" height="32" align="right" class="headings">Select An IP Address</td>
    <td width="4%"></td>
    <?
		//-------------------------------------------------------------------------------------------------------
		//here we show only the ipaddress assigned to the reseller
		$query="select tblserverip.ipaddress,tblserverip.iptype,tblserverip.id from (tblresellerip inner join tblserverip on tblresellerip.ipaddress=tblserverip.id) where tblresellerip.resellerid=$reselid";
		//myLog($query);
		$array=mysql_query($query) or die(errorCatch(mysql_error()));
?>
    <td width="50%" align="left"><select name="ip_addr_id"  class="dropdown">
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
    <td height="31" align="right" class="headings">FTP Username</td>
    <td width="4%" align="center"><div align="center"><font color="#FF0000">*</font></div></td>
    <td width="50%" align="left"><input type="text" name="ftpusername" value="" size=25 maxlength=255 class="textboxclass"></td>
  </tr>
  <tr> 
    <td align="right" class="headings">FTP/Control panel Password</td>
    <td align="center"><div align="center"><font color="#FF0000">*</font></div></td>
    <td align="left"><input name="ftppassword" type="password" class="textboxclass" id="ftppassword" value="" size=25 maxlength=255></td>
  </tr>
  <tr> 
    <td width="46%" height="27" align="right" class="headings">Company name&nbsp;</td>
    <td width="4%" class="headings">&nbsp;</td>
    <td width="50%" align="left"><p align="left"> 
        <input type="text" name="companyname" value="" size=20 maxlength=255 class="textboxclass">
    </td>
  </tr>
  <tr> 
    <td width="46%" height="15" align="right" class="headings">E-mail:</td>
    <td width="4%"><div align="center"><font color="#FF0000">*</font></div></td>
    <td align="left"><input name="email" type="text" class="textboxclass" value="<?=$email?>" size=20 maxlength=255></td>
  </tr>
  <tr> 
    <td width="46%" height="28" align="right" class="headings">Phone:</td>
    <td width="4%">&nbsp;</td>
    <td align="left"><input type="text" name="phone" value="<?=$phone?>" size=20 maxlength=255 class="textboxclass"></td>
  </tr>
  <tr> 
    <td width="46%" height="24" align="right" class="headings">Address:</td>
    <td width="4%">&nbsp;</td>
    <td align="left"><input type="text" name="address" value="<?=$address?>" size=20 maxlength=255 class="textboxclass"></td>
  </tr>
  <tr> 
    <td width="46%" height="25" align="right" class="headings">City:</td>
    <td width="4%"  class="headings">&nbsp;</td>
    <td align="left"><input type="text" name="city" value="<?=$city?>" size=20 maxlength=255 class="textboxclass"></td>
  </tr>
  <tr> 
    <td width="46%" height="32" align="right" class="headings">State/Province:</td>
    <td width="4%">&nbsp;</td>
    <td align="left"><input type="text" name="state" value="<?=$state?>" size=20 maxlength=255 class="textboxclass"></td>
  </tr>
  <tr> 
    <td width="46%" height="35" align="right" class="headings">Postal/ZIP code:</td>
    <td width="4%">&nbsp;</td>
    <td align="left"><input type="text" name="zipcode" value="<?=$zipcode?>" size=20 maxlength=255 class="textboxclass"></td>
  </tr>
  <tr> 
    <td align="right" class="headings">User Shell:</td>
    <td align="center"><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="7" height="1" border="0"></td>
    <td align="left"> <select name="shellname" style="color: red; font-family: Verdana" class="textboxclass">
        <option value="/bin/false" selected>None</option>
        <option value="/bin/sh">/bin/sh</option>
        <option value="/bin/bash">/bin/bash</option>
        <option value="/bin/bash2">/bin/bash2</option>
        <option value="/bin/bsh">/bin/bsh</option>
        <option value="/bin/tcsh">/bin/tcsh</option>
        <option value="/bin/csh">/bin/csh</option>
      </select> </td>
  </tr>
  <tr> 
    <td><font color="#003366"><strong><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="1" height="8" border="0"></strong></font></td>
  </tr>
  <tr> 
    <td align="right" class="headings">Pop mail Account:</td>
    <td align="center">&nbsp;</td>
    <td align="left"><input type="text" name="popmailaccount" value="10" size=5 maxlength=255 class="textboxclass"></td>
  </tr>
  <tr> 
    <td><font color="#003366"><strong><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="1" height="8" border="0"></strong></font></td>
  </tr>
  <tr> 
    <td align="right" class="headings">Email aliases:</td>
    <td align="center">&nbsp;</td>
    <td align="left"><input type="text" name="emailalias" value="10" size=5 maxlength=255 class="textboxclass"></td>
  </tr>
  <tr> 
    <td><font color="#003366"><strong><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="1" height="8" border="0"></strong></font></td>
  </tr>

  <tr> 
    <td align="right" class="headings">Number Of Subdomains:</td>
    <td align="center">&nbsp;</td>
    <td align="left"><input type="text" name="subdomains" value="0" size=5 maxlength=255 class="textboxclass"></td>
  </tr>
 
   <tr> 
    <td><font color="#003366"><strong><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="1" height="8" border="0"></strong></font></td>
  </tr>
  <tr> 
    <td align="right" class="headings">MySql Database:</td>
    <td align="center">&nbsp;</td>
    <td align="left"><input type="text" name="mysqldatabase" value="1" size=5 maxlength=255 onChange="return validate(document.mainform.mysqldatabase)" class="textboxclass"></td>
  </tr>
  <tr> 
    <td><font color="#003366"><strong><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="1" height="8" border="0"></strong></font></td>
  </tr>
  <tr> 
    <td align="right" class="headings">Hard Disk Space:</td>
    <td align="center"><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="7" height="1" border="0"></td>
    <td align="left" class="headings"><input type="text" name="hdspace" value="" size=5 maxlength=255  class="textboxclass">
      MB</td>
  </tr>
  <tr> 
    <td><font color="#003366"><strong><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="1" height="8" border="0"></strong></font></td>
  </tr>
  <tr> 
  <tr> 
    <td align="right" class="headings">Traffic</td>
    <td align="center"><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="7" height="1" border="0"></td>
    <td align="left" class="headings"><input name="trafficport" type="text" id="trafficport" value="" size=5  class="textboxclass">
      MB </td>
  </tr>
  <tr> 
    <td><font color="#003366"><strong><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="1" height="8" border="0"></strong></font></td>
  </tr>
  <td align="right" class="headings">Password Protect:</td>
  <td align="center"><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="7" height="1" border="0"></td>
  <td align="left"> 
    <?
		if($valPwdprotectdir == "N")
				$varPwd = "disabled";
		else
				$varPwd = "";
  ?>
    <input type="checkbox" name="pwdprotect" value="Y" size=25 <?=$varPwd?>></td>
  </tr>
  <tr> 
    <td><font color="#003366"><strong><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="1" height="8" border="0"></strong></font></td>
  </tr>
  <tr> 
    <td align="right" class="headings">CGI Support:</td>
    <td align="center"><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="7" height="1" border="0"></td>
    <td align="left"><input type="checkbox" name="cgisupport" value="Y" size=25></td>
  </tr>
  <tr> 
    <td><font color="#003366"><strong><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="1" height="8" border="0"></strong></font></td>
  </tr>
  <?
		if($valFrontpageext == "N")
				$varFP = "disabled";
		else
				$varFP = "";
  ?>
  <tr> 
    <td align="right" class="headings">Front Page Ext.:</td>
    <td align="center"><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="7" height="1" border="0"></td>
    <td align="left"><input type="checkbox" name="frontpageext" value="Y" size = "7" <?=$varFP?>></td>
  </tr>
  <tr> 
    <td><font color="#003366"><strong><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="1" height="8" border="0"></strong></font></td>
  </tr>
  <?
		if($valWebstart == "N")
				$varWS = "disabled";
		else
				$varWS = "";
  ?>
  <tr> 
    <td align="right" class="headings">Web Stats:</td>
    <td align="center"><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="7" height="1" border="0"></td>
    <td align="left"><input type="checkbox" name="webstart" value="Y" size=25 <?=$varWS?>></td>
  </tr>
  <tr> 
    <td width="46%" height="24" align="right" class="headings">Country:</td>
    <td width="4%"><div align="center"><font color="#FF0000">*</font></div></td>
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
</table>
</td>
  </tr>
  <!--<tr> 
    <td width="33%" align="right" class="headings">Proceed 
      for detailed setup</td>
    <td width="3%"><font size="2" face="Verdana">&nbsp; </font></td>
    <td align="left"><font size="2" face="Verdana"> 
      <input name="detail" type="checkbox" id="detail2" value="1">
      </font></td>
  </tr>-->
  <center>
    <tr> 
      <td width="46%" align="right"></td>
      <td width="4%"></td>
      <td width="50%"></td>
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
<table width="64%" border="0" align="center">
  <tr> 
    <td colspan="2" align="center"> <img src="/skins/<?=$_SESSION["skin"]?>/elements/line.gif" width=564 height=1 border=0>	
    </td>
  </tr>
  <tr> 
    <td width="51%" align="center">Fields marked with <font color="#FF0000">*</font> 
      are necessary</td>
    <td width="49%" align="center"><input name="button" type="submit" class="commonButton" id="button2" title="Update" onClick="return chk_form_data1(document.mainform);" value="Create Domain" > 
      <?
	if(strtoupper($_SESSION["type"])=="A")
		{
?>
      <input name="button2" type="button" class="commonButton" id="buttondx" title="Cancel" onClick="window.location='../domains/clientdomains.php'" value="Cancel" ></td>
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
		
		if(!chk_dom(f.domain_name.value))
				{
					alert("Domainname not proper");
					f.domain_name.value="";
					f.domain_name.focus();
					return false;
				}
	
		
		var tld_name_arr = f.domain_name.value;
		var splitStr = tld_name_arr.split(".");
		if(parseInt(splitStr.length) == 3)
			{
				if(parseInt(splitStr[splitStr.length-1].length) < 2 || parseInt(splitStr[splitStr.length-1].length) > 3)
						{
							alert("Domainname not proper");
							f.domain_name.value="";
							f.domain_name.focus();
							return false;
						}
			}
		else
			{
				if(parseInt(splitStr[splitStr.length-1].length) != 3)
						{
							alert("Domainname not proper");
							f.domain_name.value="";
							f.domain_name.focus();
							return false;
						}
			}


		if(f.domain_name.value=="")
				{
					alert("Domain name missing!");
					f.domain_name.focus();
					return false;
				}

	
		emailExp= /^\w+(\-\w+)*(\.\w+(\-\w+)*)*@\w+(\-\w+)*(\.\w+(\-\w+)*)+$/;
	    
		if(!f.ftpusername.value)
			  {
					alert("FTP username is empty");
					f.ftpusername.focus();
					return false;
			  }

		if(!f.ftppassword.value)
				{
					alert("Ftppassword is empty");
					f.ftppassword.focus();
					return false;
				}


		
	   if(isNaN(f.popmailaccount.value))
			{
				alert("Provide only numbers for popmail accounts!!!");
				f.popmailaccount.value="";
				f.popmailaccount.focus();
				return false;
			}


	  if(isNaN(f.emailalias.value))
			{
				alert("Provide only numbers for emailalias!!!!!!");
				f.emailalias.value="";
				f.emailalias.focus();
				return false;
			}

		if(isNaN(f.mysqldatabase.value))
			{
				alert("Provide only numbers for MySql databases!!!");
				f.mysqldatabase.value="";
				f.mysqldatabase.focus();
				return false;
			}

		if(isNaN(f.hdspace.value))
			{
				alert("Provide only numbers for harddisk space!!!");
				f.hdspace.value="";
				f.hdspace.focus();
				return false;
			}

		if(isNaN(f.trafficport.value))
			{
				alert("Provide only numbers for traffic!!!");
				f.trafficport.value="";
				f.trafficport.focus();
				return false;
			}


		
		var totalPopAccount,totalSqlDB,totalDiskSP,totalAlias,totalTraffic

		if(f.popmailaccount.value == "")
				f.popmailaccount.value = "0"
		if(f.mysqldatabase.value == "")
				f.mysqldatabase.value = "0"
		if(f.hdspace.value == "")
				f.hdspace.value = "0"
		if(f.emailalias.value == "")
				f.emailalias.value = "0"
		if(f.trafficport.value == "")
				f.trafficport.value = "0"


		totalPopAccount = parseInt(<?=$usedPopmailaccount?>) + parseInt(f.popmailaccount.value)
		totalSqlDB = parseInt(<?=$usedSqldatabase?>) + parseInt(f.mysqldatabase.value)
		totalDiskSP = parseInt(<?=$usedDiskspace?>) + parseInt(f.hdspace.value)
		totalAlias = parseInt(<?=$usedEmailalias?>) + parseInt(f.emailalias.value)
		totalTraffic = parseInt(<?=$usedTraffic?>) + parseInt(f.trafficport.value)

		if(parseInt(<?=$numPopmailaccount?>) != -1)
			   {
					if(parseInt(totalPopAccount) > parseInt(<?=$numPopmailaccount?>))
						{
							alert("There are only " + (parseInt(<?=$numPopmailaccount?>) - parseInt(<?=$usedPopmailaccount?>)) + " popmail accounts free!!!");
							f.popmailaccount.focus();
							return false;
						}

					if(parseInt(f.popmailaccount.value) < 0)
						{
							alert("Please provide a valid number greater than \nequal to \"0\" for popmail account!!!");
							f.popmailaccount.value="";
							f.popmailaccount.focus();
							return false;
						}
			   }

		if(parseInt(<?=$numSqldatabase?>) != -1)
			   {
					if(parseInt(totalSqlDB) > parseInt(<?=$numSqldatabase?>))
						{
							alert("There are only " + (parseInt(<?=$numSqldatabase?>) - parseInt(<?=$usedSqldatabase?>)) + " databasea ccounts free!!!");
							f.mysqldatabase.focus();
							return false;
						}

					if(parseInt(f.mysqldatabase.value) < 0)
						{
							alert("Please provide a valid number greater than \nequal to \"0\" for number of databases!!!");
							f.mysqldatabase.value="";
							f.mysqldatabase.focus();
							return false;
						}
			   }


		if(parseInt(<?=$numDiskspace?>) != -1)
			   {
					if(parseInt(totalDiskSP) > parseInt(<?=$numDiskspace?>))
						{
							alert("There is only " + (parseInt(<?=$numDiskspace?>) - parseInt(<?=$usedDiskspace?>)) + " MB space left with the client!!!");
							f.hdspace.focus();
							return false;
						}

					if(parseInt(f.hdspace.value) < 0)
						{
							alert("Please provide a valid number greater than equal  \nto \"0\" for amount of hard disk space!!!");
							f.hdspace.value="";
							f.hdspace.focus();
							return false;
						}
			   }


		if(parseInt(<?=$numEmailalias?>) != -1)
			   {
					if(parseInt(totalAlias) > parseInt(<?=$numEmailalias?>))
						{
							alert("There are only " + (parseInt(<?=$numEmailalias?>) - parseInt(<?=$usedEmailalias?>)) + " email alias ccounts free!!!");
							f.emailalias.focus();
							return false;
						}

					if(parseInt(f.emailalias.value) < 0)
						{
							alert("Please provide a valid number greater than equal  \nto \"0\" for number of alias accounts!!!");
							f.emailalias.value="";
							f.emailalias.focus();
							return false;
						}
			   }
		
		if(parseInt(<?=$numTraffic?>) != -1)
			   {
					if(parseInt(totalTraffic) > parseInt(<?=$numTraffic?>))
						{
							alert("There is only " + (parseInt(<?=$numTraffic?>) - parseInt(<?=$usedTraffic?>)) + " MB traffic left!!!");
							f.trafficport.focus();
							return false;
						}


					if(parseInt(f.trafficport.value) < 0)
						{
							alert("Please provide a valid number greater than equal  \nto \"0\" for amount of  traffic!!!");
							f.trafficport.value="";
							f.trafficport.focus();
							return false;
						}
			   }
		

		if(!f.popmailaccount.value)
				{
					f.popmailaccount.value="0";
					return true;
				}

		if(!f.mysqldatabase.value)
				{
					f.mysqldatabase.value="0";
					return true;
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
