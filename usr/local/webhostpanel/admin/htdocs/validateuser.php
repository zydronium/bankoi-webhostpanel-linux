<?$ACCESS_LEVEL="3";?>
<?
include "inc/connection.php";
include "inc/constants.php";
include "inc/MyLogger.php";


$_SESSION["type"]="";
$userid= $_POST["login_name"];
$password = $_POST["passwd"];
$query = "select * from tblloginmaster where username='$userid' and  password='$password'";
//myLog($query);
$array=@mysql_query($query) or die(errorCatch(mysql_error()));
$result=mysql_fetch_array($array);
$num=@mysql_num_rows($array);
if($num<=0)
{
	//mysql_close($array);
	header("Location: login.php?mode=".$ACCESS_DENIED);
}
else
{	
	$userstatus = $result["status"];
	$usertype = $result["usertype"];
	
	myLog($usertype);
	myLog($ACCESS_ADMIN);

	if($userstatus == "1"){
		$_SESSION["userid"]=$userid;
		$_SESSION["usertype"] = $usertype;
		
		if ($usertype == $ACCESS_ADMIN)
			{	
	
			//<----------Here the type a is for the ADMINISTRATOR
				$_SESSION["adminid"]= $result["id"];
				$_SESSION["type"] = $usertype;
				$_SESSION["logoname"]=$LOGO_FILE;
				header("Location: ../clients/clients.php");
			}
//------------------------------------------------------------------------------------------------------------------
		else if($usertype == $ACCESS_CLIENT)		//<------Here the type 'c' is for Reseller/Client
			{		
				$_SESSION["clientid"] = $result["typeid"];
				$_SESSION["type"] = $usertype;
				$_SESSION["clientname"] =  $result["username"];
				$reselid=$result["typeid"];
				$query="select * from tblreseller where resellerid=$reselid";
				//myLog($query);
				$arrayclient=mysql_query($query) or die(errorCatch(mysql_error()));
				$clientdetails=mysql_fetch_object($arrayclient);

				$query="select * from tblloginmaster where typeid=$reselid and ucase(usertype)='C'";
				//myLog($query);
				$arrskin=mysql_query($query) or die(errorCatch(mysql_error()));
				$GetSkin=mysql_fetch_object($arrskin);

				if($GetSkin->skinname=="")
					{
						$_SESSION["skin"]="default";	
					}
				else
					{
						$_SESSION["skin"]=$GetSkin->skinname;
					}
						
				$logoname=$clientdetails->logo;
				//echo "the logoname is ". $logoname;
				if($logoname=="")
					$_SESSION["logoname"]=$LOGO_FILE;
				else
					$_SESSION["logoname"]="../logos/" . $logoname;

				mysql_free_result($arrayclient);
				header("Location: /domains/clientdomains.php");
			}
//-------------------------------------------------------------------------------------------------------------------
		else
			{
				$_SESSION["domain"] = $userid;
				$_SESSION["domainid"]=  $result["typeid"];
				$_SESSION["type"] = $usertype;
				$_SESSION["domainname"] =="";
				$_SESSION["domainname"] =  $result["username"];
				$domainid=$result["typeid"];
				$query="select resellerid from tbldomain where domainid=$domainid";
				//myLog($query);
				$client=mysql_query($query) or die(errorCatch(mysql_error()));
				$clientid=mysql_fetch_object($client);

				$reselid=$clientid->resellerid;
				//$_SESSION["clientid"] = $reselid;
				
				mysql_free_result($client);

				$query="select * from tblreseller where resellerid=$reselid";
				//myLog($query);
				$arrayclient=mysql_query($query) or die(errorCatch(mysql_error()));
				$clientdetails=mysql_fetch_object($arrayclient);

				$_SESSION["clientid"] = $reselid;
				$_SESSION["clientname"] =  $clientdetails->resellername;
				
				$query="select * from tblloginmaster where typeid=$reselid and ucase(usertype)='C'";
				//myLog($query);
				$arrskin=mysql_query($query) or die(errorCatch(mysql_error()));
				$GetSkin=mysql_fetch_object($arrskin);

				if($GetSkin->skinname=="")
					{
						$_SESSION["skin"]="default";	
					}
				else
					{
						$_SESSION["skin"]=$GetSkin->skinname;
					}
						
				$logoname1=$clientdetails->logo;
				//echo $logoname;
				if($logoname1=="")
					$_SESSION["logoname"]=$LOGO_FILE;
				else
					$_SESSION["logoname"]="../logos/" . $logoname1;

				mysql_free_result($arrayclient);
				header("Location: ../domains/showdomaindetails.php");
			}
	}
		else
			{
				header("Location: login.php?mode=".$BLOCKED);	
			}

}
?>
