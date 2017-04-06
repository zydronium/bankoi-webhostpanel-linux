	<?$ACCESS_LEVEL=2;?>
	<?include "../inc/connection.php"?>
	<?include "../inc/params.php"?>
	<?include "../inc/functions.php"?>
	<?include "../inc/security.php"?>
	
<?
		$domainid=$_SESSION["domainid"];
		$domainname=$_SESSION["domainname"];
		$resellerid = $_SESSION["clientid"];
		
		if($resellerid=="")
			{
?>
				<script>
					alert("Sorry there are some problems.Try again");
					history.go(-1);
				</script>
<?
				die();
			}
	
		//The IP address is 
		$ipadd = $_POST["ipaddr"];
		if(strlen($ipadd) == 0)
			{
			$ipadd = "<ip>";
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
		//$ipaddress = $_POST["ipaddress"];
		
		
		if($RecordType == "A")
			{
				$host=$typeof . ".". "<domain>" . ".";
				if($ipadd != "<ip>")
					{
						$query = "select * from tbldnstemplate where host='$host' and value='$ipadd' and resellerid='$resellerid'";
						$Aresult = @mysql_query($query);
						if(mysql_num_rows($Aresult) > 0)
							{
?>
								<script>
									alert("This address map entry already exists");
									window.location = "/clients/dnsEntry.php";
								</script>
<?
								die();
							}
					}
				$query="insert into tbldnstemplate set resellerid='$resellerid',host='$host',recordtype='$RecordType',value='$ipadd'";
				mysql_query($query);
			}
	
		
		if($RecordType == "NS")
			{
				if(strlen($_POST["dmnname"]) == 0)
					{
						$stToDmn = "";
					}
				else
					{
						$stToDmn = $_POST["dmnname"] . ".";
					}
				$host="<domain>" . ".";
				$val=$ns . "." . $stToDmn;
				$query = "select * from tbldnstemplate where host='$host' and value='$val' and resellerid='$resellerid'";
				$Aresult = @mysql_query($query);
				if(mysql_num_rows($Aresult) > 0)
					{
?>
						<script>
							alert("This nameserver entry already exists");
							window.location = "/clients/dnsEntry.php";
						</script>
<?
						die();
					}
	
				$query="insert into tbldnstemplate set resellerid='$resellerid', host='$host',recordtype='$RecordType',value='$val'";
				mysql_query($query);
			}
	
	
		if($RecordType == "MX")
			{
				if(strlen($_POST["exchangeval"]) == 0)
					{
						$Exch  = "mail." . "<domain>";
					}
				else
					{
						$Exch  = $_POST["exchangeval"];
					}
				$host="<domain>" .".";
				$record=$RecordType . "\t" . $mx;
				$val=$Exch . ".";
				$query = "select * from tbldnstemplate where host='$host' and recordtype='$record' and resellerid='$resellerid'";
				$Aresult = @mysql_query($query);
				if(mysql_num_rows($Aresult) > 0)
					{
?>
						<script>
							alert("This mailexchange entry already exists");
							window.location = "/clients/dnsEntry.php";
						</script>
<?
						die();
					}
					
				$query="insert into tbldnstemplate set resellerid='$resellerid', host='$host',recordtype='$record',value='$val'";
				mysql_query($query);
			}
	
	
		if($RecordType == "CNAME")
			{
				
				if(strlen($_POST["cnameval"]) == 0)
					{
						$Exch  = "mail." . "<domain>";
					}
				else
					{
						$Exch  = $_POST["cnameval"];
					}
				$host= $cnametype . "." . "<domain>" . ".";
				$val = $Exch . ".";
				$query = "select * from tbldnstemplate where host='$host' and value='$val' and resellerid='$resellerid'";
				$Aresult = @mysql_query($query);
				if(mysql_num_rows($Aresult) > 0)
					{
?>
						<script>
							alert("This Cononical name entry already exists");
							window.location = "/clients/dnsEntry.php";
						</script>
<?
						die();
					}

				$query="insert into tbldnstemplate set resellerid='$resellerid', host='$host',recordtype='$RecordType',value='$val'";
				mysql_query($query);
			}

?>
	<script>
		alert("DNS entry successfully added for the reseller");
		window.location="/clients/dnsEntry.php";
	</script>
