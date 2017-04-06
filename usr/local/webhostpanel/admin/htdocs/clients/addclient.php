<?$ACCESS_LEVEL=1;?>
<?include "../inc/connection.php"?>
<?include "../inc/params.php"?>
<?include "../inc/functions.php"?>
<?include "../inc/security.php"?>

<html>
<head>
<title>Add Client</title>
<link rel="stylesheet" type="text/css" href="/skins/default/css/general.css">
<link rel="stylesheet" type="text/css" href="/skins/default/css/custom.css">
<link rel="stylesheet" type="text/css" href="/skins/default/css/layout.css">
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=ISO-8859-1">
<META HTTP-EQUIV="EXPIRES" CONTENT="0">
</head>
<body leftmargin=0 topmargin=0 >

<?
  $pass=$_POST["passwd0"];
  //echo "The password is ".$pass;
  $loginname=$_POST["login"];
  $companyname=$_POST["cname"];
  $contactname=$_POST["pname"];
  $phone=$_POST["phone"];
  $fax=$_POST["fax"];
  $email=$_POST["email"];
  $address=$_POST["address"];
  $city=$_POST["city"];
  $state=$_POST["state"];
  $pcode=$_POST["pcode"];
  $country=$_POST["country"];
  $skinname=$_POST["locale_var"];

  //------------------------------------------------------------------
  //Here we are checking for the duplicate values for loginname
  $str="select count(*) as flag from tblloginmaster where tblloginmaster.username='$loginname'";
  $array=mysql_query($str) or die(errorCatch(mysql_error()));
  $result=mysql_fetch_array($array);
  if($result["flag"]>0)
  {
?>
			  <script>
				  alert("User with name <?=$loginname?> already exists! Use another name");
				  history.go(-1);
			  </script>
<?
				die();
  }
else
	{
  $query="select count(*) as flag from tblftpinfo where tblftpinfo.ftpusername='$loginname'";
  $array=mysql_query($query) or die(errorCatch(mysql_error()));
  $result=mysql_fetch_array($array);
  if($result["flag"]>0)
		{
?>
			  <script>
			  alert("User with name <?=$loginname?> already exists! Use another name");
			  history.go(-1);
			  </script>
<?
		}
  else
    {

	  $query="select count(*) as flag from manageusers where username='$loginname'";
	  $array=mysql_query($query) or die(errorCatch(mysql_error()));
	  $result=mysql_fetch_array($array);
      if($result["flag"]>0)
		{
?>
			  <script>
			  alert("User with name <?=$loginname?> already exists! Use another name");
			  history.go(-1);
			  </script>
<?
	    }
	else 
		{
		  //----------------------------------------------
		  $userName = $loginname;
		  $userPass = $pass;
		  $sFullName =$contactname;
		  $userDir = $sHostingDir . "/" . $userName;
		  $sUeserDesc = "Client:".$loginname;

		  //------------------------------------------------
		  if(!isClientFolderExists())
			{
				if(!mkdir($sHostingDir,0755))
					die("User do not have enough rights");
			}
		  //-------------------------------------------------
		  if(!CreateDir($userDir))
			  die("Unable to create the directory for the client");
	      //--------------------------------------------------
		  //Here we are adding the entry to the tblreseller
		  $query="insert into tblreseller(logo, supportlink,resellername)values('','','$loginname')";
		  @mysql_query($query);

		  @mysql_free_result($result);
		  $query="select max(resellerid) as getmaxid from tblreseller";
		  $array=@mysql_query($query);
		  $result=@mysql_fetch_array($array);
		  $reselid=$result["getmaxid"];
		  $regdate=date("Y-m-d");

		  //-----------------------------------------------------
		  //This is the entry in tblloginmaster 
		  $query="insert into tblloginmaster(username, password, usertype, status, regdate,typeid,skinname) values ('$loginname', '$pass', 'c', '1','$regdate',$reselid,'default')";
		  //myLog($query);
		  @mysql_query($query);
		  //-----------------------------------------------------
		  
		  //Here we are adding the entry to the tblcontactinfo
		  $query="insert into tblclientcontact(companyname, contactname, phone, email, address, city, state, zipcode, country, resellerid) values ('$companyname', '$contactname', '$phone','$email', '$address', '$city', '$state', '$pcode', '$country', $reselid)";
		  //myLog($query);
		  @mysql_query($query);
		 
		  //-----------------------------------------------------
		  $query = "Insert into tblclientrights values ($reselid,-1,-1,'Y','Y','Y','-1','-1','-1','-1')";
		  @mysql_query($query);	
		  //-----------------------------------------------------
		  //$shell="/bin/bash";
		  //$group="webhost";
		  //addFtpUser($loginname,$pass,$userDir,$shell,$group);

		  $query="select * from tbldnstemplate where resellerid='0'";
		  $DnsArray12=mysql_query($query) or die(errorCatch(mysql_error()));
		  
		  while($DNStemplateRecord = mysql_fetch_object($DnsArray12))
				{
					$DomainHost = $DNStemplateRecord->host;
					$RecordType = $DNStemplateRecord->recordtype;
					$value = $DNStemplateRecord->value;
					$querystr="Insert into tbldnstemplate set resellerid='$reselid',host='$DomainHost',recordtype='$RecordType',value='$value'";
					mysql_query($querystr) or die(errorCatch(mysql_error()));
				}
	  
?>   
		  <script>
		  alert("One client successfully added");
		  window.location.replace("../clients/clients.php");
		  </script>
<?
    }
  }
}
?>
</body>
</html>
