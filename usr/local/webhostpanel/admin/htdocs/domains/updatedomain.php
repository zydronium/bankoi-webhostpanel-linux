<?$ACCESS_LEVEL=2;?>
<?include "../inc/connection.php"?>
<?include "../inc/params.php"?>
<?include "../inc/functions.php"?>
<?include "../inc/security.php"?>
<html>
<head>
<title>Update Domain Info</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head><link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/general.css">
<link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/custom.css">
<link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/layout.css">
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=ISO-8859-1">
<META HTTP-EQUIV="EXPIRES" CONTENT="0">
</head>




<body leftmargin=0 topmargin=0>
<form name="mainform" action="../domains/updatedomaininfo1.php" method="POST" onSubmit="return chk(document.mainform)">
<?include "../inc/mainheader.php"?>
<?
	if(strtoupper($_SESSION["type"])=="D")
		{
?>
<script>
			window.location="../login.php";
</script>
<?
		}
	if(strtoupper($_SESSION["type"])!="D")
		include "../clients/clientheader.php";
?>
<?include "../domains/domainheader.php";?>

<?
	$domainid=$_SESSION["domainid"];
	$domainname=$_SESSION["domainname"];
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
	
	
	

	$query = "select domainid from tbldomain  where resellerid = '$reselid'";
	$rsDomainsID = @mysql_query($query);
	while($rsDomainsArr = @mysql_fetch_array($rsDomainsID))
			{
				if($allDomainID == "")
						$allDomainID = $rsDomainsArr["domainid"];
				else
						$allDomainID = $allDomainID . "," . $rsDomainsArr["domainid"];
			}	

			$query = "select * from tbldomainrights  where domainid = '$domainid'";
			$rsDomainsResult = @mysql_query($query);
			$rsDomainsArray = @mysql_fetch_array($rsDomainsResult);

			$numDomainPopmailaccount = $rsDomainsArray["popmailaccount"];
			$numDomainSqldatabase = $rsDomainsArray["sqldatabase"];
			$numDomainDiskspace = $rsDomainsArray["diskspace"];
			$numDomainTraffic = $rsDomainsArray["traffic"];
			$numDomainEmailalias = $rsDomainsArray["emailalias"];
			$valDomainPwdprotectdir = $rsDomainsArray["pwdprotectdir"];
			$valDomainFrontpageext = $rsDomainsArray["frontpageext"];
			$valDomainWebstart = $rsDomainsArray["webstart"];






	$query = "select popmailaccount,sqldatabase,diskspace,emailalias,traffic,subdomains from tbldomainrights where domainid in (" . $allDomainID . ")";
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



	$query="select hosting from tbldomain where domainid=$domainid";
	//myLog($query);
	$array=mysql_query($query) or die(errorCatch(mysql_error()));
	$domainset=@mysql_fetch_array($array);
	$hosting=$domainset["hosting"];

	if($hosting=='N')
		{
			echo "<center><hr width=\"86%\"><h4><br>Domain <font color=\"red\">".$domainname." </font>not configured</h4></center>";
			echo "<center><br>Click the link to configure domain <a href=\"../domains/newdomain.php?domainid=".$domainid."\" style=\"text-decoration:none\">Configure Domain</a></center>";
			echo "<hr width=\"86%\"><br><center><a href=\"javascript:history.go(-2)\"><img src=\"../Icons/btn_backup_bg.gif\" border=\"0\" alt=\"Back\">Back</a></center>";
		}
	else
		{
?>
			
			<table width=696 border=0 cellpadding=0 cellspacing=0 align="center">
  <tr >	 
	  
    <td width="696" colspan=5 align="center">&nbsp;</td>
	</tr>
		
		<tr><td>
	    <table border=0 cellpadding=0 cellspacing=0 align="left">
        <tr> 
          <td width=3></td>
          <td width=104 class="headings">&nbsp;</td>
          <td width=332 class="headings">Domain of <font name="verdana" color="red"><strong> 
            <?=$username?>
            </strong></font></td>
          <td width=7><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="7" height="1" border="0"></td>
          <td width=115 align="right" class="verttop">&nbsp;</td>
          <td width=129><div align="right"><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="3" height="1" border="0"> 
              <input name="moveup" type="button" class="commonbutton" id="button" onClick="window.location='../domains/showdomaindetails.php'" value="Up Level" >
            </div></td>
        </tr>
      </table></td></tr>

		<tr>
    <td colspan=5><div align="center"><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="1" height="16" border="0"><font color="#006666"><img src="/skins/<?=$_SESSION["skin"]?>/elements/line.gif" width=600 height=1 border=0></font></div></td>
  </tr>

		<tr>
			<td colspan=5>
			<table width="100%" border=0 cellpadding=0 cellspacing=0 align="left">
        <?
    
    $query="select domainname from tbldomain where domainid=$domainid";
	//myLog($query);
	$array=mysql_query($query) or die(errorCatch(mysql_error()));
	$domainset=@mysql_fetch_array($array);
	$domainname=$domainset["domainname"];
?>
        <tr> 
          <td width="47%" align="right" class="headings">Domain name </td>
          <td width="4%" align="center"></td>
          <td width="49%" align="left"><font color="#FF0000"> <strong> 
            <?=$domainname?>
            </strong> </font></td>
        </tr>
        
        <tr> 
          <td><font color="#003366"><strong><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="1" height="8" border="0"></strong></font></td>
        </tr>
        <tr> 
          <td width="47%" align="right" class="headings">IP 
            address </td>
          <td><font color="#FF0000">&nbsp;</font></td>
          <?
//-------------------------------------------------------------------------------------------------------
//here we show only the ipaddress assigned to the reseller
$query="select tblserverip.ipaddress,tblserverip.iptype,tblserverip.id from (tbldomain inner join tblserverip on tbldomain.ipaddress=tblserverip.id) where tbldomain.resellerid=$reselid";
$array=mysql_query($query) or die(errorCatch(mysql_error()));
$result=mysql_fetch_array($array);
?>
          <td width="49%" align="left"> <font color="#FF0000"> <strong> 
            <?=$result["ipaddress"]." -> " . $result["iptype"]?>
            </strong> </font></td>
        </tr>
        <?
	@mysql_free_result($array);
	$query="select * from tbldomaincontact where domainid=$domainid";

	$array=mysql_query($query) or die(errorCatch(mysql_error()));
	$domaincontact=@mysql_fetch_object($array);

	$query="select * from tbldomainrights where domainid=$domainid";
	$arrayrights=mysql_query($query) or die(errorCatch(mysql_error()));
	$domainrights=@mysql_fetch_object($arrayrights);

	$query="select * from tblftpinfo where domainid=$domainid";
	$arrayftp=mysql_query($query) or die(errorCatch(mysql_error()));
	$domainftp=@mysql_fetch_object($arrayftp);
?>
        <tr> 
          <td><font color="#003366"><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="1" height="16" border="0"></font></td>
        </tr>
        <tr> 
          <td colspan=3><table width="100%" border=0 cellspacing=0 cellpadding=0 align="left">
              <tr> 
                <td width="47%" align="right" class="headings">Contact 
                  name: </td>
                <td width="4%" align="center"><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="7" height="1" border="0"></td>
                <td width="49%" align="left"> <input type="text" name="personalname" value="<?=$domaincontact->contactname?>" size=20 maxlength=255 class="textboxclass"> 
                  &nbsp; 
                </td>
              </tr>
              <tr> 
                <td><font color="#003366"><strong><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="1" height="8" border="0"></strong></font></td>
              </tr>
              <tr> 
                <td align="right" class="headings">Company name: </td>
                <td align="center"><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="7" height="1" border="0"></td>
                <td align="left" class="headings"> 
                  <input type="text" name="companyname" value="<?=$domaincontact->companyname?>" size=20 maxlength=255 class="textboxclass">
                  </td>
              </tr>
              <tr> 
                <td><font color="#003366"><strong><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="1" height="8" border="0"></strong></font></td>
              </tr>
              <tr> 
                <td align="right" class="headings">Number of SubDomains: </td>
                <td align="center">&nbsp;</td>
                <td align="left"> 
				<input type="text" name="subdomains" value="<?=$domainrights->subdomains?>" size=5 maxlength=255 onChange="return validate(document.mainform.subdomains)"  class="textboxclass"> 
                </td>
              </tr>
	      <tr> 
                <td><font color="#003366"><strong><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="1" height="8" border="0"></strong></font></td>
              </tr>
              <tr> 
                <td align="right" class="headings">Pop mail Account: </td>
                <td align="center">&nbsp;</td>
                <td align="left"> <input type="text" name="popmailaccount" value="<?=$domainrights->popmailaccount?>" size=5 maxlength=255 onChange="return validate(document.mainform.popmailaccount)"  class="textboxclass"> 
                </td>
              </tr>	  
              <tr> 
                <td><font color="#003366"><strong><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="1" height="8" border="0"></strong></font></td>
              </tr>
              <tr> 
                <td align="right" class="headings">Email aliases: </td>
                <td align="center">&nbsp;</td>
                <td align="left"> <input type="text" name="emailalias" value="<?=$domainrights->emailalias?>" size=5 maxlength=255  class="textboxclass"> 
                </td>
              </tr>
              <tr> 
                <td><font color="#003366"><strong><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="1" height="8" border="0"></strong></font></td>
              </tr>
              <tr> 
                <td align="right" class="headings">MySql Database: </td>
                <td align="center">&nbsp;</td>
                <td align="left"> <input type="text" name="mysqldatabase" value="<?=$domainrights->sqldatabase?>" size=5 maxlength=255 onChange="return validate(document.mainform.mysqldatabase)" class="textboxclass"> 
                </td>
              </tr>
              <tr> 
                <td><font color="#003366"><strong><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="1" height="8" border="0"></strong></font></td>
              </tr>
              <tr> 
                <td align="right" class="headings">Hard Disk Space: </td>
                <td align="center"><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="7" height="1" border="0"></td>
                <td align="left" class="headings"> <input type="text" name="hdspace" value="<?=$domainrights->diskspace?>" size=5 maxlength=255  class="textboxclass">
                  MB </td>
              </tr>
			  <tr> 
                <td><font color="#003366"><strong><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="1" height="8" border="0"></strong></font></td>
              </tr>
              <tr>
                <td align="right" class="headings">User Shell: </td>
                <td align="center">&nbsp;</td>
				
                <td align="left">
					<select name="shellname"  class="dropdown">
                     <option value="/bin/false" <?if($domainftp->shellname=="/bin/false") echo "selected"?>>None</option>
		    <option value="/bin/sh" <?if($domainftp->shellname=="/bin/sh") echo "selected"?>>/bin/sh</option>
                    <option value="/bin/bash" <?if($domainftp->shellname=="/bin/bash") echo "selected"?>>/bin/bash</option>
                    <option value="/bin/bash2" <?if($domainftp->shellname=="/bin/bash2") echo "selected"?>>/bin/bash2</option>
                    <option value="/bin/ash" <?if($domainftp->shellname=="/bin/ash") echo "selected"?>>/bin/ash</option>
                    <option value="/bin/bsh" <?if($domainftp->shellname=="/bin/bsh") echo "selected"?>>/bin/bsh</option>
                    <option value="/bin/tcsh" <?if($domainftp->shellname=="/bin/tcsh") echo "selected"?>>/bin/tcsh</option>
                    <option value="/bin/csh" <?if($domainftp->shellname=="/bin/csh") echo "selected"?>>/bin/csh</option>
                    
                  </select></td>
              </tr>
              <tr> 
                <td><font color="#003366"><strong><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="1" height="8" border="0"></strong></font></td>
              </tr>
              <tr> 
                <td align="right" class="headings">Traffic: </td>
                <td align="center" class="headings">&nbsp;</td>
                <td align="left" class="headings"> 
                  <input name="traffic" type="text" id="trafficport" value="<?=$domainrights->traffic?>" size=6 class="textboxclass">
                  MB </td>
              </tr>
              <tr> 
                <td><font color="#003366"><strong><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="1" height="8" border="0"></strong></font></td>
              </tr>
              <tr> 
                <td align="right" class="headings">Password Protect: </td>
                <td align="center"><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="7" height="1" border="0"></td>
                <td align="left" class="headings"> 
                  <?
					  if($domainrights->pwdprotectdir=='Y')
							{
								$pwdprotectdir="checked";
							}
					  else
							{
								$pwdprotectdir='';
							}
				  ?>
                  <input type="checkbox" name="pwdprotect" value="Y" size=25 maxlength=255 <?=$pwdprotectdir?>> 
                </td>
              </tr>
              <tr> 
                <td><font color="#003366"><strong><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="1" height="8" border="0"></strong></font></td>
              </tr>
              <tr> 
                <td align="right" class="headings">CGI Support: </td>
                <td align="center"><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="7" height="1" border="0"></td>
                <td align="left" class="headings"> 
                  <?
				  if($domainrights->cgisupport=='Y')
							{
								$cgisupport="checked";
							}
					  else
							{
								$cgisupport='';
							}
				?>
                  <input type="checkbox" name="cgisupport" value="Y" size=25 <?=$cgisupport?>> 
                </td>
              </tr>
              <tr> 
                <td><font color="#003366"><strong><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="1" height="8" border="0"></strong></font></td>
              </tr>
              <tr> 
                <td align="right" class="headings">Front Page Ext.: </td>
                <td align="center"><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="7" height="1" border="0"></td>
                <td align="left" class="headings">
                  <?
				  if($domainrights->frontpageext=='Y')
							{
								$frontpageext="checked";
							}
					  else
							{
								$frontpageext='';
							}
				?>
                  <input type="checkbox" name="frontpageext" value="Y" size = "7" <?=$frontpageext?>> 
                </td>
              </tr>
              <tr> 
                <td><font color="#003366"><strong><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="1" height="8" border="0"></strong></font></td>
              </tr>
              <tr> 
                <td align="right" class="headings">Web Stats: </td>
                <td align="center"><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="7" height="1" border="0"></td>
                <td align="left" class="headings">
                  <?
				  if($domainrights->webstart=='Y')
							{
								$webstart="checked";
							}
					  else
							{
								$webstart='';
							}
				?>
                  <input type="checkbox" name="webstart" value="Y" size=25 <?=$webstart?>> 
                </td>
              </tr>
              <tr> 
                <td><font color="#003366"><strong><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="1" height="8" border="0"></strong></font></td>
              </tr>
              <tr> 
                <td align="right" class="headings">E-mail: </td>
                <td align="center"><font color="#FF0000">*</font></td>
                <td align="left"> <input type="text" name="email" value="<?=$domaincontact->email?>" size=20 maxlength=255 class="textboxclass"> 
                </td>
              </tr>
              <tr> 
                <td><font color="#003366"><strong><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="1" height="8" border="0"></strong></font></td>
              </tr>
              <tr> 
                <td align="right" class="headings">Phone: </td>
                <td align="center"><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="7" height="1" border="0"></td>
                <td align="left"> <input type="text" name="phone" value="<?=$domaincontact->phone?>" size=20 maxlength=255  class="textboxclass"> 
                </td>
              </tr>
              <tr> 
                <td><font color="#003366"><strong><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="1" height="8" border="0"></strong></font></td>
              </tr>
              <tr> 
                <td align="right" class="headings">Address: </td>
                <td align="center"><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="7" height="1" border="0"></td>
                <td align="left"> <input type="text" name="address" value="<?=$domaincontact->address?>" size=20 maxlength=255  class="textboxclass"> 
                </td>
              </tr>
              <tr> 
                <td><font color="#003366"><strong><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="1" height="8" border="0"></strong></font></td>
              </tr>
              <tr> 
                <td align="right" class="headings">City: </td>
                <td align="center"><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="7" height="1" border="0"></td>
                <td align="left"> <input type="text" name="city" value="<?=$domaincontact->city?>" size=20 maxlength=255 class="textboxclass"> 
                </td>
              </tr>
              <tr> 
                <td><font color="#003366"><strong><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="1" height="8" border="0"></strong></font></td>
              </tr>
              <tr> 
                <td align="right" class="headings">State/Province: </td>
                <td align="center"><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="7" height="1" border="0"></td>
                <td align="left"> <input type="text" name="state" value="<?=$domaincontact->state?>" size=20 maxlength=255 class="textboxclass"> 
                </td>
              </tr>
              <tr> 
                <td><font color="#003366"><strong><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="1" height="8" border="0"></strong></font></td>
              </tr>
              <tr> 
                <td align="right" class="headings">Postal/ZIP code: </td>
                <td align="center"><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="7" height="1" border="0"></td>
                <td align="left"> <input type="text" name="zipcode" value="<?=$domaincontact->zipcode?>" size=20 maxlength=255 class="textboxclass"> 
                </td>
              </tr>
              <tr> 
                <td><font color="#003366"><strong><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="1" height="8" border="0"></strong></font></td>
              </tr>
              <tr> 
                <td align="right" class="headings">Country: </td>
                <td align="center"><font color="#FF0000">*</font></td>
                <td align="left"><select name="country" class="dropdown">
                    <?
//--------------------------------------------------------------------------------------------------
	//Here we are getting the name of the countries with there codes
    
	$query = "select * from tblcountry";
	//myLog($query);
	$array=Mysql_query($query) or die(errorCatch(mysql_error()));

					while($country=mysql_fetch_array($array, MYSQL_ASSOC))
					{
?>
                    <option value="<?=$country["code"]?>" <?if($country["code"]==$domaincontact->country) echo "Selected"?>> 
                    <?=$country["countryname"]?>
                    </option>
                    <?
					}
?>
                  </select></td>
              </tr>
              <tr> 
                <td><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="1" height="8" border="0"></td>
              </tr>
            </table></td>
        </tr>
      </table>

			</td>
		</tr>

		<tr><td colspan=5><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="1" height="16" border="0"></td></tr>

		<tr><td>
	    <table border=0 cellpadding=0 cellspacing=0 align="left">
        <tr > 
          <td colspan=3 align="center"><div align="center"><img src="/skins/<?=$_SESSION["skin"]?>/elements/line.gif" width=600 height=1 border=0>	
            </div></td>
        </tr>
        <tr> 
		 <td align="center">
<?		if(strtoupper($_SESSION["type"])!='D')
			{
?>
         <input name="updateinfo" type="submit" class="commonButton" id="button2" value="Update Info">
		  
            <img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="3" height="1" border="0"> 
<?
			}
?>

            <input type="button" class="commonButton" id="bid-update" value="Cancel" onClick="history.go(-1)" > 
            <img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="3" height="1" border="0"></td>
        </tr>
      </table></td></tr>

		<tr><td colspan=5><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="1" height="8" border="0"></td></tr>

	</table>
			
<?
		}
