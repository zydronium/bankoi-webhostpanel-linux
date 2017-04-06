<?$ACCESS_LEVEL=3;?>
<?include "../inc/connection.php"?>
<?include "../inc/params.php"?>
<?include "../inc/functions.php"?>
<?include "../inc/security.php"?>
<html>
<head>
<title>Crontab Manager</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head><link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/general.css">
<link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/custom.css">
<link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/layout.css">
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=ISO-8859-1">
<META HTTP-EQUIV="EXPIRES" CONTENT="0">

<script language="javascript">
function chk(f)
	{
		if(f.command.value=="")
			{
				alert("Please enter the command to be executed");
				f.command.focus();
				return false;
			}
		return true;
	}


function invertChecked()
			{
				f = document.mainform;
				for (i = 0 ; i < f.elements.length; i++) {
					if ((f.elements[i].type == "checkbox") && (f.elements[i].name.indexOf("delcron")==0)) {
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
					if ((f.elements[i].type == "checkbox") && (f.elements[i].name.indexOf("delcron")==0)) 
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
					alert("No Command selected to delete");
					//f.action="../domains/domains.php";
					//f.submit();
					return false;
				}
				else
				{
					//alert();
					f.action="../domains/deletecrontab.php";
					f.submit();
					return false;
				}
				
			}
			

</script>
</head>
<body leftmargin=0 topmargin=0><form name="mainform" action="addtocron.php" method="POST" > 
<?include "../inc/mainheader.php"?>
<?if(strtoupper($_SESSION["type"])=="C" || strtoupper($_SESSION["type"])=="A")
		include "../clients/clientheader.php";?>
<?include "../domains/domainheader.php"?>

<!--<table width="57%" border="0" align="center" cellspacing="0" cellpadding="0">
  <?
	if(strtoupper($_SESSION["type"])=="A")
		{
?>
  <tr> 
    <td align="left" class="navigation">Administrator &gt; 
      <?=$_SESSION["clientname"]?>
      &gt; 
      <?=$_SESSION["domainname"]?>
      &gt; Crontab Manager</td>
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
      &gt; Crontab Manager</td>
  </tr>
  <?
		}
	elseif(strtoupper($_SESSION["type"])=="D")
		{
?>
  <tr> 
    <td align="left" class="navigation"> 
      <?=$_SESSION["domainname"]?>
      &gt; Crontab Manager</td>
  </tr>
  <?
		}
?>
 </table>-->
<?
	$domainid=$_SESSION["domainid"];
	$query="select * from tblcron where domainid=$domainid";
	$arrCron=mysql_query($query) or die(errorCatch(mysql_error()));
	if(mysql_num_rows($arrCron)!=0)
		{
?>
<table width="58%" border="0" align="center">
  <tr bgcolor="#E0DDF0"> 
    <th height="15"><div align="center"><strong><font color="#003366" size="1" face="Verdana, Arial, Helvetica, sans-serif">Minutes</font></strong></div></td>
    <th><div align="center"><strong><font color="#003366" size="1" face="Verdana, Arial, Helvetica, sans-serif">Hours</font></strong></div></td>
    <th><div align="center"><strong><font color="#003366" size="1" face="Verdana, Arial, Helvetica, sans-serif">Day 
        Of Month</font></strong></div></td>
    <th><div align="center"><strong><font color="#003366" size="1" face="Verdana, Arial, Helvetica, sans-serif">Month</font></strong></div></td>
    <th><div align="center"><strong><font color="#003366" size="1" face="Verdana, Arial, Helvetica, sans-serif">Day 
        Of Week</font></strong></div></td>
    <th><div align="center"><strong><font color="#003366" size="1" face="Verdana, Arial, Helvetica, sans-serif">Command</font></strong></div></td>
    <th><div align="center"><font color="#003366" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong><a href="javascript:invertChecked()" style="text-decoration:none">Sel</a></strong></font></div></td>
  </tr>
  <?
	while($FetchCron=mysql_fetch_array($arrCron))
			{
?>
  <tr valign="top" bgcolor=""> 
    <td height="20" valign="middle"><div align="center"><font color="#003366"><font size="1"> 
        <?=$FetchCron["cronminute"]?>
        </font></font></div></td>
    <td valign="middle"><div align="center"><font color="#003366"><font size="1"> 
        <?=$FetchCron["cronhour"]?>
        <font face="Verdana, Arial, Helvetica, sans-serif"></font></font></font></div></td>
    <td valign="middle"><div align="center"><font color="#003366"><font size="1"> 
        <?=$FetchCron["cronday"]?>
        <font face="Verdana, Arial, Helvetica, sans-serif"></font></font></font></div></td>
    <td valign="middle"><div align="center"><font color="#003366"><font size="1"> 
        <?=$FetchCron["cronmonth"]?>
        <font face="Verdana, Arial, Helvetica, sans-serif"></font></font></font></div></td>
    <td valign="middle"><div align="center"><font color="#003366"><font size="1"> 
        <?=$FetchCron["cronweek"]?>
        <font face="Verdana, Arial, Helvetica, sans-serif"></font></font></font></div></td>
    <td valign="middle"><div align="center"><font color="#003366"><font size="1"> 
        <?=$FetchCron["croncommand"]?>
        <font face="Verdana, Arial, Helvetica, sans-serif"></font></font></font></div></td>
    <td><div align="center"> 
        <input name="delcron[]" type="checkbox" value="<?=$FetchCron["id"]?>">
      </div></td>
  </tr>
  
  <?
			}
?>
<tr valign="top" bgcolor="#FFFFFF"> 
    <td height="40" colspan="7"><div align="right">
        <input class="commonbutton" type="button" name="Submit452" value="Remove Selected" onClick="return chk_frm(document.mainform)">
      </div></td>
  </tr>
</table>
<?
		}
?>
<p>&nbsp;</p><table width="58%" border="0" align="center">
  <tr bgcolor="#E0DDF0"> 
    <th height="22" colspan="3"><div align="center" class="clientheading">CronTab Manager</div></tr>
  <tr> 
    <td width="50%"><div align="right" class="headings">Minute <font color="#FF0000">*</font></font></div></td>
    <td width="3%">&nbsp;</td>
    <td width="47%"><input name="minute" type="text" id="minute" class="textboxclass"></td>
  </tr>
  <tr> 
    <td><div align="right" class="headings">Hour <font color="#FF0000">*</font></font></div></td>
    <td>&nbsp;</td>
    <td><input name="hour" type="text" id="hour" class="textboxclass"></td>
  </tr>
  <tr> 
    <td><div align="right" class="headings">Day of the Month <font color="#FF0000">*</font></font></div></td>
    <td>&nbsp;</td>
    <td><input name="day" type="text" id="day" class="textboxclass"></td>
  </tr>
  <tr> 
    <td height="22"><div align="right" class="headings">Month <font color="#FF0000">*</font></font></div></td>
    <td>&nbsp;</td>
    <td><input name="month" type="text" id="month" class="textboxclass"></td>
  </tr>
  <tr> 
    <td><div align="right" class="headings">Day of the Week <font color="#FF0000">*</font></font></div></td>
    <td>&nbsp;</td>
    <td><input name="week" type="text" id="week" class="textboxclass"></td>
  </tr>
  <tr> 
    <td><div align="right" class="headings">Command <font color="#FF0000">*</font></font></div></td>
    <td>&nbsp;</td>
    <td><input name="command" type="text" id="command" size="30" class="textboxclass"></td>
  </tr>
  <tr> 
    <td height="24" colspan="3"><div align="center"><font color="#FF0000" size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong><img src="/skins/default/elements/line.gif" width=500 height=1 border=0></strong></font> 
      </div></td>
  </tr>
  <tr> 
    <td colspan="3"><div align="center"> 
        <input class="commonbutton" type="submit" name="Submit" value="Submit" onClick="return chk(document.mainform)">
      </div></td>
  </tr>
</table>
</body>
</form>
</html>
<br>
<?include "../inc/footer.php"?>
