<?$ACCESS_LEVEL=2;?>
<?include "../inc/connection.php"?>
<?include "../inc/params.php"?>
<?include "../inc/functions.php"?>
<?include "../inc/security.php"?>


<?
	//------------------SESSION VARIABLES------------------------------------------------------------
	$reselid = $_SESSION["clientid"];
	$resellername = $_SESSION["clientname"];
	//$domainid=$_SESSION["domainid"];
	//$domainname=$_SESSION["domainname"];


	//Echo "Reseller id " .$reselid;
	//Echo "<br>Reseller Name " .$resellername;
	//Echo "<br>Domain Name " .$domainname . "<br>";
	//If the session has expired then do not allow the domain to be created.

	//------------------VARIABLES--------------------------------------------------------------------
	$domainname = $_POST["domain_name"];
	$ipaddress = $_POST["ip_addr_id"];
	//$detail = $_POST["detail"];
	$isWWW = $_POST["isWWW"];
	$password = $_POST["ftppassword"];
	$phone = $_POST["phone"];
	$email = $_POST["email"];
	$address = $_POST["address"];
	$city = $_POST["city"];
	$states = $_POST["state"];
	$zipcode = $_POST["zipcode"];
	$country = $_POST["country"];
	$companyname = $_POST["companyname"];
	$personalname = $_POST["personalname"];
	$ipaddress = $_POST["ip_addr_id"];
	$popmailaccount = $_POST["popmailaccount"];
	$ftpUser = $_POST["ftpusername"];
	$mysqldatabase = $_POST["mysqldatabase"];
	$ftppassword = $_POST["ftppassword"];
	$emailalias = $_POST["emailalias"];
	$webstart = $_POST["webstart"];
	$shellname = $_POST["shellname"];
	$hdspace = $_POST["hdspace"];
	$shellname = $_POST["shellname"];
	$traffic = $_POST["traffic"];
	$ftpusers = 1;
	$traffic = $_POST["trafficport"];
	$cgi_sup = $_POST["cgisupport"];
	$subdomains = $_POST["subdomains"];

	//-----------------------------------------------------------------------------------------------
	if(empty($domainname) || strlen($domainname)==0 || strlen($reselid)==0)
		{
			//myLog("There are errors creating domain.Contact your administrator because your session has expired.");
?>
<script>
			alert("There are errors creating domain.Contact your administrator because your session has expired.");
			window.location = '../clients/clients.php';
</script>
<?
	die();
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


	
	//---------------------------------------------------------------------------------------------------
	//Here we are checking if number of FTPusers,popmailaccount,emailalias,database are not exceeding the 
	//stipulated values assigned to the selected client.If they are exceeded then we have do deny him of
	//making new domain 
	//A==>stands for actual allowed
	$query="select * from tblclientrights where resellerid='$reselid'";
	//myLog($query);
	$array=mysql_query($query) or die(errorCatch(mysql_error()));
	$result=mysql_fetch_array($array);

	$Apopmailaccount=$result["popmailaccount"];
	$Aemailalias=$result["emailalias"];
	$Adatabase=$result["sqldatabase"];

	//---------------------------------------------------------------------------------------
	//Free the previous result
	@mysql_free_result($array);

	$Tpopmailaccount= $popmailaccount;
	$Temailalias= $emailalias;
	$Tdatabase= $mysqldatabase;

	//echo "Tftpuser1" & Tftpuser &"<br>";
	//echo "Tpopmailaccount1" & Tpopmailaccount &"<br>";
	//echo "Temailalias1" & Temailalias &"<br>";
	//echo "Tdatabase1" & Tdatabase &"<br>";
	
	$query="select count(domainid) as cntdomain from tbldomain where tbldomain.resellerid='$reselid'";
	//myLog($query);
	$array=mysql_query($query) or die(errorCatch(mysql_error()));
	$result=mysql_fetch_array($array);
	$domaincount=$result["cntdomain"];
	@mysql_free_result($array);
	//echo "domaincount ".$domaincount;
	if(!$domaincount==0)
	 {
		 //Here we are getting domainid of all the domains created by the selected client
		 //----------------------------------------------------------------------------------------------------
		 $query="select domainid from tbldomain where resellerid='$reselid'";
		 //myLog($query);
		 $array=mysql_query($query) or die(errorCatch(mysql_error()));
		 $totalid=mysql_num_rows($array);
		 if(!$totalid==0)
			{
				while($domainrights=mysql_fetch_object($array))
					{
						//Calculating the total number of various account for the domains of the selected.
			        
						$query="select * from tbldomainrights where domainid='$domainrights->domainid'";
						//myLog($query);
						$array=mysql_query($query) or die(errorCatch(mysql_error()));
						if(mysql_num_rows($array)>0)
						{
							while($accountcount=mysql_fetch_object($array))
								{
									$Tpopmailaccount=$accountcount->pop + $Tpopmailaccount;
									$Temailalias=$accountcount->alias + $Temailalias;
									$Tdatabase=$accountcount->sqldatabase + $Tdatabase;
								}
						}
					}
			}
	 }

$flag=0;
//-----------------------------------------------------------------------------------------
//Checking whether the clients limits are not exceeding the stipulated limits
//echo "The ftpusers are ".$Aftpuser;
if(!$Apopmailaccount==-1)
	{
				if($Apopmailaccount < $Tpopmailaccount)
					{
?>
			<script>
				alert("Sorry client do not have enough Popmail Accounts");
				history.go(-1);
			</script>
<?
			$flag=1;
					die();}
	}

if(!$Aemailalias==-1)
	{
				if( $Aemailalias < $Temailalias)
					{
?>
			<script>
				alert("Sorry client do not have enough Email Alias Account");
				history.go(-1);
			</script>
<?
			$flag=1;
					die();}
	}
if(!$Adatabase==-1)
	{
				if($Adatabase < $Tdatabase)
					{
?>
			<script>
				alert("Sorry client do not have enough Database Accounts");
				history.go(-1);
			</script>
<?	
			$flag=1;
					die();}
	}
//echo "Thje flag is ".$flag;
if($flag==0)
	{	
		        //echo "query1 <BR>";
		//-----------------------------------------------------------------------------------------------------
		 //Here we are checking for the duplicate values for ftpusername
		 $query="select count(*) as ftpcount from tblftpinfo where ftpusername='$ftpUser'";
		 $array=mysql_query($query) or die(errorCatch(mysql_error()));
		 $rsftpinfo=mysql_fetch_array($array);
		 if($rsftpinfo["ftpcount"] > 0)
			{
?>
				  <script>
					  alert("FTP username already exists! Use another name");
					  history.go(-1);
				  </script>
<?
			die();}
					  else
						{
								  $query="select count(username) as cntuser from manageusers where username='$ftpUser'";
								  $array=mysql_query($query) or die(errorCatch(mysql_error()));
								  $rsuser=mysql_fetch_array($array);
								  if($rsuser["cntuser"] > 0)
									{
?>
									<script language="JavaScript">
										alert("FTP username already used!Choose another name for FTP user");
										history.go(-1);
									</script>
<?
									die();}
								  else
									{	  
										  @mysql_free_result($array);
										  $query="select count(username) as cntuser from tblloginmaster where username='$ftpUser'";
										  $array=mysql_query($query) or die(errorCatch(mysql_error()));
										  $rsuser=mysql_fetch_array($array);
										  if($rsuser["cntuser"]>0)
											{
?>
												<script language="JavaScript">
													alert("FTP username already used!Choose another name for FTP user!");
													history.go(-1);
												</script>
<?	
											die();}
									}
						}
			}
	//}
	
		@mysql_free_result($array);
	        //echo "query4 <BR>";
		$query="select count(resellername) as cntuser from tblreseller where resellername='$ftpUser'";
		$array=mysql_query($query) or die(errorCatch(mysql_error()));
		$rsuser=mysql_fetch_array($array);
		if($rsuser["cntuser"] > 0)
			{
?>		
				<script language="JavaScript">
					alert("FTP username already used!Choose another name for FTP user!");
					history.go(-1);
				</script>
<?		
			die();}
		else
			{
				
				  if($_POST["www_prefix"]=="")
						$isWWW = False;
				  else
						$isWWW = True;
				  
					
				  if($_POST["pwdprotect"]=="")
						  $pwdprotect="N";
				  else
						  $pwdprotect="Y";
					
				  if($_POST["cgisupport"]=="")
						{
						   $cgisupport="N";
						   $bcgi = False;
						}
				  else
						{
						   $cgisupport="Y";
						   $bcgi = True;
						}
					 
				  if($_POST["frontpageext"]=="")
						  $frontpageext="N";
				  else
						  $frontpageext="Y";
					 
					 
				  if($_POST["aspdotnetsupport"]=="")
						{	 
						  $aspdotnetsupport="N";
						  $bDotNet  = False;
						}
				  else
						{
						  $aspdotnetsupport="Y";
						  $bDotNet  = True;
						}
					 
				  if($_POST["webstart"]=="")
						  $webstart="N";
				  else
						  $webstart="Y";
						  
				 
				  //------------------------------------------------------------------------------------------
				  //Formatting the date to the MySql format
				  $dt=date("Y-m-d");
				  //------------------------------------------------------------------------------------------
				  
				  $query="insert into tbldomain(domainname,resellerid,ipaddress,domainlimits,hosting) values('$domainname',$reselid,'$ipaddress','0','Y')";
				  
				  mysql_query($query) or die(errorCatch(mysql_error()));

					//Getting the id of the domain-----------------------------------------------
					$query="select max(domainid) as domainid from tbldomain";
					$array=mysql_query($query) or die(errorCatch(mysql_error()));
					$domainset=mysql_fetch_array($array);
					$domainid=$domainset["domainid"];
					$newid = $domainid;
					//$_SESSION["domainid"]=$domainid;
					//$_SESSION["domainname"]=$domainname;

					//-----------------------------------------------------------
					$query="select * from tblserverip where id=$ipaddress";
					//echo "The query is " . $query;
					$iparray=mysql_query($query) or die(errorCatch(mysql_error()));
					$ipresult=@mysql_fetch_array($iparray);
					$ipadd=$ipresult["ipaddress"];
					mysql_free_result($iparray);	


				  $query="insert into tblloginmaster(username,typeid,usertype,regdate,skinname,status,password) values('$domainname',$domainid,'d','$dt','default','1','$password')";
				  //echo "The query is " . $query;
				  mysql_query($query) or die(errorCatch(mysql_error()));
				
				  //This function creates all the directories for the clients
				  //-----------------------------------------------------------
					CreateDomainDirs($domainname,$resellername);
					//Ashish changed the code to make the httpd.include dynamic
					SethttpsIncludeFile($resellername,$domainname,$ftpUser,$ipadd,$ftppassword);

					//SethttpsIncludeFile($resellername,$domainname,$ipadd,$cgi_sup,$webstart);
					//$varUser = SethttpsIncludeFile1($resellername,$domainname,$ftpUser,$ftppassword); 

					//echo "<br> the value returned is " . $varUser;
					if($varUser == "user problem")
						{
							RemoveDomainDirs($domainname,$resellername);
							$query = "delete from tblloginmaster where typeid=" . $domainid;
							mysql_query($query);

							$query = "delete from tbldomain where domainid=" . $domainid;
							mysql_query($query);
?>
							<script>
								alert("Sorry - The user can not be added.Use other username!")
								history.go(-1);
							</script>
<?
							die();
						}

				$homeDir = $sHostingDir."/".$resellername . "/" . $domainname;
				DomainFP($domainname,$homeDir,$ipadd,$ftpUser);

				//Making the DNS entries
				//--------------------------------------------------
				MakeDNSEntries($domainid,$domainname,$ipadd,$isWWW,$reselid);

				$query  = "Insert into tbldomaincontact(companyname,contactname,phone,email,address,city,state,zipcode,country,domainid) values('$companyname','$personalname','$phone','$email','$address','$city','$states','$zipcode','$country',$domainid)";
				@mysql_query($query) or die(errorCatch(mysql_error()));
				
				//Setting up the values for the domain
				//--------------------------------------------------
			//	$emailalias = -1;
			//	$popmailaccount = -1;

				//Creating the mail account o fthe user
				//--------------------------------------------------
				mkdir($maildomainpath.$domainname);
							
				$query="insert into mail_domain(domain, description, aliases, mailboxes, maxquota, created, modified,active) values('$domainname','$domainname','$emailalias','$popmailaccount',-1,NOW(),NOW(),1)";
				@mysql_query($query) or die(errorCatch(mysql_error()));

				$query = "insert into tblmaildomain (domainid, domainname, actiontype) values ($newid,'$domainname', 1)";
				@mysql_query($query) or die(errorCatch(mysql_error()));

				$query = "insert into tbldomainrights(domainid,popmailaccount,sqldatabase,pwdprotectdir,cgisupport,frontpageext,diskspace,webstart,emailalias,traffic,subdomains) values ($newid,$popmailaccount,$mysqldatabase,'$pwdprotect','$cgisupport','$frontpageext','$hdspace','$webstart','$emailalias','$traffic','$subdomains')";
				@mysql_query($query) or die(errorCatch(mysql_error()));	


				$query = "Insert into tbldomainpref values ($newid,'$pwdprotect','$cgisupport','$frontpageext','$aspdotnetsupport','$webstart')";
				@mysql_query($query) or die(errorCatch(mysql_error()));

				$query="insert into tblftpinfo(domainid,ftpusername,ftppassword,type,shellname,status) values($newid,'$ftpUser','$ftppassword','D','$shellname','1')";
				@mysql_query($query) or die(errorCatch(mysql_error()));

				addcronuser($domainid);
	?>
				<script>
				  alert("Domain successfully added");
				  window.location = "../domains/clientdomains.php";
				</script>
	<?
		}
							
	?>
