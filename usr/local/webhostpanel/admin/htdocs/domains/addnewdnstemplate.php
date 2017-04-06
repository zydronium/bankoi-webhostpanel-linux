	<?$ACCESS_LEVEL=3;?>
	<?include "../inc/connection.php"?>
	<?include "../inc/params.php"?>
	<?include "../inc/functions.php"?>
	<?include "../inc/security.php"?>
	
	<?
		$domainid=$_SESSION["domainid"];
		$domainname=$_SESSION["domainname"];
		
		/*$domainid=$_SESSION["domainid"];
		$domainname=$_SESSION["domainname"];
		
		$query="delete from tbldnsslave where domainid=".$domainid;
		mysql_query($query);
		echo "<br>".$query;
		
		$query="insert into tbldnsstatus set status='master' where domainid='$domainid'";
		echo "<br>".$query;
		mysql_query($query);
	
		$cmd="sed -e \"/\"".$Domainname."\"/d\"  \"/etc/named.conf\"  >  /tmp/named.conf";
		echo "<br>".$cmd;
		/*system($cmd);
		system("cp -f /tmp/named.conf /etc/named.conf | rm -f /tmp/named.conf");*/
	
		if($domainid=="")
			{
				myLog("ERROR-->The domain id was missing from the page addnewdnstemplate.php");
	?>
				<script>
					alert("Sorry there are some problems.Try again");
					history.go(-1);
				</script>
	<?
				die();
			}
	
	
		//For A
		$typeof=$_POST["typeof"];

		//For PTR
		$subnet=$_POST["subnet"];
		
		//For NS
		$ns=$_POST["ns"];
		
		//For MX
		$mx=$_POST["mx"];
	
		//For CNAME
		$cnametype=$_POST["cnametype"];
		
		
		$RecordType= $_POST["redordtype"];
		//echo "The record type is " .$RecordType;
		$ipaddress = $_POST["ipaddress"];
		if($RecordType == "A")
			{
				$host=$typeof . ".".$domainname.".";
				$query = "select * from tbldnsdomain where host='$host' and value='$ipaddress'";
				$Aresult = @mysql_query($query);
				if(mysql_num_rows($Aresult) > 0)
					{
	?>
						<script>
							alert("This address map entry already exists");
							window.location = "/domains/dnsEntry.php";
						</script>
	<?
						die();
					}
				$NewDnsEntry =htmlspecialchars($host);
				$NewDnsEntry .= "\t" . "IN". "\t" . htmlspecialchars($RecordType);
				$NewDnsEntry .= "\t" . htmlspecialchars($ipaddress);
				$query="insert into tbldnsdomain set domainid=$domainid,host='$host',recordtype='$RecordType',value='$ipaddress'";
				mysql_query($query);
			}
	
	
		if($RecordType == "PTR")
			{
	   
				$host="<" . $ipaddress . ">/" . $subnet;
				$NewDnsEntry =htmlspecialchars($host);
				$NewDnsEntry .= "\t" . "IN". "\t" . htmlspecialchars($RecordType);
				$NewDnsEntry .= "\t" . htmlspecialchars($val);
				$query="insert into tbldnsdomain set domainid=$domainid, host='$host',recordtype='$RecordType',value='<domain>.'";
				mysql_query($query);
			}
	
	
		if($RecordType == "NS")
			{
				$host=$domainname.".";
				$val=$ns . ".".$domainname.".";
				$query = "select * from tbldnsdomain where host='$host' and value='$val'";
				$Aresult = @mysql_query($query);
				if(mysql_num_rows($Aresult) > 0)
					{
	?>
						<script>
							alert("This nameserver entry already exists");
							window.location = "/domains/dnsEntry.php";
						</script>
	<?
						die();
					}
				$NewDnsEntry =htmlspecialchars($host);
				$NewDnsEntry .= "\t" . "IN". "\t" . htmlspecialchars($RecordType);
				$NewDnsEntry .= "\t" . htmlspecialchars($val);
	
				$query="insert into  tbldnsdomain set domainid=$domainid, host='$host',recordtype='$RecordType',value='$val'";
				mysql_query($query);
			}
	
	
		if($RecordType == "MX")
			{
				$host=$domainname.".";
				$record=$RecordType . "\t" . $mx;
				$val="mail.".$domainname.".";
				$query = "select * from tbldnsdomain where host='$host' and recordtype='$record'";
				$Aresult = @mysql_query($query);
				if(mysql_num_rows($Aresult) > 0)
					{
	?>
						<script>
							alert("This mailexchange entry already exists");
							window.location = "/domains/dnsEntry.php";
						</script>
	<?
						die();
					}
				$NewDnsEntry =htmlspecialchars($host);
				$NewDnsEntry .= "\t" . "IN". "\t" . htmlspecialchars($record);
				$NewDnsEntry .= "\t" . htmlspecialchars($val);
				$query="insert into tbldnsdomain set domainid=$domainid, host='$host',recordtype='$record',value='$val'";
				mysql_query($query);
			}
	
	
		if($RecordType == "CNAME")
			{
				$host= $cnametype . ".".$domainname.".";
				$val = $domainname . ".";
				$query = "select * from tbldnsdomain where host='$host' and value='$val'";
				$Aresult = @mysql_query($query);
				if(mysql_num_rows($Aresult) > 0)
					{
	?>
						<script>
							alert("This Cononical name entry already exists");
							window.location = "/domains/dnsEntry.php";
						</script>
	<?
						die();
					}
				$NewDnsEntry =htmlspecialchars($host);
				$NewDnsEntry .= "\t" . "IN". "\t" . htmlspecialchars($RecordType);
				$NewDnsEntry .= "\t" . htmlspecialchars($val) . "\n";
			$query="insert into tbldnsdomain set domainid=$domainid, host='$host',recordtype='$RecordType',value='$domainname.'";
	mysql_query($query);
			}
	
		//echo $NewDnsEntry;
	
		AddDomainTemplate($domainname,$NewDnsEntry);
	?>
	<script>
		alert("DNS entry successfully added for the domain");
		window.location="dnsEntry.php";
	</script>
