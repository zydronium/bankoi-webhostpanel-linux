<? $ACCESS_LEVEL=1; ?>
<?
include "../inc/connection.php";
include "../inc/params.php";
include "../inc/functions.php";
include "../inc/security.php";
include "../inc/constants.php";
?>


<html>
<head>
<title>Reading IP Address</title>
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
    <td align="left" class="navigation">Administrator &gt; Servers &gt; Reading IP Address</td>
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

<table width="58%" border="0" align="center">
  <tr> 
    <td width="13%"><div align="center"> 
        <input type="button" name="Button22" value="Read IP" onClick="window.location='readIp.php'" class="commonbutton" title="Read IP">
      </div></td>
    <td width="13%"><div align="center"> 
        <input type="button" name="Button222" value="Add New IP" onClick="window.location='addnewIP.php'" class="commonbutton" title="Add New IP">
      </div></td>
    <td width="49%"><div align="center"></div></td>
    <td width="25%"><div align="center"></div></td>
  </tr>
  <tr> 
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>

<table width="64%" border="0" align="center">
  <tr align="left" valign="top"> 
    <td colspan="8" bgcolor="#FFFFFF" class="navigation"><div align="left">&nbsp; 
        &nbsp; 
        <!--<img src="/skins/<?=$_SESSION["skin"]?>/icons/btn_client-templates_bg.gif" width="24" height="22">-->
        <strong><font color="#333333">Reading IP Listing </font></strong></div>
      <table width="33%" border="0" align="right">
        
      </table>
      <!--<br> <input name="clientsearch" type="text" id="clientsearch2"> &nbsp; <input  class="searchButton" type="button" name="Button" value="Search" onClick="searchclient()" disabled> 
      &nbsp;&nbsp; <input class="commonButton" type="button" name="Submit2" value="Show all" onClick="showall()" disabled> -->
    </td>
  </tr>
  <tr align="center" bgcolor="#FFFFFF"> 
    <!--<th width="3%" height="25" class="headings">P </td>
    <th width="3%" class="headings">S </td>-->
    <th width="22%" align="left" class="headings">IP Address 
    </td>
    <th width="26%" align="left" class="headings">Subnet Mask 
    </td>
    <th width="20%" align="left" class="headings">Interface 
    </td>
    <th width="26%" class="headings">Status</td>
    
    </td>
  </tr>
<?

@mysql_free_result($numip1);
$query1="select ipaddress from tblserverip";
//myLog($query);
$arrayip1=mysql_query($query1) or die(errorCatch(mysql_error()));
$numip1=mysql_num_rows($arrayip1);

$i=0;
while($ip1=@mysql_fetch_object($arrayip1))
{
	$arr[$i]=$ip1;
	$i++;
}

// This is code written while first time managing IP addresses
					$outputip=`ifconfig | grep "inet addr" | cut -d ":" -f2 | cut -d " " -f1`;
					$outputmask=`ifconfig | grep "Mask" | cut -d ":" -f4`;
					$outputint=`ifconfig | grep "eth" | tr -s " " | cut -d " " -f1 | cut -d ":" -f1`;
					$arrip=split ("\n",$outputip);
					$arrmask=split ("\n",$outputmask);
					$arrint=split ("\n",$outputint);
					//myLog(count($arrint));
					//print_r($arrint);
					for($j=0;$j<$numip1;$j++)
					{
						$status=0;
						$setmask=$arrmask[$j];
						$setint=$arrint[$j]; 
					for($i=0; $i<=count($arrint)-2;$i++)
					{
						//myLog($arrip[$i]);
						$setip=$arrip[$i];
					//	$setmask=$arrmask[$i];
					//	$setint=$arrint[$i]; 
						
						$status=0;						
						//for ($j=0;$j<$numip1;$j++)
						//{
							if($arr[$j]->ipaddress==$setip)
							{
								$status=1;
								break;
						}						
					}
					 ?>

				

  <tr align="center"  height="1" bgcolor="<?=$bgcol?>"> 
    <!--<td><font color="#000000" size="1"><img src="/skins/<?=$_SESSION["skin"]?>/icons/ok1.gif" width="16" height="16" border="0"></font></td>
    <td><font color="#000000" size="1"><img src="/skins/<?=$_SESSION["skin"]?>/icons/on1.gif" width="16" height="16"></font></td>-->
    <td align="left" class="btntext"> 
      <?=$arr[$j]->ipaddress?>
    </td>
    <td align="left" class="clientheading"> 
      <?=$setmask?>
    </td>
    <td align="left" class="clientheading"> 
      <?=$setint?>
    </td>

    <td class="clientheading"> 
      <? if($status==1) {?>
      Added 
      <? } elseif($status==0) {?>
     Not Available on Server
	 <? } else {  ?>
	<a href="readAdd.php?ip=<?=$setip?>">Not Added</a>
	<? } ?>    
</td>
    
  </tr>
  <? } ?>
 
<tr align="center"  height="1"> 
    <td colspan="8"><div align="right">
        <input name="remove256" class="commonbutton" type="button" id="remove256" value="<<Back" onClick="window.location='../server/serverip.php'">
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
