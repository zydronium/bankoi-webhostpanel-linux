<?$ACCESS_LEVEL=3;?>
<?include "../inc/connection.php"?>
<?include "../inc/params.php"?>
<?include "../inc/functions.php"?>
<?include "../inc/security.php"?>
<?include "../inc/constants.php"?>


<?
	//------------------SESSION VARIABLES------------------------------------------------------------
	$domainid=$_SESSION["domainid"];
	$domainname=$_SESSION["domainname"];
	$resellername=$_SESSION["clientname"];
	//-----------------------------------------------------------------------------------------------
	$query = "select frontpageext from tbldomainrights where domainid='$domainid'";
	$arrfp = mysql_query($query);
	$resultFp = mysql_fetch_array($arrfp);
	//echo $resultFp["frontpageext"];
	if(strtoupper($resultFp["frontpageext"])=="Y")
		{
	//------------------VARIABLES--------------------------------------------------------------------
		$fpsupport=$_POST["fp_support"];
		$fplogin1="";
		if($fpsupport!=1)
			$fpsupport=0;
		
		$fpsupportssl=$_POST["fp_support_ssl"];
		if($fpsupportssl!=1)
			$fpsupportssl=0;

		$fpauth=$_POST["fp_auth"];
		$fplogin=$_POST["fp_login"];
		$fplogin1=$_POST["fp_login1"];
		$fppassword=$_POST["fp_password"];

  		 
		 //myLog($fplogin1);
		 if(testForUniqueness("tbldomainfp","fplogin",$fplogin) || $fplogin1!="")
		 {
				
				 $query="select * from tbldomainfp where domainid='$domainid'";
				 $array=mysql_query($query); // or die(errorCatch(mysql_error()));
				 $totalid=mysql_num_rows($array);
				  
				  
				  if($totalid==0)
				  {
					  $query = "insert into tbldomainfp (domainid,fpsupport,fpsupportssl,fpauth,fplogin,fppassword) values ('".$domainid."','".$fpsupport."','".$fpsupportssl."','".$fpauth."','".$fplogin."','".$fppassword ."')";
					  @mysql_query($query) or die(errorCatch(mysql_error()));
					  
					  $homeDir = $sHostingDir."/".$resellername . "/" . $domainname . "/conf/" . $domainname . ".conf";
					  EnableFrontPageExt($domainname,$fplogin,$fppassword,$HomeDir);
				  }
				  else
				  {
					  $query = "update tbldomainfp set fpsupport='".$fpsupport."',fpsupportssl='".$fpsupportssl."',fpauth='".$fpauth."',fppassword='".$fppassword."' where domainid='".$domainid."'";
					  @mysql_query($query) or die(errorCatch(mysql_error()));
					  
					  $homeDir = $sHostingDir."/".$resellername . "/" . $domainname . "/conf/" . $domainname . ".conf";
					  DisableFrontPageExt($domainname,$HomeDir);
				  }
					
					?>
			 <script>
				alert("Front page installed for the selected domain!");
				window.location.replace("fplogin.php");
			 </script>
<?
			}
		 else 
			{
?>
			 <script>
				alert("The user name already exists");
				window.location.replace("fplogin.php?mode="+<?=$USERNAME_ALREADY?>);
			 </script> 
<?
			} 
		}
	else
		{
?>
			<center><font face="verdana" size="2" color="red">Sorry the front page support for this domain is disabled</font><br> <br>
			<input type="button" name="amit" class="commonbutton" value="Back" onClick=history.go(-1)></center>
<?
		}
?>