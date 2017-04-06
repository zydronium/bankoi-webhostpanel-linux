<?$ACCESS_LEVEL=2;?>
<?include "../inc/connection.php"?>
<?include "../inc/params.php"?>
<?include "../inc/functions.php"?>
<?include "../inc/security.php"?>

<html>
<head>
<title>All Domain Listing</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head><link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/general.css">
<link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/custom.css">
<link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/layout.css">
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=ISO-8859-1">
<META HTTP-EQUIV="EXPIRES" CONTENT="0">
</head>
<script>
function invertChecked()
			{
				f = document.mainform;
				for (i = 0 ; i < f.elements.length; i++) {
					if ((f.elements[i].type == "checkbox") && (f.elements[i].name.indexOf("deletedomains")==0)) {
						if (f.elements[i].checked || (f.elements[i].value == "DISABLED") || f.elements[i].disabled) {
							f.elements[i].checked = false;
						} else {
							f.elements[i].checked = true;
						}
					}
				}
			}
function chk_frm(f)
			{
				var counter;
				counter=0;
				for (i = 0 ; i < f.elements.length; i++) 
					{
					if ((f.elements[i].type == "checkbox") && (f.elements[i].name.indexOf("deletedomains")==0)) 
						{
						if (f.elements[i].checked) 
							{
								counter=counter+1;
							}
						}
					}
					//alert();
				if(counter==0)
				{
					alert("No domains to delete");
					//f.action="../domains/domains.php";
					//f.submit();
					return false;
				}
				else
				{
					//alert();
					f.action="../domains/deletedomain.php";
					f.submit();
					return false;
				}
				
			}
			
			
	function searchclient()
	{
	document.mainform.action="searchdomains.php";
	document.mainform.submit();
	}		
	function showall()
	{
	document.mainform.action="domains.php";
	document.mainform.submit();
	}			
			
</script>

