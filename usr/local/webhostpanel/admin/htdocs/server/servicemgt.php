<?$ACCESS_LEVEL=1;?>
<?include "../inc/connection.php"?>
<?include "../inc/params.php"?>
<?include "../inc/functions.php"?>
<?include "../inc/security.php"?>
<html>
<head>
<script language="JavaScript">
function startservices(servicename)
	{
		if(confirm("Are you sure to start " + servicename))
			{
				//alert("../server/services.php?service=" + servicename);
				document.mainform.action = "../server/services.php?service=" + servicename + "&action=start";
				document.mainform.submit();
				return true;
			}
		else
			{
				return false;
			}
	}

function stopservices(servicename)
	{
		if(confirm("Are you sure to stop " + servicename))
			{
				//alert("../server/services.php?service=" + servicename);
				document.mainform.action = "../server/services.php?service=" + servicename + "&action=stop";
				document.mainform.submit();
				return true;
			}
		else
			{
				return false;
			}
	}

function restartservices(servicename)
	{
		if(confirm("Are you sure to restart " + servicename))
			{
				//alert("../server/services.php?service=" + servicename);
				document.mainform.action = "../server/services.php?service=" + servicename + "&action=restart";
				document.mainform.submit();
				return true;
			}
		else
			{
				return false;
			}
	}

</script>
</head>
<link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/general.css">
<link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/custom.css">
<link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/layout.css">


<body leftmargin=0 topmargin=0>
<form name="mainform" method="post">
<?include "../inc/mainheader.php"?>
  <!--<table width="59%" border="0" align="center" cellspacing="0" cellpadding="0">
<?
	if(strtoupper($_SESSION["type"])=="A")
		{
?>
    <tr> 
      <td align="left" class="navigation">Administrator &gt; Servers &gt; Service Management</td>
    </tr>
<?
		}
	elseif(strtoupper($_SESSION["type"])=="C")
		{

		}
	elseif(strtoupper($_SESSION["type"])=="D")
		{
		
		}
?>
    <tr> 
      <td>&nbsp;</td>
    </tr>
  </table>-->


  <table width="53%" border="0" align="center">
    <tr bgcolor="#D9D9FF"> 
      <td><div align="center" class="headings">Service</div>
        <div align="center" class="headings"></div></td>
      <td><div align="center" class="headings">Start</div></td>
      <td><div align="center" class="headings">Stop</div></td>
      <td><div align="center" class="headings">Restart</div></td>
      <td><div align="center" class="headings">Current Status</div></td>
    </tr>
<?
	if(CheckStatus("httpd") == 1)
		{
			$str = "Running";
			$start = "Disabled";
			$stop = "Enabled";
		}
	else
		{
			$str = "Stopped";
			$start = "Eabled";
			$stop = "Disabled";
		}
?>
    <!--<tr bgcolor="#FFFFFF"> 
		  <td class="headings"><div align="center">APACHE</div></td>
		 
		  <td width="15%" class="headings"><div align="center"><input type="image" src="/skins/<?=$_SESSION["skin"]?>/icons/on.gif" alt="Start Apache" border="0" onClick="return startservices('APACHE')" <?=$start?>></div></td>
		 
		  <td width="14%" class="headings" ><div align="center"><input type="image" src="/skins/<?=$_SESSION["skin"]?>/icons/off.gif" alt="Stop Apache" border="0" onClick="return stopservices('APACHE')" <?=$stop?>></div></td>
		 
		  <td width="20%" class="headings"><div align="center"><input type="image"  src="/skins/<?=$_SESSION["skin"]?>/icons/btn_refresh_bg.gif" width="20" height"20" alt="Restart Apache" border="0" onClick="return restartservices('APACHE')" ></div></td>

		  <td width="31%" align="center" class="clientheading"><?=$str?><div align="center"></div></td>
    </tr>-->
    
<?
	$st = CheckStatus("named") ;
	if($st== 1)
		{
			$str = "Running";
			$start = "Disabled";
			$stop = "Enabled";
		}
	else
		{
			$str = "Stopped";
			$start = "Eabled";
			$stop = "Disabled";
		}
?>	
	
	<tr bgcolor="#FFFFFF"> 
		  <td class="headings"><div align="center">DNS</div></td>
		  
		  <td class="headings"><div align="center"><input type="image" src="/skins/<?=$_SESSION["skin"]?>/icons/on.gif" alt="Start DNS" border="0" onClick="return startservices('DNS')" <?=$start?>></div></td>
		  
		  <td class="headings"><div align="center"><input type="image" src="/skins/<?=$_SESSION["skin"]?>/icons/off.gif" alt="Stop DNS" border="0" onClick="return stopservices('DNS')" <?=$stop?>></div></td>
		  
		  <td class="headings"><div align="center"><input type="image" src="/skins/<?=$_SESSION["skin"]?>/icons/btn_refresh_bg.gif" width="20" height"20" alt="Restart DNS" border="0" onClick="return restartservices('DNS')" ></div></td>

		  <td class="clientheading"><div align="center"><?=$str?></div></td>
    </tr>

<?
	if(CheckPostfixStatus() == 1)
		{
			$str = "Running";
			$start = "Disabled";
			$stop = "Enabled";
		}
	else
		{
			$str = "Stopped";
			$start = "Eabled";
			$stop = "Disabled";
		}
?>

    <!--<tr bgcolor="#FFFFFF"> 
		  <td class="headings"><div align="center">POSTFIX</div></td>
		  
		  <td class="headings"><div align="center"><input type="image" src="/skins/<?=$_SESSION["skin"]?>/icons/on.gif" alt="Start Postfix" border="0" onClick="return startservices('POSTFIX')" <?=$start?>></div></td>
		  
		  <td class="headings"><div align="center"><input type="image" src="/skins/<?=$_SESSION["skin"]?>/icons/off.gif" alt="Stop Postfix" border="0" onClick="return stopservices('POSTFIX')" <?=$stop?>></div></td>
		  
		  <td class="headings"><div align="center"><input type="image" src="/skins/<?=$_SESSION["skin"]?>/icons/btn_refresh_bg.gif" width="20" height"20" alt="Restart Postfix" border="0" onClick="return restartservices('POSTFIX')" ></div></td>

		  <td class="clientheading"><div align="center"><?=$str?></div></td>
    </tr>-->
<?
	if(CheckStatus("mysqld") == 1)
		{
			$str = "Running";
			$start = "Disabled";
			$stop = "Enabled";
		}
	else
		{
			$str = "Stopped";
			$start = "Eabled";
			$stop = "Disabled";
		}
?>
	
	



    <tr> 
      <td height="26" colspan="5"><div align="right"> </div></td>
    </tr>
    <tr> 
      <td height="26" colspan="5"><div align="right"> 
          <input name="button" type="button" class="commonButton" id="bid-update" onClick="window.location='../server/server.php'" value="Cancel" >
        </div></td>
    </tr>
  </table>
</form>
</body>
</html>
<br>
<?include "../inc/footer.php"?>