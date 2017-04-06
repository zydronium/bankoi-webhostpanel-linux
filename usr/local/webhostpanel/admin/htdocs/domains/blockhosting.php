<?$ACCESS_LEVEL=2;?>
<?include "../inc/connection.php"?>
<?include "../inc/params.php"?>
<?include "../inc/functions.php"?>
<?include "../inc/security.php"?>


<?
	//------------------SESSION VARIABLES------------------------------------------------------------


	//------------------VARIABLES--------------------------------------------------------------------
	
	$domainid = $_GET["domainid"];
	$mode = $_GET["mode"];

	if(!isset($domainid) || !isset($mode))
		{
			echo "There are errors creating domain.Contact your administrator because your session has expired.";
?>
			<script>
					window.location='../logout.php';
			</script>
<?
			die();
		}

		if($mode==0)
		{
		
		$query="select * from tbldomain where domainid=$domainid";
		//myLog($query);
		$arraydomain=mysql_query($query) or die(errorCatch(mysql_error()));
		$numdomains=mysql_num_rows($arraydomain);
		$domains=@mysql_fetch_object($arraydomain);

		$reselid= $domains->resellerid;
		
		$query="select * from tblreseller where resellerid=$reselid";
		$arrayreseller=mysql_query($query) or die(errorCatch(mysql_error()));
		$reseller=@mysql_fetch_object($arrayreseller);	
		$resellername=$reseller->resellername;

		if($numdomains==0)
			{
				?>
				<script>
						window.history.go(-1);
				</script>
				<?
				die();	
			}
		
			else

			{
				$query="select * from tblftpinfo where domainid=$domainid";
				//myLog($query);
				$arraydomainftp=mysql_query($query) or die(errorCatch(mysql_error()));
				$domainsftp=@mysql_fetch_object($arraydomainftp);

				$ststusftp=blockFtpUser($domainsftp->ftpusername);
				
				
				myLog($resellername. "   " . $domains->domainname);

				$ststusdomain=DeleteHttpdEntry($resellername,$domains->domainname);
				
				if($ststusftp=="true" || $ststusdomain=="true")
				{
					$query="update tblloginmaster set status='0' where typeid='".$domainid."' and usertype='d'";
					//myLog($query);
					mysql_query($query) or die(errorCatch(mysql_error()));

					//$query="update tbldomain set hosting='N' where domainid=".$domainid;
					//myLog($query);
					//mysql_query($query) or die(errorCatch(mysql_error()));


				}
			
			}

if(strtoupper($_SESSION["type"])=="A")
	{
?>
			
			<script>
					alert("Domain Hosting Disabled Successfully");
					window.location='../domains/domains.php';
			</script>
<?
	}
if(strtoupper($_SESSION["type"])=="C")
	{
?>
			
			<script>
					alert("Domain Hosting Disabled Successfully");
					window.location='../domains/clientdomains.php';
			</script>
<?
	}	
		}
		else if($mode==1)
		{
		
		$query="select * from tbldomain where domainid=" . $domainid;
		myLog($query);
		$arraydomain=mysql_query($query) or die(errorCatch(mysql_error()));
		$numdomains=mysql_num_rows($arraydomain);
		$domains=@mysql_fetch_object($arraydomain);


		$reselid= $domains->resellerid;
		
		$query="select * from tblreseller where resellerid=$reselid";
		$arrayreseller=mysql_query($query) or die(errorCatch(mysql_error()));
		$reseller=@mysql_fetch_object($arrayreseller);	
		$resellername=$reseller->resellername;

		if($numdomains==0)
			{
				?>
				<script>
						window.history.go(-1);
				</script>
				<?
				die();	
			}
		
			else

			{
				$query="select * from tblftpinfo where domainid=".$domainid;
				//myLog($query);
				$arraydomainftp=mysql_query($query) or die(errorCatch(mysql_error()));
				$domainsftp=@mysql_fetch_object($arraydomainftp);


				if($domains->hosting=="Y")
				{
					$ststusftp=unblockFtpUser($domainsftp->ftpusername);
					$ststusdomain=EditHttpdEntry($resellername,$domains->domainname);
				}

				if(($ststusftp=="true" && $ststusdomain=="true") || ($domains->hosting=="N"))
				{
					$query="update tblloginmaster set status='1' where typeid=$domainid and usertype='d'";
					//myLog($query);
					mysql_query($query) or die(errorCatch(mysql_error()));

					//$query="update tbldomain set hosting='Y' where domainid=".$domainid;
					//myLog($query);
					//mysql_query($query) or die(errorCatch(mysql_error()));


				}
			
			}

if(strtoupper($_SESSION["type"])=="A")
	{
?>
			
			<script>
					alert("Domain Hosting Enabled Successfully");
					window.location='../domains/domains.php';
			</script>
<?
	}
if(strtoupper($_SESSION["type"])=="C")
	{
?>
			
			<script>
					alert("Domain Hosting Enabled Successfully");
					window.location='../domains/clientdomains.php';
			</script>
<?
	}
	
		}
		else
		{
			?>
			<script>
					window.history.go(-1);
			</script>
			<?
			die();	
		
		}