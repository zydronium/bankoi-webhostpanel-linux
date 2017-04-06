<?$ACCESS_LEVEL=3?>
<?include "../inc/connection.php"?>
<?include "../inc/params.php"?>
<?include "../inc/functions.php"?>
<?include "../inc/security.php"?>
<html>
<head>
<title>Add SubDomains</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head><link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/general.css">
<link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/custom.css">
<link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/layout.css">
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=ISO-8859-1">
<META HTTP-EQUIV="EXPIRES" CONTENT="0">
</head>
<body leftmargin=0 topmargin=0>
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
    <td align="left" class="navigation">Administrator &gt; 
      <?=$_SESSION["clientname"]?>
      &gt; 
      <?=$_SESSION["domainname"]?>
      &gt; Add SubDomains</td>
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
      &gt; Add SubDomains</td>
  </tr>
  <?
		}
	elseif(strtoupper($_SESSION["type"])=="D")
		{
?>
  <tr> 
    <td align="left" class="navigation">
      <?=$_SESSION["domainname"]?>
      &gt; Add SubDomains </td>
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
?>



<script>
function chk_dom(dom_name)
{
	nore = /\.$/;
	re = /^[A-Za-z0-9]([A-Za-z0-9-]*[A-Za-z0-9])*(\.[A-Za-z0-9]([A-Za-z0-9-]*[A-Za-z0-9])*)+$/;
	return (dom_name.search(nore) == -1) && (dom_name.search(re) != -1);
}
function chk_form_data1(f)
{
	if(f.subdomain.value=="")
	{
		alert("Enter subdomain name");
		f.username.focus();
		return false;
	}

	if(f.username.value=="")
	{
		alert("Enter Username");
		f.username.focus();
		return false;
	}

	if(f.password.value=="")
	{
		alert("Enter Password");
		f.username.focus();
		return false;
	}
	return true;
}
</script>

<?
	$query = "select subdomains from tbldomainrights where domainid = '$domainid'";
	$exSubdomains = @mysql_query($query);
	$rsSubdomains = @mysql_fetch_array($exSubdomains);
	$numOfSubDomains = $rsSubdomains["subdomains"];

	if($numOfSubDomains > 0)
		{
?>


<body>
<form method="POST" name="mainform" action="addsubdomain.php" onSubmit="return chk_form_data1(document.mainform)">
  <div align="center">
    <center>
      <table border="0" width="48%">
        <tr bgcolor="#FFFFFF"> 
          <th width="100%" colspan="2"> <p align="center"><b><font face="Trebuchet MS" size="2" color="#003366">Add 
              New Sub Domain</font></b></td> </tr>
        <tr bgcolor="#FFFFFF"> 
          <td width="30%" height="36"><font face="Trebuchet MS" size="2" color="#0B3986"><b>Sub 
            domain Name</b></font></td>
          <td width="70%"><input type="text" name="subdomain" size="20">
            <?="." . $domainname?>
          </td>
        </tr>
        <tr bgcolor="#FFFFFF"> 
          <td width="30%"><font size="2" color="#0B3986" face="Trebuchet MS"><b>Username</b></font></td>
          <td width="70%"><input type="text" name="username" size="20"></td>
        </tr>
        <tr bgcolor="#FFFFFF"> 
          <td width="30%"><font color="#0B3986" size="2" face="Trebuchet MS"><b>Password</b></font></td>
          <td width="70%"><input type="password" name="password" size="20"></td>
        </tr>
        <tr bgcolor="#FFFFFF"> 
          <td width="100%" colspan="2"> <p align="center"><font color="#006666"><img src="/skins/<?=$_SESSION["skin"]?>/elements/line.gif" width=400 height=1 border=0></font> 
          </td>
        </tr>
        <tr bgcolor="#FFFFFF">
          <td colspan="2"><div align="center">
              <input class="commonbutton" type="submit" value="Add Sub Domain" name="amt">
              <input class="commonbutton" type="button" value="Back" name="Back" onClick="window.location='managesubdomain.php'">
            </div></td>
        </tr>
      </table>
    </center>
  </div>
</form>
<?
		}
	else
		{
			echo "<center>This domain has no rights to create SubDomains</center>";
		}
?>
<br>
<? include "../inc/footer.php" ?>
</body>

