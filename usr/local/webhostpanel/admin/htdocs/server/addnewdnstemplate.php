<?$ACCESS_LEVEL=1;?>
<?include "../inc/connection.php"?>
<?include "../inc/params.php"?>
<?include "../inc/functions.php"?>
<?include "../inc/security.php"?>

<?
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
	
	
	$ipadd = $_POST["ipaddr"];
		if(strlen($ipadd) == 0)
			{
				$ipadd = "<ip>";
			}


	switch ($RecordType):
    case "A":
				$host=$typeof . ".<domain>.";
				$val = $ipadd;
				$query="insert into tbldnstemplate set host='$host',recordtype='$RecordType',value='$val'";
				
				if(!mysql_query($query));
					
				break;
    case "NS":
				$host="<domain>.";
				if($_POST["dmnname"] == "")
					{
						$val=$ns . ".";
					}
				else
					{
						$val=$ns . ".<" . $_POST["dmnname"] . ">.";	//".<domain>.";
					}
				
				$query="insert into tbldnstemplate set host='$host',recordtype='$RecordType',value='$val'";
				
				if(!mysql_query($query));
					
				break;
	case "MX":
				if(strlen($_POST["exchangeval"]) == 0)
					{
						$Exch  = "mail." . "<domain>";
					}
				else
					{
						$Exch  = $_POST["exchangeval"];
					}
				$host="<domain>.";
				$record=$RecordType . "\t" . $mx;
				$val=$Exch . ".";
				$query="insert into tbldnstemplate set host='$host',recordtype='$record',value='$val'";
				
				if(!mysql_query($query));
					
				break;
	case "CNAME":
				if(strlen($_POST["cnameval"]) == 0)
					{
						$Exch  = "mail." . "<domain>";
					}
				else
					{
						$Exch  = $_POST["cnameval"];
					}
				$host= $cnametype . ".<domain>.";
				$val = $Exch . ".";
				$query="insert into tbldnstemplate set host='$host',recordtype='$RecordType',value='$val'";
				
				if(!mysql_query($query));
					
				break;
    default:
			
	endswitch;
?>
<script>
	alert("DNS entry successfully added to the template");
	window.location="dnsTemplate.php";
</script>