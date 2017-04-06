<?$ACCESS_LEVEL=2;?>
<?include "../inc/security.php"?>
<?
	//In this file we are setting the ID and the NAME of the domain in the session
	//----------------------------------------------------------------------------
	include "../inc/connection.php";
	$domainid=$_GET["domainid"];
	$_SESSION["domainid"]=$domainid;

	if(isset($_GET["code"]))
	   {
			$query="select * from tbldomain where domainid=$domainid";
			//myLog($query);
			$arrcl=mysql_query($query) or dir(errorCatch(mysql_error()));
			$result=mysql_fetch_array($arrcl);
			$clientid=$result["resellerid"];
			
			mysql_free_result($arrcl);

			$query="select * from tblreseller where resellerid=$clientid";
			//myLog($query);
			$arrcl=mysql_query($query) or dir(errorCatch(mysql_error()));
			$result=mysql_fetch_array($arrcl);
			$clientname=$result["resellername"];

			$_SESSION["clientid"]=$clientid;
			$_SESSION["clientname"]=$clientname;

			mysql_free_result($arrcl);
	   }


	//echo "Wait redirecting the page...";
	
	$query="select * from tbldomain where domainid=$domainid";
	//myLog($query);
	$array=mysql_query($query) or die(errorCatch(mysql_error()));
	$domainset=mysql_fetch_array($array);
	$_SESSION["domainname"]=$domainset["domainname"];
	mysql_free_result($array);
?>
<script>
	window.location ="../domains/showdomaindetails.php";
</script>