<?$ACCESS_LEVEL=2;?>
<?include "../inc/connection.php"?>
<?include "../inc/params.php"?>
<?include "../inc/functions.php"?>
<?include "../inc/security.php"?>


<?
  
	$reselid=$_SESSION["clientid"];
	//echo $reselid."<br>";

	//------------------VARIABLES-----------------------------
	$domainname=$_POST["domain_name"];
	$ipaddress=$_POST["ip_addr_id"];
	$detail=$_POST["detail"];
	$isWWW=$_POST["isWWW"];
	$password=$_POST["password"];
	$phone = $_POST["phone"];
	$email = $_POST["email"];
	$address = $_POST["address"];
	$city = $_POST["city"];
	$states = $_POST["state"];
	$zipcode = $_POST["zipcode"];
	$country = $_POST["country"];
	$companyname = $_POST["companyname"];
	$personalname = $_POST["personalname"];
  
	//------------------VARIABLES-----------------------------
  
	if($detail==1)
		{
			$hosting='Y';
		}
	else
		{
			$hosting='N';
		}

	$query="select * from tbldomain where domainname='$domainname'";
	//myLog($query);
	$array=mysql_query($query) or die(errorCatch(mysql_error()));
	$num=mysql_num_rows($array);
	if($num>0)
		{
?>
			<script>
				alert("Domain name already exists");
				history.go(-1);
			</script>
<?
			die();
		}
  
	//Entry to the table domain--------------------------------------------------
	$query="insert into tbldomain(domainname,resellerid,ipaddress,domainlimits,hosting) values('$domainname',$reselid,'$ipaddress','0','N')";
	//myLog($query);
	mysql_query($query) or die(errorCatch(mysql_error()));

	//Getting the id of the domain-----------------------------------------------
	$query="select max(domainid) as domainid from tbldomain";
	//myLog($query);
	$array=mysql_query($query) or die(errorCatch(mysql_error()));
	$domainset=mysql_fetch_array($array);
	$domainid=$domainset["domainid"];
	$_SESSION["domainid"]=$domainid;
	$_SESSION["domainname"]=$domainname;


	$dt=date("Y-m-d");
	$query="insert into tblloginmaster(username,typeid,usertype,regdate,skinname,status,password) values('$domainname',$domainid,'d','$dt','default','1','$password')";
	//myLog($query);
	mysql_query($query) or die(errorCatch(mysql_error()));

	$query="select * from tblserverip where id=$ipaddress";
	//myLog($query);
	$iparray=mysql_query($query) or die(errorCatch(mysql_error()));
	$ipresult=@mysql_fetch_array($iparray);
	$ipadd=$ipresult["ipaddress"];
	mysql_free_result($iparray);

	//Making the DNS entries
	//--------------------------------------------------
	MakeDNSEntries($domainid,$domainname,$ipadd,$isWWW);

	$query  = "Insert into tbldomaincontact(companyname,contactname,phone,email,address,city,state,zipcode,country,domainid) values('$companyname','$personalname','$phone','$email','$address','$city','$states','$zipcode','$country',$domainid)";
  	//myLog($query);
  	@mysql_query($query) or die(errorCatch(mysql_error()));
	//Setting up the values for the domain
	//--------------------------------------------------
	$emailalias = -1;
	$popmailaccount = -1;

	//Creating the mail account o fthe user
	//--------------------------------------------------
	//echo "$maildomainpath.$domainname.\"/\".$mailname.\"@\".$domainname,0700";
	mkdir($maildomainpath.$domainname);
	//mkdir($maildomainpath.$domainname."/".$mailname."@".$domainname,0700);
	
	$query="insert into mail_domain(domain, description, aliases, mailboxes, maxquota, created, modified,active) values('$domainname','$domainname','$emailalias','$popmailaccount',-1,NOW(),NOW(),1)";
	//myLog($query);
	@mysql_query($query) or die(errorCatch(mysql_error()));

	if(!$detail==1)
	{
?>
		<script>
			window.location="../domains/clientdomains.php";
		</script>
<?	
	}
  else
	{
?>
		<script>
			window.location="../domains/newdomain.php?domainid=<?=$domainid?>";
		</script>
<?	
	}
?>