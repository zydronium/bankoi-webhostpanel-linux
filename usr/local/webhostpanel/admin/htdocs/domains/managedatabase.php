<?$ACCESS_LEVEL=3;?>
<?include "../inc/connection.php"?>
<?include "../inc/params.php"?>
<?include "../inc/functions.php"?>
<?include "../inc/security.php"?>
<html>
<head>
<title>Manage Database</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head><link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/general.css">
<link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/custom.css">
<link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/layout.css">
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=ISO-8859-1">
<META HTTP-EQUIV="EXPIRES" CONTENT="0">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<script language="javascript">
	function chk(f)
		{
			
			if(f.databasename.value=="")
				{
					alert("Please provide database name");
					f.databasename.focus();
					return false
				}

			if(f.username.value=="")
				{
					alert("Please provide username");
					f.username.focus();
					return false
				}
			
			if(f.pass.value=="")
				{
					alert("Please provide password");
					f.pass.focus();
					return false
				}
			return true
		}


function invertChecked()
			{
				f = document.mainform;
				for (i = 0 ; i < f.elements.length; i++) {
					if ((f.elements[i].type == "checkbox") && (f.elements[i].name.indexOf("domainid")==0)) {
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
					if ((f.elements[i].type == "checkbox") && (f.elements[i].name.indexOf("domainid")==0)) 
						{
						if (f.elements[i].checked) 
							{
								counter=counter+1;
							}
						}
					}
				if(counter==0)
				{
					alert("No Database to delete");
					return false;
				}
				else
				{
					f.action="../domains/deletedatabase.php";
					f.submit();
					return false;
				}
				
			}

</script>

<body topmargin="0">
<form name="mainform" action="createdatabase.php" method="post" onSubmit="return chk(document.mainform)">
  <?
	$domainid=$_SESSION["domainid"];
	$domainname = $_SESSION["domainname"];
	include "../inc/mainheader.php";
	if(strtoupper($_SESSION["type"])=="C" || strtoupper($_SESSION["type"])=="A")
		include "../clients/clientheader.php";
	include "../domains/domainheader.php";
?>
  <!--<table width="61%" border="0" align="center" cellspacing="0" cellpadding="0">
    <?
	if(strtoupper($_SESSION["type"])=="A")
		{
?>
    <tr> 
      <td align="left" class="navigation">Administrator&gt;<?=$_SESSION["clientname"]?>&gt;<?=$_SESSION["domainname"]?>&gt;Manage Database</td>
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
        <?=$domainname?>
        &gt;Manage Database</td>
    </tr>
    <?
		}
	elseif(strtoupper($_SESSION["type"])=="D")
		{
?>
    <tr> 
      <td align="left" class="navigation"> 
        <?=$domainname?>
        &gt; Manage Database</td>
    </tr>
    <?
		}
?>
    <tr> 
      <td>&nbsp;</td>
    </tr>
  </table>-->

  <p>&nbsp;</p><table width="63%" border="0" align="center">
    <?
	
	$query = "Select * from tbldatabase where domainid='$domainid'";
	//echo $query;
	$data = mysql_query($query) or die("Can not get the database listing");
	if(mysql_num_rows($data) <= 0)
		{
				//echo "No database created";
		}
		else
		{
?>
    <tr bgcolor="#FFFFFF"> 
      <td colspan="5"><div align="center" class="clientheading"> 
          Databases Created So Far</font></strong>
          </div>
        <div align="center"><strong></strong></div>
        <div align="center"><strong></strong></div>
        <div align="center"><strong></strong></div></td>
    </tr>
    <tr bgcolor="#E2F0FE"> 
      <th width="32%"><div align="center" class="tableheadings"> 
          Database
        </div></td>
      <th width="33%"><div align="center" class="tableheadings"> 
          Username
        </div></td>
      <th width="27%"><div align="center" class="tableheadings"> 
          Password
        </div></td>
      <th width="4%"><div align="center" class="tableheadings"><a href="javascript:invertChecked()" style="text-decoration:none"> 
          Sel
          </a> </div></td>
      <th width="4%"  class="tableheadings">Manage DB</td> </tr>
    <?
	while($recordDatabase = mysql_fetch_array($data))
					{
?>
    <tr valign="middle" bgcolor=""> 
      <td height="18"><div align="center" class="mainheading"> 
          <?=$recordDatabase["databasename"]?>
        </div></td>
      <td><div align="center" class="mainheading"> 
          <?=$recordDatabase["dbusername"]?>
        </div></td>
      <td><div align="center" class="mainheading"> 
          <?=$recordDatabase["dbpassword"]?>
        </div></td>
      <td><div align="center"> 
          <input type="checkbox" name="domainid[]" value="<?=$recordDatabase["databasename"]?>">
        </div></td>
      <td><a href = "/phpMyAdmin" target="_blank"><img src="../skins/<?=$_SESSION["skin"]?>/icons/phpmyadmin.JPG" border="0"></a></td>
    </tr>
    <?
					}
?>
    <tr valign="top" bgcolor="#FFFFFF"> 
      <td height="18" colspan="5"><div align="right"> 
          <input class="commonbutton" type="button" name="Button" value="Remove Database" title="Remove Database" onClick="return chk_frm(document.mainform)">
        </div></td>
    </tr>
  </table>
<?
			  }

		$query = "select count(*) as countSqlDatabase from tbldatabase where domainid='$domainid'";
		$exSqlDatabase = @mysql_query($query);
		$rsSqlDatabase = @mysql_fetch_array($exSqlDatabase);
		$domainUsedSqlDatabase = $rsSqlDatabase ["countSqlDatabase"];

		$query = "select sqldatabase from tbldomainrights where domainid='$domainid'";
		$exAssignedSqlDatabase = @mysql_query($query);
		$rsAssignedSqlDatabase = @mysql_fetch_array($exAssignedSqlDatabase);
		$domainAssignedSqlDatabase = $rsAssignedSqlDatabase ["sqldatabase"];

		if($domainUsedSqlDatabase  < $domainAssignedSqlDatabase)
			{

?>
  <table width="593" align="center">
    <tr> 
      <th colspan="3" align="right" class="headings"><div align="center"><strong><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Create Database </font></strong></div></td>
        </tr>
    <tr> 
      <td width="282" align="right" class="headings">Database Name:</td>
      <td width="30" align="center">&nbsp;</td>
      <td width="265" align="left"><input type="text" name="databasename" class="textboxclass"></td>
    </tr>
    <tr> 
      <td align="right" class="headings">Username: </td>
      <td width="30" align="center">&nbsp;</td>
      <td width="265" align="left"><input type="text" name="username" value="" class="textboxclass"></td>
    </tr>
    <tr> 
      <td align="right" class="headings">Password: </td>
      <td align="center">&nbsp;</td>
      <td align="left"><input type="password" name="pass" value="" class="textboxclass"></td>
    </tr>
    <tr> 
      <td height="32" colspan="3" align="right"><div align="center"><font color="#FF0000" size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong><img src="/skins/default/elements/line.gif" width=600 height=1 border=0></strong></font></div></td>
    </tr>
    <tr>
      <td align="right" colspan="3"><div align="center">
          <input class="commonbutton" type="submit" name="sub" value="Create Database" title="Create Database">
          <input class="commonbutton" type="button" name="Submit2" value="Cancel" title="Cancel" onClick="window.location='../domains/showdomaindetails.php'">
        </div></td>
    </tr>
  </table>
<?
			}
	else
		{
			echo "<center><div class=\"navigation\">The domain has used all its DATABASE accounts</div></center>";
		}
?>
</form>
<br><br><tr><td align="center">
<? include "../inc/footer.php" ?></td></tr>
</body>
</html>

