<?$ACCESS_LEVEL=1;?>
<?include "../inc/connection.php"?>
<?include "../inc/params.php"?>
<?include "../inc/functions.php"?>
<?include "../inc/security.php"?>


<?
$popmail=$_POST["popmail"];
$sql=$_POST["sql"];
$email=$_POST["email"];
$diskspace=$_POST["diskspace"];
$domains=$_POST["domains"];
$traffic=$_POST["traffic"];
$pwdprotectdir="Y";
$frontpageext="Y";
$webstart="Y";

$popmail=(trim($popmail)==""?-1:$popmail);
$sql=(trim($sql)==""?-1:$sql);
$email=(trim($email)==""?-1:$email);
$diskspace=(trim($diskspace)==""?-1:$diskspace);
$domains=(trim($domains)==""?-1:$domains);
$traffic=(trim($traffic)==""?-1:$traffic);

$query="update tblclientrights set popmailaccount='".$popmail."',sqldatabase='".$sql."',emailalias='".$email."',diskspace='".$diskspace."',domains='".$domains."',pwdprotectdir='".$pwdprotectdir."',frontpageext='".$frontpageext."',webstart='".$webstart."',traffic='".$traffic."' where resellerid='".$_SESSION["clientid"]."'";

mysql_query($query) or die(errorCatch(mysql_error()));
?>
<script>
alert("Clients Limits set!");
location.replace('../domains/clientdomains.php');
</script>