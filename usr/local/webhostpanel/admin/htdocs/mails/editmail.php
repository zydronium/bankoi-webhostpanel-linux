<? $ACCESS_LEVEL=3 ?>
<? include "../inc/connection.php";?>
<? include "../inc/params.php";?>
<? include "../inc/functions.php";?>
<? include "../inc/security.php";?>
<html>
<head>
<title>Clients Listing</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head><link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/general.css">
<link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/custom.css">
<link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/layout.css">
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=ISO-8859-1">
<META HTTP-EQUIV="EXPIRES" CONTENT="0">
</head>
<body leftmargin=0 topmargin=0>
<? include "../inc/mainheader.php"?>
<?
	if(strtoupper($_SESSION["type"])!="D")
		include "../clients/clientheader.php";
	include "../domains/domainheader.php";
?>
<?
$domainid=$_SESSION["domainid"];
	$domainname=$_SESSION["domainname"];
$mail=0;
$alias=0;
	if(isset($_GET["id"])){
			$id1=$_GET["id"];
			$uid=split('@',$id1);
			$flag=0
?>
<form name="form1" method="post" action="updatemail.php">
  <p>
    <input type="hidden" name="mailid" value="<?=$id1?>">
  </p>
  <table width="80%" border="0" align="center" cellspacing="0" cellpadding="0">
    <?
	if(strtoupper($_SESSION["type"])=="A")
		{
?>
    <tr> 
      <td align="left" class="navigation">Administrator &gt; 
        <?=$_SESSION["clientname"]?>
        &gt; 
        <?=$domainname?>
        &gt; Edit Mail</td>
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
        &gt; Edit Mail</td>
    </tr>
    <?
		}
	elseif(strtoupper($_SESSION["type"])=="D")
		{
?>
    <tr> 
      <td align="left" class="navigation"> 
        <?=$domainname?>
        &gt; Edit Mail</td>
    </tr>
    <?
		}
?>
    <tr> 
      <td>&nbsp;</td>
    </tr>
  </table>

  <table align="center">
<tr>
      <td colspan=2> <div align="center"><strong> <font color="#3366FF" size="3" face="Verdana, Arial, Helvetica, sans-serif">Update</font><font color="#FF0000" size="3" face="Verdana, Arial, Helvetica, sans-serif"> 
          <?=$id1?>
          </font></strong> </div>
        <div align="center"></div></td></tr>
	<tr> 
      <td colspan=2><img src="/skins/<?=$_SESSION["skin"]?>/elements/line.gif" width=564 height=1 border=0></td>
    </tr>
<?
			$query="select * from mail_mailbox where username='".$uid[0]."@".$uid[1]."' and domain='".$uid[1]."'";
			//myLog($query);
			$rs=mysql_query($query) or die(errorCatch(mysql_error()));
			$n=mysql_num_rows($rs);
			if($n>0){
				$flag=1;
				$mail=1;								
				$checked="checked";
			}else{
				$checked="";
			}
	?>

	<tr> 
      <td colspan=2><input type="radio" name="isalias" <?=$checked?>> <font color="#3366FF" size="2" face="Verdana, Arial, Helvetica, sans-serif">Mail 
        </font></td>
    </tr>
       <tr> 
      <td><div align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">New 
          Password</font></div></td>
      <td><input type="text" name="pass"></td>
    </tr>
    <tr> 
      <td><div align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Re-Type 
          New Password</font></div></td>
      <td><input type="text" name="pass2"></td>
    </tr>
	<? 
		
	$query="select * from mail_alias where address='".$uid[0].'@'.$uid[1]."' and domain='".$uid[1]."'";
	//myLog($query);
			$rs=mysql_query($query) or die(errorCatch(mysql_error()));
			$n=mysql_affected_rows();
			if($n>0){
				$flag=1;
				$alias=1;
				$res=mysql_fetch_array($rs);
				$checked="checked";
				$goto=$res['goto'];
			}else{
				$checked="";
				$goto="";
			}
	
	?>
    <tr> 
      <td colspan=2><input name="isalias" type="radio" id="isalias" <?=$checked?>> <font color="#3366FF" size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
        Alias</font></td>
    </tr>
    <tr> 
      <td height="27"><div align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Redirect 
          Address</font></div></td>
      <td><input name="redir" type="text" id="redir" value="<?=$goto?>"></td>
    </tr>
    <tr> 
      <td height="27" colspan="2"><div align="right"><font color="#3366FF" size="2" face="Verdana, Arial, Helvetica, sans-serif"><font color="#FF0000"></font></font></div></td>
    </tr>
	
	
    <tr> 
      <td colspan=2><img src="/skins/<?=$_SESSION["skin"]?>/elements/line.gif" width=564 height=1 border=0></td>
    </tr>
	<?if($flag==1){?>
    <tr> 
      <td colspan=2><div align="center"> 
          <input type="submit" class="commonButton" onclick="return chk_frm();" value="Update">
          <input type="button" class="commonButton" value="Cancel" onclick="javascript:history.back();">
        </div></td>
    </tr>
    <tr> 
      <td colspan=2><img src="/skins/<?=$_SESSION["skin"]?>/elements/line.gif" width=564 height=1 border=0></td>
    </tr>
	<?}?>
  </table>

  </form>
  <?}?>
<p>&nbsp;</p>
<p><br>
</p>
<?include "../inc/footer.php"?>
<script language="JavaScript">
function chk_frm(){
flag=true;

<?if($mail==1){?>
if(document.form1.ismail.checked!=true){
	flag=flag && confirm("mailbox will be deleted");
}
if(document.form1.ismail.checked==true){
if(document.form1.pass.value=="" && document.form1.pass2.value==""){
	flag=flag && confirm("password for mailbox will not changed");
}
if(document.form1.pass.value!=document.form1.pass2.value){
	alert("password does not match");
	flag=false;
}
}
<?}?>
<?if($alias==1){?>
if(document.form1.isalias.checked!=true){
	flag=flag && confirm("mail alias will be deleted");
}
if(document.form1.isalias.checked==true && document.form1.redir.value==""){
	alert("provide value for redirect address");
	flag=false;
}
<?}?>

return flag;
}
</script>