<body leftmargin=0 topmargin=0>
<form name="mainform" action="../clients/deleteclients.php" method="post">
  <?include "../inc/mainheader.php"?>
  <table width="80%" border="0" align="center" cellspacing="0" cellpadding="0">
    <?
	if(strtoupper($_SESSION["type"])=="A")
		{
?>
    <tr> 
      <td align="left" class="navigation">Administrator &gt; All Domain Listing</td>
    </tr>
    <?
		}
	elseif(strtoupper($_SESSION["type"])=="C")
		{
?>
    <tr> 
      <td align="left" class="navigation">&nbsp;</td>
    </tr>
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
  </table>

  <table width="80%" border="0" align="center">
    <tr align="left"> 
      <td colspan="8" bgcolor="#FFFFFF"> <table width="33%" border="0" align="right">
          <tr> 
            <td width="55%" height="34" align="right" valign="middle" class="navigation"><a href="" style="text-decoration:none"><img src="../Icons/btn_delete_bg.gif" border="0" width="24" height="22" onClick="return chk_frm(document.mainform)"></a></td>
            <td width="45%" align="left" valign="middle"><a href="" style="text-decoration:none" onClick="return chk_frm(document.mainform)"><strong>Delete 
              Domains</a></td>
          </tr>
        </table>
        <table width="64%" border="0">
          <tr> 
            <td><font color="#003366" size="2" face="Arial, Helvetica, sans-serif"><strong><img src="../Icons/btn_domain-user_bg.gif" width="24" height="22"></strong>&nbsp;<strong>Domain 
              Listing</strong></font> <br> <strong><font color="#003366" size="2" face="Arial, Helvetica, sans-serif"> 
              <input name="domainsearch" type="text" id="clientsearch2" class="textboxclass">
              <font color="#FF0000"><strong>&nbsp;<font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
              <input  class="commonButton" type="button" name="Button" value="Search" onClick="searchclient()">
              &nbsp;&nbsp; 
              <input class="commonButton" type="button" name="Submit2" value="Show all" onClick="showall()">
              </font></strong></font></font></strong> </td>
          </tr>
        </table></td>
    </tr>
    <tr align="center"> 
      <td width="2%" bgcolor="#CAE1EC" class="tableheadings">P</td>
      <td width="2%" bgcolor="#CAE1EC" class="tableheadings">S</td>
      <td width="2%" bgcolor="#CAE1EC" class="tableheadings">H</td>
      <td width="42%" align="left" bgcolor="#FFE2C6" class="tableheadings">Domain 
        Name [Client Name]</td>
		<td width="13%" bgcolor="#CAE1EC" class="tableheadings">View Site</td>
      <td width="18%" align="center" bgcolor="#CFECF1" class="tableheadings">Creation 
        Date</td>
      <td width="11%" bgcolor="#CFECF1" class="tableheadings">Disk Usage</td>
      <td width="10%" bgcolor="#CFECF1" class="tableheadings"> <a href="javascript:invertChecked()" style="text-decoration:none">Sel</a></td>
    </tr>
    <?
@mysql_free_result($numclients);
//$reselid=$_SESSION["clientid"];
//echo $DomainDir . $domains->domainname)/1024 . " MB";


$query="select * from tbldomain order by domainname";
//myLog($query);
$arraydomain=mysql_query($query) or die(errorCatch(mysql_error()));
$numdomains=mysql_num_rows($arraydomain);
if($numdomains==0)
	{?>
    <font color="red">Sorry no Domains to show</font> 
    <?}
else
	{
		$count=1;
		while($domains=@mysql_fetch_object($arraydomain))
			{
				$reselid=$domains->resellerid;
				
				$query="select resellername from tblreseller where resellerid=$reselid";
				//myLog($query);
				$reselarr=mysql_query($query) or die(errorCatch(mysql_error()));
				$reselname=mysql_fetch_array($reselarr);
				$resellername=$reselname["resellername"];

				//This query gets the creation date for the domain
				$query="select regdate from tblloginmaster where ucase(usertype)=ucase('d') and typeid='$domains->domainid'";
				//myLog($query);
				$array=mysql_query($query) or die(errorCatch(mysql_error()));
				$dt=mysql_fetch_array($array);
				
				$regdate=$dt["regdate"];
				if($count % 2==0)
				   {
						$bgcol="#F4F3FE";
						$count=$count+1;
				   }
				else
				   {
						$bgcol="";
						$count=$count+1;
				   }
				    $DomainDir = $sHostingDir . "/" .$resellername . "/";
					$HomeDir=$DomainDir . $domains->domainname;
					$query="select * from tblloginmaster where Ucase(usertype)='D' and typeid=$domains->domainid";
					//echo $query;
					$resultset=mysql_query($query) or die(errorCatch(mysql_error()));
					$Statusarr=mysql_fetch_array($resultset);
					$status=$Statusarr["status"];
					
					$query="select hosting from tbldomain where domainid=$domains->domainid";
					$resulthosting=mysql_query($query) or die(errorCatch(mysql_error()));
					$HostingArr=mysql_fetch_array($resulthosting);
					$HostingVal=$HostingArr["hosting"];
					
  				    if(GetDomainSpace($HomeDir)!="" || strtoupper($HostingVal) == "Y")
						{
							$pic="/skins/" . $_SESSION["skin"] . "/icons/on.gif";
							$tip="Hosting Configured";
						}
					else
						{
							$pic="/skins/" . $_SESSION["skin"] . "/icons/off.gif";
							$tip="Hosting Not Configured";
						}
					


					if($status==1)
						{
							$pic1="/skins/" . $_SESSION["skin"] . "/icons/on.gif";
							$mode=0;
							$tip1="Hosting Status UP";
						}
					else 
						{
							$pic1="/skins/" . $_SESSION["skin"] . "/icons/block.gif";
							$mode=1;
							$tip1="Hosting Blocked";
						}
				
?>
    <tr align="center" bgcolor="<?=$bgcol?>"> 
      <td class="clientheading"><a href="resetpassword.php?domainid=<?=$domains->domainid?>&usertype=d&name=<?=$domains->domainname?>"><img src="/skins/<?=$_SESSION["skin"]?>/icons/ok.gif" width="16" height="16" border="0" alt="Reset Password"></a></td>
      <td class="clientheading"><a href="blockhosting.php?domainid=<?=$domains->domainid?>&mode=<?=$mode?>"><img src="<?=$pic1?>" width="16" height="16" alt="<?=$tip1?>" border="0"></a></td>
      
      <td class="clientheading"><img src="<?=$pic?>" alt="<?=$tip?>" width="16" height="16" border="0"></td>
      <td align="left" class="clientheading" onmouseover="bgColor='#DDDDDD'" onmouseout="bgColor='<?=$bgcol?>'"><a href="../domains/setdomainid.php?domainid=<?=$domains->domainid?>&code=NO" style="text-decoration:none"><font size="1"> 
        <?=$domains->domainname?><b>
        <?="  [".$resellername."]"?>
        </a></td><td class="clientheading"><a href="http://<?=$domains->domainname?>/" target="_blank"><img src="/skins/<?=$_SESSION["skin"]?>/icons/buttongo.gif"  border="0" width="16" height="16"></a></td>
      <td align="center" class="clientheading"> 
        <?=$regdate?></font>
        </td>
      <td class="clientheading"> 
        <?
	$HomeDir=$DomainDir . $domains->domainname;
	if(($space=GetDomainSpace($HomeDir))=="")
		{
			$space="--";
		}
?>
        <?= $space?></font>
        </td>
      <td class="clientheading"><input type="checkbox" name="deletedomains[]" value="<?=$domains->domainid?>"> 
    </tr>
    <?
			}}
?>
  </table>
</form>
</body>
</html>
<br><br>
<? include "../inc/footer.php" ?>