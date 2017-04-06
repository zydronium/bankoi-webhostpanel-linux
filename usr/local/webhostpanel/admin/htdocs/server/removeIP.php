<?$ACCESS_LEVEL=1;?>
<?include "../inc/connection.php"?>
<?include "../inc/params.php"?>
<?include "../inc/functions.php"?>
<?include "../inc/security.php"?>
<html>
<head>
</head>
<link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/general.css">
<link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/custom.css">
<link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/layout.css">
<body leftmargin=0 topmargin=0>
<form name="form1" action="remove.php" method="post">
       <?include "../inc/mainheader.php"?>
<?
$ids="";
$id=$_POST["id"];

if(isset($id)){
echo "<table align='center'>";
echo "<tr><td colspan=2><img src='/skins/default/elements/line.gif' width=564 height=1 border=0></td></tr>";
echo "<tr><td align='center'><font color='red' size='3' face='Verdana, Arial, Helvetica, sans-serif'>IP Address</font></td><td><font color='red' size='3' face='Verdana, Arial, Helvetica, sans-serif'>can be deleted?</font></td></tr>";
for($i=0;$i<count($_POST["id"]);$i++){

$ids=$ids.$_POST["id"][$i].",";
$query="select * from tblserverip where Id='".$_POST["id"][$i]."'";
//echo $query;
myLog($query);
$rs=mysql_query($query) or die(errorCatch(mysql_error()));;
$result=mysql_fetch_array($rs);
echo "<tr><td align='center'><font color='#3366FF' size='2' face='Verdana, Arial, Helvetica, sans-serif'>".$result["ipaddress"]."</font></td>";
$query="select * from tbldomain where ipaddress='".$_POST["id"][$i]."'";
myLog($query);
$rs=mysql_query($query) or die(errorCatch(mysql_error()));;
$n=mysql_affected_rows();
if($n>0)
{
	//echo "<td><font color='#3366FF' size='2' face='Verdana, Arial, Helvetica, sans-serif'>No</font></td></tr>";
?>
<script>
	alert("Cannot Delete This Ip");
	history.back();
</script>
<?
}else
		echo "<td><font color='#3366FF' size='2' face='Verdana, Arial, Helvetica, sans-serif'>Yes</font></td></tr>";
}
echo "<tr><td colspan=2><img src='/skins/default/elements/line.gif' width=564 height=1 border=0></td></tr>";
echo "</table><br>";
//echo $ids;
echo "<input type='hidden' name='idd' value='".$ids."'>";
echo "<div align='center'><input type='Submit' class='commonButton' value='Proceed'> <input class='commonButton' type='button' value='cancel' onclick='javascript:history.back();'></div>";
}
?>
</form>
</body>
</html>

<? include "../inc/footer.php" ?>
