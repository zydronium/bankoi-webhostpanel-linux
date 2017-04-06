<?$ACCESS_LEVEL=3;?>
<?include "../inc/connection.php"?>
<?include "../inc/params.php"?>
<?include "../inc/security.php"?>
<?include "../inc/functions.php"?>
<?include "../inc/constants.php"?>

<?
	$InfoArray=split("\n",$_POST["users"]);
	$pwddirectory=$_POST["pwddirectory"];
	$domainid = $_SESSION["domainid"];
	$domainname = $_SESSION["domainname"];
	
	/*$query = "select count(*) as dirCount from tbldirpass where domainname = '$domainname' and dirname = '$pwddirectory'";
	echo $query . mysql_num_rows($exDir);
	$exDir = @mysql_query($query);
	if(mysql_num_rows($exDir) != 0)
		{
			$rsDir = @mysql_fetch_array($exDir);
			if($rsDir["dirCount"] == $pwddirectory)
				{
?>
					<script>
						alert("Password for this directory already set!")
						window.location = "explorer.php";
					</script>
<?	
					die();
				}
		}*/
	
	
	
	$query="select resellername,domainname from(tbldomain inner join tblreseller on tbldomain.resellerid=tblreseller.resellerid) where tbldomain.domainid='$domainid'";
	
	$resultSet=mysql_query($query) or die(errorCatch(mysql_error()));
	$ResultArray=mysql_fetch_array($resultSet);
	if(mysql_num_rows($resultSet) > 0)
		{
			$ClientName=$ResultArray["resellername"];
			$DomainName=$ResultArray["domainname"];
		}
	else
		{
			echo "Problem occured - Can not get the domain details!";
			exit;
		}
	$home=$sHostingDir . "/" . $ClientName . "/" . $DomainName;
	for($k=0; $k< count($InfoArray); $k++)
		{
			$TempArr=split("/",$InfoArray[$k]);
			if(!$TempArr[0]=="")
				{
					if($username=="")
						{
							$username = trim($TempArr[0]);
							$passwd = trim($TempArr[1]);
						}
					else
						{
							$username .= "," . trim($TempArr[0]);
							$passwd .="," . trim($TempArr[1]);
						}
				}	
			
			$usrName = trim($TempArr[0]);
			$usrPass = trim($TempArr[1]);
			
			$query = "insert into tbldirpass (domainname,dirname,username,passwd) values('$domainname','$pwddirectory','$usrName','$usrPass')";
			@mysql_query($query);

		}
		
	
	if(PwdProtectDir($home,$username,$passwd,$pwddirectory,$DomainName))
		{
?>
				<script>
					alert("Password to directory set!");
					window.location="../domains/explorer.php"
				</script>
<?
		}
	else
		{
?>
				<script>
					alert("Password to directory not set!");
					window.location="../domains/explorer.php"
				</script>
<?
	}
?>