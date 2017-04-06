<?$ACCESS_LEVEL=2;?>
<?include "../inc/connection.php"?>
<?include "../inc/params.php"?>
<?include "../inc/functions.php"?>
<?include "../inc/security.php"?>

<?
	$resellername=$_SESSION["clientname"];
	$reselid=$_SESSION["clientid"];

	if(strlen($_POST["deldomain"])==0)
	{
?>
	<script>
		alert("No Domains to delete");
		window.location="../domains/clientdomains.php";
	</script>
<?
	die();}
	$deldomain=split(",",$_POST["deldomain"]);
	for($i=0; $i < count($deldomain)-1; $i++)
		{
			$domainid=$deldomain[$i];
			$query="select * from tbldomain where domainid=$domainid";
			//myLog($query);
			$array=mysql_query($query) or die(errorCatch(mysql_error()));
			$result=mysql_fetch_object($array);
			if(mysql_num_rows($array)!=0)
				{
					$domainname=$result->domainname;
					mysql_free_result($array);

					$userDir = $sHostingDir . "/" . $resellername . "/" . $domainname;
					//----------------------------------------------------------------------------------------------
						if(isFolderExists($userDir))
							{
								RemoveDomainDirs($domainname,$resellername);
							}
					//------------------------------------------------------------------------------------
						if(!DeleteHttpdEntry($resellername,$domainname))
							{
									myLog("Error during deleting the entry from the file /etc/httpd/conf/httpd.include");	
									die("Sorry due to some internal error the domain can not be deleted");
							}
					//------------------------------------------------------------------------------------

					// The function deletes the ftpuser from crontab
					DeleteCronUser($domainid);	

					//Getting the name of the ftp user for the domain
						$query="select * from tblftpinfo where domainid=$domainid";
						$FTParr=mysql_query($query) or die(errorCatch(mysql_error()));
						if(mysql_num_rows($FTParr)!=0)
							{
								$FTPuser=mysql_fetch_array($FTParr);
								$username=$FTPuser["ftpusername"];
								DelFTPUser($username);
							}
					//------------------------------------------------------------------------------------
					//This function deletes the DNS entry of the selected domain
					         DeleteDNS($domainname);
					//------------------------------------------------------------------------------------
					//This function deletes the Mail Directories of the selected domain
						$Path = $maildomainpath . "/" . $domainname;
						DeleteDomainMailDir($Path);
					//----------------------------------------------------------------------------------------------
					//This function deletes the logrotate files of the selected domain
						RemoveLogFiles($domainname);
					//----------------------------------------------------------------------------------------------
					//This function removes the domain's zone entry from the /etc/named.conf file
						DeleteNamedEntry($domainname);
					//----------------------------------------------------------------------------------------------
					//This function removes all the databses made by the domain on the server
						DeleteDomainDatabase($domainid);
					//----------------------------------------------------------------------------------------------
					//This function delets the mail directories of the selected domain
						$Path = $maildomainpath . "/" . $domainname;
						DeleteMailDir($Path);
//----------------------------------------------------------------------------------------------
					$query="delete from tblloginmaster where ucase(usertype)='D' and typeid=$domainid";
					//myLog($query);
					@mysql_query($query) or die(errorCatch(mysql_error()));

					$query="delete from tbldomainrights where domainid=$domainid";
					@mysql_query($query) or die(errorCatch(mysql_error()));

					$query="delete from tbldomain where domainid=$domainid";
					@mysql_query($query) or die(errorCatch(mysql_error()));

					$query="delete from tbldomaincontact where domainid=$domainid";
					@mysql_query($query) or die(errorCatch(mysql_error()));

					$query="delete from tbldomainpref where domainid=$domainid";
					@mysql_query($query) or die(errorCatch(mysql_error()));

					$query="delete from tblftpinfo where domainid=$domainid";
					@mysql_query($query) or die(errorCatch(mysql_error()));

					$query="delete from tblmaildomain where domainid=$domainid";
					@mysql_query($query) or die(errorCatch(mysql_error()));

					$query="delete from mail_domain where domain='$domainname'";
					@mysql_query($query) or die(errorCatch(mysql_error()));

					$query="delete from mail_alias where domain='$domainname'";
					@mysql_query($query) or die(errorCatch(mysql_error()));

					$query="delete from mail_mailbox where domain='$domainname'";
					@mysql_query($query) or die(errorCatch(mysql_error()));

					$query="delete from tbldatabase where domainid='$domainid'";
					@mysql_query($query) or die(errorCatch(mysql_error()));

					$query="delete from tbldirpass where domainname='$domainname'";
					@mysql_query($query) or die(errorCatch(mysql_error()));

					$query="delete from tbldnsdomain where domainid='$domainid'";
					@mysql_query($query) or die(errorCatch(mysql_error()));

					$query="delete from tbldomainfp where domainid='$domainid'";
					@mysql_query($query) or die(errorCatch(mysql_error()));

					$query="delete from tbldnsdomain where domainid='$domainid'";
					@mysql_query($query) or die(errorCatch(mysql_error()));

					$query="delete from tblcron where domainid='$domainid'";
					@mysql_query($query) or die(errorCatch(mysql_error()));

					$query="delete from tbllogrotate where domainid='$domainid'";
					@mysql_query($query) or die(errorCatch(mysql_error()));

					$query="delete from tblsubdomain where domainid='$domainid'";
					@mysql_query($query) or die(errorCatch(mysql_error()));
				}//End of if condition
		}//End of for loop
?>
<SCRIPT>
	alert("Domains successfully deleted");
	window.location="../domains/clientdomains.php";
</SCRIPT>
