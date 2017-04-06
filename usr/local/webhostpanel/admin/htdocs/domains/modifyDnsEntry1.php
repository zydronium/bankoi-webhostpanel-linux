<?$ACCESS_LEVEL=3;?>
<?include "../inc/connection.php"?>
<?include "../inc/params.php"?>
<?include "../inc/functions.php"?>
<?include "../inc/security.php"?>
<html>
<head>
<title>Add DNS Entry For Domain</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head><link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/general.css">
<link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/custom.css">
<link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/layout.css">
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=ISO-8859-1">
<META HTTP-EQUIV="EXPIRES" CONTENT="0">
<body topmargin="0">
<?
	$domainid=$_SESSION["domainid"];
	$domainname=$_SESSION["domainname"];
	$query="select tblserverip.ipaddress from (tbldomain inner join tblserverip on tbldomain.ipaddress=tblserverip.id) where tbldomain.domainid=$domainid";
	$ArrIpid = mysql_query($query) or die("There were some error while creating the DNS entry");
	$arr=mysql_fetch_array($ArrIpid);
	$ipaddress=$arr["ipaddress"];

	if($domainid=="")
		{
			myLog("ERROR-->The domain id was missing from the page modifyDnsEntry.php");
?>
			<script>
				alert("Sorry there are some problems.Try again");
				history.go(-1);
			</script>
<?
			die();
		}
	if(isset($_GET["mode"]))
	{
	    $mode=$_GET["mode"];
		if($mode=="add")
		{
			$recordType=$_POST["recordType"];

	include "../inc/mainheader.php";
	include "../clients/clientheader.php";
	include "../domains/domainheader.php";

?>
<form name="mainform" action="addnewdnstemplate.php" method="post">
  <table width="80%" border="0" align="center" cellspacing="0" cellpadding="0">
    <?
	if(strtoupper($_SESSION["type"])=="A")
		{
?>
    <tr> 
      <td align="left" class="navigation">Administrator &gt; 
        <?=$_SESSION["clientname"]?>
        &gt; 
        <?=$_SESSION["domainname"]?>
        &gt; Add DNS Entries</td>
    </tr>
    <?
		}
	elseif(strtoupper($_SESSION["type"])=="C")
		{
?>
    <tr> 
      <td align="left" class="navigation"> 
        <?=$_SESSION["clientname"]?>
        &gt; 
        <?=$_SESSION["domainname"]?>
        &gt; Add DNS Entries</td>
    </tr>
    <?
		}
	elseif(strtoupper($_SESSION["type"])=="D")
		{
?>
    <tr> 
      <td align="left" class="navigation"> 
        <?=$_SESSION["domainname"]?>
        &gt; Add DNS Entries</td>
    </tr>
    <?
		}
?>
    <tr> 
      <td>&nbsp;</td>
    </tr>
  </table>
  
  <table width="64%" border="0" align="center">
    <tr> 
      <td height="29" colspan="2">&nbsp;</td>
    </tr>
<?
	//------------------------------------------------------------------------------------------------------------
	 if($recordType=="A")
	 { 
	 	echo "<tr><td align=\"center\"><font face=\"verdana\" size=\"2\" color=\"red\">Add DNS entry for recordtype \"A\"</font></td></tr></center>";
?>
		<tr> 
		  <td><br><div align="center"> 
			  <input type="text" name="typeof" value="" class="textboxclass">
          &middot; 
          <?=$domainname?>
          &middot; A <<?=$ipaddress?>> </div></td>
		</tr>
<? 
	} 
  //-------------------------------------------------------------------------------------------------------------------------------------
  if($recordType=="PTR")
  { 
  		echo "<tr><td align=\"center\"><font face=\"verdana\" size=\"2\" color=\"red\">Add DNS entry for recordtype \"PTR\"</font></td></tr></center>";
?>
		<tr>
			<td align="center">
				&lt;<?=$ipaddress?>&gt;/
			  <select name="subnet" id="select">
				<option value="8">8</option>
				<option value="16">16</option>
				<option value="24">24</option>
				<option value="32">32</option>
			  </select>
        PTR
        <?=$domainname?>
      </td>
		<tr>
<?
	}
  
 //------------------------------------------------------------------------------------------------------------
  if($recordType=="NS")
   { 
	  echo "<tr><td align=\"center\"><font face=\"verdana\" size=\"2\" color=\"red\">Add NS entry for recordtype \"NS\"</font></td></tr></center>";
?>
			<tr> 
   				 <td align="center">
					<?=$domainname?>.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NS&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="ns" value="" class="textboxclass">
        . 
        <?=$domainname?>
        . </td>
			</tr>
<?
}

//------------------------------------------------------------------------------------------------------------
	if($recordType=="MX")
		{ 
		echo "<tr><td align=\"center\"><font face=\"verdana\" size=\"2\" color=\"red\">Add mail exchange entry for recordtype \"MX\"</font></td></tr></center>";
?>
			<tr> 
			    <td align="center">Select Mail Exchange Priority
				    <select name="mx">
						<option value="5">5</option>
						<option value="10">10</option>
						<option value="15">15</option>
						<option value="20">20</option>
						<option value="25">25</option>
						<option value="30">30</option>
						<option value="35">35</option>
						<option value="40">40</option>
						<option value="45">45</option>
						<option value="50">50</option>
						<option value="60">60</option>
						<option value="70">70</option>
						<option value="80">80</option>
						<option value="90">90</option>
						<option value="100">100</option>
					</select>
				</td>
			</tr>
<? 
		}
	 
//------------------------------------------------------------------------------------------------------------ 
  if($recordType=="CNAME") 
	{
	  echo "<tr><td align=\"center\"><font face=\"verdana\" size=\"2\" color=\"red\">Add Cononical name entry for recordtype \"CNAME\"</font></td></tr></center>";
?>
    <tr> 
      <td align="center"><input type="text" name="cnametype" value="" class="textboxclass">
        .
        <?=$domainname?>
        .&nbsp;&nbsp;&nbsp;&nbsp;CNAME&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
        <?=$domainname?>
        .</td>
    </tr>
<?
	} 
   

		} else

	if($mode=="delete")
	{
		if(strlen($_POST["chkEntries"])==0)
		{
?>
    		<script>
				alert("No DNS Template to delete");
				window.location="../domains/dnsEntry.php";
			</script>
<?
		die();
		}
		else
			{
				for($i=0; $i < count($_POST["chkEntries"]); $i++)
					{
						$id=$_POST["chkEntries"][$i];
						$query="delete from tbldnsdomain where id=$id and domainid='$domainid'";
						//myLog($query);
						mysql_query($query) or die(errorCatch(mysql_error()));
					}
			}
?>
		<SCRIPT>
			alert("DNS Entries successfully deleted");
			window.location="dnsEntry.php";
		</SCRIPT>
<? 
	} 
	else 
		{ 
?>
    <SCRIPT>
		alert("Don't Edit URL");
		window.location="dnsEntry.php";
	</SCRIPT>
<?
		}
?>

<? 
	} 
	else 
		{ 
?>
    <SCRIPT>
		alert("Don't Edit URL");
		window.location="dnsTemplate.php";
	</SCRIPT>
<?
		}
?>
    <tr> 
      <td colspan="2"><div align="right"> 
          <input type="submit" class="commonbutton" name="Add" value="Add DNS Template">
          <input type="button" class="commonbutton" name="Add2" value="Back" onClick="window.location='dnsEntry.php'">
        </div></td>
    </tr>
    <tr> 
      <td colspan="2">&nbsp;</td>
    </tr>
  </table>
<input type="hidden" name="redordtype" value="<?=$recordType?>">
<input type="hidden" name="ipaddress" value="<?=$ipaddress?>">

</form>
<br>
<? include "../inc/footer.php"?>