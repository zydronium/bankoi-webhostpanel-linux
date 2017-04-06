<?$ACCESS_LEVEL=2;?>
<?
include "../inc/connection.php";
?>
<?include "../inc/security.php"?>
<?include "../inc/functions.php"?>
<html>
<head>
<title>Configure Domain</title>

<link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/general.css">
<link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/custom.css">
<link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/layout.css">
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=ISO-8859-1">
<META HTTP-EQUIV="EXPIRES" CONTENT="0">

<script language="JavaScript" src="/js/functions.js"></script>
<script language="javascript">

function validate(f)
{
  if(isNaN(f.value))
     {
        alert("Numbers Only");
        f.value="";
	    return false;
      }
   return true;
}




//---------------------------------------------------------------------------------------------------------
function chk(f)
{
  	emailExp= /^\w+(\-\w+)*(\.\w+(\-\w+)*)*@\w+(\-\w+)*(\.\w+(\-\w+)*)+$/;
	    if(!f.ftpusername.value)
          {
				alert("FTP username is empty");
				f.ftpusername.focus();
				return false;
		  }

		if(!f.password.value)
          {
				alert("password is empty");
				f.password.focus();
				return false;
		  }
	
if(!f.popmailaccount.value){
    f.popmailaccount.value="0";
	return true;
	}

if(!f.mysqldatabase.value){
     f.mysqldatabase.value="0";
	 return true;
	 }


  return true;
}


//-----------------------------------
function chk_form_data1(f)
{
	if(!chk(f))
	   return false
	f.submit();
	return true;
}

		function chk_form_data(f)
		{
			return true;
		}

		function setFocus()
		{
			if (document.forms[0].domain_name)
				document.forms[0].domain_name.focus();
		}
		

</script>	
</head>	
<? 
	$reselid=$_SESSION["clientid"];
	$username=$_SESSION["clientname"];
	$domainid=$_GET["domainid"];
?>
<body leftmargin=0 topmargin=0>

<?
	include "../inc/mainheader.php";
	include "../clients/clientheader.php";
?>

<form action="../domains/create_domain.php" method="post" name="mainform" onSubmit="return chk(document.mainform)">
  <table width="80%" border="0" align="center" cellspacing="0" cellpadding="0">
    <?
	if(strtoupper($_SESSION["type"])=="A")
		{
?>
    <tr> 
      <td align="left" class="navigation">Administrator &gt; 
        <?=$_SESSION["clientname"]?>
        &gt; Configuring Hosting</td>
    </tr>
    <?
		}
	elseif(strtoupper($_SESSION["type"])=="C")
		{
?>
    <tr> 
      <td align="left" class="navigation"> 
        <?=$_SESSION["clientname"]?>
        &gt; Configuring Hosting</td>
    </tr>
    <?
		}
	elseif(strtoupper($_SESSION["type"])=="D")
		{
?>
    <tr> 
      <td align="left" class="navigation">&nbsp; </td>
    </tr>
    <?
		}
?>
    <tr> 
      <td>&nbsp;</td>
    </tr>
  </table>

  <table width=564 border=0 cellpadding=0 cellspacing=0 align="center">
  <tr >	 
	  <td colspan=5 align="center"><img src="/skins/<?=$_SESSION["skin"]?>/elements/line.gif" width=560 height=1 border=0>	  
	  </td>
	</tr>
		<tr><td colspan=5><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="1" height="8" border="0"></td></tr>
		<tr><td>
	    <table border=0 cellpadding=0 cellspacing=0 align="left">
		    <tr>
			    <td width=3><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="3" height="1" border="0"></td>
			    <td width=436>Domain of <font name="verdana" color="red"><strong><?=$username?></strong></font></b><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" width="100%" height=1 alt="" border=0></img></td>
			    <td width=7><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="7" height="1" border="0"></td>
			    
            <td width=115 align="right" class="verttop">&nbsp;</td>
			    <td width=3><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="3" height="1" border="0"></td>
		    </tr>
        </table></td></tr>

		<tr><td colspan=5><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="1" height="16" border="0"></td></tr>

		<tr>
			<td colspan=5>
			<table width="100%" border=0 cellpadding=0 cellspacing=0 align="left">
          <?
    
    $query="select domainname from tbldomain where domainid=$domainid";
	//myLog($query);
	$array=mysql_query($query) or die(errorCatch(mysql_error()));
	$domainset=@mysql_fetch_array($array);
	$domainname1=$domainset["domainname"];
