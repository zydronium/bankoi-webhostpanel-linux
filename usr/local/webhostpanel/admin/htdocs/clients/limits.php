<?$ACCESS_LEVEL=1;?>
<?include "../inc/connection.php"?>
<?include "../inc/params.php"?>
<?include "../inc/functions.php"?>
<?include "../inc/security.php"?>
<html>
<head>
<title>
Manage Clients Limits
</title>
</head>
<link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/general.css">
<link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/custom.css">
<link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/layout.css">
<body leftmargin=0 topmargin=0>
<form name="form1" action="" method="post">
  <?include "../inc/mainheader.php"?>
  <?include "../clients/clientheader.php"?>
  <?
	   $resellerid = $_SESSION["clientid"];
	   $username=$_SESSION["clientname"];
	   $query="select * from tblclientrights where resellerid= '$resellerid'";
	   $rs=mysql_query($query);
	   $res=mysql_fetch_array($rs);
	   ?>
  <!--<table width="61%" border="0" align="center" cellspacing="0" cellpadding="0">
    <?
	if(strtoupper($_SESSION["type"])=="A")
		{
?>
    <tr> 
      <td align="left" class="navigation">Administrator 
        &gt;
        <?=$_SESSION["clientname"]?>
        &gt;Limits</td>
    </tr>
    <?
		}
	elseif(strtoupper($_SESSION["type"])=="C")
		{
?>
    <tr> 
      <td align="left" class="navigation">
        <?=$_SESSION["clientname"]?>
        &gt;Limits</td>
    </tr>
    <?
		}
	elseif(strtoupper($_SESSION["type"])=="D")
		{
?>
    <tr> 
      <td align="left" class="navigation"></td>
    </tr>
    <?
		}
?>
    <tr> 
      <td>&nbsp;</td>
    </tr>
  </table>-->
  <table width="61%" border="0" align="center">
    <tr>
      <td width="80%">Set client <font color="#FF0000"><strong><?=$username?></strong></font> Limits</td>
      <td width="20%"><input name="button22" type="button" class="commonbutton" id="button22" title="Up Level" onClick="window.location='../domains/clientdomains.php'" value="Up Level" ></td>
    </tr>
  </table>
  <table width="18%" align="center" cellspacing="2">
    <?$val=$res["ftpusers"]==-1?"":$res["ftpusers"]?>
    <tr> 
      <td colspan="3" align="right" class="headings"><div align="right"> </div></td>
      <?$val=$res["popmailaccount"]==-1?"":$res["popmailaccount"]?>
    </tr>
    <tr>
      <td colspan="3" align="right" class="headings"><div align="center"><img src="/skins/default/elements/line.gif" width=400 height=1 border=0></div></td>
    </tr>
   <tr> 
      <td width="43%" align="right" class="headings">Pop mail Accounts</td>
      <td width="7%" align="center" class="headings">&nbsp;</td>
      <td width="50%" align="center"><div align="left"> 
          <input name="popmail" type="text" id="popmail" value="<?=$val?>" class="textboxclass">
        </div></td>
    </tr>
	
    <tr> 
      <td align="right" width="43%" class="headings"> MySql Databases</td>
      <td align="center">&nbsp;</td>
      <?$val=$res["sqldatabase"]==-1?"":$res["sqldatabase"]?>
      <td align="center"><div align="left"> 
          <input name="sql" type="text" id="sql" value="<?=$val?>" class="textboxclass">
        </div></td>
    </tr>
    <tr> 
      <td align="right" width="43%" class="headings">Email Alias</td>
      <td align="center" class="headings">&nbsp;</td>
      <?$val=$res["emailalias"]==-1?"":$res["emailalias"]?>
      <td align="center"><div align="left"> 
          <input name="email" type="text" id="email" value="<?=$val?>" class="textboxclass">
        </div></td>
    </tr>
	
	
    <tr> 
      <td align="right" class="headings">Disk Space</font></td>
      <td align="center" class="headings">&nbsp;</td>
      <td align="center"  class="headings"><div align="left"> 
          <?$val=$res["diskspace"]==-1?"":$res["diskspace"]?>
          <input name="diskspace" type="text" id="diskspace" value="<?=$val?>" class="textboxclass">
          <font color="#666666"><strong>MB</strong></font></div></td>
    </tr>
    <tr> 
      <td align="right" class="headings">Domains</td>
      <td align="center">&nbsp;</td>
      <td align="center"><div align="left"> 
          <?$val=$res["domains"]==-1?"":$res["domains"]?>
          <input name="domains" type="text" id="domains" value="<?=$val?>" class="textboxclass">
        </div></td>
    </tr>
    <tr> 
      <td align="right" class="headings">Traffic </td>
      <td align="center">&nbsp;</td>
      <td align="center"><div align="left" class="headings"> 
          <?$val=$res["traffic"]==-1?"":$res["traffic"]?>
          <input name="traffic" type="text" id="traffic" value="<?=$val?>" class="textboxclass">
          <font color="#666666"><strong>MB</strong></font></div></td>
    </tr>
    <tr> 
      <td colspan="3" align="right" class="clientheading"><font color="#FF0000"><strong>**Leave 
        field blank for Unlimited</strong></font></td>
    </tr>
    <tr> 
      <td colspan="3"><img src="/skins/default/elements/line.gif" width=400 height=1 border=0></td>
    </tr>
  </table>
