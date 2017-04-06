<? $ACCESS_LEVEL=1; ?>
<?
include "../inc/connection.php";
include "../inc/params.php";
include "../inc/functions.php";
include "../inc/security.php";
include "../inc/constants.php";
?>


<?
// This is code written while first time managing IP addresses
				$query="select * from tblfirsttime where status='0'";
				myLog($query);
				$arraytimes=mysql_query($query) or die(errorCatch(mysql_error()));
				$numtimes=mysql_num_rows($arraytimes);

				if($numtimes == 1) 
				{
					$outputip=`ifconfig | grep "inet addr" | cut -d ":" -f2 | cut -d " " -f1`;
					$outputmask=`ifconfig | grep "Mask" | cut -d ":" -f4`;
					$outputint=`ifconfig | grep "eth" | tr -s " " | cut -d " " -f1`;
					$arrip=split ("\n",$outputip);
					$arrmask=split ("\n",$outputmask);
					$arrint=split ("\n",$outputint);								
					for($i=0; $i<=count($arrint)-2;$i++)
					{
						$setip=$arrip[$i];
						$setmask=$arrmask[$i];
						$setint=$arrint[$i];
						$query="insert into tblserverip(ipaddress,subnet,interface,iptype) values ('$setip','$setmask','$setint','Shared')";
						@mysql_query($query); 
					}
					$query="update tblfirsttime set status='1' where status='0'";
					@mysql_query($query); 
				}