?>
          <tr> 
            <td width="46%" align="right" class="headings"><strong>Domain 
              name</strong></font></td>
            <td width="4%" align="center"></td>
            <td width="50%" align="left"><font color="#FF0000"><b>
              <?=$domainname1?>
              </font></td>
          </tr>
          <tr> 
            <td><font color="#003366"><strong><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="1" height="8" border="0"></strong></font></td>
          </tr>
          <tr> 
            <td><font color="#003366"><strong><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="1" height="8" border="0"></strong></font></td>
          </tr>
          <tr> 
            <td width="46%" align="right" class="headings">Select 
              IP address</td>
            <td></td>
            <?
//-------------------------------------------------------------------------------------------------------
//here we show only the ipaddress assigned to the reseller
$query="select tblserverip.ipaddress,tblserverip.iptype,tblserverip.id from (tblresellerip inner join tblserverip on tblresellerip.ipaddress=tblserverip.id) where tblresellerip.resellerid='$reselid'";
//myLog($query);
$array=mysql_query($query) or die(errorCatch(mysql_error()));
?>
            <td width="50%" align="left"><select name="ip_addr_id" >
                <?
   while($result=mysql_fetch_array($array))
   {
?>
                <option value="<?=$result["id"]?>">
                <?=$result["ipaddress"]." -> " . $result["iptype"]?>
                <?
   }
