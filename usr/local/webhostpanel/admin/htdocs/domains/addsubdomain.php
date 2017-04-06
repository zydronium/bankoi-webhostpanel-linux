<?$ACCESS_LEVEL=3?>
<?include "../inc/connection.php"?>
<?include "../inc/params.php"?>
<?include "../inc/functions.php"?>
<?include "../inc/security.php"?>

<?
	$domainid=$_SESSION["domainid"];
	$dmnid=$_SESSION["domainid"];
	$domainname=$_SESSION["domainname"];
	$username=$_SESSION["clientname"];
	$reselid=$_SESSION["clientid"];

	$subdomain = $_POST["subdomain"];
	$name = $_POST["username"];
	$password = $_POST["password"];

	if($subdomain == "")
	{
?>
			<script>
			alert("Plase provide SubDomain name");
			history.go(-1);
			</script>
<?
			die();
	}
	
	
	if($name == "")
	{
	?>
	<script>
		alert("Plase provide Username");
		history.go(-1);
	</script>
	<?
			die();
	}
	
	if($password == "")
		{
?>
	<script>
		alert("Plase provide  Password");
		history.go(-1);
	</script>
<?
			die();
	}


	$query = "select subdomains from tbldomainrights where domainid = '$domainid'";
	$exSubdomains = @mysql_query($query);
	$rsSubdomains = @mysql_fetch_array($exSubdomains);
	$numOfSubDomains = $rsSubdomains["subdomains"];

	if($numOfSubDomains == 0)
		{
?>
				<script>
					alert("This domain has no rights to create SubDomains!!!");
					window.location = "managesubdomain.php";
				</script>
<?
				die();
		}


	$query = "select count(username) as SubDomains from tblsubdomain where domainid = '$domainid'";
	$exusedSubdomains = @mysql_query($query);
	$rsusedSubdomains = @mysql_fetch_array($exusedSubdomains);
	$numOfUsedSubDomains = $rsusedSubdomains["SubDomains"];

	if($numOfSubDomains <= $numOfUsedSubDomains)
		{
?>
				<script>
					alert("Domains subdomains account has been exhausted!!!");
					window.location = "managesubdomain.php";
				</script>
<?
				die();
		}

	$subdomain = $subdomain . "." . $domainname;
	$query = "select domainname from tbldomain where domainname='$subdomain'"; 
	$arrCounter = mysql_query($query);
	if(mysql_num_rows($arrCounter) > 0)
		{
?>
				<script>
					alert("Domain name already in use!!!");
					history.go(-1);
				</script>
<?
				die();
		}


	$query = "select ftpusername from tblftpinfo where ftpusername='$name'";
	$arrCounter = mysql_query($query);
	if(mysql_num_rows($arrCounter) > 0)
		{
?>
				<script>
					alert("Username already in use!!!");
					history.go(-1);
				</script>
<?
				die();
		}



////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	$FolderName = $sHostingDir ."/" . $username . "/" . $domainname . "/" . "subdomains";
	if(!is_dir($FolderName))
		{
			CreatesubdomainDir($FolderName);
		}
	$FolderName = $sHostingDir ."/" . $username . "/" . $domainname . "/" . "subdomains" . "/" . $subdomain;
	
	if(!is_dir($FolderName))
		{
			CreatesubdomainDir($FolderName);
		}

	$query = "select tblserverip.ipaddress as ipadd from(tbldomain inner join tblserverip on tbldomain.ipaddress = tblserverip.Id) where tbldomain.domainid ='$dmnid'";
	//echo $query;
	$ipArray = mysql_query($query);
	$fetchArr = mysql_fetch_array($ipArray);
	$ipaddress = $fetchArr["ipadd"];

	

	if(subDomainhttpFile($username,$domainname,$subdomain,$name,$ipaddress,$password) == "user problem")
		{
			$sPath=$FolderName;
			$cmd="rm -rf " . $sPath . " 2>&1";
			$output = `$cmd`;
?>
				<script>
					alert("Sorry the user already exists!!!");
					history.go(-1);
				</script>
<?
				die();
		}

	$NewDnsEntry =htmlspecialchars($subdomain) . ".";
	$NewDnsEntry .= "\t" . "IN". "\t" . htmlspecialchars("A");
	$NewDnsEntry .= "\t" . htmlspecialchars($ipaddress);
	AddDomainTemplate($domainname,$NewDnsEntry);


	$query="insert into tblsubdomain(domainid,subdomain,username,password) values ('$domainid','$subdomain','$name','$password')";
	mysql_query($query);

	$query = "insert into tbldnsdomain(domainid,host,recordtype,value) values('$domainid','$subdomain','A','$ipaddress')";
	mysql_query($query);
?>
	<script>
		alert("Subdomain added");
		window.location = "managesubdomain.php";
	</script>
