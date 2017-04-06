<?$ACCESS_LEVEL=2;?>
<?include "../inc/connection.php"?>
<?include "../inc/params.php"?>
<?include "../inc/functions.php"?>
<?include "../inc/security.php"?>


<?
	//------------------SESSION VARIABLES------------------------------------------------------------
	$reselid=$_SESSION["clientid"];
	$resellername=$_SESSION["clientname"];
	$domainname=$_SESSION["domainname"];
	$newid = $_SESSION["domainid"];
	$domainid = $newid;
	//-----------------------------------------------------------------------------------------------
	if(!isset($domainname) || strlen($domainname)==0 || strlen($reselid)==0)
		{
			echo "There are errors creating domain.Contact your administrator because your session has expired.";
?>
			<script>
					window.location'../clients/clients.php';
			</script>
<?
			die();
		}
	//-----------------------------------------------------------------------------------------------

	//------------------VARIABLES--------------------------------------------------------------------
	
	$popmailaccount = $_POST["popmailaccount"];
	$mysqldatabase = $_POST["mysqldatabase"];
	$emailalias = $_POST["emailalias"];
	$shellname = $_POST["shellname"];
	$hdspace = $_POST["hdspace"];
	$personalname = $_POST["personalname"];
	$companyname = $_POST["companyname"];
	$email = $_POST["email"];
	$phone = $_POST["phone"];
	$address = $_POST["address"];
	$city = $_POST["city"];
	$state = $_POST["state"];
	$zipcode = $_POST["zipcode"];
	$country = $_POST["country"];
	$traffic = $_POST["traffic"];
	$subdomains = $_POST["subdomains"];


	$query = "select count(username) as SubDomains from tblsubdomain where domainid = '$newid'";
	$exusedSubdomains = @mysql_query($query);
	$rsusedSubdomains = @mysql_fetch_array($exusedSubdomains);
	$domainUsedSubDomains = $rsusedSubdomains["SubDomains"];


	if($domainUsedSubDomains > $subdomains)
		{
	?>
				<script>
					alert("Domain has got " + "<?=$domainUsedSubDomains?>" + " subdomains and you have assigned a number less than that!!!\nPlease assign number greater then equal to " + "<?=$domainUsedSubDomains?>");
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

	$query="select count(domainid) as cntdomain from tbldomain where tbldomain.resellerid='$reselid' and domainid!=$newid";
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

//-----------------------------------------------------------------------------------------
//Checking whether the clients limits are not exceeding the stipulated limits
//echo "The ftpusers are ".$Apopmailaccount;

if(! $Apopmailaccount==-1)
	{
				if($Apopmailaccount < $Tpopmailaccount)
					{
?>
			<script>
				alert("Sorry client do not have enough Popmail Accounts");
				history.go(-1);
			</script>
<?
					die();}
	}

if(! $Aemailalias==-1)
	{
				if( $Aemailalias < $Temailalias)
					{
?>
			<script>
				alert("Sorry client do not have enough Email Alias Account");
				history.go(-1);
			</script>
<?
					die();}
	}
if(! $Adatabase==-1)
	{
				if($Adatabase < $Tdatabase)
					{
?>
			<script>
				alert("Sorry client do not have enough Database Accounts");
				history.go(-1);
			</script>
<?	
					die();}
	}

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
					$dateofcre=date("Y-m-d");
					//------------------------------------------------------------------------------------------
					$query="select * from tblftpinfo where domainid='$newid'";
					$FTParray=mysql_query($query) or die(errorCatch(mysql_error()));
					$FTPres=mysql_fetch_array($FTParray);
					$Username=$FTPres["ftpusername"];
					//The function changes the current working shell for the domain
							
							ChangeShell($Username,$shellname);
					//------------------------------------------------------------------------------------------
					$query = "update  tbldomainrights set popmailaccount=$popmailaccount,sqldatabase=$mysqldatabase,pwdprotectdir='$pwdprotect',cgisupport='$cgisupport',frontpageext='$frontpageext',diskspace='$hdspace',webstart='$webstart',emailalias='$emailalias',traffic='$traffic', subdomains='$subdomains' where domainid=$newid";
					//myLog($query);
					@mysql_query($query) or die(errorCatch(mysql_error()));	

					$query="update tbldomaincontact set companyname='$companyname',contactname='$personalname',phone='$phone',email='$email',address='$address',city='$city',state='$state',zipcode='$zipcode',country='$country'  where domainid='$newid'";
					//myLog($query);
					@mysql_query($query) or die(errorCatch(mysql_error()));
			

					$query = "update tbldomainpref set pwdprotect='$pwdprotect',cgisupport='$cgisupport',frontpageext='$frontpageext',traffic='$traffic',webstart='$webstart' where domainid='$newid'";
					//myLog($query);
					@mysql_query($query) or die(errorCatch(mysql_error()));

					$query="update tblftpinfo set shellname='$shellname' where domainid='$newid'";
					//myLog($query);
					@mysql_query($query) or die(errorCatch(mysql_error()));

					$query="update mail_domain set aliases ='$emailalias', mailboxes = '$popmailaccount' where domain='$domainname'";
					@mysql_query($query) or die(errorCatch(mysql_error()));
?>
<script>
  alert("Domain successfully updated")
  window.location.replace("showdomaindetails.php");
</script>
