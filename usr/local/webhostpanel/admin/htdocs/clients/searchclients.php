<?$ACCESS_LEVEL=1;?>
<?
include "../inc/connection.php";
include "../inc/params.php";
include "../inc/functions.php";
include "../inc/security.php";
include "../inc/constants.php";
?>

<?
$pattern=$_POST["clientsearch"];
//myLog($pattern);
?>

<html>
<head>
<title>Clients Listing</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head><link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/general.css">
<link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/custom.css">
<link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/layout.css">
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=ISO-8859-1">
<META HTTP-EQUIV="EXPIRES" CONTENT="0">
<script>
function invertChecked()
			{
				f = document.mainform;
				for (i = 0 ; i < f.elements.length; i++) {
					if ((f.elements[i].type == "checkbox") && (f.elements[i].name.indexOf("delclients")==0)) {
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
					if ((f.elements[i].type == "checkbox") && (f.elements[i].name.indexOf("delclients")==0)) 
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
					alert("No clients to delete");
					//f.action="../clients/clients.php";
					//f.submit();
					return false;
				}
				else
				{
					//alert();
					f.action="../clients/deleteclients.php";
					f.submit();
					return false;
				}
				
			}

	function search()
	{
	document.mainform.action="searchclients.php";
	document.mainform.submit();
	}		
	function showall()
	{
	document.mainform.action="clients.php";
	document.mainform.submit();
	}	
</script>
</head>
<body leftmargin=0 topmargin=0>
<form name="mainform" action="searchclients.php" method="post"> 
<?include "../inc/mainheader.php"?>
<table width="72%" border="0" align="center" cellpadding="0" cellspacing="0" >
  <?
	if(strtoupper($_SESSION["type"])=="A")
		{
?>
  <tr> 
    <td width="54%" align="left"  class="navigation">Administrator&gt;Clients 
      Search</td>
    <td width="46%" align="right" ></td>
  </tr>
  <?
		}
	elseif(strtoupper($_SESSION["type"])=="C")
		{
?>
  <tr> 
    <td width="54%" align="left" class="navigation">&nbsp;</td>
    <td width="46%" align="right"class="navigation"></td>
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
    <td colspan="2">&nbsp;</td>
  </tr>
</table>
<?
@mysql_free_result($numclients);
$arrayclient=search("tblreseller","resellername",$pattern);
$numclients=mysql_num_rows($arrayclient);
if($numclients==0)
	{
		echo "<center><font color='red' size='4' face='Verdana'>Sorry no client to show</font><br><br><input name='clientsearch' type='text' id='clientsearch' class='textboxclass'>&nbsp;<input  class='searchButton' type='submit' name='Submit' value='Search' onClick='search()'>&nbsp;<input class='commonButton' type='submit' name='Submit2' value='Show All' onClick='showall()'><br><br></center>";
		include "../inc/footer.php";
		die();
	}
else
	{
?>
<table width="72%" border="0" align="center">
  <tr align="left" valign="top"> 
    <td colspan="8" bgcolor="#FFFFFF" class="navigation"><img src="../skins/<?=$_SESSION["skin"]?>/icons/btn_client-templates_bg.gif" width="24" height="22">Client 
      Listing 
      <table width="33%" border="0" align="right">
        <tr> 
          <td align="right" valign="middle" class="headings"><input class="commonButton" type="button" name="Submit22" value="Remove Selected" onClick="return chk_frm(document.mainform)"></td>
        </tr>
      </table>
      <strong><font color="#003366" size="2" face="Arial, Helvetica, sans-serif"><br>
      </font></strong> <input name="clientsearch" type="text" id="clientsearch3" class="textboxclass"> 
      &nbsp; <input  class="searchButton" type="submit" name="Submit" value="Search" onClick="search()">
      <input class="commonButton" type="submit" name="Submit2" value="Show all" onClick="showall()"> 
      &nbsp;&nbsp;<font size="2" face="Verdana, Arial, Helvetica, sans-serif">&nbsp; 
      </font> </td>
  </tr>
  <tr align="center"> 
    <th width="2%" height="21" valign="middle" bgcolor="#CAE1EC" class="tableheadings">P 
    <th width="2%" valign="middle" bgcolor="#CAE1EC" class="tableheadings">S 
    <th width="10%" valign="middle" bgcolor="#CAE1EC" class="tableheadings">Date 
    <th width="35%" align="left" bgcolor="#FFE2C6" class="tableheadings">Client Name 
    <th width="15%" align="left" bgcolor="#CFECF1" class="tableheadings">Company Name 
    <th width="15%" bgcolor="#CFECF1" class="tableheadings">Domains 
    <th width="11%" bgcolor="#CFECF1" class="tableheadings">Traffic 
    <th width="2%" bgcolor="#CFECF1" class="headings"> <a href="javascript:invertChecked()" style="text-decoration:none">Sel</a></tr>
  <?

		$count=1;
		while($clients=@mysql_fetch_object($arrayclient))
			{
				//This query gets the total number of clients for the selected client
				$query="select * from tbldomain where resellerid=$clients->resellerid";
				//myLog($query);
				$array=mysql_query($query) or die(errorCatch(mysql_error()));
				$numdomains=0;
				$numdomains=mysql_num_rows($array);
				//echo "The domain count is ".$numdomains;

				//This query gets the company name from the tblclientcontact for the selected client
				$query="select companyname from tblclientcontact where resellerid='$clients->resellerid'";
				//myLog($query);
				$array=mysql_query($query) or die(errorCatch(mysql_error()));
				$company=mysql_fetch_array($array);
				$companyname=$company["companyname"];

				//This query gets the creation date for the selected client
				$query="select regdate from tblloginmaster where ucase(usertype)=ucase('c') and typeid='$clients->resellerid'";
				//myLog($query);
				$array=mysql_query($query) or die(errorCatch(mysql_error()));
				$dt=mysql_fetch_array($array);
				$regdate=$dt["regdate"];
				
				if($count % 2==0)
				   {
						$bgcol="#F9F2E3";
						$count=$count+1;
				   }
				else
				   {
						$bgcol="";
						$count=$count+1;
				   }
?>
  <tr align="center"  height="1" > 
    <td class="clientheading"><a href="resetpassword.php?clid=<?=$clients->resellerid?>&usertype=c"><img src="../skins/<?=$_SESSION["skin"]?>/icons/ok1.gif" width="16" height="16" border="0"></a> 
    </td>
    <td class="clientheading"><img src="../skins/<?=$_SESSION["skin"]?>/icons/on1.gif" width="16" height="16"> 
    </td>
    <td class="clientheading"> 
      <?=$regdate?>
    </td>
    <td align="left" class="clientheading"><a href="../clients/choose.php?clid=<?=$clients->resellerid?>" style="text-decoration:none"> 
      <?=$clients->resellername?>
      </a> </td>
    <td align="left" class="clientheading"> 
      <?=$companyname?>
    </td>
    <td class="clientheading"> 
      <?=$numdomains?>
    </td>
    <?
	$TotalTraffic=0;
	$query = "select tbldomain.domainname from (tblreseller inner join tbldomain on tblreseller.resellerid = tbldomain.resellerid) where tblreseller.resellername ='$clients->resellername'";
	//echo $query;
	$ClientDomain = @mysql_query($query);
	$mnth = date('M');
	$yer = date('Y');
	if(@mysql_num_rows($ClientDomain) == 0)
		{
			
		}
	else
		{
			//--------------------------------------------------------------------------------------------------------
			while($DomainNm = mysql_fetch_object($ClientDomain))
				{
					$InterDomainName = $DomainNm->domainname;
					$query = "Select traffic from monthly_traffic where mnt ='$mnth' and yr='$yer' and domainname ='$InterDomainName'";
					//echo "<br>Domain Query " . $query;
					$rest = @mysql_query($query); 
					$getRest = @mysql_fetch_array($rest);
					//echo "The number of rows " . @mysql_num_rows($rest);
					if(@mysql_num_rows($rest) == "0")
						{
							$DomainTraffic = "--";
						}
					else
						{
							
							$DomainTraffic = $getRest["traffic"];
							//echo "<br>Doamin Traffic is = " . $DomainTraffic;
						}
					//Adding the traffic to the total traffic		
					if($DomainTraffic != "--")
						{
							$TotalTraffic = $TotalTraffic + $DomainTraffic;
							//echo "<br>Total Traffic is = " . $TotalTraffic;
						}
				}//This is the end of while loop
			//--------------------------------------------------------------------------------------------------------
			
					
			$TotalTraffic = round(($TotalTraffic)/1024);
			if($TotalTraffic >= 1024)
				{
					$TotalTraffic = round($TotalTraffic/1024) . " MB"; 
				}
			else
				{
					$TotalTraffic = $TotalTraffic . " KB"; 
				}
		}
 ?><td class="clientheading"> <?
	if($TotalTraffic == "0")
		{
		  echo "--";
		}
	else
		{
			echo $TotalTraffic;
		}
?>
</td>
    <td width="7%" class="clientheading"><input type="checkbox" name="delclients[]" value="<?=$clients->resellerid?>"> 
    </td>
  </tr>
  <?
			}
	}

?>
</table>
<p>&nbsp;</p>
</body>
</form>
</html>
<? include "../inc/footer.php" ?>