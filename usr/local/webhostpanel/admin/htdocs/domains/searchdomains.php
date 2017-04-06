<?$ACCESS_LEVEL=2;?>
<?include "../inc/connection.php"?>
<?include "../inc/params.php"?>
<?include "../inc/functions.php"?>
<?include "../inc/security.php"?>

<?
$pattern=$_POST["domainsearch"];
?>

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
  <table width="74%" border="0" align="center" cellspacing="0" cellpadding="0">
    <?
	if(strtoupper($_SESSION["type"])=="A")
		{
?>
    <tr> 
      <td align="left" class="navigation">Administrator &gt; Domain Search</td>
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
  <table width="72%" border="0" align="center">
    <tr align="left"> 
      <td colspan="8" bgcolor="#FFFFFF"><table width="100%" border="0">
          <tr> 
            <td  class="navigation"><img src="/skins/<?=$_SESSION["skin"]?>/icons/btn_domain-user_bg.gif" width="24" height="22">&nbsp;Domain 
              Listing<br> <strong><font color="#003366" size="2" face="Arial, Helvetica, sans-serif"> 
              <input name="domainsearch" type="text" id="domainsearch3" class="textboxclass">
              <font color="#FF0000"><strong>&nbsp;<font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
              <input  class="searchButton" type="button" name="Button" value="Search" onClick="searchclient()">
              &nbsp;&nbsp; 
              <input class="commonButton" type="button" name="Submit2" value="Show all" onClick="showall()">
              </font></strong></font></font></strong> </td>
            <td  class="navigation">&nbsp;</td>
            <td valign="bottom"  class="navigation"><div align="right"><font color="#400040" size="2" face="Verdana"><a href="" style="text-decoration:none"> 
                <input class="commonButton" type="button" name="Submit22" value="Remove Selected" onClick="return chk_frm(document.mainform)">
                </a></font></div></td>
          </tr>
        </table></td>
    </tr>
    <tr align="center"> 
      <th width="2%" height="27" bgcolor="#CAE1EC" class="tableheadings">P 
      <th width="2%" bgcolor="#CAE1EC" class="tableheadings">S 
      <th width="16%" bgcolor="#CAE1EC" class="tableheadings">Date
      <th width="32%" align="left" bgcolor="#FFE2C6" class="tableheadings">Domain 
        Name [Client Name] 
      <th width="10%" align="left" bgcolor="#FFE2C6" class="tableheadings"><div align="center">View 
          Site </div>
      <th width="12%" bgcolor="#CFECF1" class="tableheadings">Disk Usage 
      <th width="6%" align="center" bgcolor="#CFECF1" class="tableheadings">Traffic 
      <th width="20%" bgcolor="#CFECF1" class="tableheadings"> <a href="javascript:invertChecked()" style="text-decoration:none">Sel</a> 
    </tr>
    <?
@mysql_free_result($numclients);
//$reselid=$_SESSION["clientid"];
//echo $DomainDir . $domains->domainname)/1024 . " MB";

$arraydomain=search("tbldomain","domainname",$pattern);
$numdomains=mysql_num_rows($arraydomain);

if($numdomains!=0)
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
?>
    <tr align="center" bgcolor="<?=$bgcol?>"> 
      <td><font color="#000000" size="1"><a href="resetpassword.php?domainid=<?=$domains->domainid?>&usertype=d"><img src="/skins/<?=$_SESSION["skin"]?>/icons/ok1.gif" width="16" height="16" border="0"></a></font></td>
      <td><font color="#000000" size="1"><img src="/skins/<?=$_SESSION["skin"]?>/icons/on1.gif" width="16" height="16"></font></td>
      <td><font color="#000000" size="1"> 
        <?=$regdate?>
        </font></td>
      <td align="left"><a href="../domains/setdomainid.php?domainid=<?=$domains->domainid?>&code=NO" style="text-decoration:none"><font size="1"> 
        <?=$domains->domainname?>
        <font size="1"><b> 
        <?="  [".$resellername."]"?>
        </b></font></font></a></td>
      <td class="clientheading"><a href="http://<?=$domains->domainname?>/" target="_blank"><img src="/skins/<?=$_SESSION["skin"]?>/icons/buttongo.gif"  border="0" width="16" height="16"></a><font color="#000000" size="1">&nbsp; 
        </font></td>
      <td><font color="#000000" size="1"> 
        <?
	$HomeDir=$DomainDir . $domains->domainname;
?>
        <?= GetDomainSpace($HomeDir) ?>
        </font></td>
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
					$DomainTraffic = ($DomainTraffic)/1024 . " MB"; 
				}
			else
				{
					$DomainTraffic = $DomainTraffic . " KB"; 
				}
			//echo "The domain traffic is " . $DomainTraffic;
		}
?>
      <td align="center" class="clientheading"> 
        <?=$DomainTraffic?>
      </td>
      <td><font color="#000000" size="1"> 
        <input type="checkbox" name="deletedomains[]" value="<?=$domains->domainid?>">
        </font></tr>
    <?
			}}
else
	{?>
    <tr> 
      <td colspan="7"> <font color="red">Sorry no Domains to show</font> </td>
    </tr>
    <? } ?>
  </table>
</form>
</body>
</html>
<br><br>
<? include "../inc/footer.php" ?>