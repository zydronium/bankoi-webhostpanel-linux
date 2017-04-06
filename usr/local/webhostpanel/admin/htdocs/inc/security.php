<?
include "connection.php";
include "constants.php";
include "MyLogger.php";

	if(!isset($_SESSION["userid"]) || !isset($_SESSION["type"]))
	{
		?>
		
		 <script>
		 	 window.location.replace("../logout.php");
		 </script>
	<?
	}


//This segment of code checks the correct accessibility of the page to the correct user
//-------------------------------------------------------------------------------------
myLog("The ACCESS LEVEl is " . $ACCESS_LEVEL);
switch ($ACCESS_LEVEL)
	{
		case 1:
				if(strtoupper($_SESSION["type"]) != "A")
					{	
						echo "<script>window.location='../inc/error.htm'</script>";
					}
				break;
		case 2:
				if(((strtoupper($_SESSION["type"])) != "A") && ((strtoupper($_SESSION["type"])) != "C"))
					{
						echo "<script>window.location='../inc/error.htm'</script>";
					}
				break;
		case 3:
				if(strtoupper($_SESSION["type"])!="A" && strtoupper($_SESSION["type"])!="C" && strtoupper($_SESSION["type"])!="D")
						echo "<script>window.location='../inc/error.htm'</script>";
				break;
		default:
				echo "<script>window.location='/login.php'</script>";
	}
//-------------------------------------------------------------------------------------
?>