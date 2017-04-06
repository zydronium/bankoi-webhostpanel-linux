<?$ACCESS_LEVEL=2;?>
<?include "../inc/connection.php"?>
<?include "../inc/params.php"?>
<?include "../inc/functions.php"?>
<?include "../inc/security.php"?>
<html>
<head>
<title>Domains Listing</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head><link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/general.css">
<link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/custom.css">
<link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/layout.css">
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=ISO-8859-1">
<META HTTP-EQUIV="EXPIRES" CONTENT="0">
</head>

<?
$pattern=$_POST["clientdomainsearch"];
myLog($pattern);
?>

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
					//f.action="../domains/clientdomains.php";
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
	document.mainform.action="searchclientdomains.php";
	document.mainform.submit();
	}		
	function showall()
	{
	document.mainform.action="clientdomains.php";
	document.mainform.submit();
	}
			
</script>

<body leftmargin=0 topmargin=0>
<?include "../inc/mainheader.php"?>
<?include "../clients/clientheader.php"?>
<form name="mainform" action="searchclientdomains.php" method="post">
  <table width="72%" border="0" align="center" cellspacing="0" cellpadding="0">
    <?
	if(strtoupper($_SESSION["type"])=="A")
		{
?>
    <tr> 
      <td align="left" class="navigation">Administrator &gt; 
        <?=$_SESSION["clientname"]?>
        &gt;Client Domain Listing</td>
    </tr>
    <?
		}
	elseif(strtoupper($_SESSION["type"])=="C")
		{
?>
    <tr> 
      <td align="left" class="navigation"> 
        <?=$_SESSION["clientname"]?>
        &gt; Client Domain Listing</td>
    </tr>
    <?
		}
	elseif(strtoupper($_SESSION["type"])=="D")
		{
?>
    <tr> 
      <td align="left" class="navigation">&nbsp; </td>
    </tr>
    <?
		}
?>
    <tr> 
      <td>&nbsp;</td>
    </tr>
  </table>

  <table width="72%" border="0" align="center">
    <?
