<?$ACCESS_LEVEL=1;?>
<?include "../inc/connection.php"?>
<?include "../inc/params.php"?>
<?include "../inc/functions.php"?>
<?include "../inc/security.php"?>

<?
	$tmonth = $_POST["tmonth"];
	$tdate = $_POST["tdate"];
	$thour = $_POST["thour"];
	$tminute = $_POST["tminute"];
	$tyear = $_POST["tyear"];
	$tday= $_POST["tday"];
	$tsec= $_POST["tsec"];
		
	$str = $tmonth . $tdate . $thour . $tminute . $tyear . "." . $tsec;
	SetDateTime($str);
?>
<script>
	alert("System Date and Time set");
	window.location = "../server/server.php";
</script>