?>
              </select> </td>
          </tr>
         
          <tr> 
            <td colspan=3><table width="100%" border=0 cellspacing=0 cellpadding=0 align="left">
                <tr> 
                  <td width="46%"><font color="#003366"><strong><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="1" height="8" border="0"></strong></font></td>
                </tr>
                <tr> 
                  <td align="right" class="headings">FTP Username</td>
                  <td width="4%" align="center"><div align="left"><font color="#FF0000">*</font></div></td>
                  <td width="50%" align="left"><input type="text" name="ftpusername" value="" size=25 maxlength=255 class="textboxclass"></td>
                </tr>
                <tr> 
                  <td><font color="#003366"><strong><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="1" height="8" border="0"></strong></font></td>
                </tr>
                <tr> 
                  <td align="right" class="headings">FTP User Password</td>
                  <td align="center"><div align="left"><font color="#FF0000">*</font></div></td>
                  <td align="left"><input type="password" name="password" value="" size=25 maxlength=255 class="textboxclass"></td>
                </tr>
                <tr> 
                  <td><font color="#003366"><strong><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="1" height="8" border="0"></strong></font></td>
                </tr>
                <tr> 
                  <td align="right" class="headings">User Shell:</td>
                  <td align="center"><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="7" height="1" border="0"></td>
                  <td align="left"> <select name="shellname" style="color: red; font-family: Verdana" class="textboxclass">
                      <option value="/bin/sh">/bin/sh</option>
                      <option value="/bin/bash">/bin/bash</option>
                      <option value="/bin/bash2">/bin/bash2</option>
                      <option value="/bin/ash">/bin/ash</option>
                      <option value="/bin/bsh">/bin/bsh</option>
                      <option value="/bin/tcsh">/bin/tcsh</option>
                      <option value="/bin/csh">/bin/csh</option>
                      <option value="/bin/false" selected>None</option>
                    </select> </td>
                </tr>
                <tr> 
                  <td><font color="#003366"><strong><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="1" height="8" border="0"></strong></font></td>
                </tr>
                <tr> 
                  <td align="right" class="headings">Pop mail Account:</td>
                  <td align="center">&nbsp;</td>
                  <td align="left"><input type="text" name="popmailaccount" value="10" size=5 maxlength=255 onChange="return validate(document.mainform.popmailaccount)" class="textboxclass"></td>
                </tr>
                <tr> 
                  <td><font color="#003366"><strong><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="1" height="8" border="0"></strong></font></td>
                </tr>
                <tr> 
                  <td align="right" class="headings">Email aliases:</td>
                  <td align="center">&nbsp;</td>
                  <td align="left"><input type="text" name="emailalias" value="10" size=5 maxlength=255 class="textboxclass"></td>
                </tr>
                <tr> 
                  <td><font color="#003366"><strong><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="1" height="8" border="0"></strong></font></td>
                </tr>
                <tr> 
                  <td align="right" class="headings">MySql Database:</td>
                  <td align="center">&nbsp;</td>
                  <td align="left"><input type="text" name="mysqldatabase" value="1" size=5 maxlength=255 onChange="return validate(document.mainform.mysqldatabase)" class="textboxclass"></td>
                </tr>
                <tr> 
                  <td><font color="#003366"><strong><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="1" height="8" border="0"></strong></font></td>
                </tr>
                <tr> 
                  <td align="right" class="headings">Hard Disk Space:</td>
                  <td align="center"><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="7" height="1" border="0"></td>
                  <td align="left" class="headings"><input type="text" name="hdspace" value="" size=5 maxlength=255  class="textboxclass"> 
                    MB</td>
                </tr>
                <tr> 
                  <td><font color="#003366"><strong><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="1" height="8" border="0"></strong></font></td>
                </tr>
                <tr> 
				<tr> 
                  <td align="right" class="headings">Traffic</td>
                  <td align="center"><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="7" height="1" border="0"></td>
                  <td align="left" class="headings"><input name="trafficport" type="text" id="trafficport" value="" size=5  class="textboxclass">
                    MB </td>
                </tr>
                <tr> 
                  <td><font color="#003366"><strong><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="1" height="8" border="0"></strong></font></td>
                </tr>
                  <td align="right" class="headings">Password Protect:</td>
                  <td align="center"><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="7" height="1" border="0"></td>
                  <td align="left"><input type="checkbox" name="pwdprotect" value="Y" size=25 maxlength=255></td>
                </tr>
                <tr> 
                  <td><font color="#003366"><strong><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="1" height="8" border="0"></strong></font></td>
                </tr>
                <tr> 
                  <td align="right" class="headings">CGI Support:</td>
                  <td align="center"><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="7" height="1" border="0"></td>
                  <td align="left"><input type="checkbox" name="cgisupport" value="Y" size=25></td>
                </tr>
                <tr> 
                  <td><font color="#003366"><strong><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="1" height="8" border="0"></strong></font></td>
                </tr>
                <tr> 
                  <td align="right" class="headings">Front Page Ext.:</td>
                  <td align="center"><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="7" height="1" border="0"></td>
                  <td align="left"><input type="checkbox" name="frontpageext" value="Y" size = "7"></td>
                </tr>
                <tr> 
                  <td><font color="#003366"><strong><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="1" height="8" border="0"></strong></font></td>
                </tr>
                
                <tr> 
                  <td align="right" class="headings">Web Stats:</td>
                  <td align="center"><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="7" height="1" border="0"></td>
                  <td align="left"><input type="checkbox" name="webstart" value="Y" size=25></td>
                </tr>
              </table></td>
          </tr>
        </table>

			</td>
		</tr>

		<tr><td colspan=5><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="1" height="16" border="0"></td></tr>

		<tr><td>
	    <table border=0 cellpadding=0 cellspacing=0 align="left">
		<tr >	 
	  <td colspan=5 align="center"><img src="/skins/<?=$_SESSION["skin"]?>/elements/line.gif" width=560 height=1 border=0>	  
	  </td>
	</tr>
		    <tr>
			    <td width=446><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="3" height="1" border="0"></td>
			    <td align="right">
				<input type="button" class="commonButton" id="bid-update" value="Create Domain" title="Update" onClick="chk_form_data1(document.mainform);" ></td>
			    <td><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="3" height="1" border="0"></td>
		    </tr>
        </table></td></tr>

		<tr><td colspan=5><img src="/skins/<?=$_SESSION["skin"]?>/elements/white.gif" alt="" width="1" height="8" border="0"></td></tr>

	</table>
	<input type="hidden" name="cmd" value="update">
</form>

	</body>
</html>
<?include "../inc/footer.php";?>