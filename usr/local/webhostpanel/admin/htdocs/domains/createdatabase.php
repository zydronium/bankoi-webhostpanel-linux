<?$ACCESS_LEVEL=3;?>
<?include "../inc/connection.php"?>
<?include "../inc/params.php"?>
<?include "../inc/functions.php"?>
<?include "../inc/security.php"?>

<?
	$databasename = $_POST["databasename"];
	$username = $_POST["username"];
	$pass = $_POST["pass"];
	$domainid=$_SESSION["domainid"];
	$Dbflag=0;
	$userflag=0;

	$query = "select count(*) as DbCount from tbldatabase where domainid = '$domainid'";
	$arrres = @mysql_query($query);
	$Res = @mysql_fetch_array($arrres);
	$count = $Res["DbCount"];

	$query = "select sqldatabase from tbldomainrights where domainid = '$domainid'";
	$arrres1 = @mysql_query($query);
	$Res1 = @mysql_fetch_array($arrres1);
	$count1 = $Res1["sqldatabase"];

	if($count >= $count1)
		{
?>
			<script>
				alert("Domains has utilized all his database account!!!");
				window.location = "managedatabase.php";
			</script>
<?
			die();
		}


	//echo "grant all privileges on " . $databasename . ".* to " . $username . "@\"localhost\" identified by '" . $pass . "'";

	if(IsExistsDB($databasename))
		{
			$Dbflag=1;
			if(IsUser($databasename,$username))
				{
					$query="grant all privileges on " . $databasename . ".* to " . $username . "@\"localhost\" identified by '" . $pass . "'";
					if(mysql_query($query))
						{
							$Dbflag=1;
							$userflag=1;
							myLog("Database created successfully 23");
							//Insrting the record to the database
							$query="insert into tbldatabase (domainid,databasename,dbusername,dbpassword,dbtype) values($domainid,'$databasename','$username','$pass','MySql')";
							myLog($query);
							mysql_query($query);
						}
					else
						{
							myLog(mysql_error() . " --> While Creating Db");
							$Dbflag=0;
							$userflag=0;
							//myLog("Database not created 35");
							$query="drop database " . $databasename;
							@mysql_query($query);
						}

				}
			else
				{
					$Dbflag=0;
					$userflag=0;
					$query="drop database " . $databasename;
					@mysql_query($query);
				}
		}

		if($Dbflag==1 && $userflag==1)
			{
?>
					<SCRIPT>
						alert("Database Successfully created");
						window.location="managedatabase.php";
					</SCRIPT>
<?
			}
		else
			{
?>
					<SCRIPT>
						alert("Database already exists");
						window.location="managedatabase.php";
					</SCRIPT>
<?
			}
?>