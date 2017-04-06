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
<link rel="shortcut icon" href="/favicon.ico"> 
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
<?include "../inc/mainheader.php"?><form name="mainform" action="searchclients.php" method="post"> 
<!--<table width="72%" border="0" align="center" cellpadding="0" cellspacing="0" >
<?
	$query = "select count(*) as clientNum from tblloginmaster where usertype='c'";
	$exNumClients = @mysql_query($query);  
	$rsNumClients = @mysql_fetch_array($exNumClients);
	$numOfClients = $rsNumClients["clientNum"];
	
	if(strtoupper($_SESSION["type"])=="A")
		{
?>
  <tr> 
    <td width="54%" align="left"  class="navigation">Administrator&gt;Clients Listing</td>
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
</table>-->


  
<?
@mysql_free_result($numclients);
$query="select * from tblreseller order by resellername";
$arrayclient=mysql_query($query) or die(errorCatch(mysql_error()));
$numclients=mysql_num_rows($arrayclient);
if($numclients == 0)
	{
	        ?>
		<table width="58%" border="0" align="center">
  <tr>
    <td><input name="button2" type="button" class="commonButton" id="button" title="New Client"  onClick="window.location='../clients/newclient.php'" value="New Client" c></td>
  </tr>
</table>
<?
		echo "<center><font color='red' size='4' face='Verdana'>Sorry no client to show</font></center><br><br>";

		include "../inc/footer.php";
		die();
	}
else
	{
?>
<table width="603" border="0" align="center">
  <tr align="left" valign="top"> 
    <td colspan="10" bgcolor="#FFFFFF" class="navigation"> 
      <?
	if(strtoupper($_SESSION["type"])=="A")
		{
?>
      <input name="button" type="button" class="commonButton" id="bid-new-client" title="New Client"  onClick="window.location='../clients/newclient.php'" value="New Client" >     </td>
    <?
		}


?>
  </tr>
  <tr align="left" valign="top">
    <td colspan="10" bgcolor="#FFFFFF" class="navigation"><div align="center">
	<img src="/skins/<?=$_SESSION["skin"]?>/elements/line.gif" width=564 height=1 border=0>	
      </div></td>
  </tr>
  <tr align="left" valign="top"> 
    <td colspan="8" bgcolor="#FFFFFF" class="navigation"> 
      <!--<img src="/skins/<?=$_SESSION["skin"]?>/icons/btn_client-templates_bg.gif" width="24" height="22">Client 
      Listing -->
      <table width="100%" border="0" align="right">
        <tr> 
          <td align="right" valign="middle" class="navigation"><div align="left">Clients 
              ( 
              <?=$numOfClients?>
              ) </div></td>
          <td align="right" valign="middle" class="navigation"><input class="commonButton" type="button" name="Submit22" value="Remove Selected" onClick="return chk_frm(document.mainform)"></td>
        </tr>
      </table>
      <!--<br> <input name="clientsearch" type="text" id="clientsearch2" class="textboxclass"> 
      &nbsp; <input  class="searchButton" type="button" name="Button" value="Search" onClick="searchclient()"> 
      <input class="commonButton" type="button" name="Submit2" value="Show all" onClick="showall()"> -->
    </td>
  </tr>
  <tr align="center" valign="top"> 
    <!--<th width="2%" height="21" bgcolor="#CAE1EC" class="tableheadings">P -->
    <th width="3%" height="25" bgcolor="#FFFFFF"  class="tableheadings">S 
    <th width="14%" align="left" valign="middle" bgcolor="#FFFFFF" class="tableheadings">Date 
    <th width="41%" align="left" bgcolor="#FFFFFF" class="tableheadings" valign="middle">Client 
      Name<img src="../skins/<?=$_SESSION["skin"]?>/icons/arrow_up.gif" width="10" height="13"> 
      <!--<th width="15%" align="left" bgcolor="#CFECF1" class="tableheadings">Company 
      Name 
    <th width="15%" bgcolor="#FFFFFF" class="tableheadings">Domain 
    <th width="11%" bgcolor="#FFFFFF" class="tableheadings">Traffic -->
    <th bgcolor="#FFFFFF" class="tableheadings" colspan="4"><a href="javascript:invertChecked()" style="text-decoration:none">Sel</a> 
  </tr>
  <?

		$count=1;
		while($clients=@mysql_fetch_object($arrayclient))
			{
				//This query gets the total number of clients for the selected client
				$query="select * from tbldomain where resellerid=$clients->resellerid";
				$array=mysql_query($query) or die(errorCatch(mysql_error()));
				$numdomains=0;
				$numdomains=mysql_num_rows($array);

				//This query gets the company name from the tblclientcontact for the selected client
				$query="select companyname from tblclientcontact where resellerid='$clients->resellerid'";
				$array=mysql_query($query) or die(errorCatch(mysql_error()));
				$company=mysql_fetch_array($array);
				$companyname=$company["companyname"];

				//This query gets the creation date for the selected client
				$query="select regdate from tblloginmaster where ucase(usertype)=ucase('c') and typeid='$clients->resellerid'";
				$array=mysql_query($query) or die(errorCatch(mysql_error()));
				$dt=mysql_fetch_array($array);
				$regdate=$dt["regdate"];
				
				if($count % 2==0)
				   {
						$bgcol="";
						$count=$count+1;
				   }
				else
				   {
						$bgcol="";
						$count=$count+1;
				   }
?>
  <tr align="center"  height="1"> 
    <!--<td height="20" class="clientheading">
	<a href="resetpassword.php?clid=<?=$clients->
    resellerid?>&usertype=c&name= 
    <?=$clients->resellername?>
    "> <img src="/skins/<?=$_SESSION["skin"]?>/icons/ok1.gif" width="16" height="16" border="0"><font size="2" face="Verdana, Trebuchet MS"></a></font><font size="2" face="Verdana, Trebuchet MS"></td></font>--> 
    <td><font size="2" face="Verdana, Trebuchet MS"><img src="/skins/<?=$_SESSION["skin"]?>/icons/on1.gif"border="0"></font></td>
    <td width="10%" align="left" class=""><font size="2" face="Verdana, Trebuchet MS"> 
      <?
	  	list ($year,$month, $day) = split ('[/.-]', $regdate);
	  	$str = $month . "/" . $day . "/" . $year;	
	  ?>
      <?=$str?>
      </font></td>
    <td width="10%" align="left" class="clientheading"><font size="2" face="Verdana, Trebuchet MS"><a href="../clients/choose.php?clid=<?=$clients->resellerid?>" style="text-decoration:none"> 
<?
		$query="select * from tblclientcontact where resellerid='$clients->resellerid'";
		$exContact=mysql_query($query);
		$rsContact=mysql_fetch_array($exContact);
?>
      <?=$clients->resellername?> <font color="red">[<?=$rsContact["contactname"]?>]</font>
      </a></font></td>
    <!--<td align="left" class="clientheading"> 
      <?=$companyname?>
    </td>
    <td class="clientheading"> 
      <?=$numdomains?>
    </td>
    <?
	$TotalTraffic=0;
	$query = "select tbldomain.domainname from (tblreseller inner join tbldomain on tblreseller.resellerid = tbldomain.resellerid) where tblreseller.resellername ='$clients->
    resellername'"; //echo $query; $ClientDomain = @mysql_query($query); 
	$mnth = date('M'); $yer = date('Y'); 
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
			$rest = @mysql_query($query); 
			$getRest = @mysql_fetch_array($rest); 
			if(@mysql_num_rows($rest) == "0") 
				{ 
					$DomainTraffic = "--"; 
				} 
			else 
				{ 
					$DomainTraffic = $getRest["traffic"]; 
				} 
			//Adding the traffic to the total traffic 
			if($DomainTraffic != "--") 
			{ 
			$TotalTraffic = $TotalTraffic + $DomainTraffic; } }
			//This is the end of while loop 
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
?> 
    <td width="10%" class="clientheading"> <font size="2" face="Verdana, Trebuchet MS"> 
      <?
	if($TotalTraffic == "0" || $TotalTraffic == "")
		{
			echo "--";
		}
	else
		{
			echo $TotalTraffic;
		}
?>
      </font></td>
    --> 
    <td width="12%"> <div align="right"><font size="2" face="Verdana, Trebuchet MS"> 
        <input type="checkbox" name="delclients[]" value="<?=$clients->resellerid?>">
        </font></div></td>
  </tr>
  <?
			}
	}

?>
</table>
<br>
</body>
</form>
</html>
<? include "../inc/footer.php" ?>

