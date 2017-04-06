<?$ACCESS_LEVEL=1;?>
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
<form name="mainform" action="searchdomains.php" method="post">
  <?include "../inc/mainheader.php"?>
  <!--<table width="73%" border="0" align="center" cellspacing="0" cellpadding="0">
<?
	$query = "select count(*) as domainNum from tblloginmaster where usertype='d'";
	$exNumDomains = @mysql_query($query);  
	$rsNumDomains = @mysql_fetch_array($exNumDomains);
	$numOfDomains = $rsNumDomains["domainNum"];
	
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
  </table>-->

  <table width="564" border="0" align="center">
    <tr align="left"> 
      <td colspan="9" bgcolor="#FFFFFF"> <table width="100%" border="0">
          <tr> 
            <td width="58%"><font color="#003366" size="2" face="Arial, Helvetica, sans-serif"> 
              <strong><img src="../Icons/btn_domain-user_bg.gif" width="24" height="22"></strong>&nbsp;<strong>Domain 
              Listing</strong></font> <br> <strong><font color="#003366" size="2" face="Arial, Helvetica, sans-serif"> 
              <!--<input name="domainsearch" type="text" id="clientsearch2" class="textboxclass">
              <font color="#FF0000"><strong>&nbsp;<font size="2" fac	e="Verdana, Arial, Helvetica, sans-serif"> 
              <input  class="searchButton" type="button" name="Button" value="Search" onClick="searchclient()">
              <input class="commonButton" type="button" name="Submit2" value="Show all" onClick="showall()">-->
              </font></strong></font></font></strong> Domains( 
              <?=$numOfDomains?>
              )</td>
            <td width="16%" valign="bottom">&nbsp;</td>
            <td width="26%" align="right" valign="bottom"><input class="commonButton" type="button" name="Submit22" value="Remove Selected" onClick="return chk_frm(document.mainform)"> 
            </td>
          </tr>
        </table></td>
    </tr>
    <tr align="center" valign="middle" bgcolor="#FFFFFF"> 
      <!--<th width="2%" height="3" class="tableheadings">P</td> -->
      <th width="2%" height="3" class="tableheadings"><font color="#333333">S</td> 
        <!--<th width="2%" height="3" class="tableheadings">H</td> -->
        </font> 
      <th width="15%" height="3" class="tableheadings"><font color="#333333">Date 
        </font> 
      <th width="37%" height="3" align="left" class="tableheadings"><font color="#333333">Domain 
        Name [Client Name]</td> </font> 
        <!--<th width="10%" height="3" class="tableheadings"><font color="#333333">View 
        Site</td> </font> 
      <th width="13%" height="3" align="center" class="tableheadings"><font color="#333333">Traffic</td> 
        </font> 
      <th width="14%" height="3" class="tableheadings"><font color="#333333">Disk 
        Usage</td> </font> -->
      <th width="5%" colspan="4" class="tableheadings"> <font color="#333333"><a href="javascript:invertChecked()" style="text-decoration:none">Sel</a></td> 
        </font></tr>
<?
@mysql_free_result($numclients);
//$reselid=$_SESSION["clientid"];
//echo $DomainDir . $domains->domainname)/1024 . " MB";


$query="select * from tbldomain order by domainname";
$arraydomain=mysql_query($query) or die(errorCatch(mysql_error()));
$numdomains=mysql_num_rows($arraydomain);
if($numdomains==0)
	{?>
    <tr> 
      <td colspan="8"><font color="red">Sorry no Domains to show</font></td>
    </tr>
    <?}
