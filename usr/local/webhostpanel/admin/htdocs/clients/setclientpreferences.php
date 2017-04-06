<?$ACCESS_LEVEL=2;?>
<?
include "../inc/connection.php";
include "../inc/params.php";
include "../inc/functions.php";
include "../inc/security.php";
?>

<html>
<head>

<title>Set Preferences</title>
<link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/general.css">
<link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/custom.css">
<link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/layout.css">
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=ISO-8859-1">
<META HTTP-EQUIV="EXPIRES" CONTENT="0">
</head>
<body leftmargin=0 topmargin=0>
<?
include "../inc/mainheader.php";
include "../clients/clientheader.php";
//include "../domains/domainheader.php";

$reselid=$_SESSION["clientid"];
$id=$_SESSION["userid"];
//$home_dir = dirname(__FILE__);
//echo "The home dir is " . $home_dir;
$reselid=$_SESSION["clientid"];
$skinname=$_POST["skinname"];
$upload_file=$HTTP_POST_FILES['userfile']['name'][0];
$upload_size=$HTTP_POST_FILES['userfile']['size'][0]/1024;
$upload_type=$HTTP_POST_FILES['userfile']['type'][0];
$upload_tmp=$HTTP_POST_FILES['userfile']['tmp_name'][0];
$resellername=$_SESSION["clientname"];
if($upload_tmp=="")
	{

		$query="update tblloginmaster set skinname='$skinname' where typeid=$reselid and ucase(usertype)='C'";
		mysql_query($query);
		if(strtoupper($_SESSION["type"]) == "C")
			{
				$_SESSION["skin"] = $skinname;
			}
?>
<script>
	alert("Client preference set");
</script>
<?
	if(strtoupper($_SESSION["type"]) == "A")
			{
?>
				<script>
					window.location="../domains/clientdomains.php";
				</script>
<?
			}
	if(strtoupper($_SESSION["type"]) == "C")
			{
?>
				<script>
					window.location="../domains/clientdomains.php";
				</script>
<?
			}
		die();
	}

if(substr($upload_type,0,5)!="image")
  {
    echo "<center><font color=\"red\">Sorry the file is not a valid picture</font><center>";
?>
<script>
	alert("Sorry the file is not a valid picture");
	window.location="../clients/clientpreferences.php";
</script>
<?
	die();
  }

$TOuploadDir=$sCpHomeDir . "/admin/htdocs/logos/";

$ext=strtoupper((substr($upload_type,strlen($upload_type)-4,strlen($upload_type))));
//echo "The extension is " .$ext;
if(strtoupper($ext)=="/GIF")
	$ext="GIF";

if(move_uploaded_file($upload_tmp,$TOuploadDir.$upload_file))
  {
     rename($TOuploadDir.$upload_file, $TOuploadDir.$resellername . "." . $ext);
?>

<center>
<font color="red" face="verdana" size="2">

<? 
	echo "The logo for " . $resellername . " has been successfully uploaded"?>
</font></center>
<?
  }
else
  {
     echo "Sorry the file ".$upload_file." cannot be uploaded";
	 include "files.php";
  }
  $flname=$resellername . "." . $ext;
$query="update tblreseller set logo='$flname' where resellerid=$reselid";
//myLog($query);
mysql_query($query) or die("There was some problem while uploading the logo for the client " . $resellername);

$query="update tblloginmaster set skinname='$skinname' where typeid=$reselid and ucase(usertype)='C'";
//myLog($query);
mysql_query($query) or die("There was some problem while setting the skin for the client " . $resellername);
		if(strtoupper($_SESSION["type"]) == "C")
			{
				$_SESSION["skin"] = $skinname;
				$_SESSION["logoname"]="../logos/" . $flname;
			}
?>
<!--<table width="80%" border="0" align="center" cellspacing="0" cellpadding="0">
  <?
	if(strtoupper($_SESSION["type"])=="A")
		{
?>
  <tr> 
    <td align="left" class="navigation">Administrator 
      &gt; 
      <?=$_SESSION["clientname"]?>
      &gt; Preferences </td>
  </tr>
  <?
		}
	elseif(strtoupper($_SESSION["type"])=="C")
		{
?>
  <tr> 
    <td align="left" class="navigation">
      <?=$_SESSION["clientname"]?>
      &gt; Preferences </td>
  </tr>
  <?
		}
	elseif(strtoupper($_SESSION["type"])=="D")
		{
?>
  <tr> 
    <td align="left" class="headings"></td>
  </tr>
  <?
		}
?>
  <tr> 
    <td>&nbsp;</td>
  </tr>
</table>-->

<hr width="70%">
<center>
  <table>
    <tr> 
      <td width="150"> <div align="right" class="headings">The 
          logoname id: </div></td>
      <td width="20">&nbsp;</td>
      <td width="155"> <font color="#FF0000"> 
        <?=$_SESSION["clientname"] . "." . $ext?>
        </font></td>
    </tr>
    <tr> 
      <td> <div align="right" class="headings">The 
          file size is:  </div></td>
      <td>&nbsp;</td>
      <td> <font color="#FF0000"> 
        <?=$upload_size?>
        <font color="#0000FF">KB </font></font></td>
    </tr>
    <tr> 
      <td> <div align="right" class="headings">The 
          file type is: </div></td>
      <td>&nbsp;</td>
      <td> <font color="#FF0000"> 
        <?=$upload_type?>
        </font></td>
    </tr>
  </table>
  <hr width="70%">
</center>
<?
	if(strtoupper($_SESSION["type"]) == "A")
			{
				
?>
		<center><a href="../clients/clients.php"><img src="../Icons/btn_backup_bg.gif" border="0" alt="Back">Back</a></center>
<?
			}
	if(strtoupper($_SESSION["type"]) == "C")
			{
				
?>
		<center><a href="../domains/clientdomains.php"><img src="../Icons/btn_backup_bg.gif" border="0" alt="Back">Back</a></center>
<?
			}
?>

<br>
<?include "../inc/footer.php"?>