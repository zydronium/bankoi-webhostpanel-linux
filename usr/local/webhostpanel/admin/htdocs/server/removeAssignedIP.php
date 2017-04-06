<?$ACCESS_LEVEL=1;?>
<?include "../inc/connection.php"?>
<?include "../inc/params.php"?>
<?include "../inc/functions.php"?>
<?include "../inc/security.php"?>
<html>
<head>
<title>Remove IP Assigned To Client</title>
</head>
<link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/general.css">
<link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/custom.css">
<link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/layout.css">
<body leftmargin=0 topmargin=0>
<form name="form1" action="removeAssigned.php" method="post">
       <?include "../inc/mainheader.php"?>
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
      &gt; Remove IP</td>
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
      &gt; Log Manager</td>
  </tr>
  <?
		}
	elseif(strtoupper($_SESSION["type"])=="D")
		{
?>
  <tr> 
    <td align="left" class="navigation"> 
      <?=$_SESSION["domainname"]?>
      &gt; Log Manager</td>
  </tr>
  <?
		}
?>
 </table>-->
<?
$ids="";
if(isset($_POST["id"]))
	{

		echo "<table align='center' width='10%'>";
		echo "<tr><td colspan=2><img src='/skins/default/elements/line.gif' width=564 height=1 border=0></td></tr>";
		echo "<tr ><td align='center' class ='clientheading'>IP Address</font></td><td class ='clientheading'>Can be removed?</td></tr>";
		
		for($i=0;$i<count($_POST["id"]);$i++)
			{
				$ids=$ids.$_POST["id"][$i].",";
				$query="select * from tblserverip where Id='".$_POST["id"][$i]."'";
				//myLog($query);
				$rs=mysql_query($query) or die(errorCatch(mysql_error()));;
				$result=mysql_fetch_array($rs);
				echo "<tr><td align='center'><font color='#3366FF' size='2' face='Verdana, Arial, Helvetica, sans-serif'>".$result["ipaddress"]."</font></td>";
				$query="select * from tbldomain where ipaddress='".$_POST["id"][$i]."' and resellerid='".$_SESSION["clientid"]."'";
				//myLog($query);
				$rs=mysql_query($query) or die(errorCatch(mysql_error()));;
				$n=mysql_affected_rows();
				if($n > 0)
					echo "<td ><font color='#3366FF' size='2' face='Verdana, Arial, Helvetica, sans-serif'>No</font></td></tr>";
				else
						echo "<td ><font color='#3366FF' size='2' face='Verdana, Arial, Helvetica, sans-serif'>Yes</font></td></tr>";
			}
		echo "<tr><td colspan=2 ><img src='/skins/default/elements/line.gif' width=564 height=1 border=0></td></tr>";
		echo "</table><br>";
		echo "<input type='hidden' name='idd' value='".$ids."'>";
		echo "<div align='center'><input class='commonButton' type='Submit' value='Proceed'> <input class='commonButton' type='button' value='cancel' onclick='javascript:history.back();'></div>";
}
?>
</form>
</body>
</html>


<? include "../inc/footer.php" ?>