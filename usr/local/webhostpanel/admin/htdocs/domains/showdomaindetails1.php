<?$ACCESS_LEVEL=3?>
<?include "../inc/connection.php"?>
<?include "../inc/params.php"?>
<?include "../inc/functions.php"?>
<?include "../inc/security.php"?>
<html>
<head>
<title>Domain Information</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head><link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/general.css">
<link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/custom.css">
<link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/layout.css">
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=ISO-8859-1">
<META HTTP-EQUIV="EXPIRES" CONTENT="0">
</head>
<body leftmargin=0 topmargin=0>
<?include "../inc/mainheader.php"?>
<?
	if((strtoupper($_SESSION["type"])) !="D")
		{
			include "../clients/clientheader.php";
		}
?>
<?include "../domains/domainheader.php";?>
<?
	$domainid=$_SESSION["domainid"];
	$domainname=$_SESSION["domainname"];
	$username=$_SESSION["clientname"];
	$reselid=$_SESSION["clientid"];

	$query="select hosting from tbldomain where domainid=$domainid";
	$array=mysql_query($query) or die(errorCatch(mysql_error()));
	$domainset=@mysql_fetch_array($array);
	$hosting=$domainset["hosting"];
	
	$query="select status from tblloginmaster where typeid=$domainid and usertype='d'";
	$array1=mysql_query($query) or die(errorCatch(mysql_error()));
	$loginset=@mysql_fetch_array($array1);
	$blockstatus=$loginset["status"];

	if($hosting=='N' && $blockstatus=='1')
		{	
			echo "<center><h4><br>Domain <font color=\"red\">".$domainname." </font>hosting not configured</h4></center>";
			echo "<center><br>Click the link to configure domain <a href=\"../domains/newdomain.php?domainid=".$domainid."\" style=\"text-decoration:none\">Configure Domain</a></center>";
			echo "<br><center><a href=\"javascript:history.go(-2)\"><img src=\"../Icons/btn_backup_bg.gif\" border=\"0\" alt=\"Back\">Back</a></center>";
		}
	else if($hosting=='N' && $blockstatus=='0')
		{	
			echo "<center><h4><br>Domain <font color=\"red\">".$domainname." </font>hosting not configured</h4></center>";
			echo "<center><br>Domain is blocked you can't configure it without unblocking it</center>";
			echo "<br><center><a href=\"javascript:history.go(-2)\"><img src=\"../Icons/btn_backup_bg.gif\" border=\"0\" alt=\"Back\">Back</a></center>";
		}
	else
		{
?>
<!--<table width="61%" border="0" align="center" cellspacing="0" cellpadding="0">
  <?
	if(strtoupper($_SESSION["type"])=="A")
		{
?>
  <tr> 
    <td align="left" class="navigation">Administrator &gt; <?=$_SESSION["clientname"]?> &gt; <?=$_SESSION["domainname"]?> &gt; Domain Details</td>
  </tr>
  <?
		}
	elseif(strtoupper($_SESSION["type"])=="C")
		{
?>
  <tr> 
    <td align="left" class="navigation"><?=$_SESSION["clientname"]?> &gt; <?=$_SESSION["domainname"]?> &gt; Domain Details</td>
  </tr>
  <?
		}
	elseif(strtoupper($_SESSION["type"])=="D")
		{
?>
  <tr> 
    <td align="left" class="navigation"><?=$_SESSION["domainname"]?> &gt; Domain Details </td>
  </tr>
  <?
		}
?>
  <tr> 
    <td>&nbsp;</td>
  </tr>
</table>-->
<table width=713 border=0 cellpadding=0 cellspacing=0 align="center">
  <tr>
    <td width="713"> <table width="665" border=0 align="left" cellpadding=0 cellspacing=0>
        <tr> 
          <td width=3></td>
          <td width=436></img></td>
          <td width=7>&nbsp;</td>
          <?if(strtoupper($_SESSION["type"])!="D")
					{	
			?>
          <td width="226" align="right" class="verttop"><input name="upButton" type="button" class="commonbutton" id="button" onClick="window.location='../domains/clientdomains.php'" value="Up Level" > 
            <div align="right"><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="3" height="1" border="0"></div></td>
          <?
					}
			?>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td colspan=5><div align="center"><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="1" height="16" border="0"><img src="/skins/<?=$_SESSION["skin"]?>/elements/line.gif" width=560 height=1 border=0>	
      </div></td>
  </tr>
  <tr> 
    <td colspan=5> <table width="84%" border=0 cellpadding=0 cellspacing=0 align="center">
        <?
    
    $query="select domainname from tbldomain where domainid=$domainid";
	//myLog($query);
	$array=mysql_query($query) or die(errorCatch(mysql_error()));
	$domainset=@mysql_fetch_array($array);
	$domainname=$domainset["domainname"];
?>
        <tr> 
          <td width="47%" align="right" class="headings">Domain name </td>
          <td width="7%" align="center"></td>
          <td width="46%" align="left"><font color="#FF0000"><b> 
            <?=$domainname?>
            </font></td>
        </tr>
        <tr> 
          <td class="headings"><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="1" height="8" border="0"> 
          </td>
        </tr>
        <tr> 
          <td width="47%" align="right" class="headings">Assigned IP </td>
          <td class="headings">&nbsp; </td>
          <?
//-------------------------------------------------------------------------------------------------------
//here we show only the ipaddress assigned to the reseller
$query="select tblserverip.ipaddress,tblserverip.iptype,tblserverip.id from (tbldomain inner join tblserverip on tbldomain.ipaddress=tblserverip.id) where tbldomain.resellerid=$reselid";
//myLog($query);
$array=mysql_query($query) or die(errorCatch(mysql_error()));
$result=mysql_fetch_array($array);
?>
          <td width="46%" align="left"> <font color="#FF0000"> 
            <?=$result["ipaddress"]." -> " . $result["iptype"]?>
            </font></td>
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
          <td colspan=3><table width="100%" border=0 align="center" cellpadding=0 cellspacing=0>
              <tr> 
                <td width="47%" align="right" class="headings">Contact name:</strong></font></td>
                <td width="7%" align="center"><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="7" height="1" border="0"></td>
                <td width="46%" align="left"><font color="#FF0000"> 
                  <?=$domaincontact->contactname?>
                  </font></td>
              </tr>
              <tr> 
                <td><font color="#003366"><strong><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="1" height="8" border="0"></strong></font></td>
              </tr>
              <tr> 
                <td align="right" class="headings">FTP Username </td>
                <td align="center">&nbsp;</td>
                <td align="left"><font color="#FF0000"> 
                  <?=$domainftp->ftpusername?>
                  </font></td>
              </tr>
              <tr> 
                <td><font color="#003366"><strong><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="1" height="8" border="0"></strong></font></td>
              </tr>
              <tr> 
                <td align="right" class="headings">FTP User Password </td>
                <td align="center">&nbsp;</td>
                <td align="left"><font color="#FF0000"> 
                  <?=$domainftp->ftppassword?>
                  </font></td>
              </tr>
              <tr> 
                <td><font color="#003366"><strong><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="1" height="8" border="0"></strong></font></td>
              </tr>
              <tr> 
                <td align="right" class="headings">Company name: </td>
                <td align="center"><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="7" height="1" border="0"></td>
                <td align="left"><font color="#FF0000"> 
                  <?=$domaincontact->companyname?>
                  </font></td>
              </tr>
              <tr> 
                <td><font color="#003366"><strong><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="1" height="8" border="0"></strong></font></td>
              </tr>
              <tr> 
                <td align="right" class="headings">Number of SubDomains: </td>
                <td align="center">&nbsp;</td>
                <td align="left"><font color="#FF0000"> 
                  <?=$domainrights->subdomains?>
                  </font></td>
              </tr>
              <tr> 
                <td><font color="#003366"><strong><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="1" height="8" border="0"></strong></font></td>
              </tr>
              <tr> 
                <td align="right" class="headings">Pop mail Account: </td>
                <td align="center">&nbsp;</td>
                <td align="left"><font color="#FF0000"> 
                  <?=$domainrights->popmailaccount?>
                  </font></td>
              </tr>
              <tr> 
                <td><font color="#003366"><strong><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="1" height="8" border="0"></strong></font></td>
              </tr>
              <tr> 
                <td align="right" class="headings">Email aliases: </td>
                <td align="center">&nbsp;</td>
                <td align="left"><font color="#FF0000"> 
                  <?=$domainrights->emailalias?>
                  </font></td>
              </tr>
              <tr> 
                <td><font color="#003366"><strong><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="1" height="8" border="0"></strong></font></td>
              </tr>
              <tr> 
                <td align="right" class="headings">MySql Database: </td>
                <td align="center">&nbsp;</td>
                <td align="left"><font color="#FF0000"> 
                  <?=$domainrights->sqldatabase?>
                  </font></td>
              </tr>
              <tr> 
                <td><font color="#003366"><strong><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="1" height="8" border="0"></strong></font></td>
              </tr>
              <tr> 
                <td align="right" class="headings">Traffic: </td>
                <td align="center">&nbsp;</td>
                <td align="left"><div  class="headings"><font color="#FF0000"> 
                    <?=$domainrights->traffic?>
                    </font> MB </div></td>
              </tr>
              <tr> 
                <td class="headings"><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="1" height="8" border="0"> 
                </td>
              </tr>
              <tr> 
                <td align="right" class="headings">Password Protect: </td>
                <td align="center"><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="7" height="1" border="0"></td>
                <td align="left"><font color="#FF0000"> 
                  <?=$domainrights->pwdprotectdir?>
                  </font></td>
              </tr>
              <tr> 
                <td  class="headings"><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="1" height="8" border="0"> 
                </td>
              </tr>
              <tr> 
                <td align="right" class="headings">CGI Support: </td>
                <td align="center"><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="7" height="1" border="0"></td>
                <td align="left"><font color="#FF0000"> 
                  <?=$domainrights->cgisupport?>
                  </font></td>
              </tr>
              <tr> 
                <td><font color="#003366"><strong><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="1" height="8" border="0"> 
                </td>
              </tr>
              <tr> 
                <td align="right" class="headings">Front Page Ext.: </td>
                <td align="center"><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="7" height="1" border="0"></td>
                <td align="left"><font color="#FF0000"> 
                  <?=$domainrights->frontpageext?>
                  </font></td>
              </tr>
              <tr> 
                <td><font color="#003366"><strong><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="1" height="8" border="0"></strong></font></td>
              </tr>
              <tr> 
                <td align="right" class="headings">Hard Disk Space: </td>
                <td align="center"><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="7" height="1" border="0"></td>
                <td align="left"><div  class="headings"><font color="#FF0000"> 
                    <?=$domainrights->diskspace?>
                    </font> MB </div></td>
              </tr>
              <tr> 
                <td><font color="#003366"><strong><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="1" height="8" border="0"></strong></font></td>
              </tr>
              <tr> 
                <td align="right" class="headings">Web Stats: </td>
                <td align="center"><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="7" height="1" border="0"></td>
                <td align="left"><font color="#FF0000"> 
                  <?
					 if(strtoupper($domainrights->webstart) == "Y")
						{
							echo "Y     <a href='http://" . $domainname . "/webstat' target='_blank' style='text-decoration:none'><img src='../skins/" . $_SESSION['skin'] . "/icons/stats.gif' border=0> <b>View Web Stats<b></a>";
						}
					else
						{
							echo "N";
						}
				?>
                  </font></td>
              </tr>
              <tr> 
                <td><font color="#003366"><strong><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="1" height="8" border="0"></strong></font></td>
              </tr>
              <tr> 
                <td align="right" class="headings">E-mail: </td>
                <td align="center">&nbsp;</td>
                <td align="left"><font color="#FF0000"> 
                  <?=$domaincontact->email?>
                  </font></td>
              </tr>
              <tr> 
                <td><font color="#003366"><strong><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="1" height="8" border="0"></strong></font></td>
              </tr>
              <tr> 
                <td align="right" class="headings">Phone: </td>
                <td align="center"><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="7" height="1" border="0"></td>
                <td align="left"><font color="#FF0000"> 
                  <?=$domaincontact->phone?>
                  </font></td>
              </tr>
              <tr> 
                <td><font color="#003366"><strong><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="1" height="8" border="0"></strong></font></td>
              </tr>
              <tr> 
                <td align="right" class="headings">Address: </td>
                <td align="center"><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="7" height="1" border="0"></td>
                <td align="left"><font color="#FF0000"> 
                  <?=$domaincontact->address?>
                  </font></td>
              </tr>
              <tr> 
                <td><font color="#003366"><strong><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="1" height="8" border="0"></strong></font></td>
              </tr>
              <tr> 
                <td align="right" class="headings">City: </td>
                <td align="center"><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="7" height="1" border="0"></td>
                <td align="left"><font color="#FF0000"> 
                  <?=$domaincontact->city?>
                  </font></td>
              </tr>
              <tr> 
                <td><font color="#003366"><strong><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="1" height="8" border="0"></strong></font></td>
              </tr>
              <tr> 
                <td align="right" class="headings">State/Province: </td>
                <td align="center"><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="7" height="1" border="0"></td>
                <td align="left"><font color="#FF0000"> 
                  <?=$domaincontact->state?>
                  </font></td>
              </tr>
              <tr> 
                <td><font color="#003366"><strong><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="1" height="8" border="0"></strong></font></td>
              </tr>
              <tr> 
                <td align="right" class="headings">Postal/ZIP code: </td>
                <td align="center"><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="7" height="1" border="0"></td>
                <td align="left"><font color="#FF0000"> 
                  <?=$domaincontact->zipcode?>
                  </font></td>
              </tr>
              <tr> 
                <td><font color="#003366"><strong><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="1" height="8" border="0"></strong></font></td>
              </tr>
              <tr> 
                <td align="right" class="headings">Country: </td>
                <td align="center"><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="7" height="1" border="0"></td>
                <td align="left"> <font color="#FF0000"> 
                  <?
//--------------------------------------------------------------------------------------------------
	//Here we are getting the name of the countries with there codes
    
	$query = "select * from tblcountry";
	//myLog($query);
	$array=Mysql_query($query) or die(errorCatch(mysql_error()));

					while($country=mysql_fetch_array($array, MYSQL_ASSOC))
					{
						if($country["code"]==$domaincontact->country)
						{
							echo $country["countryname"];
						}
					}
?>
                  </font></td>
              </tr>
              <tr> 
                <td><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="1" height="8" border="0"></td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td> <table width="670" border=0 align="left" cellpadding=0 cellspacing=0>
        <tr > 
          <td colspan=3 align="center"><img src="/skins/<?=$_SESSION["skin"]?>/elements/line.gif" width=560 height=1 border=0>	
          </td>
        </tr>
        <tr> 
          <td height="26" align="center"><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="3" height="1" border="0"> 
            <?		if(strtoupper($_SESSION["type"])!='D')
			{
?>
            <input type="button" class="commonButton" id="bid-update" value="Ok" onClick="history.go(-2)" > 
            <img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="3" height="1" border="0"> 
            <input name="update" type="button" class="commonButton" id="moveup" onClick="window.location='../domains/updatedomain.php'" value="Update Domain" > 
            <?
			}
?>
          </td>
        </tr>
      </table></td>
  </tr>
 
</table>
			
<?
		}
?>

<?include "../inc/footer.php"?>