@mysql_free_result($numclients);
$reselid=$_SESSION["clientid"];
$resellername=$_SESSION["clientname"];
$DomainDir = $sHostingDir . "/" .$resellername . "/";
$pattern="%".$pattern."%";
$query="select * from tbldomain where resellerid=$reselid and domainname like '$pattern' order by domainname";
//myLog($query);
$arraydomain=mysql_query($query) or die(errorCatch(mysql_error()));
$numdomains=mysql_num_rows($arraydomain);
if($numdomains==0)
	{
?>
    <center>
      <hr>
      <tr align="center"> 
        <td colspan="10"><font size="5" color="red">Sorry no Domains to show</font><br> 
          <br></td>
      </tr>
      <tr align="center"> 
        <td colspan="10"  class="navigation"> 
          <?
		if(strtoupper($_SESSION["type"])=="A")
			{
?>
          <a href="clientdomains.php"><img src="/skins/<?=$_SESSION["skin"]?>/icons/btn_backup_bg.gif" border="0" alt="Back">Back</a> 
          <?
			}
		elseif(strtoupper($_SESSION["type"])=="C")
			{
?>
          <a href="../domains/clientdomains.php"><img src="/skins/<?=$_SESSION["skin"]?>/icons/btn_backup_bg.gif" border="0" alt="Back">Back</a> 
          <?
			}
?>
        </td>
      </tr>
    </center>
    <? include "../inc/footer.php" ?>
    <?
die();}
else
	{
		$count=1;
?>
    <tr align="left"> 
      <td colspan="10" bgcolor="#FFFFFF"   class="navigation"><img src="/skins/<?=$_SESSION["skin"]?>/icons/btn_domain-user_bg.gif" width="24" height="22">&nbsp;&nbsp;Domain 
        Listing for client <font color="Red"> 
        <?=$_SESSION["clientname"]?>
        </font> <table width="33%" border="0" align="right">
          <tr> 
            <td align="right" valign="middle"><input class="commonButton" type="button" name="Submit22" value="Remove Selected" onClick="return chk_frm(document.mainform)"></td>
          </tr>
        </table>
        <br> <strong><font color="#003366" size="2" face="Arial, Helvetica, sans-serif"> 
        <input name="clientdomainsearch" type="text" id="clientsearch2"  class="textboxclass">
        <font color="#FF0000"><strong><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
<input  class="searchButton" type="button" name="Button" value="Search" onClick="searchclient()">
        <input class="commonButton" type="button" name="Submit2" value="Show all" onClick="showall()">
        </font></strong></font></font></strong> </td>
    </tr>
    <tr align="center" valign="middle"> 
      <th width="2%" height="24" bgcolor="#CAE1EC" class="tableheadings">P 
      <th width="2%" bgcolor="#CAE1EC" class="tableheadings">S 
      <th width="2%" bgcolor="#CAE1EC" class="tableheadings">H 
      <th width="11%" bgcolor="#CAE1EC" class="tableheadings">Date 
      <th width="40%" align="left" bgcolor="#FFE2C6"  class="tableheadings">Domain 
        Name 
      <th width="11%" align="left"  bgcolor="#CFECF1"><div align="center" class="tableheadings">View 
          Site</div>
      <th width="9%" align="center" bgcolor="#CFECF1" class="tableheadings">Traffic 
      <th colspan="2" bgcolor="#CFECF1" class="tableheadings">Disk Usage 
      <th width="9%" bgcolor="#CFECF1" class="tableheadings"><strong> <a href="javascript:invertChecked()" style="text-decoration:none">Sel</a></strong> 
    </tr>
    <?
		while($domains=@mysql_fetch_object($arraydomain))
			{
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
				   
				   
				    $query="select * from tblloginmaster where Ucase(usertype)='D' and typeid=$domains->domainid";
				    $resultset=mysql_query($query) or die(errorCatch(mysql_error()));
					$Statusarr=mysql_fetch_array($resultset);
					$status=$Statusarr["status"];			   
				   
				   if($status==1)
						{
							$pic1="/skins/" . $_SESSION["skin"]. "/icons/on1.gif";
							$mode=0;
							$tip1="Hosting Status UP";
						}
						
					else 
						{
							$pic1="/skins/" . $_SESSION["skin"] . "/icons/block1.gif";
							$mode=1;
							$tip1="Hosting Blocked";
						}
?>
    <tr align="center" valign="middle" > 
      <td><font color="#000000" size="1"><a href="resetpassword.php?domainid=<?=$domains->domainid?>&usertype=d"><img src="/skins/<?=$_SESSION["skin"]?>/icons/ok1.gif" width="16" height="16" border="0"></a></font></td>
      <td><font color="#000000" size="1"><img src="/skins/<?=$_SESSION["skin"]?>/icons/on1.gif" width="16" height="16"></font></td>
      <td><img src="<?=$pic1?>" alt="<?=$tip1?>" width="16" height="16" border="0"></td>
      <td><font color="#000000" size="1"> 
        <?=$regdate?>
        </font></td>
      <td align="left"><a href="setdomainid.php?domainid=<?=$domains->domainid?>" style="text-decoration:none"><font size="1"> 
        <?=$domains->domainname?>
        </font></a></td>
      <td align="left"><div align="center"><a href="http://<?=$domains->domainname?>/" target="_blank"><img src="/skins/<?=$_SESSION["skin"]?>/icons/buttongo.gif"  border="0" width="16" height="16"></a></div>
        </td>
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
      <td colspan="2"><font color="#000000" size="1"> 
        <?
	$HomeDir=$DomainDir . $domains->domainname;
?>
        <?= GetDomainSpace($HomeDir) ?>
        </font></td>
      <td><font color="#000000" size="1"> 
        <input type="checkbox" name="deletedomains[]" value="<?=$domains->domainid?>">
        </font></td>
    </tr>
    <?
			}}
?>

    <tr align="center"> 
      <?
		if(strtoupper($_SESSION["type"])=="A")
			{
?>
      <td colspan="9"  class="navigation"> <a href="clientdomains.php"><img src="/skins/<?=$_SESSION["skin"]?>/icons/btn_backup_bg.gif" border="0" alt="Back">Back</a></td>
      <?
			}
		elseif(strtoupper($_SESSION["type"])=="C")
			{
?>
      <td colspan="7"  class="navigation"> <a href="../domains/clientdomains.php"><img src="../skins/<?=$_SESSION["skin"]?>/icons/btn_backup_bg.gif" border="0" alt="Back">Back</a></td>
      <?
			}
?>
    </tr>
  </table>
</form>
</body>
</html>
<br>
<? include "../inc/footer.php" ?>