<?$ACCESS_LEVEL=1;?>
<?include "../inc/connection.php"?>
<?include "../inc/params.php"?>
<?include "../inc/functions.php"?>
<?include "../inc/security.php"?>
<html>
<head>
<title>Add DNS Template</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head><link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/general.css">
<link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/custom.css">
<link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/layout.css">
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=ISO-8859-1">
<META HTTP-EQUIV="EXPIRES" CONTENT="0">
<body topmargin="0">
<?
	if(isset($_GET["mode"]))
	{
	    $mode=$_GET["mode"];
		if($mode=="add")
		{
			$recordType=$_POST["recordType"];

	include "../inc/mainheader.php";
?>
<form name="mainform" action="addnewdnstemplate.php" method="post">
<!--  <table width="80%" border="0" align="center" cellspacing="0" cellpadding="0">
    <?
	if(strtoupper($_SESSION["type"])=="A")
		{
?>
    <tr> 
      <td align="left" class="navigation">Administrator &gt; Servers &gt; Add 
        to DNS Templates</td>
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
  
  <table width="80%" border="0" align="center">
    <tr> 
      <td height="29" colspan="2"><hr></td>
    </tr>
<?
	//------------------------------------------------------------------------------------------------------------
	 if($recordType=="A")
	 { 
	 	echo "<tr><td align=\"center\" class='clientheading'>Add DNS entry for recordtype \"A\" </td></tr></center>";
?>
		<tr> 
		  <td><br><div align="center" class="headings">
			  <input type="text" name="typeof" value="" class="textboxclass">
			  &middot;&lt;domain&gt;&middot; A <input type="text" name="ipaddr"  class="textboxclass">  <font color="#000066">*</font> </div><br> 
			</div></td>
		</tr>
<? 
	} 
    
 //------------------------------------------------------------------------------------------------------------
  if($recordType=="NS")
   { 
	  echo "<tr><td align=\"center\" class='clientheading'>Add NS entry for recordtype \"NS\" </td></tr></center>";
?>
			<tr> 
   				 <td align="center" class="headings">
					&lt;domain&gt;.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NS&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="ns" value="" class="textboxclass">
        . 
        <select name="dmnname" id="dmnname"  class="headings">
          <option value="domain">&lt;Domain&gt;</option>
		  <option value=""></option>
        </select>
        . </td>
			</tr>
<?
  }

//------------------------------------------------------------------------------------------------------------
	if($recordType=="MX")
		{ 
		echo "<tr><td align=\"center\" class='clientheading'>Add mail exchange entry for recordtype \"MX\" </td></tr></center>";
?>
			<tr> 
			    <td align="center" class="headings">&lt;domain&gt;.
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
					</select>&nbsp;&nbsp;
        <input type="text" name="exchangeval"  class="textboxclass"> 
				</td>
			</tr>
<? 
		}
	 
//------------------------------------------------------------------------------------------------------------ 
  if($recordType=="CNAME") 
	{
	  echo "<tr><td align=\"center\" class='clientheading'>Add Cononical name entry for recordtype \"CNAME\" </td></tr></center>";
?>
    <tr> 
      <td align="center" class="headings"><input type="text" name="cnametype" value="" class="textboxclass">.&lt;domain&gt;.&nbsp;&nbsp;CNAME&nbsp;&nbsp; 
			<input type="text" name="cnameval"  class="textboxclass"></td>
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
				window.location="dnsTemplate.php";
			</script>
<?
		die();
		}
		else
			{
				for($i=0; $i < count($_POST["chkEntries"]); $i++)
					{
						$id=$_POST["chkEntries"][$i];
						$query="delete from tbldnstemplate where id=$id";
						//myLog($query);
						mysql_query($query) or die(errorCatch(mysql_error()));
					}
			}
?>
		<SCRIPT>
			alert("DNS Entries successfully deleted");
			window.location="dnsTemplate.php";
		</SCRIPT>
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
      <td colspan="2"><div align="right" class="headings">
          <input type="submit" class="commonbutton" name="Add" value="Add DNS Template">
          <input type="button" class="commonbutton" name="Add2" value="Back" onClick="window.location='dnsTemplate.php'">
        </div><br></td>
    </tr>
	<?
		if($recordType=="A")
		 { 
		 	echo "<tr><td align=\"center\"><font face=\"verdana\" size=\"1\" color=\"Blue\">* </font><font face=\"verdana\" size=\"1\" color=\"red\">Please provide IP address in the trailing text box, if u leave it blank then \"&lt;ip&gt;\" will be taken as default</font></td></tr></center>";
		} 
	?>
    <tr> 
      <td colspan="2"><hr></td>
    </tr>
  </table>
<input type="hidden" name="redordtype" value="<?=$recordType?>">
</form>
<br>
<? include "../inc/footer.php"?>
