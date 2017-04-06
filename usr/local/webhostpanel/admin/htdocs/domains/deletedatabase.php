<?$ACCESS_LEVEL=3;?>
<?include "../inc/connection.php"?>
<?include "../inc/params.php"?>
<?include "../inc/functions.php"?>
<?include "../inc/security.php"?>

<?
	$IDdomain=$_SESSION["domainid"];
	
	if(count($_POST["domainid"])==0)
		{
?>
<script>
	alert("No Database to delete");
	window.location="managedatabase.php";
</script>
<?
			myLog("No database to delete");
			die();
		}
	else
		{
			for($i=0; $i <= count($_POST["domainid"])-1; $i++)
				{
					$databasename = $_POST["domainid"][$i]; //This containd the database name
					//echo "The domain id is " . $domainid;
					//$query="select * from tbldatabase where domainid='$domainid'";
					//echo $query;

					//$res=mysql_query($query) or die("Some error occured while deleting the database");
					
					//if(mysql_num_rows($res) > 0)
						//{
							
							//$arr=mysql_fetch_row($res);
							//$databasename= $arr["databasename"];
							//$dbuser= $arr["dbusername"];
							//$password= $arr["dbpassword"];
							//mysql_free_result($res);

								if(DeleteDomainDB($IDdomain , $databasename))
								{
									$query="delete from tbldatabase where domainid='$IDdomain' and databasename='$databasename'";
									mysql_query($query) or die("There were some errors deleting the database");
									?>
									<script>
										alert("Database deleted Successfully");
										window.location="managedatabase.php";
									</script>
									<?
								}
						//}
					
				}
		}
?>
<script>
	alert("Problem deletying databases");
	window.location="managedatabase.php";
</script>