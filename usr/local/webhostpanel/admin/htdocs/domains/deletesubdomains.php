<?$ACCESS_LEVEL=3?>
<?include "../inc/connection.php"?>
<?include "../inc/params.php"?>
<?include "../inc/functions.php"?>
<?include "../inc/security.php"?>

<?
	$dmnid=$_SESSION["domainid"];
	$domainname=$_SESSION["domainname"];
	$username=$_SESSION["clientname"];
	$reselid=$_SESSION["clientid"];

	if(strlen($_POST["subdomainid"]) <= 0)
		{
?>
			<script>
				alert("No Sub Domains to delete!!!");
				window.location = "";
			</script>
<?
			die();
		}
	
	for($i=0; $i <= count($_POST["subdomainid"])-1; $i++)
		{
			$idDel = $_POST["subdomainid"][$i];
			$query = "select * from tblsubdomain where id='$idDel'";
			$arrSubDomain = mysql_query($query);
			if(!mysql_num_rows($arrSubDomain) <= 0)
				{
						$subDomainresult = mysql_fetch_array($arrSubDomain);
						$subdomain = $subDomainresult["subdomain"];
						$name = $subDomainresult["username"];
						

						$FolderName = $sHostingDir ."/" . $username . "/" . $domainname . "/" . "subdomains" . "/" . $subdomain;
						$sPath=$FolderName;
						$cmd="rm -rf " . $sPath . " 2>&1";
						$output = `$cmd`;

						$sPath=$sHostingDir ."/" . $username . "/" . $domainname . "/conf/" . $subdomain . ".include";
						//echo "<br>File Path " . $sPath;

						$cmd="rm -f " . $sPath . " 2>&1";
						$output = `$cmd`;

						DelFTPUser($name);

						$dirPath=$sCpHomeDir . "/admin/htdocs/";
						$clientPath=$sHostingDir . "/" . $username;
						$DomainConfPath=$clientPath . "/" . $domainname . "/conf/";
						$sEntry = "Include " . $DomainConfPath . $subdomain . ".include\n";
						//echo "<br>Entry to delete " . $sEntry;
						$lines = file("/etc/httpd/conf/httpd.include");
						$ftpuserfile="";
						foreach ($lines as $line_num => $line) 
							{
								$pos=strpos($line, $sEntry);
								if($pos === false || $pos1 === false)
								{
									$ftpuserfile = $ftpuserfile . $line;
								}
								
							}


						if (!$handle = fopen("/etc/httpd/conf/httpd.include", 'w')) 
							{
								echo "Cannot open file (\"httpd.include\") line no 67";
								return false;
							}

						if (!fwrite($handle, $ftpuserfile)) 
							{
								echo "Cannot write to file (\"httpd.include\") line no 73";
								return false;
							}
						fclose($handle);

						$query = "select tblserverip.ipaddress as ipadd from(tbldomain inner join tblserverip on tbldomain.ipaddress = tblserverip.Id) where tbldomain.domainid ='$dmnid'";

						$ipArray = mysql_query($query);
						$fetchArr = mysql_fetch_array($ipArray);
						$ipaddress = $fetchArr["ipadd"];

						$NewDnsEntry =htmlspecialchars($subdomain) . ".";
						$NewDnsEntry .= "\t" . "IN". "\t" . htmlspecialchars("A");
						$NewDnsEntry .= "\t" . htmlspecialchars($ipaddress);
						DeleteDNSEntryDomain($domainname,$NewDnsEntry);

						$query = "delete from tblsubdomain where id='$idDel'";
						mysql_query($query);
			
						$query = "delete from tbldnsdomain where host='$subdomain' and domainid='$dmnid' and recordtype='A'";
						mysql_query($query);			
				}	
		}
?>

<script>
		alert("Sub Domain deleted successfully!!!");
		window.location = "managesubdomain.php";
</script>