?>
</body>
<?include "../inc/footer.php"?>
</form>
</html>
<br>
<br>


<?
		$domainSubdomainsLimit = $domainrights->subdomains;
		$query = "select count(*) as countMailAccount from mail_mailbox where domain='$domainname'";
		$exMailAccount = @mysql_query($query);
		$rsMailAccount = @mysql_fetch_array($exMailAccount);
		$domainUsedMailAccount = $rsMailAccount ["countMailAccount"];

		$query = "select count(*) as countMailAlias from mail_alias where domain='$domainname'";
		$exMailAlias = @mysql_query($query);
		$rsMailAlias = @mysql_fetch_array($exMailAlias);
		$domainUsedMailAlias = $rsMailAlias ["countMailAlias"];

		$query = "select count(*) as countSqlDatabase from tbldatabase where domainid='$domainid'";
		$exSqlDatabase = @mysql_query($query);
		$rsSqlDatabase = @mysql_fetch_array($exSqlDatabase);
		$domainUsedSqlDatabase = $rsSqlDatabase ["countSqlDatabase"];
		
		$query = "select count(username) as SubDomains from tblsubdomain where domainid = '$domainid'";
		$exusedSubdomains = @mysql_query($query);
		$rsusedSubdomains = @mysql_fetch_array($exusedSubdomains);
		$domainUsedSubDomains = $rsusedSubdomains["SubDomains"];

		if($domainUsedSqlDatabase == "")
				$domainUsedSqlDatabase = "0";
	
		if($domainUsedMailAlias == "")
				$domainUsedMailAlias = "0";

		if($domainUsedMailAccount == "")
				$domainUsedMailAccount = "0";
				
		if($domainUsedSubDomains == "")
				$domainUsedSubDomains = "0";
