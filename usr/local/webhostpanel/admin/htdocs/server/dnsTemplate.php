<?$ACCESS_LEVEL=1 ;?>
<?include "../inc/connection.php"?>
<?include "../inc/params.php"?>
<?include "../inc/functions.php"?>
<?include "../inc/security.php"?>
<html>
<head>
<title>Manage DNS</title>
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

<body topmargin="0">
<?
	include "../inc/mainheader.php";
	//include "../clients/clientheader.php";
?>
<!--<table width="80%" border="0" align="center" cellspacing="0" cellpadding="0">
  <?
	if(strtoupper($_SESSION["type"])=="A")
		{
?>
  <tr> 
    <td align="left" class="navigation">Administrator &gt; Servers &gt; DNS Templates</td>
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
<table width="79%" align="center">
  <tr>
    <td><hr></td>
  </tr>
  <tr>
    <td class="clientheading"><form name="form1" action="modifyDnsTemplate.php?mode=add" method="post">
        <p> <div class="clientheading">Add a DNS record </div></p>
        <table width="86%" border="0" align="center">
          <tr> 
            <td width="43%"><div align="right" class="headings">Record 
                Type &nbsp; </div></td>
            <td width="9%">&nbsp;</td>
            <td width="48%"><select name="recordType" id="select">
                <option value="NS">NS</option>
                <option value="A">A</option>
                <option value="MX">MX</option>
                <option value="CNAME">CNAME</option>
              </select></td>
          </tr>
        </table>
        <p align="right"> 
          <input type="submit" class="commonbutton" name="Submit" value="Submit">
        </p>
        </form>
      <hr>
    </td>
  </tr>
  <tr>
    <td><form name="form2" action="modifyDnsTemplate.php?mode=delete" method="post">
        <table width="100%" border="0">
          <tr bgcolor="#FFFFFF"> 
            <td colspan="4"> <p align="right"> 
                <input name="remove" class="commonbutton" type="submit" id="remove" value="Remove Selected">
                <font color="#003366" face="Verdana"><strong><font size="2"> </font></strong></font></p></td>
          </tr>
          <tr bgcolor="#FFCC99"> 
            <td width="31%"><div align="center" class="headings">Host </div></td>
            <td width="34%"><div align="center" class="headings">Record Type </div></td>
            <td width="25%"><div align="center" class="headings">Value </div></td>
            <td width="10%"><div align="center"  class="headings"> <a href="javascript:invertChecked()">Sel</a> 
                </div></td>
          </tr>
          <?		  
$query="select * from tbldnstemplate where resellerid = '0' order by recordtype";
//myLog($query);
$arraydns=mysql_query($query) or die(errorCatch(mysql_error()));
$numDnsTemplate=mysql_num_rows($arraydns);
if($numDnsTemplate==0)
	{
		echo "Sorry no DSN Entries to show";
	}		  
else {		  
		while($DnsEntries=mysql_fetch_object($arraydns))
		{
?>
          <tr bgcolor="#CFECF1"> 
            <td><p align="center" class="normaltext"> 
                <?=htmlspecialchars($DnsEntries->host)?>
                 </p></td>
            <td><p align="center" class="normaltext"> 
                <?=htmlspecialchars($DnsEntries->recordtype)?>
                 </p></td>
            <td><p align="center" class="normaltext"> 
                <?=htmlspecialchars($DnsEntries->value)?>
                 </p></td>
            <td><p align="center" class="normaltext"> 
                <input type="checkbox" name="chkEntries[]" value="<?=$DnsEntries->id?>">
                </p></td>
          </tr>
          
          <?
		  }}
		  ?>
		  <tr bgcolor="#CFECF1"> 
            <td colspan="4" bgcolor="#FFFFFF"> <div align="right">
                <input name="remove256" class="commonbutton" type="button" id="remove256" value="<<Back" onClick="window.location='../server/server.php'">
              </div></td>
          </tr>
        </table>
        <p>&nbsp;</p></form>
     
      <hr></td>
  </tr>
</table>
<p>&nbsp;</p>
</body>
</html>
<? include "../inc/footer.php" ?>