else
	{
		$count=1;
		while($domains=@mysql_fetch_object($arraydomain))
			{
				$reselid=$domains->resellerid;
				
				$query="select resellername from tblreseller where resellerid=$reselid";
				$reselarr=mysql_query($query) or die(errorCatch(mysql_error()));
				$reselname=mysql_fetch_array($reselarr);
				$resellername=$reselname["resellername"];

				//This query gets the creation date for the domain
				$query="select regdate from tblloginmaster where ucase(usertype)=ucase('d') and typeid='$domains->domainid'";
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
							$pic="/skins/" . $_SESSION["skin"] . "/icons/on1.gif";
							$tip="Hosting Configured";
						}
					else
						{
							$pic="/skins/" . $_SESSION["skin"] . "/icons/off1.gif";
							$tip="Hosting Not Configured";
						}
					


					if($status==1)
						{
							$pic1="/skins/" . $_SESSION["skin"] . "/icons/on1.gif";
							$mode=0;
							$tip1="Hosting Status UP";
						}
					else 
						{
							$pic1="/skins/" . $_SESSION["skin"] . "/icons/off1.gif";
							$mode=1;
							$tip1="Hosting Blocked";
						}
				
?>
    <tr align="center" > 
      <!-- <td class="clientheading"><a href="resetpassword.php?domainid=<?=$domains->
      domainid?>&usertype=d&name=<?=$domains->domainname?>
      "><img src="/skins/<?=$_SESSION["skin"]?>/icons/ok1.gif" width="16" height="16" border="0" alt="Reset Password"><font size="2" face="Verdana, Trebuchet MS"></a></font><font size="2" face="Verdana, Trebuchet MS"></td></font>--> 
      <td class=""><font size="2" face="Verdana, Trebuchet MS"><a href="blockhosting.php?domainid=<?=$domains->domainid?>&mode=<?=$mode?>"><img src="<?=$pic1?>"  alt="<?=$tip1?>" border="0"></a></font></td>
      <!--<td class="clientheading"><img src="<?=$pic?>" alt="<?=$tip?>" width="16" height="16" border="0"></td>-->
      <td class=""> <font size="2" face="Verdana, Trebuchet MS"> 
        <?
	  	list ($year,$month, $day) = split ('[/.-]', $regdate);
	  	$str = $month . "/" . $day . "/" . $year;	
	  ?>
        <?=$str?>
        </font></td>
      <td align="left" class=""><font size="2" face="Verdana, Trebuchet MS"><font size="2" face="Verdana, Trebuchet MS"><a href="../domains/setdomainid.php?domainid=<?=$domains->domainid?>&code=NO" style="text-decoration:none"> 
        <?=$domains->domainname?><b>
        <?="  [".$resellername."]"?>
        </a></font></td>
      <!-- <td class=""><a href="http://<?=$domains->
      domainname?>/" target="_blank"><img src="/skins/<?=$_SESSION["skin"]?>/icons/buttongo.gif"  border="0" width="16" height="16"><font size="2" face="Verdana, Trebuchet MS"></a></font><font size="2" face="Verdana, Trebuchet MS"></td></font> 
      <?
	$mnth = date('M');
	$yer = date('Y');

	$query = "Select traffic from monthly_traffic where mnt ='$mnth' and yr='$yer' and domainname ='$domains->domainname'";
	//Echo $query;
	$rest = @mysql_query($query); 
	$getRest = @mysql_fetch_array($rest);
	//echo @mysql_num_rows($rest);
	if(@mysql_num_rows($rest) == "0")
		{
			$DomainTraffic = "--";
		}
	else
		{
			$DomainTraffic = round(($getRest["traffic"])/1024);
			if($DomainTraffic > 1024)
				{
					$DomainTraffic = round($DomainTraffic/1024) . " MB"; 
				}
			else
				{
					$DomainTraffic = $DomainTraffic . " KB"; 
				}
			//echo "The domain traffic is " . $DomainTraffic;
		}
?>
      <td align="center" class="clientheading"> <font size="2" face="Verdana, Trebuchet MS"> 
        <?=$DomainTraffic?>
        </font></td>
      <td class="clientheading"> <font size="2" face="Verdana, Trebuchet MS"> 
        <?
	$HomeDir=$DomainDir . $domains->domainname;
	if(($space=GetDomainSpace($HomeDir))=="")
		{
			$space="--";
		}
?>
        <?= $space?>
        </font></td>
      --> 
      <td class="clientheading"><font size="2" face="Verdana, Trebuchet MS"> 
        <input type="checkbox" name="deletedomains[]" value="<?=$domains->domainid?>">
        </font></tr>
    <?
			}}
?>
  </table>
</form>
</body>
</html>
<br><br>
<? include "../inc/footer.php" ?>