?>
<html>
<head>
<title>Managing IP Address</title>
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
					if ((f.elements[i].type == "checkbox") && (f.elements[i].name.indexOf("id")==0)) {
						if (f.elements[i].checked || (f.elements[i].value == "DISABLED") || f.elements[i].disabled) {
							f.elements[i].checked = false;
						} else {
							f.elements[i].checked = true;
						}
					}
				}
			}
	
	function searchclient()
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
<?include "../inc/mainheader.php"?>
<form name="mainform" action="../clients/deleteclients.php" method="post"> 
<!--<table width="64%" border="0" align="center" cellspacing="0" cellpadding="0">
  <?
	if(strtoupper($_SESSION["type"])=="A")
		{
?>
  <tr> 
    <td align="left" class="navigation">Administrator &gt; Servers &gt; IP Address 
      Listing </td>
  </tr>
  <?
		}
	elseif(strtoupper($_SESSION["type"])=="C")
		{
?>
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

<table width="61%" border="0" align="center">
  <tr> 
    <td width="13%" valign="middle"><div align="center" border="0"> 
        <input type="button" name="Button22" value="Read IP" onClick="window.location='readIp.php'" class="commonbutton" title="Read IP">
      </div></td>
    <td width="13%" valign="middle"><div align="center" border="0"> 
        <p> 
          <input type="button" name="Button222" value="Add New IP" onClick="window.location='addnewIP.php'" class="commonbutton" title="Add New IP">
        </p>
      </div></td>
    <td width="49%"><div align="center"></div></td>
    <td width="25%"><div align="center"></div></td>
  </tr>
</table>

<table width="64%" border="0" align="center">
  <tr align="left" valign="top"> 
    <td colspan="8" bgcolor="#FFFFFF" class="navigation">&nbsp; &nbsp; <!--<img src="/skins/<?=$_SESSION["skin"]?>/icons/btn_client-templates_bg.gif" width="24" height="22">-->
      <table width="103%" border="0" align="right">
        <tr> 
          <td width="21%" align="right" valign="middle" class="headings"><div align="left"><font color="#333333"><strong>Server 
              IP Listing </strong></font></div></td>
          <td width="58%" align="right" valign="middle" class="headings">&nbsp;</td>
          <td width="21%" align="left" valign="middle"  class="headings"> <div align="left">
              <input class="commonButton" type="button" name="Submit22" value="Remove Selected" onClick="return chk_frm(document.mainform)">
            </div></td>
        </tr>
      </table>
      <!--<br> <input name="clientsearch" type="text" id="clientsearch2"> &nbsp; <input  class="searchButton" type="button" name="Button" value="Search" onClick="searchclient()" disabled> 
      &nbsp;&nbsp; <input class="commonButton" type="button" name="Submit2" value="Show all" onClick="showall()" disabled> -->
    </td>
  </tr>
  <tr align="center" valign="middle" bgcolor="#FFFFFF"> 
    <!--<th width="3%" height="25" class="headings">P </td>
    <th width="3%" class="headings">S </td>-->
    <th width="22%" align="left" class="headings">IP Address 
    </td>
    <th width="26%" align="left" class="headings">Subnet Mask 
    </td>
    <th width="24%" align="left" class="headings">Interface 
    </td>
    <th width="9%" class="headings">Clients
    <th width="6%" class="headings">Hosting
<th width="7%" class="headings"> <a href="javascript:invertChecked()" style="text-decoration:none">Sel</a> 
    </td>
  </tr>
  <?
@mysql_free_result($numip);
$query="select * from tblserverip";
//myLog($query);
$arrayip=mysql_query($query) or die(errorCatch(mysql_error()));
$numip=mysql_num_rows($arrayip);
if($numip==0)
	{
		echo "Sorry no IP to show";
	}
else
	{
		$count=1;
		while($ip=@mysql_fetch_object($arrayip))
			{
				//This query gets the total number of clients for the selected ip
				$query="select * from tblresellerip where ipaddress='$ip->Id'";
				myLog($query);
				$arrayclients=mysql_query($query) or die(errorCatch(mysql_error()));
				$numclients=0;
				$numclients=mysql_num_rows($arrayclients);
				//echo "The client count is ".$numdomains;

				//This query gets the company name from the tblclientcontact for the selected client
				$query="select * from tbldomain where ipaddress='$ip->Id'";
				myLog($query);
				$arraydomains=mysql_query($query) or die(errorCatch(mysql_error()));
				$numdomains=0;
				$numdomains=mysql_num_rows($arraydomains);

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
    <!--<td><font color="#000000" size="1"><img src="/skins/<?=$_SESSION["skin"]?>/icons/ok1.gif" width="16" height="16" border="0"></font></td>
    <td><font color="#000000" size="1"><img src="/skins/<?=$_SESSION["skin"]?>/icons/on1.gif" width="16" height="16"></font></td>-->
    <td align="left" class="btntext"> 
      <?=$ip->ipaddress?>
    </td>
    <td align="left" class="clientheading"> 
      <?=$ip->subnet?>
    </td>
    <td align="left" class="clientheading"> 
      <?=$ip->interface?>
    </td>
    <td class="clientheading"> 
      <?=$numclients?>
    </td>
    <td class="clientheading"> 
      <?=$numdomains?>
    </td>
    <td class="clientheading"> <input name="id[]" type="checkbox" id="id[]" value="<?=$ip->Id?>"> 
    </td>
  </tr>
  
  <?
			}
	}
?>
<tr align="center"  height="1"> 
    <td colspan="8"><div align="right">
        <input name="remove256" class="commonbutton" type="button" id="remove256" value="<<Back" onClick="window.location='../server/server.php'">
      </div></td>
  </tr>
</table>
<p>&nbsp;</p>
</body>
</form>
</html>
<? include "../inc/footer.php" ?>
<script>
function chk_frm(f)
			{
				var counter;
				counter=0;
				for (i = 0 ; i < f.elements.length; i++) 
					{
					if ((f.elements[i].type == "checkbox") && (f.elements[i].name.indexOf("id")==0)) 
						{
						if (f.elements[i].checked) 
							{
								counter=counter+1;
							}
						}
					}
				if(counter==0)
				{
					alert("No IPs to delete");
					
				}
				else
				{
					f.action="../server/removeIP.php";
					f.submit();
				}
			}
</script>
