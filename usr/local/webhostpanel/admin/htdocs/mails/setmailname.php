<? $ACCESS_LEVEL=3 ?>
<form name="mainform" action="POST">
<?
		$_SESSION["mailnm"] = $_GET["mailnm"];

?>
<script>
	window.location = "changeemailpass.php";
</script>