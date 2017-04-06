<?$ACCESS_LEVEL=3;?>
<html>
<head>
<title>Manage Front Page Support</title>
<link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/general.css">
<link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/custom.css">
<link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/layout.css">
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=ISO-8859-1">
<META HTTP-EQUIV="EXPIRES" CONTENT="0">
</head>
<?include "../inc/mainheader.php"?>
<?if(strtoupper($_SESSION["type"])=="C" || strtoupper($_SESSION["type"])=="A")
		include "../clients/clientheader.php";?>
<?include "../domains/domainheader.php"?>
<?include "../inc/connection.php"?>
<?include "../inc/params.php"?>
<?include "../inc/functions.php"?>
<?include "../inc/security.php"?>
<?include "../inc/constants.php"?>
<body topmargin="0">
<?
$message="";
if( isset($_GET['mode']) )
{
	if($_GET['mode']==$SESSION_EXPIRE)
		$message=$MESG_SESSION_EXPIRE;
	else if($_GET['mode']==$ACCESS_DENIED)
		$message=$MESG_INVALID_USERNAME;
	else if($_GET['mode']==$USERNAME_NOT_EXIST)
		$message=$MESG_USERNAME_NOT_EXIST;
	else if($_GET['mode']==$MAIL_TRANS_SUCCESS)
		$message=$MESG_MAIL_TRANS_SUCCESS;
	else if($_GET['mode']==$MAIL_TRANS_FAILURE)
		$message=$MESG_MAIL_TRANS_FAILURE;
	else if($_GET['mode']==$PASSWORD_SENT)
		$message=$MESG_PASSWORD_SENT;
	else
		$message="Failure due to Invalid Data";
}