?>

<script>

//---------------------------------------------------------------------------------------------------------
function chk(f)
{
	
  	if(f.email.value=="")
	{
		alert("Please supply email address");
		f.email.focus();
		return false;
	}

	emailExp= /^\w+(\-\w+)*(\.\w+(\-\w+)*)*@\w+(\-\w+)*(\.\w+(\-\w+)*)+$/;
   if (!(emailExp.test(f.email.value)))
      { 
		   alert("Email address is not proper");
		   f.email.focus();
		   return false;  
	  }

	if(isNaN(f.subdomains.value))
			{
				alert("Provide only numbers for subdomains accounts!!!");
				f.subdomains.value="";
				f.subdomains.focus();
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
				alert("Provide only numbers for traffic!!!!!!");
				f.trafficport.value="";
				f.trafficport.focus();
				return false;
			}


		if(parseInt(f.subdomains.value) < parseInt(<?=$domainUsedSubDomains?>))
						{
							alert("Domain has used " + "<?=$domainUsedSubDomains?>" + " subDomain accounts.\nYou can not assign value less than " +  "<?=$domainUsedSubDomains?>");
							f.subdomains.value = "<?=$domainUsedSubDomains?>"
							f.subdomains.focus();
							return false;
						}
		
		var totalPopAccount,totalSqlDB,totalDiskSP,totalAlias,totalTraffic,totalSubdomains
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
		if(f.subdomains.value == "")
				f.subdomains.value = "0"

		totalPopAccount = parseInt(<?=$usedPopmailaccount?>) + parseInt(f.popmailaccount.value) - parseInt(<?=$numDomainPopmailaccount?>) 
		totalSqlDB = parseInt(<?=$usedSqldatabase?>) + parseInt(f.mysqldatabase.value) - parseInt(<?=$numDomainSqldatabase?>) 
		totalDiskSP = parseInt(<?=$usedDiskspace?>) + parseInt(f.hdspace.value) - parseInt(<?=$numDomainDiskspace?>) 
		totalAlias = parseInt(<?=$usedEmailalias?>) + parseInt(f.emailalias.value) - parseInt(<?=$numDomainEmailalias?>) 
		totalTraffic = parseInt(<?=$usedTraffic?>) + parseInt(f.trafficport.value) - parseInt(<?=$numDomainTraffic?>) 
		totalSubdomains = parseInt(<?=$usedSubdomains?>) + parseInt(f.subdomains.value) - parseInt(<?=$numDomainSubdomains?>) 

		
		if(parseInt(<?=$numPopmailaccount?>) != -1)
			   {
					if(parseInt(totalPopAccount) > parseInt(<?=$numPopmailaccount?>))
						{
							alert("There are only " + (parseInt(<?=$numPopmailaccount?>) - parseInt(<?=$usedPopmailaccount?>)) + " popmail accounts free!!!");
							f.popmailaccount.value = "<?=$numDomainPopmailaccount?>"
							f.popmailaccount.focus();
							return false;
						}
			   }

		if(parseInt(<?=$numSqldatabase?>) != -1)
			   {
					if(parseInt(totalSqlDB) > parseInt(<?=$numSqldatabase?>))
						{
							alert("There are only " + (parseInt(<?=$numSqldatabase?>) - parseInt(<?=$usedSqldatabase?>)) + " databasea ccounts free!!!");
							f.mysqldatabase.value = "<?=$numDomainSqldatabase?>"
							f.mysqldatabase.focus();
							return false;
						}
			   }


		if(parseInt(<?=$numDiskspace?>) != -1)
			   {
					if(parseInt(totalDiskSP) > parseInt(<?=$numDiskspace?>))
						{
							alert("There is only " + (parseInt(<?=$numDiskspace?>) - parseInt(<?=$usedDiskspace?>)) + " MB space left with the client!!!");
							f.hdspace.value = "<?=$numDomainDiskspace?>"
							f.hdspace.focus();
							return false;
						}
			   }


		if(parseInt(<?=$numEmailalias?>) != -1)
			   {
					if(parseInt(totalAlias) > parseInt(<?=$numEmailalias?>))
						{
							alert("There are only " + (parseInt(<?=$numEmailalias?>) - parseInt(<?=$usedEmailalias?>)) + " email alias ccounts free!!!");
							f.emailalias.value = "<?=$numDomainEmailalias?>"
							f.emailalias.focus();
							return false;
						}
			   }
		
		if(parseInt(<?=$numTraffic?>) != -1)
			   {
					if(parseInt(totalTraffic) > parseInt(<?=$numTraffic?>))
						{
							alert("There is only " + (parseInt(<?=$numTraffic?>) - parseInt(<?=$usedTraffic?>)) + " MB traffic left!!!");
							f.trafficport.value = "<?=$numDomainTraffic?>"
							f.trafficport.focus();
							return false;
						}
			   }
		
		if(parseInt(<?=$domainUsedMailAccount?>) > parseInt(f.popmailaccount.value))
			{
				alert("Domain has used " + "<?=$domainUsedMailAccount?>" + " mail accounts.\nYou can not assign value less than " +  "<?=$domainUsedMailAccount?>");
				f.popmailaccount.value = "<?=$domainUsedMailAccount?>";
				f.popmailaccount.focus();
				return false;
			}

		if(parseInt(<?=$domainUsedSqlDatabase?>) > parseInt(f.mysqldatabase.value))
			{
				alert("Domain has used " + "<?=$domainUsedSqlDatabase?>" + " Database accounts.\nYou can not assign value less than " +  "<?=$domainUsedSqlDatabase?>");
				f.mysqldatabase.value = "<?=$domainUsedSqlDatabase?>";
				f.mysqldatabase.focus();
				return false;
			}

	
		if(parseInt(<?=$domainUsedMailAlias?>) > parseInt(f.emailalias.value))
			{
				alert("Domain has used " + "<?=$domainUsedMailAlias?>" + " Mail Alias accounts.\nYou can not assign value less than " +  "<?=$domainUsedMailAlias?>");
				f.emailalias.value = "<?=$domainUsedMailAlias?>";
				f.emailalias.focus();
				return false;
			}



		if(!f.popmailaccount.value)
				{
					f.popmailaccount.value="0";
					return true;
				}
				
		if(!f.subdomains.value)
				{
					f.subdomains.value="0";
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


//-----------------------------------
function chk_form_data1(f)
{
	if(!chk(f))
	   return false
	f.submit();
	return true;
}

function chk_form_data(f)
	{
		return true;
	}

function setFocus()
{
	if (document.forms[0].domain_name)
		document.forms[0].domain_name.focus();
}


</script>	
