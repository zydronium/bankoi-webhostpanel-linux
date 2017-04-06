<?$ACCESS_LEVEL=3;?>
<?include "../inc/connection.php"?>
<?include "../inc/params.php"?>
<?include "../inc/functions.php"?>
<?include "../inc/security.php"?>
<html>

<?
	$domainid = $_SESSION["domainid"];
	$domainname = $_SESSION["domainname"];
	$resellername = $_SESSION["clientname"];

	$opt = $_POST["opt"];
	$size = $_POST["size"];
	$time = $_POST["time"];
	$numberoffiles = $_POST["numberoffiles"];
	$compressfiles = $_POST["compressfiles"];

	
	//echo "OPtion= " . $opt ."<br>";
	//echo "size= " . $size ."<br>";
	//echo "time= " . $time ."<br>";
	//echo "numberoffiles= " . $numberoffiles ."<br>";
	//echo "compressfiles= " . $compressfiles ."<br>";
	
	if(strtoupper($opt) == "S")
		{
			if($size == "" || $numberoffiles == "")
				{
?>
					<script>
						alert("The size for the log file is missing!.Please provide the value for the size \nor The number of log files is missing");
						history.go(-1);
					</script>
<?
					myLog("Log file creation denied because the size for the log file was not provided");
					die();
				}
		}

	//Here we are calling the function that creates the entries for the logrotate file
	//-----------------------------------------------------------------------------------

			CreateDomainLogFiles($resellername,$domainname,$size,$time,$compressfiles,$numberoffiles);
			
			$query = "select domainid from tbllogrotate where domainid='$domainid'";
			$check = mysql_query($query);
			if(mysql_num_rows($check) <= 0)
				{
					if($size != "")
						{
							$query = "insert into tbllogrotate (domainid,condition,files_no,condition_val,status,compressed) values('$domainid','size','$numberoffiles','$size','1','$compressfiles')";
							mysql_query($query);
						}
			
					if($time != "")
						{
							$query = "insert into tbllogrotate (domainid,condition,files_no,condition_val,status,compressed) values('$domainid','time','$numberoffiles','$time','1','$compressfiles')";
							mysql_query($query);
						}
				}
			else
				{
					if($size != "")
						{
							$query = "update tbllogrotate set condition='size', files_no='$numberoffiles', condition_val='$size', status='1', compressed='$compressfiles' where domainid = '$domainid'";
							mysql_query($query);
						}
			
					if($time != "")
						{
							$query = "update tbllogrotate set condition='time', files_no='$numberoffiles', condition_val='$time', status='1', compressed='$compressfiles' where domainid = '$domainid'";
							mysql_query($query);
						}
				}
			
?>
<script>
	alert("The log rotation enabled for the domain <?=$domainname?>");
	history.go(-1);
</script>