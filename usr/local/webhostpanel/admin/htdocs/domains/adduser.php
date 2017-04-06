<?$ACCESS_LEVEL=3;?>
<?include "../inc/connection.php"?>
<?include "../inc/params.php"?>
<?include "../inc/functions.php"?>
<?include "../inc/security.php"?>
<html>
<head>
<title>Manage Users</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head><link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/general.css">
<link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/custom.css">
<link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/layout.css">
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=ISO-8859-1">
<META HTTP-EQUIV="EXPIRES" CONTENT="0">
</head>
<script>
	function chkdata(f)
	{
		if(f.username.value=="")
			{		
				alert("Please provide username");
				f.username.focus();
				return false;
			}

		if(f.pass1.value=="" && f.pass2.value=="")
			{		
				alert("Password can not be blank");
				f.pass1.focus();
				return false;
			}

		if(f.pass1.value!=f.pass2.value)
			{		
				alert("Two password does not match");
				f.pass1.focus();
				return false;
			}
		return true;
	}
</script>
<body leftmargin=0 topmargin=0>
<form name="mainform" action="../domains/adduser1.php" method="POST">
  <?include "../inc/mainheader.php"?>
  <?
	if(strtoupper($_SESSION["type"])!="D")
		include "../clients/clientheader.php";
?>
  <?include "../domains/domainheader.php";?>
  <?
	//Here we are select all the users for the selected domain
	$domainid=$_SESSION["domainid"];

	$query="select * from manageusers where domainid=$domainid";
	//myLog($query);
	$array=mysql_query() or die(errorCatch(mysql_error()));
	$num=mysql_num_rows($array);
	if($num!=0)
		{
?>
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
        &gt; Add User</td>
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
        &gt; Add User</td>
    </tr>
    <?
		}
	elseif(strtoupper($_SESSION["type"])=="D")
		{
?>
    <tr> 
      <td align="left" class="navigation"> 
        <?=$_SESSION["domainname"]?>
        &gt; Add User</td>
    </tr>
    <?
		}
?>
    <tr> 
      <td>&nbsp;</td>
    </tr>
  </table>

  <table width="80%" border="0" align="center">
  <tr> 
    <td colspan="4"><hr width="100%"></td>
  </tr>
  <tr> 
    <td width="47%"><div align="right"><font color="#FF0000" size="1" face="Verdana">USERNAME</font></div></td>
    <td width="3%"><font color="#FF0000">&nbsp;</font></td>
    <td width="32%"><font color="#FF0000" size="1" face="Verdana">PASSWORD</font></td>
    <td width="18%">&nbsp;</td>
  </tr>

<?
	while($result=mysql_fetch_array($array))
			{
?>

  <tr> 
    <td><?=$result["username"]?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><input type="checkbox" name="checkbox" value="checkbox"></td>
  </tr>
<?
			}
?>
  <tr> 
    <td colspan="4">&nbsp;</td>
  </tr>
</table>
<?
		}
//------------------------------------------------------------------------------------------------
?>


<table width="80%" border="0" align="center">
  <tr> 
    <td colspan="3"><hr width="100%"></td>
  </tr>
  <tr> 
    <td width="47%"><div align="right"><strong><font color="#003366" size="2" face="Verdana">Username</font></strong></div></td>
    <td width="3%">&nbsp;</td>
    <td width="50%"><input name="username" type="text" id="username"></td>
  </tr>
  <tr> 
    <td><div align="right"><strong><font color="#003366" size="2" face="Verdana">Password</font></strong></div></td>
    <td>&nbsp;</td>
    <td><input name="pass1" type="password" id="pass1"></td>
  </tr>
  <tr> 
    <td><div align="right"><strong><font color="#003366" size="2" face="Verdana">Confirm 
        Password</font></strong></div></td>
    <td>&nbsp;</td>
    <td><input name="pass2" type="password" id="pass2"></td>
  </tr>
  <tr> 
    <td><div align="right"><font color="#003366" size="2" face="Verdana"><strong>User 
        Shell</strong></font></div></td>
    <td>&nbsp;</td>
    <td><select name="usershell" id="usershell">
        <option>/bin/bash</option>
        <option>/sbin/nologin</option>
        <option>/bin/sync</option>
        <option>/sbin/shutdown</option>
        <option>/sbin/halt</option>
        <option>/dev/null</option>
        <option>/bin/false</option>
        <option>/bin/sh</option>
      </select></td>
  </tr>
  <tr> 
    <td colspan="3"><hr width="100%"></td>
  </tr>
  <tr>
    <td colspan="3"><div align="center">
        <input type="submit" name="Submit" value="Add User" class="commonbutton" onClick="return chkdata(document.mainform)">
        <input type="button" name="Submit2" value="Cancel" class="commonbutton">
      </div></td>
  </tr>
</table>
</form>
</body>
</html>
