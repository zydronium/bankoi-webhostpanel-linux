<?$ACCESS_LEVEL=3;?>
<?include "../inc/connection.php"?>
<?include "../inc/params.php"?>
<?include "../inc/security.php"?>
<?include "../inc/functions.php"?>
<?include "../inc/constants.php"?>

<html>
<head>
<title>Set Password Protect Dir...</title>

<link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/general.css">
<link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/custom.css">
<link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/layout.css">
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=ISO-8859-1">
<META HTTP-EQUIV="EXPIRES" CONTENT="0">
<script>
function invertChecked()
			{
				f = document.mainform;
				for (i = 0 ; i < f.elements.length; i++) {
					if ((f.elements[i].type == "checkbox") && (f.elements[i].name.indexOf("dir_id")==0)) {
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
					if ((f.elements[i].type == "checkbox") && (f.elements[i].name.indexOf("dir_id")==0)) 
						{
						if (f.elements[i].checked) 
							{
								counter=counter+1;
							}
						}
					}
				if(counter==0)
				{
					alert("No Directory password entry \nselected for deletion!!!");
					return false;
				}
				else
				{
					//alert();
					f.action="../domains/removedirpass.php";
					f.submit();
					//alert("This is under construction!!!")
					return false;
				}
				
			}

</script>

<?
	if(isset($textfield))
		{
			$txtfld=$textfield;
		}
	$domainid=$_SESSION["domainid"];
	$domainname=$_SESSION["domainname"];
?>


	<body leftmargin=0 topmargin=0>
	<form name="mainform" method="POST" action="setpwdprotectdir.php" onSubmit="return validate()">


<?
	include "../inc/mainheader.php";
	if(strtoupper($_SESSION["type"])=="C" || strtoupper($_SESSION["type"])=="A")
		include "../clients/clientheader.php";
	include "../domains/domainheader.php";
	
	$query="select resellername,domainname from(tbldomain inner join tblreseller on tbldomain.resellerid=tblreseller.resellerid) where tbldomain.domainid='$domainid'";
	//myLog($query);
	$resultSet=mysql_query($query) or die(errorCatch(mysql_error()));
	$ResultArray=mysql_fetch_array($resultSet);
	if(mysql_num_rows($resultSet) > 0)
		{
			$ClientName=$ResultArray["resellername"];
			$DomainName=$ResultArray["domainname"];
		}
	else
		{
			echo "Problem occured - Can not get the domain details!";
			exit;
		}

	//Setting the directory path here
	if(strlen($_GET["Dirs"])==0)
		{
			$Dirs="";
			$Dirs1="";
			$Dirs1=$Dirs;
			$Path=$sHostingDir . "/" . $ClientName . "/" . $DomainName . "/";
		}
	else
		{
			$Dirs1=$_GET["Dirs1"] . "/" . $_GET["Dirs"];
			$Path=$sHostingDir . "/" . $ClientName . "/" . $DomainName . "/" . substr($Dirs1,1,strlen($Dirs1)) . "/";
		}
	$DirsOfDomain="";
	$DirsOfDomain=Split(",", GetDirs($Path));
?>
  <!--<table width="50%" border="0" align="center" cellspacing="0" cellpadding="0">
    <?
	if(strtoupper($_SESSION["type"])=="A")
		{
?>
    <tr> 
      <td align="left" class="navigation">Administrator &gt; 
        <?=$_SESSION["clientname"]?>
        &gt; 
        <?=$_SESSION["domainname"]?>
        &gt; Password Protect Directory</td>
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
        &gt; Password Protect Directory</td>
    </tr>
    <?
		}
	elseif(strtoupper($_SESSION["type"])=="D")
		{
?>
    <tr> 
      <td align="left" class="navigation"> 
        <?=$_SESSION["domainname"]?>
        &gt; Password Protect Directory</td>
    </tr>
    <?
		}
?>
    <tr> 
      <td>&nbsp;</td>
    </tr>
	<tr> 
      <td align="left" bgcolor="#FFFFFF"><div align="center"></div></tr>
    <tr>
  </table>-->
  <p>&nbsp;</p>
  <?
  	$query= "Select * from tbldirpass where domainname='$domainname'";
	$res=mysql_query($query);
	$num_rows=mysql_num_rows($res);
	if($num_rows > 0)
		{
  ?>
  <table width="58%" border="0" align="center">
    <tr> 
      <th colspan="4"><font size="2" face="Verdana, Trebuchet MS"><strong>Password 
        Protected Directories&nbsp;</td> &nbsp;</td> &nbsp;</td> &nbsp;</td></strong> 
        </font></tr>
    <tr> 
      <td><div align="center"><strong><font size="2" face="Verdana, Trebuchet MS">Directory 
          Name</font></strong></div></td>
      <td><div align="center"><strong><font size="2" face="Verdana, Trebuchet MS">Username</font></strong></div></td>
      <td><div align="center"><strong><font size="2" face="Verdana, Trebuchet MS">Password</font></strong></div></td>
      <td width="5%" height="3" bgcolor="#FFFFFF" class="tableheadings"> <a href="javascript:invertChecked()" style="text-decoration:none;color:black"><strong><font size="2" face="Verdana, Trebuchet MS">Sel</font></strong></a></td>
    </tr>
<?	
//	echo $num_rows;
	for ($i=1;$i<=$num_rows;$i++)
		{	$arr=mysql_fetch_array($res)
			
?>
    <tr> 
      <td><div align="center"><font color="#003366" size="2" face="Geneva, Arial, Helvetica, sans-serif"> 
          <?=$arr["dirname"]?>
          </font></div></td>
      <td><div align="center"><font color="#003366" size="2" face="Geneva, Arial, Helvetica, sans-serif"> 
          <?=$arr["username"]?>
          </font></div></td>
      <td><div align="center"><font color="#003366" size="2" face="Geneva, Arial, Helvetica, sans-serif"> 
          <?=$arr["passwd"]?>
          </font></div></td>
      <td><input name="dir_id[]" type="checkbox" id="dir_id[]" value="<?=$arr["id"]?>"></td>
    </tr>
    <?}?>
    <tr> 
      <td colspan="4"><div align="right">
          <input type="button" name="Submit3" value="Remove Selected" class="commonbutton" onClick="return chk_frm(document.mainform)">
        </div></td>
    </tr>
  </table>
 <?
 	}
 ?>
  <table width="59%" border="0" align="center">
    <tr>
      <th><div align="center"><font color="#003366">&nbsp; <strong>Directories</strong></font></div></tr>
  </table>
  <table width="45%" border="0" align="center">
      <tr><td align="left" bgcolor="#FFFFFF">&nbsp;</td>
    </tr>
    <tr>

      <td align="left" bgcolor="#003366"><font color="#FFFFFF" size="2" face="Verdana"><a href="explorer.php?Dirs1=<?=substr($Dirs1,1,strlen($Dirs1))?>" style="color:#ffffff; text-decoration:none">Folder Listing</a></font></td>
    </tr>
    <?
	if($DirsOfDomain[0]=="")
		{
			echo "<tr><td align='center' bgcolor='#C1ECF9'><font face='verdana' color='red' size='2'>Sorry there is no directory in the current directory</font></td></tr>";
		}
	else
		{
			for($i=0; $i < count($DirsOfDomain); $i++)
			{
					if($Path==$sHostingDir . "/" . $ClientName . "/" . $DomainName . "/")
						{	
								//echo "In Home Dir";
								if(strtoupper($DirsOfDomain[$i])=="HTTPDOCS" ) //|| strtoupper($DirsOfDomain[$i])=="HTTPSDOCS")
										{
											echo "<tr><td align='left' valign='top' bgcolor='#EEFAFD'><img src='folder1.gif' border='0'>&nbsp;&nbsp;<a href='explorer.php?Dirs1=" . $Dirs1 ."&Dirs=" . $DirsOfDomain[$i] . "' style='text-decoration:none'>" . $DirsOfDomain[$i]."</a></td></tr>";
										}
						}
					else
						{
							//echo "Not In Home Dir";	
							echo "<tr><td align='center' bgcolor='#EEFAFD'><a href='explorer.php?Dirs1=" . $Dirs1 ."&Dirs=" . $DirsOfDomain[$i] . "'>" . $DirsOfDomain[$i]."</a></td></tr>";	
						}
			}
		}
	echo "<center><font face='verdana' color='#003366'>Folder Name=" . $Path ."</font><br></center>";
?>
  </table>    
  <table width="52%" border="0" align="center">
    <tr bgcolor="#FFFFFF"> 
      <td colspan="3">&nbsp;</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td width="45%"><div align="right"><strong><font color="#003366" size="2" face="Verdana">Directory 
          Name</font></strong></div></td>
      <td width="10%">&nbsp;</td>
      <td width="45%"><input type="text" name="pwddirectory" value="<?=$Dirs1?>" class="textboxclass" readonly></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="24" colspan="3" valign="top"><div align="center"><font color="#0000FF" size="1" face="Verdana">There 
          should be only one username and password on line in the text area.Seperated 
          with forward slashes.</font></div></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="21" valign="top" bgcolor=""><div align="right"><strong><font color="#003366" size="2" face="Verdana">Username/Password</font></strong></div></td>
      <td height="21">&nbsp;</td>
      <td height="21"><textarea name="users" cols="29" rows="6" class="textboxclass"></textarea></td>
    </tr>
    <tr> 
      <td height="21" colspan="3"> <div align="center"><font color="#006666"><img src="/skins/<?=$_SESSION["skin"]?>/elements/line.gif" width=400 height=1 border=0></font> 
        </div></td>
    </tr>
    <tr>
      <td height="21" colspan="3"><div align="center">
          <input type="submit" name="Submit" value="Set Password" class="commonbutton">
          <input type="button" name="Submit2" value="Cancel" class="commonbutton" onClick="window.location='showdomaindetails.php'">
        </div></td>
    </tr>
  </table>
</form>
<br>
<?include "../inc/footer.php";?>


<script>
	function validate()
		{
				if(document.mainform.pwddirectory.value == "")
					{
							alert("Please select the directory for \nwhich the password is to be set!!!")
							document.mainform.pwddirectory.focus();
							return false;
					}

				if(document.mainform.users.value == "")
					{
							alert("Please provide username and password \nto be set for the directory!!!")
							document.mainform.users.focus();
							return false;
					}


				return true;
		}
</script>
