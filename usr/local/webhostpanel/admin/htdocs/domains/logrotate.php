<?$ACCESS_LEVEL=3;?>
<?include "../inc/connection.php"?>
<?include "../inc/params.php"?>
<?include "../inc/functions.php"?>
<?include "../inc/security.php"?>
<html>
<head>



<title>Log Manager</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head><link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/general.css">
<link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/custom.css">
<link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/layout.css">
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=ISO-8859-1">
<META HTTP-EQUIV="EXPIRES" CONTENT="0">
<body leftmargin=0 topmargin=0>
<?include "../inc/mainheader.php"?>
<?if(strtoupper($_SESSION["type"])=="C" || strtoupper($_SESSION["type"])=="A")
		include "../clients/clientheader.php";?>
<?include "../domains/domainheader.php"?>
<script>
function chk(f)
	{
		for (var i=0; i < document.form1.opt.length; i++)
		 {      
		 	if (document.form1.opt[i].checked) 
				{         
					//alert(document.form1.opt[i].value);
					if(document.form1.opt[i].value=="s")
						{
							if(document.form1.size.value=="")
								{
									alert("Provide a value for the log file size");
									document.form1.size.focus();
									return false;
								}
								
							if(isNaN(document.form1.size.value))
								{
									alert("Size can only be numbers please");
									document.form1.size.value = "";
									document.form1.size.focus();
									return false;
								}
						}
					if(document.form1.opt[i].value=="t")
						{
							if(document.form1.time.value=="")
								{
									alert("Please select the value for time base log rotation.");
									document.form1.time.focus();
									return false;
								}
						}
						
				}   
		}
		
		
		if(document.form1.numberoffiles.value=="")
			{
				alert("Please provide a value for the number of log files");
				document.form1.numberoffiles.focus();
				return false;
			}
			
		if(isNaN(document.form1.numberoffiles.value))
			{
				alert("Only numbers please for number of log rotate file");
				document.form1.numberoffiles.value = "";
				document.form1.numberoffiles.focus();
				return false;
			}
		return true;
	}
</script>

<!--<table width="60%" border="0" align="center" cellspacing="0" cellpadding="0">
  <?
	if(strtoupper($_SESSION["type"])=="A")
		{
?>
  <tr> 
    <td height="32" align="left" class="navigation">Administrator &gt; 
      <?=$_SESSION["clientname"]?>
      &gt; 
      <?=$_SESSION["domainname"]?>
      &gt; Log Manager</td>
  </tr>
  <?
		}
	elseif(strtoupper($_SESSION["type"])=="C")
		{
?>
  <tr> 
    <td height="29" align="left" class="navigation"> 
      <?=$_SESSION["clientname"]?>
      &gt; 
      <?=$_SESSION["domainname"]?>
      &gt; Log Manager</td>
  </tr>
  <?
		}
	elseif(strtoupper($_SESSION["type"])=="D")
		{
?>
  <tr> 
    <td height="26" align="left" class="navigation"> 
      <?=$_SESSION["domainname"]?>
      &gt; Log Manager</td>
  </tr>
  <?
		}
?>
 </table>-->

<?
	$domainname = $_SESSION["domainname"];
	$query = "select * from tbllogrotate where domainid='$domainid'";
	$check = mysql_query($query);
	if(mysql_num_rows($check) <= 0)
		{
			$str = "Log Rotate Disabled For The Domain " . $domainiame;
		}
	else
		{
			$str = "Log Rotate Enabled For The Domain " . $domainiame;
			$resultarr = mysql_fetch_array($check);
			if($resultarr["condition"] == "size")
				{
					$size1 = $resultarr["condition_val"];
					$valofradiosize = "checked";
				}
			else
				{
					$time1 = $con_val = $resultarr["condition_val"];
					$valofradiotime = "checked";
				}
			
			$numfiles = $resultarr["files_no"];
			$compressed = $resultarr["compressed"];
			if($compressed == "1")
				$st="checked";
			else
				$st = "";
		}
?>
<form name="form1" method="post" action="../domains/createlogfiles.php">
  <table width="458" border="0" align="center">
    <tr bgcolor="#FBDCC8"> 
      <th height="21" colspan="3"><div align="center" class="clientheading">Log 
          Manager</div></tr>
    <tr bgcolor="#FFFFFF"> 
      <td colspan="3" align ="center" class="navigation"> 
        <?=$str?>
      </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td class="headings">&nbsp;</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td width="186"><div align="right" class="headings">Log rotation condition:<font color="#FF0000">*</font></div></td>
      <td width="22">&nbsp;</td>
      <td width="236" class="headings"> 
        <?
	     if($valofradiotime == "")
				{		 
?>
        <input type="radio" name="opt" value="s" checked> 
        <?
				}
		else	
				{
?>
        <input type="radio" name="opt" value="s" <?=$valofradiosize?>> 
        <?
				}
?>
        By Size 
        <input name="size" type="text" id="size" size="10" value="<?=$size1?>" class="textboxclass">
        KB</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td><div align="right"></div></td>
      <td>&nbsp;</td>
      <td class="headings"><input type="radio" name="opt" value="t" <?=$valofradiotime?>>
        By Time 
        <select name="time" id="time">
          <option value=""></option>
          <option value="daily" <?if($time1=='daily') echo "selected"?>>Daily</option>
          <option value="weekly" <?if($time1=='weekly') echo "selected"?>>Weekly</option>
          <option value="monthly" <?if($time1=='monthly') echo "selected"?>>Monthly</option>
        </select></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td><div align="right" class="headings">Max number of log files:</div></td>
      <td>&nbsp;</td>
      <td><input name="numberoffiles" type="text" id="numberoffiles" size="5" value="<?=$numfiles?>" class="textboxclass"> 
      </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td><div align="right" class="headings">Compress log files:</div></td>
      <td>&nbsp;</td>
      <td> <input name="compressfiles" type="checkbox" id="compressfiles" value="1" <?=$st?>></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td colspan="3"><div align="right"><font color="#006666"><img src="/skins/<?=$_SESSION["skin"]?>/elements/line.gif" width=500 height=1 border=0></font></div></td>
    </tr>
    <tr> 
      <td colspan="3"><div align="center"> 
          <input class="commonbutton" type="submit" name="Submit" value="Submit" onClick="return chk()">
        </div></td>
    </tr>
  </table>
</form>
</body>
</html>
<br>
<?include "../inc/footer.php"?>

