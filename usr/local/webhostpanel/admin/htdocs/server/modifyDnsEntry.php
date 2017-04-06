<?$ACCESS_LEVEL=1;?>
<?include "../inc/connection.php"?>
<?include "../inc/params.php"?>
<?include "../inc/functions.php"?>
<?include "../inc/security.php"?>

<?
	if(isset($_GET["mode"]))
	{
	    $mode=$_GET["mode"];
		if($mode=="add")
		{
			$recordType=$_POST["recordType"];
?>



<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body>


<form name="form1" method="post" action="">
  
  <table width="100%" border="1">
    <tr> 
      <td width="32%"><p><strong><font size="2" face="Courier New, Courier, mono">Domain 
          Name: &nbsp;&nbsp;</font></strong></p></td>
      <td colspan="2"><input name="domainName" type="text" id="domainName"></td>
    </tr>
    
     
	 <?
	 if($recordType=="A" || $recordType=="PTR")
	 {
	 ?>
	  <tr> 
	  <td><p><strong><font size="2" face="Courier New, Courier, mono">IP Address:</font></strong></p></td>
      <td width="23%"><input name="ipaddress" type="text" id="ipaddress"></td>
<? if($recordType=="PTR") {?>	 
	  <td width="45%">/ 
	      <select name="subnet" id="select">
          <option value="8">8</option>
          <option value="16">16</option>
          <option value="24">24</option>
          <option value="32">32</option>
        </select></td>
		<? }
		?>
    </tr>
	<? } ?>
    
	<? if($recordType=="NS") { ?>
	<tr> 
      <td><p><strong><font size="2" face="Courier New, Courier, mono">Name Server 
          </font></strong></p></td>
      <td colspan="2"><input name="nameServer" type="text" id="nameServer"></td>
    </tr>
<?}?>
<? if($recordType=="MX") {  ?>
    <tr> 
      <td><p><strong><font size="2" face="Courier New, Courier, mono">Mail Exchanger 
          </font></strong></p></td>
      <td colspan="2"><input name="mailExchanger" type="text" id="mailExchanger"></td>
    </tr>
    <tr> 
      <td><p><strong><font size="2" face="Courier New, Courier, mono">Priority 
          of Mail Exchange Service</font></strong></p></td>
      <td colspan="2"><select name="select">
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
        </select></td>
    </tr>
	<? } ?>
    
	<? if($recordType=="CNAME") {?>
	<tr> 
      <td><p><strong><font size="2" face="Courier New, Courier, mono">Cononical 
          Name</font></strong></p></td>
      <td colspan="2"><input name="cname" type="text" id="cname"></td>
    </tr>
	
	<? } ?>

</table>

	<?} else if($mode=="delete")
	{
		if(strlen($_POST["chkEntries"])==0)
		{
	?>
		<script>
			alert("No DNS Template to delete");
			window.location="dnsEntry.php";
		</script>
<?
	die();}
	else
		{
				
			for($i=0; $i < count($_POST["chkEntries"]); $i++)
			{
				$id=$_POST["chkEntries"][$i];
				$query="delete from tbldnsdomain where id=$id";
				//myLog($query);
				mysql_query($query) or die(errorCatch(mysql_error()));
			}
		}
?>
<SCRIPT>
	alert("DNS Entries successfully deleted");
	window.location="dnsEntry.php";
</SCRIPT>
<? } else { ?>
<SCRIPT>
	alert("Don't Edit URL");
	window.location="dnsEntry.php";
</SCRIPT>
<?}?>
<? } else { ?>
<SCRIPT>
	alert("Don't Edit URL");
	window.location="dnsEntry.php";
</SCRIPT>
<?}?>