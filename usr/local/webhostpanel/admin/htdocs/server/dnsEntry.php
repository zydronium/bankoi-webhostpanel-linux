
<? $ACCESS_LEVEL=1 ?>
<?include "../inc/connection.php"?>
<?include "../inc/params.php"?>
<?include "../inc/functions.php"?>
<?include "../inc/security.php"?>
<html>
<head>
<title>Delete Domains</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head><link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/general.css">
<link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/custom.css">
<link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/layout.css">
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=ISO-8859-1">
<META HTTP-EQUIV="EXPIRES" CONTENT="0">
<script language="JavaScript">
function invertChecked()
			{
				f = document.form2;
				for (i = 0 ; i < f.elements.length; i++) {
					if ((f.elements[i].type == "checkbox") && (f.elements[i].name.indexOf("chkEntries")==0)) {
						if (f.elements[i].checked || (f.elements[i].value == "DISABLED") || f.elements[i].disabled) {
							f.elements[i].checked = false;
						} else {
							f.elements[i].checked = true;
						}
					}
				}
			}
</script>

<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body>
<?
	include "../inc/mainheader.php";
	include "../clients/clientheader.php";
?>
<p>&nbsp;</p>
<table width="79%" align="center">
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><form name="form1" action="modifyDnsEntry.php?mode=add" method="post">
        <p><font size="2" face="Courier New, Courier, mono">Add a DNS record</font></p>
        <p><font size="2" face="Courier New, Courier, mono"><strong>Record Type 
          &nbsp;&nbsp;&nbsp;</strong></font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
          <select name="recordType" id="recordType">
            <option value="NS">NS</option>
            <option value="A">A</option>
            <option value="PTR">PTR</option>
            <option value="MX">MX</option>
            <option value="CNAME">CNAME</option>
            <option value="RP">RP</option>
            <option value="HINFO">HINFO</option>
            <option value="NULL">NULL</option>
          </select>
        </p>
        <p align="right">
          <input type="submit" class="commonbutton" name="Submit" value="Submit">
        </p>
      </form>
      <p>&nbsp;</p>
      </td>
  </tr>
  <tr>
    <td><form name="form2" action="modifyDnsEntry.php?mode=delete" method="post">
        <p align="right"><br>
          <input name="remove" class="commonbutton" type="submit" id="remove" value="Remove Selected">
        </p>
        <table width="100%" border="0">
          <tr> 
            <td width="31%"><p><strong><font size="2" face="Courier New, Courier, mono">Host</font></strong></p></td>
            <td width="34%"><p><strong><font size="2" face="Courier New, Courier, mono">Record 
                Type</font></strong></p></td>
            <td width="25%"><p><strong><font size="2" face="Courier New, Courier, mono">Value</font></strong></p></td>
            <td width="10%"><p><strong><font size="2" face="Courier New, Courier, mono"> 
                <a href="javascript:invertChecked()">Sel</a> </font></strong></p></td>
          </tr>
          <?
		  $domainid=$_SESSION["domainid"];		  
$query="select * from tbldnsdomain where domainid=".$domainid;
$arraydns=mysql_query($query) or die("Cannot get the DNS listing from DNS Template table");
$numDnsTemplate=mysql_num_rows($arraydns);
if($numDnsTemplate==0)
	{
		echo "Sorry no DSN Entries to show";
	}		  
else {		  
		while($DnsEntries=mysql_fetch_object($arraydns))
		{
?>
          <tr> 
            <td><p><font size="2" face="Courier New, Courier, mono"> 
                <?=htmlspecialchars($DnsEntries->host)?>
                </font></p></td>
            <td><p><font size="2" face="Courier New, Courier, mono"> 
                <?=htmlspecialchars($DnsEntries->recordtype)?>
                </font></p></td>
            <td><p><font size="2" face="Courier New, Courier, mono"> 
                <?=htmlspecialchars($DnsEntries->value)?>
                </font></p></td>
            <td><p><font size="2" face="Courier New, Courier, mono">
			
                <input type="checkbox" name="chkEntries[]" value="<?=$DnsEntries->id?>">
                </font></p></td>
          </tr>
		  <?
		  }}
		  ?>
        </table>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
      </form>
     
      </td>
  </tr>
</table>
<p>&nbsp;</p>
</body>
</html>
<? include "../inc/footer.php" ?>