<div align="center"><input class="commonButton" type="button" value="Set Limits" onClick="chk_form_data(document.form1)"><input class="commonButton" type="button" value="Cancel" onclick="javascript:history.back()"></div>
<p>&nbsp;</p>
<? include "../inc/footer.php" ?>
</form>
</head>
</html>



<?
		$query = "Select count(domainname) as numDomain  from tbldomain where resellerid = '$resellerid'";
		$exDomainCount = @mysql_query($query);
		$rsDomainCount = @mysql_fetch_array($exDomainCount);
		$numberOfDomains = $rsDomainCount["numDomain"];
		
		
		$query = "select domainid from tbldomain where resellerid = '$resellerid'";
		$exDomains = @mysql_query($query);
		
		if($numberOfDomains > 0)
			{
				while($rsDomains = @mysql_fetch_array($exDomains))
							{
								if($domainIDS == "")
									{
										$domainIDS = $rsDomains["domainid"];
									}
								else
									{
										$domainIDS = $domainIDS . "," . $rsDomains["domainid"];
									}
							}
			}


		if($numberOfDomains > 0)
			{
					$query = "select sum(popmailaccount) as popacc,sum(sqldatabase) as sqldb,sum(diskspace) as disksp,sum(emailalias) as alias,sum(traffic) as traffic from tbldomainrights where domainid in ($domainIDS)"; 
					$exResellerRights = @mysql_query($query);
					$rsResellerRights = @mysql_fetch_array($exResellerRights);

					$usedPopAcc = $rsResellerRights["popacc"];
					$usedSqlDB = $rsResellerRights["sqldb"];
					$usedSpace = $rsResellerRights["disksp"];
					$usedAlias = $rsResellerRights["alias"];
					$usedTraffic = $rsResellerRights["traffic"];

			}
?>
<script>
function chk_form_data(f)
{
    if(validate(f))
	   {
			f.action = "/clients/setlimits.php";
			f.submit();
			return true;
		}	
	return false
}


function validate(f)
{
		if(isNaN(f.popmail.value) || parseInt(f.popmail.value) < 0)
		 {
			alert("Popmail account requires a +ve numbers Only");
			f.popmail.value="";
			f.popmail.focus()
			return false;
		  }


		if(isNaN(f.sql.value) || parseInt(f.sql.value) < 0)
		 {
			alert("Sql database requires a +ve numbers Only");
			f.sql.value="";
			f.sql.focus()
			return false;
		  }	  


		if(isNaN(f.email.value) || parseInt(f.email.value) < 0)
		 {
			alert("Sql database requires a +ve numbers Only");
			f.email.value="";
			f.email.focus()
			return false;
		  }	  


		if(isNaN(f.diskspace.value) || parseInt(f.diskspace.value) < 0)
		 {
			alert("Disk Space requires a +ve numbers Only");
			f.diskspace.value="";
			f.diskspace.focus()
			return false;
		  }
	  
	  
		if(isNaN(f.traffic.value) || parseInt(f.traffic.value) < 0)
		 {
			alert("Traffic requires a +ve numbers Only");
			f.traffic.value="";
			f.traffic.focus()
			return false;
		  }

		
		if(parseInt(<?=$numberOfDomains?>) > 0)
			{
					
					if(parseInt(f.popmail.value) < parseInt(<?=$usedPopAcc?>))
					 {
						alert("This client has allocated " + " <?=$usedPopAcc?> " + " popmail accounts \nto its domain.His limits can not be less than " + " <?=$usedPopAcc?> " + "!!!");
						f.popmail.value="<?=$usedPopAcc?>";
						f.popmail.focus()
						return false;
					  }


					if(parseInt(f.sql.value) < parseInt(<?=$usedSqlDB?>))
					 {
						alert("This client has allocated " + " <?=$usedSqlDB?> " + " sql database accounts \nto its domain.His limits can not be less than " + " <?=$usedSqlDB?> " + "!!!");
						f.sql.value="<?=$usedSqlDB?>";
						f.sql.focus()
						return false;
					  }	  


					if(parseInt(f.email.value) < parseInt(<?=$usedAlias?>))
					 {
						alert("This client has allocated " + " <?=$usedAlias?> " + "mailalias accounts \nto its domain.His limits can not be less than " + " <?=$usedAlias?> " + "!!!");
						f.email.value="<?=$usedAlias?>";
						f.email.focus()
						return false;
					  }	  


					if(parseInt(f.diskspace.value) < parseInt(<?=$usedSpace?>))
					 {
						alert("This client has allocated " + " <?=$usedSpace?> " + " space \nto its domain.His limits can not be less than " + " <?=$usedSpace?> " + "!!!");
						f.diskspace.value="<?=$usedSpace?>";
						f.diskspace.focus()
						return false;
					  }
				  
				  
				   if(parseInt(<?=$numberOfDomains?>) > parseInt(f.domains.value))
					  {
						alert("This client has " + " <?=$numberOfDomains?> " + " domain to his credit.The minimum number of domains \nfor this client should be equal to " + " <?=$numberOfDomains?> " + "!!!");
						f.domains.value="<?=$numberOfDomains?>";
						f.domains.focus()
						return false;
					  }

					if(parseInt(f.traffic.value) < parseInt(<?=$usedTraffic?>))
					 {
						alert("This client has allocated " + " <?=$usedTraffic?> " + " traffic \nto its domain.His limits can not be less than " + " <?=$usedTraffic?> " + "!!!");
						f.traffic.value="<?=$usedTraffic?>";
						f.traffic.focus()
						return false;
					  }
			}
	  return true;
}
</script>
