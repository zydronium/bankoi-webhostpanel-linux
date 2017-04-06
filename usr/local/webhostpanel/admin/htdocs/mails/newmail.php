<? $ACCESS_LEVEL=3 ?>
<? include "../inc/connection.php"; ?>
<? include "../inc/params.php"; ?>
<? include "../inc/functions.php"; ?>
<? include "../inc/security.php"; ?>
<? $_SESSION["mailnm"] = ""; ?>

<html>
<head>
<script language="JavaScript">
function chk_frm()
	{

			if(document.form1.mailname.value=="")
				{
					alert("provide value for mailname");
					document.form1.mailname.focus();
					return false;
				}
		
			if(document.form1.pass.value=="")
				{
					alert("provide value for password");
					document.form1.pass.focus();
					return false;
				}
			if(document.form1.pass2.value=="")
				{
					alert("provide value for confirm password");
					document.form1.pass2.focus();
					return false;
				}
			if(document.form1.pass.value!=document.form1.pass2.value)
				{
					alert("Confirm password does not match");
					document.form1.pass2.focus();
					return false;
				}

			return true;
	}

function submit_form(f)
	{
				var counter;
				counter=0;
				for (i = 0 ; i < f.elements.length; i++) 
					{
					if ((f.elements[i].type == "checkbox") && (f.elements[i].name.indexOf("emailacc")==0)) 
						{
						if (f.elements[i].checked) 
							{
								counter=counter+1;
							}
						}
					}
				if(counter==0)
				{
					alert("No mail account to delete!");
					return false;
				}
				else
				{
					//alert();
					f.action="removemailacc.php";
					f.submit();
					return false;
				}
				
	}
</script>
<title>Manage Mail Account</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head><link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/general.css">
<link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/custom.css">
<link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/layout.css">
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=ISO-8859-1">
<META HTTP-EQUIV="EXPIRES" CONTENT="0">
</head>
<body leftmargin=0 topmargin=0>
<? include "../inc/mainheader.php"; ?>

<?
	if(strtoupper($_SESSION["type"])!="D")
		include "../clients/clientheader.php";	
	include "../domains/domainheader.php";

	$domainid=$_SESSION["domainid"];
	$domainname=$_SESSION["domainname"];
?>

<form name="form1" method="post" action="createmail.php">
  <!--<table width="61%" border="0" align="center" cellspacing="0" cellpadding="0">
    <?
	if(strtoupper($_SESSION["type"])=="A")
		{
?>
    <tr> 
      <td align="left" class="navigation">Administrator &gt; 
        <?=$_SESSION["clientname"]?>
        &gt; 
        <?=$domainname?>
        &gt; Mail Account</td>
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
        &gt; Mail Account</td>
    </tr>
    <?
		}
	elseif(strtoupper($_SESSION["type"])=="D")
		{
?>
    <tr> 
      <td align="left" class="navigation"> 
        <?=$domainname?>
        &gt; Mail Account</td>
    </tr>
    <?
		}
?>
    <tr> 
      <td>&nbsp;</td>
    </tr>
<tr>
      <td class="clientheading"><u>Note: The Username for webmail and mail client (Outlook Express/Eudora) will be user%donaimname.tld </u></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
  </table>-->
  <table width=80% border=0 cellpadding=0 cellspacing=0 align="center">
