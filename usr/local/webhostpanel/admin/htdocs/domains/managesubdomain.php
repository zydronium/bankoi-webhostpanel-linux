<?$ACCESS_LEVEL=3?>
<?include "../inc/connection.php"?>
<?include "../inc/params.php"?>
<?include "../inc/functions.php"?>
<?include "../inc/security.php"?>
<html>
<head>
<title>Manage SubDomains</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head><link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/general.css">
<link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/custom.css">
<link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/layout.css">
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=ISO-8859-1">
<META HTTP-EQUIV="EXPIRES" CONTENT="0">
</head>
<script>
function invertChecked()
			{
				f = document.mainform;
				for (i = 0 ; i < f.elements.length; i++) {
					if ((f.elements[i].type == "checkbox") && (f.elements[i].name.indexOf("subdomainid")==0)) {
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
					if ((f.elements[i].type == "checkbox") && (f.elements[i].name.indexOf("subdomainid")==0)) 
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
					alert("No sub domains to delete");
					f.action="#";
					f.submit();
					return false;
				}
				else
				{
					f.action="deletesubdomains.php";
					f.submit();
					return false;
				}
				
			}
</script>

<body leftmargin=0 topmargin=0>
<form name="mainform" method="post" action="">
<?include "../inc/mainheader.php"?>
<?
	if(strtoupper($_SESSION["type"])!="D")
		{
			include "../clients/clientheader.php";
		}
?>
<?include "../domains/domainheader.php";?>
<!--<table width="60%" border="0" align="center" cellspacing="0" cellpadding="0">
  <?
	if(strtoupper($_SESSION["type"])=="A")
		{
?>
  <tr> 
    <td align="left" class="navigation">Administrator &gt; <?=$_SESSION["clientname"]?> &gt; <?=$_SESSION["domainname"]?> &gt; Manage SubDomains</td>
  </tr>
  <?
		}
	elseif(strtoupper($_SESSION["type"])=="C")
		{
?>
  <tr> 
    <td align="left" class="navigation"><?=$_SESSION["clientname"]?> &gt; <?=$_SESSION["domainname"]?> &gt; Manage SubDomains</td>
  </tr>
  <?
		}
	elseif(strtoupper($_SESSION["type"])=="D")
		{
?>
  <tr> 
    <td align="left" class="navigation"><?=$_SESSION["domainname"]?> &gt; Manage SubDomains </td>
  </tr>
  <?
		}
?>
  <tr> 
    <td>&nbsp;</td>
  </tr>
</table>-->
<?
	$domainid=$_SESSION["domainid"];
	$domainname=$_SESSION["domainname"];
	$username=$_SESSION["clientname"];
	$reselid=$_SESSION["clientid"];

	$query = "select subdomains from tbldomainrights where domainid = '$domainid'";
	$exSubdomains = @mysql_query($query);
	$rsSubdomains = @mysql_fetch_array($exSubdomains);
	$numOfSubDomains = $rsSubdomains["subdomains"];
	
	$query = "select count(*) as subDomainCnt from tblsubdomain where domainid = '$domainid'";
	$exUsedSubdomains = @mysql_query($query);
	$rsUsedSubdomains = @mysql_fetch_array($exUsedSubdomains);
	$UsedSubDomains = $rsUsedSubdomains["subDomainCnt"];

	if($numOfSubDomains > 0)
		{
			if($numOfSubDomains > $UsedSubDomains)
				{
?>
	<center><a href='addnewsubdomain.php'>Add New Sub Domain</a><center><br>
<?
				}
	$query = "Select * from tblsubdomain where domainid=$domainid";
	$array=mysql_query($query) or die(errorCatch(mysql_error()));
	if(mysql_num_rows($array) == 0)
		{
			Echo "<center>Sorry no SUBDOMAINS for the selected domain!!!</center><br><br>";
			include "../inc/footer.php";
			die();
		}
	else
		{
?>
  <div align="center">
<center>
      <table border="0" width="48%">
        <tr align="center" bgcolor="#FFFFFF"> 
          <td colspan="4"><div align="right"><b></b><b></b><b></b><b><a href=javascript:chk_frm(document.mainform)>
              <input class="commonbutton" type="button" name="Submit452" value="Remove Selected" onClick="return chk_frm(document.mainform)">
              </a></b></div></td>
        </tr>
        <tr align="center" bgcolor="#FFFFFF"> 
          <th width="35%"><b><font color="#003366" face="Trebuchet MS" size="2">Subdomain 
            Name</font></b></td>
          <th width="23%"><b><font color="#003366" face="Trebuchet MS" size="2">Username</font></b></td>
          <th width="26%"><b><font color="#003366" face="Trebuchet MS" size="2">Password</font></b></td>
          <th><b><font color="#003366" face="Trebuchet MS" size="2"><a href="javascript:invertChecked()" style="text-decoration:none;color=#003366">Sel</a></font></b></td>
        </tr>
        <?
			while($subDomain = mysql_fetch_array($array))
				{
?>
        <tr align="center" bgcolor="#FFFFFF"> 
          <td width="35%"><font size="2" color="#0B3986"> 
            <?=$subDomain["subdomain"]?>
            </font></td>
          <td width="23%"><font size="2" color="#0B3986"> 
            <?=$subDomain["username"]?>
            </font></td>
          <td width="26%"><font size="2" color="#0B3986"> 
            <?=$subDomain["password"]?>
            </font></td>
          <td width="16%"><input type="checkbox" name="subdomainid[]" value="<?=$subDomain["id"]?>"></td>
        </tr>
        <?
				}
		}

		}
	else
		{
			echo "<center>This domain has no rights to create SubDomains</center><br><br>";
			include "../inc/footer.php";
		}
?>
      </table>
</center>
</div>
</form>

</body>
</html>