//Session variables
	$domainid=$_SESSION["domainid"];
	$domainname=$_SESSION["domainname"];
	$username=$_SESSION["clientname"];
	$reselid=$_SESSION["clientid"];

	$query = "select frontpageext from tbldomainrights where domainid='$domainid'";
	$arrfp = mysql_query($query);
	$resultFp = mysql_fetch_array($arrfp);
	//echo $resultFp["frontpageext"];
	if(strtoupper($resultFp["frontpageext"])=="Y")
		{
	if($fplogin=="")
		{ 
?>
				<script language="JavaScript"> 
				function validate()
				{
					regExp = /\w{1,}/;

					if (!regExp.test(document.form1.fp_password.value))
						{ 
							alert("Password Cann't Be Empty ");
							document.form1.fp_password.focus();
							return false;  
						}
					else if (document.form1.fp_cpassword.value!=document.form1.fp_password.value)
						{ 
							alert("Confirm Password should be same as new Password ");
							document.form1.fp_password.value="";
							document.form1.fp_cpassword.value="";
							document.form1.fp_password.focus();
							return false;  
						}
					else
							return true;
				 }
				</script>
<?		} 
	else 
		{ 
?>
				 <script language="JavaScript"> 
				function validate()
				{
					regExp = /\w{1,}/;
					if (!regExp.test(document.form1.fp_login.value))
						{ 
						   alert("Login Name Cann't Be Empty ");
						   document.form1.fp_login.focus();
						   return false;  
						}				 
					else if (!regExp.test(document.form1.fp_password.value))
						{ 
						   alert("Password Cann't Be Empty ");
						   document.form1.fp_password.focus();
						   return false;  
						}
					else if (document.form1.fp_cpassword.value!=document.form1.fp_password.value)
						{ 
						   alert("Confirm Password should be same as new Password ");
						   document.form1.fp_password.value="";
						   document.form1.fp_cpassword.value="";
						   document.form1.fp_password.focus();
						   return false;  
						}
					else
							return true;
				 }
				</script>
 
<? 
		} 

	     $fplogin="";
	     $fppassword="";

  		 $query="select * from tbldomainfp where domainid='$domainid'";
		 $array=mysql_query($query) or die(errorCatch(mysql_error()));
		 $totalid=mysql_num_rows($array);
		  if(!$totalid==0)
		  {
			  while($domainfp=mysql_fetch_object($array))
				{
					  $fpsupport=$domainfp->fpsupport;
					  $fpsupportssl=$domainfp->fpsupportssl;
					  $fpauth=$domainfp->fpauth;
					  $fplogin=$domainfp->fplogin;
					  $fppassword=$domainfp->fppassword;
				}
		  }
  ?>
  
  


<form name="form1" method="post" action="create_fplogin.php" onSubmit="return validate()">
  <!--<table width="80%" border="0" align="center" cellspacing="0" cellpadding="0">
    <?
	if(strtoupper($_SESSION["type"])=="A")
		{
?>
    <tr> 
      <td align="left" class="navigation">Administrator &gt; 
        <?=$_SESSION["clientname"]?>
        &gt; 
        <?=$_SESSION["domainname"]?>
        &gt; Front Page Extention Setup</td>
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
        &gt; Front Page Extention Setup</td>
    </tr>
    <?
		}
	elseif(strtoupper($_SESSION["type"])=="D")
		{
?>
    <tr> 
      <td align="left" class="navigation"> 
        <?=$_SESSION["domainname"]?>
        &gt; Front Page Extention Setup</td>
    </tr>
    <?
		}
?>
    <tr> 
      <td>&nbsp;</td>
    </tr>
  </table>-->
<?
	$pathToHttp = "http://" . $domainname . "/_vti_bin/_vti_adm/fpadmcgi.exe?page=webad";
?>
  <table width="61%" border="0" align="center" cellspacing="2">
    <?
		if($totalid != 0)
			{
?>
    <tr> 
      <td class="clientheading"><a href="<?=$pathToHttp?>" target="_blank"> 
        <div align="center" class="clientheading">Admin web for HTTP</div>
        </a></td>
      <td class="clientheading" colspan="2">Admin web for SSL</td>
    </tr>
    <?
			}
?>
    <tr bgcolor="#C8DCFB"> 
      <th colspan="3"><div align="center" class="headings">FrontPage Extention 
          Setup </div></td>
        </tr>
    <tr> 
      <td width="49%"> <div align="right"  class="headings">FrontPage support: 
        </div></td>
      <?
		if($fpsupport==1)
			$fpsupportstatus="checked";
		else
			$fpsupportstatus="";
?>
      <td width="2%"><div align="center" class="headings"> </div></td>
      <td width="49%"><font color="#003366" size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
        <input name="fp_support" type="checkbox" id="fp_support2" value="1" <?=$fpsupportstatus?>>
        </font></td>
    </tr>
    <br>
    <br>
    <tr> 
      <td height="21"><div align="right" class="headings">FrontPage over SSL support: 
        </div></td>
      <?
		if($fpsupportssl==1)
			$fpsupportsslstatus="checked";
		else
			$fpsupportsslstatus="";
?>
      <td><div align="center"></div></td>
      <td><font color="#003366" size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
        <input name="fp_support_ssl" type="checkbox" id="fp_support_ssl2" value="1" <?=$fpsupportsslstatus?>>
        </font></td>
    </tr>
    <tr> 
      <td rowspan="2"><div align="right" class="headings">FrontPage authorization:</div>
        <div align="right"></div></td>
      <?
		if($fpauth==0)
			{
				$fpauthstatus1="checked";
				$fpauthstatus2="";
			}
		else
			{
				$fpauthstatus1="";
				$fpauthstatus2="checked";
			}
?>
      <td height="21"><p align="center"> <font color="#003366" size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
          <label> </label>
          </font></p></td>
      <td height="21"><font color="#003366" size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
        <label> 
        <input name="fp_auth" type="radio" value="0" <?=$fpauthstatus1?>>
        Authorization DISABLED</label>
        <label> </label>
        </font></td>
    </tr>
    <tr> 
      <td><div align="center"><font color="#003366" size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
          <label></label>
          </font></div></td>
      <td><font color="#003366" size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
        <label> 
        <input type="radio" name="fp_auth" value="1" <?=$fpauthstatus2?>>
        Authorization ENABLED</label>
        </font></td>
    </tr>
    <tr> 
      <td><div align="right" class="headings">FrontPage Admin's Login:</div></td>
      <td><div align="center"><font color="#FF0000" size="2" face="Verdana, Arial, Helvetica, sans-serif">* 
          </font></div></td>
      <td><font color="#003366" size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
        <? if($fplogin==""){ ?>
        <input name="fp_login" type="text" id="fp_login" value="<?=$fplogin?>" class="textboxclass">
        <? } else { ?>
        <?=$fplogin?>
        <input name="fp_login1" type="hidden" id="fp_login1" value="<?=$fplogin?>">
        <? } ?>
        </font></td>
    </tr>
    <tr> 
      <td><div align="right" class="headings">FrontPage Admin's Password:</div></td>
      <td><div align="center"><font color="#FF0000" size="2" face="Verdana, Arial, Helvetica, sans-serif">* 
          </font></div></td>
      <td><font color="#003366" size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
        <input name="fp_password" type="password" id="fp_password2" value="<?=$fppassword?>" class="textboxclass">
        </font></td>
    </tr>
    <tr> 
      <td><div align="right" class="headings">Confirm Password:</div></td>
      <td><div align="center"><font color="#FF0000" size="2" face="Verdana, Arial, Helvetica, sans-serif">* 
          </font></div></td>
      <td><font color="#003366" size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
        <input name="fp_cpassword" type="password" id="fp_cpassword2" value="<?=$fppassword?>" class="textboxclass">
        </font></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td colspan="3"> <div align="center"><font color="#006666"><img src="/skins/<?=$_SESSION["skin"]?>/elements/line.gif" width=560 height=1 border=0></font> 
        </div></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td colspan="3"><div align="center">
          <input class="commonbutton" type="submit" name="Submit" value="Submit">
        </div></td>
    </tr>
  </table>
        </form>
<?
		}
	else
		{
?>
			<center><font face="verdana" size="2" color="red">Sorry the front page support for this domain is disabled</font><br> <br>
			<input type="button" name="amit" class="commonbutton" value="Back" onClick=history.go(-1)></center>
<?
		}
?>	
</body>
</html>
<br>
<?include "../inc/footer.php"?>