<?
	//Here we are extracting the IP address assigned to the domain
	$query = "select tblserverip.ipaddress from (tblserverip inner join tbldomain on  tblserverip.Id = tbldomain.ipaddress) where tbldomain.domainid='$domainid'";
	$IPArr = mysql_query($query);
	$resIP = mysql_fetch_array($IPArr);
	$IPAddress = $resIP["ipaddress"];
	$MailPath = "http://" . $IPAddress . "/horde";
	$query="select * from mail_mailbox where domain='$domainname' order by username";
	$emailArr=mysql_query($query) or die(errorCatch(mysql_error()));
	$num=mysql_num_rows($emailArr);
	if($num > 0)
		{
?>
    <tr> 
      <td colspan="3" align="center">&nbsp;</tr>
    <tr> 
      <td height="6" colspan="4"> <div align="center" class="headings">Email Name </div>
    
        <div align="left" class="navigation"> </div></td>
    </tr>
    <tr> 
      <td height="5"  colspan="4" align="center"> <div align="center">
	  <img src="/skins/<?=$_SESSION["skin"]?>/elements/line.gif" width=560 height=1 border=0> 
        </div></td>
    </tr>
    <?
    while($ResultSet=mysql_fetch_array($emailArr))
			{
?>
    <tr> 
      <td width="60%" height="10" align="right"> 
        <a href="setmailname.php?mailnm=<?=$ResultSet["username"]?>" style="text-decoration:none"><?=$ResultSet["username"]?></a>
      </td>
      <td width="4%">&nbsp;</td>
      <td width="36%" height="10"> <div align="left"> 
          <input type="checkbox" name="emailacc[]" value="<?=$ResultSet["id"]?>">
          <a href ="<?=$MailPath?>" target=_blank>WebMail</a></div></td>
    </tr>
    <?
			}
?>
    <tr> 
      <td height="36" colspan="3" align="center"> <div align="center"></div>
        <div align="center"> 
          <input type="button" name="Button352" value="Remove Selected" class="commonButton" onClick="return submit_form(document.form1)">
        </div></td>
    </tr>
    <tr> 
      <td height="11" colspan="3" align="center"><div align="center"><img src="/skins/<?=$_SESSION["skin"]?>/elements/line.gif" width=560 height=1 border=0> 
        </div></td>
    </tr>
    <tr>
      <td height="11" colspan="3" align="center">&nbsp;</td>
    </tr>
    <?
		}
?>
  </table>

  <?
				$query = "select count(*) as domainMailCount from mail_mailbox where domain = '$domainname'"; 			
				$rsDomaiMail = @mysql_query($query);
				$rsDomainMailResult = @mysql_fetch_array($rsDomaiMail);
				$usedDomainMailAccount = $rsDomainMailResult["domainMailCount"];


				$query = "select popmailaccount from tbldomainrights where domainid = '$domainid'"; 			
				$rsDomaipopMail = @mysql_query($query);
				$rsDomainpopMailResult = @mysql_fetch_array($rsDomaipopMail);
				$usedDomainPopMailAccount = $rsDomainpopMailResult["popmailaccount"];

				if($usedDomainMailAccount < $usedDomainPopMailAccount)
				{
  ?>


  <table width="583" align="center">
    <tr> 
      <th height="21" colspan="3" align="center" class="clientheading">Create New Mail</font></font></td>
    </tr>
    <tr> 
      <td colspan="3"><div align="center"></div></td>
    </tr>
    <tr> 
      <td width="262"><div align="right" class="headings">  
          Email Name </div></td>
      <td width="21">&nbsp;</td>
      <td class="clientheading">
        <input name="mailname" type="text" class="textboxclass">
        @ 
        <?=$domainname?>
       </td>
    </tr>
    <tr> 
      <td colspan="2"></td>
      <td width="284"></td>
    </tr>
    <tr> 
      <td><div align="right" class="headings">Password</div></td>
      <td>&nbsp;</td>
      <td><input type="password" name="pass" class="textboxclass"></td>
    </tr>
    <tr> 
      <td><div align="right" class="headings">Confirm 
          Password</div></td>
      <td>&nbsp;</td>
      <td><input type="password" name="pass2" class="textboxclass"></td>
    </tr>
    <tr> 
      <td colspan=3><div align="center">
          <div align="center"><img src="/skins/<?=$_SESSION["skin"]?>/elements/line.gif" width=560 height=1 border=0> 
          </div>
        </div></td>
    </tr>
    <tr>
      <td colspan=3> <div align="center">
          <input name="Submit" type="submit" class="commonButton" onClick="return chk_frm();" value="Create">
          <input name="button" type="button" class="commonButton" onClick="window.location='/domains/showdomaindetails.php'" value="Cancel">
        </div></td>
    </tr>
    <tr> </tr>
  </table>
<?
				}
  else
	echo "<center><div  class=\"navigation\">The domain has used all its POPMAIL accounts</div></center>";
?>

  </form>

<br>
</p>
<? include "../inc/footer.php"?>
</body>

</html>
