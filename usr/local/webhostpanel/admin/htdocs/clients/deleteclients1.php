<? $ACCESS_LEVEL=1; ?>
<?include "../inc/connection.php"?>
<?include "../inc/params.php"?>
<?include "../inc/functions.php"?>
<?include "../inc/security.php"?>

<?

	if(strlen($_POST["delclients"])==0 || $_POST["delclients"]=="")
	{	
?>
	<script>
		alert("No clients to delete");
		window.location="../clients/clients.php";
	</script>
<?
	die();}
	$delclients=split(",",$_POST["delclients"]);
	for($i=0; $i<count($delclients)-1; $i++)
		{
			$reselid=$delclients[$i];
			$query="select * from tblreseller where resellerid=$reselid";
			$array=mysql_query($query) or die(errorCatch(mysql_error()));
			if(mysql_num_rows($array) == 0)
				{
?>
					<script>
						alert("The domain has been deleted");
					</script>
<?
				}
			else
				{
					$result=mysql_fetch_object($array);
					$resellername=$result->resellername;
					mysql_free_result($array);

					$userDir = $sHostingDir . "/" . $resellername;
					//-------------------------------------------------------------------------------------------------------
					  if(isFolderExists($userDir))
						{
							if(!DeleteDir($userDir))
								die("Unable to delete the client directory");
						}
					//-------------------------------------------------------------------------------------------------------
					$query="delete from tblclientcontact where resellerid=$reselid";
					mysql_query($query);

					$query="delete from tblclientrights where resellerid=$reselid";
					mysql_query($query);

					//Getting the ip assigned to the reseller
					//----------------------------------------------------------------------------
					$query="select * from tblresellerip where resellerid=$reselid";
					$arriIP=mysql_query($query) or die(errorCatch(mysql_error()));
					if(mysql_num_rows($arriIP) > 0)
						{
								while($RecIp=mysql_fetch_array($arriIP))
										{
											$query="update tblserverip set isavailable='Y' where ucase(iptype)='EXCLUSIVE' and id=" . $RecIp['ipaddress'];
											//myLog($query);
											mysql_query($query) or die(errorCatch(mysql_error()));
										}
						}


					$query="delete from tblreseller where resellerid=$reselid";
					mysql_query($query);

					$query="delete from tblresellerip where resellerid=$reselid";
					mysql_query($query);

					$query="delete from tblloginmaster where typeid=$reselid and ucase(usertype)='C'";
					mysql_query($query);
					
					$query="delete from tbldnstemplate where resellerid='$reselid'";
					mysql_query($query);
				}
		}
?>
<SCRIPT>
	alert("Clients successfully deleted");
	window.location="../clients/clients.php";
</SCRIPT>