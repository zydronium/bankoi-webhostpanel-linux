<?$ACCESS_LEVEL=3;?>
<?include "../inc/connection.php"?>
<?include "../inc/params.php"?>
<?include "../inc/functions.php"?>
<?include "../inc/security.php"?>
<html>
<head>
<title>Manage DNS Entries</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head><link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/general.css">
<link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/custom.css">
<link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/layout.css">
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=ISO-8859-1">
<META HTTP-EQUIV="EXPIRES" CONTENT="0">
<script language="JavaScript">
function chk_frm(f)
			{
				var counter;
				counter=0;
				for (i = 0 ; i < f.elements.length; i++) 
					{
					if ((f.elements[i].type == "checkbox") && (f.elements[i].name.indexOf("chkEntries")==0)) 
						{
						if (f.elements[i].checked) 
							{
								counter=counter+1;
							}
						}
					}

				if(counter==0)
				{
					alert("No dns entries selected to delete");
					return false;
				}
				else
				{
					f.action="modifyDnsEntry.php?mode=delete";
					f.submit();
					return false;
				}
				
			}


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
	if(strtoupper($_SESSION["type"])=="D")
		{
?>
			<script>
				alert("Sorry domains are not authorized to view this page");
				window.location = "../logout.php";
			</script>
<?
			die();	
		}
	include "../inc/mainheader.php";
	if(strtoupper($_SESSION["type"])=="C" || strtoupper($_SESSION["type"])=="A")
		include "../clients/clientheader.php";
	include "../domains/domainheader.php";
?>
<table width="61%" border="0" align="center" cellspacing="0" cellpadding="0">
  <?
	if(strtoupper($_SESSION["type"])=="A")
		{
?>
  <tr> 
    <td align="left" class="navigation">Administrator &gt; 
      <?=$_SESSION["clientname"]?>
      &gt; 
      <?=$_SESSION["domainname"]?>
      &gt; Domain DNS Entries</td>
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
      &gt; Domain DNS Entries</td>
  </tr>
  <?
		}
	elseif(strtoupper($_SESSION["type"])=="D")
		{
?>
  <tr> 
    <td align="left" class="navigation"> 
      <?=$_SESSION["domainname"]?>
      &gt; Domain DNS Entries</td>
  </tr>
  <?
		}
?>
  <tr> 
    <td>&nbsp;</td>
  </tr>
</table>
<table width="60%" align="center">
 
  <tr>
    <td height="67"><form name="form1" action="modifyDnsEntry.php?mode=add" method="post">
        <p align="center"><font color="#FF0000" size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong><img src="/skins/default/elements/line.gif" width=600 height=1 border=0></strong></font></p>
        <p align="left"><font color="#FF0000" size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong>Add 
          a DNS record</strong></font></p>
        <table width="100%" border="0">
          <tr> 
            <td width="48%"><div align="right"><font color="#003366" size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong>Record 
                Type </strong></font></div></td>
            <td width="5%">&nbsp;</td>
            <td width="23%"><select name="recordType" id="recordType">
                <option value="NS">NS</option>
                <option value="A">A</option>
                <option value="MX">MX</option>
                <option value="CNAME">CNAME</option>
              </select> </td>
            <td width="24%"><div align="right"> 
                <input type="submit" class="commonbutton" name="Submit" value="Submit">
              </div></td>
          </tr>
          <tr> 
            <td height="10" colspan="4"><font color="#FF0000" size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong><img src="/skins/default/elements/line.gif" width=600 height=1 border=0></strong></font></td>
          </tr>
        </table>
        </form>

      </td>
  </tr></table>
  </table>
<table width="60%" align="center">
  <tr>
    <td><form name="form2" action="modifyDnsEntry.php?mode=delete" method="post">
        <p align="right"><br>
          <input name="remove" class="commonbutton" type="submit" id="remove" value="Remove Selected" onClick="return chk_frm(document.form2)">
        </p>
        <table width="100%" border="0">
          <tr bgcolor="#DFE8F7"> 
            <td width="31%"><p align="center"><font color="#003366" size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong>Host</strong></font></p></td>
            <td width="34%"><p align="center"><font color="#003366" size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong>Record 
                Type</strong></font></p></td>
            <td width="25%"><p align="center"><font color="#003366" size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong>Value</strong></font></p></td>
            <td width="10%"><p align="center"><font color="#003366" size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
                <a href="javascript:invertChecked()" style="text-decoration:none">Sel</a> 
                </strong></font></p></td>
          </tr>
          <?
		  $domainid=$_SESSION["domainid"];		  
$query="select * from tbldnsdomain where domainid='$domainid' order by recordtype";
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
          <tr bgcolor="#FCEEE0"> 
            <td><p align="center"><font color="#003366" size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
                <?=htmlspecialchars($DnsEntries->host)?>
                </font></p></td>
            <td><p align="center"><font color="#003366" size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
                <?=htmlspecialchars($DnsEntries->recordtype)?>
                </font></p></td>
            <td><p align="center"><font color="#003366" size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
                <?=htmlspecialchars($DnsEntries->value)?>
                </font></p></td>
            <td><p align="center"><font color="#003366" size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
                <input type="checkbox" name="chkEntries[]" value="<?=$DnsEntries->id?>">
                </font></p></td>
          </tr>
          <?
		  }}
		  ?>
        </table>
      </form>
      </td>
  </tr>
</table>
<p align="center"><font color="#FF0000" size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong><img src="/skins/default/elements/line.gif" width=600 height=1 border=0></strong></font></p>
<p align="center"> 
  <input type="button" name="Button352" value="Back" class="commonButton" onClick="window.location='/domains/showdomaindetails.php'">
</p>
</body>
</html>
<br>
<? include "../inc/footer.php" ?>