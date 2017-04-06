<?
include "inc/connection.php";
include "inc/constants.php";
include "inc/MyLogger.php";

		if($_GET['mode']==$SEND_ERROR)
		mail($ADMIN_EMAIL,"Error found in Linux Hosting Contril Panal",$_SESSION['errorMesg']);

		session_destroy();
		Header("Location: login.php");
?>