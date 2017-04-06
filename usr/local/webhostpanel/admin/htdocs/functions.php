<?
	//--------------------------------------------------------------------------------------------------------------
	//Function to create Directory
	function CreateDir($FolderName)
	{
		$sPath=$FolderName;
		//echo "The path is ".$sPath;
		if(mkdir($sPath, 0700))
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	//--------------------------------------------------------------------------------------------------------------	
	//Function to check whether the /usr/client filder exists or not
	Function isClientFolderExists()
	{
		global $sHostingDir;
		if(is_dir($sHostingDir))
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	//--------------------------------------------------------------------------------------------------------------
	//Function to delete Directory
	function DeleteDir($FolderName)
	{
		$sPath=$FolderName;
		///echo "The path is ".$sPath;
		if(system("rm -rf " . $sPath)!="FALSE")
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	//--------------------------------------------------------------------------------------------------------------	
	//Function to check whether the /usr/client filder exists or not
	Function isFolderExists($folder)
	{
		if(is_dir($folder))
		{
		return true;
		}
		else
		{
		return false;
		}
	}

	//--------------------------------------------------------------------------------------------------------------
	//This function creates all the needed directories for the domain
	function CreateDomainDirs($domainname,$clientname)
	{
		global $sHostingDir;
		$clientPath=$sHostingDir."/".$clientname;

		//Creating the path for various folders to be created
		//---------------------------------------------------
		$DomainPath=$clientPath."/".$domainname;
		$cgibin=$DomainPath . "/cgi-bin";
		$conf=$DomainPath . "/conf";
		$errordocs=$DomainPath . "/error_docs";
		$httpdocs=$DomainPath . "/httpdocs";
		$httpsdocs=$DomainPath . "/httpsdocs";
		$pd=$DomainPath . "/pd";
		$statistics=$DomainPath . "/statistics";
		$logs=$statistics . "/logs";
		$webstat=$statistics . "/webstat";
		$webstatssl=$statistics . "/webstat-ssl";
		$ftpstat=$statistics . "/ftpstat";
		$web_users=$DomainPath . "/web_users";
		$mailDir="/var/virtual/maildomains/".$domainname;

		//Now we create the directories here
		//----------------------------------
		@mkdir($DomainPath);
		@mkdir($cgibin);
		@mkdir($conf);
		@mkdir($errordocs);
		@mkdir($httpdocs);
		@mkdir($httpsdocs);
		@mkdir($pd);
		@mkdir($statistics);
		@mkdir($logs);
		@mkdir($webstat);
		@mkdir($webstatssl);
		@mkdir($ftpstat);
		@mkdir($mailDir,0755);
		@mkdir($web_users);
		@chmod($mailDir,0755);
		@chown($mailDir,"postfix");
		@chgrp($mailDir,"postfix");
	}
	//--------------------------------------------------------------------------------------------------------------
	//This function creates all the needed directories for the domain
	function RemoveDomainDirs($domainname,$clientname)
	{
		global $sHostingDir;
		$clientPath=$sHostingDir."/".$clientname;

		//Creating the path for various folders to be created
		//---------------------------------------------------
		$DomainPath=$clientPath."/".$domainname;
		system("rm -rf " . $DomainPath);
	}//End of the function


	//--------------------------------------------------------------------------------------------------------------
	//This function gets the name of all the skins from the directory "skins"
	function GetSkins()
	{
	  global $sCpHomeDir;
	  $filesArr="";
	  $dirPath=$sCpHomeDir . "/admin/htdocs/skins/";
	  if ($handle = opendir($dirPath)) 
		{
          while (false !== ($file = readdir($handle))) 
			{
			  if ($file != "." && $file != ".." && is_dir($dirPath .$file))
					{   
								if($filesArr=="")
								{
									$filesArr = trim($file);
								}
								else
								{
									$filesArr = $filesArr. "," . trim($file);
								}
					}				
			}
          closedir($handle);
		}  
      return $filesArr;     
   }//End of the function
   

    //--------------------------------------------------------------------------------------------------------------
	//Function which sets the HTTPD.INCLUDE file to the conf folder for the domain
	function SethttpsIncludeFile($clientname,$domainname,$ftpusername,$IPaddress,$Password)
	{
		global $sCpHomeDir;
		global $sHostingDir;

		$dirPath=$sCpHomeDir . "/admin/htdocs/";
		$clientPath=$sHostingDir."/".$clientname;
		$DomainConfPath=$clientPath."/".$domainname . "/conf/";
		$SetPathinHttpdInclude="/home/clients/".$clientname;

		// Get a file into an array.
		$lines = file ($dirPath . "httpd.include");
		
		$httpdinclude="";

		// Loop through our array, show html source as html source; and line numbers too.
		foreach ($lines as $line_num => $line) 
				{
					$httpdinclude= $httpdinclude . $line;
				}
		
		$wwwdomainname="www." . $domainname;
		$httpdinclude=str_replace ("/home/httpd/vhosts", $SetPathinHttpdInclude, $httpdinclude);
		$httpdinclude=str_replace ("www.fotolab30.com", $wwwdomainname, $httpdinclude);
		$httpdinclude=str_replace ("fotolab30.com", $domainname, $httpdinclude);
		$httpdinclude=str_replace ("fotolab30", $ftpusername, $httpdinclude);
		$httpdinclude=str_replace ("217.76.147.5", $IPaddress, $httpdinclude);
		
		if (!$handle = fopen($DomainConfPath. "httpd.include", 'w')) 
			{
				print "Cannot open file (\"httpd.include\")";
				return false;
			}

		// Write the string to our opened file.
		if (!fwrite($handle, $httpdinclude)) 
			{
				print "Cannot write to file (\"httpd.include\")";
				return false;
			}
		fclose($handle);

		//***********************************************************************************
		//The above file created is placed in the conf folder of the domain folder
		//and then this file is included in the file /etc/httpd/conf/httpd.include
		//and then this file /etc/httpd/conf/httpd.include is included in the APACHE
		//httpd.conf file of the APACHE where the sites are hosted
		//The entry to the main APACHE file is done once.The repeted entries are
		//added to the file named /etc/httpd/conf/httpd.include.And u r done.
		//***********************************************************************************
		
		//This puts an entry to the httpd.include file of the apache
		//Include /etc/httpd/conf/httpd.include
		//---------------------------------------------------------------------------
		$httpdincludepath="/etc/httpd/conf/";
		if (!$handle = fopen($httpdincludepath. "httpd.include", 'a')) 
			{
				print "Cannot open file (\"httpd.include\")";
				return false;
			}

		if (!fwrite($handle, "Include " . $DomainConfPath . "httpd.include \n")) 
			{
				print "Cannot write to file (\"httpd.include\")";
				return false;
			}
		fclose($handle);

		//here we are creating the user
		//$CreateUsr="useradd -d " . $clientPath . "/" . $domainname . " -g webhost -s /bin/false -p" . //$Password . " " . $ftpusername;
		//echo $CreateUsr;
		//system($CreateUsr);

		//These are the folders on which the doain will have the rights
		//------------------------------------------------------------------------------------------------
		$DomainPath=$clientPath."/".$domainname;		
		$cgibin=$DomainPath . "/cgi-bin";
		$httpdocs=$DomainPath . "/httpdocs";
		$httpsdocs=$DomainPath . "/httpsdocs";
		$web_users=$DomainPath . "/web_users";

		//Now we give rights to domain folder

		$GrantRights="chmod 755 -R " . $httpdocs;
		//echo "The o/p of sys cmd " . system($GrantRights) . "\n";
		if(system($GrantRights)=="FALSE")
			{
				echo "Rights not set for the domain to the domain folder line no 346";
				return false;
			}

		$GrantRights="chmod 755 -R " . $httpsdocs;
		if(system($GrantRights)=="FALSE")
			{
				echo "Rights not set for the domain to the domain folder line no 353";
				return false;
			}

		$GrantRights="chmod 755 -R " . $web_users;
		if(system($GrantRights)=="FALSE")
			{
				echo "Rights not set for the domain to the domain folder line no 360";
				return false;
			}

		$GrantRights="chmod 755 -R " . $cgibin;
		if(system($GrantRights)=="FALSE")
			{
				echo "Rights not set for the domain to the domain folder line no 367";
				return false;
			}
		//------------------------------------------------------------------------------------------------

		if(!addFtpUser($ftpusername,$Password,$clientPath . "/" . $domainname,"/bin/bash","webhost"))
			{
				echo "Ftp user not created line no 374";
				return false;
			}

		//*****************************************************************************************
		//Now we copy the domain files to httpdocs folder for the domain
		copy("../newdomfiles/undercons.gif",$clientPath."/".$domainname . "/httpdocs/undercons.gif");
		$lines = file ("../newdomfiles/index.htm",$clientPath."/".$domainname . "/httpdocs/");
		
		$httpdinclude="";

		// Loop through our array, show html source as html source; and line numbers too.
		foreach ($lines as $line_num => $line) 
				{
					$httpdinclude= $httpdinclude . $line;
				}
		
		$httpdinclude=str_replace ("{domain}", $domainname, $httpdinclude);
		
		if (!$handle = fopen($clientPath."/".$domainname . "/httpdocs/index.htm", 'w')) 
			{
				echo "Cannot open file (\"index.htm\") line no 395";
				return false;
			}

		// Write $somecontent to our opened file.
		if (!fwrite($handle, $httpdinclude)) 
			{
				echo "Cannot write to file (\"index.htm\") line no 402";
				return false;
			}
		fclose($handle);

		
		//*****************************************************************************************
		//Now we copy the domain files to httpsdocs folder for the domain
		copy("../newdomfiles/undercons.gif",$clientPath."/".$domainname . "/httpsdocs/undercons.gif");

		$lines = file ("../newdomfiles/index.htm",$clientPath."/".$domainname . "/httpsdocs/");
		
		$httpdinclude="";

		// Loop through our array, show html source as html source; and line numbers too.
		foreach ($lines as $line_num => $line) 
				{
					$httpdinclude= $httpdinclude . $line;
				}
		
		$httpdinclude=str_replace ("{domain}", $domainname, $httpdinclude);
		
		if (!$handle = fopen($clientPath."/".$domainname . "/httpsdocs/index.htm", 'w')) 
			{
				echo "Cannot open file (\"index.htm\") line no 426";
				return false;
			}

		// Write $somecontent to our opened file.
		if (!fwrite($handle, $httpdinclude)) 
			{
				echo "Cannot write to file (\"index.htm\") line no 433";
				return false;
			}
		fclose($handle);
		//*****************************************************************************************

		//Now we are restarting the apache so that we may see the new domain site running
		if(system("/etc/init\.d/httpd restart")=="FALSE")
			{
				echo "<center>Problems restarting the APACHE server.Contact administrator</center>";
				echo "<br><center>You must restart APACHE so the site may run...</center>";
			}
	}//End of the function




	//--------------------------------------------------------------------------------------------------------------
    //This function makes the DNS entries for the particular domain

	Function MakeDNSEntries($DomainId,$DimainName,$IPAddress,$isWWW)
		{
			//echo "<br>domain id in dns " . $DomainId;
			//echo "<br>domainname id in dns " . $DimainName;
			//echo "<br>domainip id in dns " . $IPAddress;
			$mainStr="";
			$StrToFile="";
			$query="select * from tbldnstemplate";
			myLog($query);
			$DnsArray=mysql_query($query) or die(errorCatch(mysql_error()));
			$num=mysql_num_rows($DnsArray);
			if($num==0)
				{
					echo "Sorry there is no DNS template to create";
					return false;
				}
			else
				{
					$mainStr=htmlspecialchars("\$TTL    86400") . "\n\n";
					$mainStr .= htmlspecialchars("@	IN	SOA	ns.") . $DimainName . htmlspecialchars(". admin.linuxcp.com. (" . "\n1066802227; \n30; \n	10800; \n604800;\n	86400 );\n");

					while($DNStemplateRecord=mysql_fetch_object($DnsArray))
							{
								$DomainHost=htmlspecialchars($DNStemplateRecord->host);
								$DomainHost=(str_replace (htmlspecialchars("<domain>"), $DimainName, $DomainHost));
								$DomainHost=(str_replace (htmlspecialchars("<ip>"), $IPAddress, $DomainHost));

								$RecordType=htmlspecialchars($DNStemplateRecord->recordtype);

								$value=htmlspecialchars($DNStemplateRecord->value);
								$value=str_replace (htmlspecialchars("<domain>"), $DimainName, $value);
								$value=str_replace (htmlspecialchars("<ip>"), $IPAddress, $value);

								$querystr="Insert into tbldnsdomain set domainid='$DomainId',host='$DomainHost',recordtype='$RecordType',value='$value'";
								myLog($query);
								mysql_query($querystr) or die(errorCatch(mysql_error()));
								
								$StrToFile .= htmlspecialchars($DomainHost);
								$StrToFile .= "\t" ."IN"."\t" . htmlspecialchars($RecordType);
								$StrToFile .= "\t" . htmlspecialchars($value) . "\n";

								$mainStr .= htmlspecialchars($StrToFile);
								$StrToFile="";

							}

					$StrToFile="";
					if($isWWW)
						{
							$StrToFile .= "www." . htmlspecialchars($DimainName) . ".";
							$StrToFile .= "\t IN \t" . "CNAME";
							$StrToFile .= "\t" . htmlspecialchars($DimainName) . ".\n";
							$mainStr .= htmlspecialchars($StrToFile);
						}
					

					if (!$handle = fopen("/var/named/" . $DimainName .".dns", 'w')) 
						{
							echo "Cannot create file ($DimainName .\"dns\") line no 509";
							return false;
						}

					
					if (!fwrite($handle, htmlspecialchars($mainStr))) 
						{
							echo "Cannot write to file ($DimainName .\"dns\") line no 516";
							return false;
						}
					fclose($handle);


					if (!$handle = fopen("/etc/named.conf", 'a')) 
						{
							echo "Cannot Write to file /etc/named.conf line no 524";
							return false;
						}

					$StrToFile="";
					$StrToFile="\n zone \"".htmlspecialchars($DimainName)."\" { type master; file \"/var/named/".htmlspecialchars($DimainName).".dns\"; };";
					if (!fwrite($handle, $StrToFile)) 
						{
							echo "Cannot write to file /etc/named.conf line no 532";
							return false;
						}
					fclose($handle);
				}
			return True;				
		}//End of function

	//--------------------------------------------------------------------------------------------------------------


   //--------------------------------------------------------------------------------------------------------------
   // Function for creating ftp user

   function addFtpUser($ftpusername,$password,$home,$shell,$group)
		{
			$password=crypt($password,"\$1\$9");	
			//$CreateUsr="useradd -d " .$home." -g ".$group." -s ".$shell." -p" . $password . " " . $ftpusername;
			//echo $password . "<br>" . addslashes($password) . "<br>". $CreateUsr;
			
			if(system("useradd -d " .$home." -g ".$group." -s ".$shell." -p'" . $password . "' " . $ftpusername)=="FALSE")
				{
					echo "Problems creating FTP user for " . $ftpusername . " line no 554";
					return false;
				}
			elseif(system("chown ".$ftpusername." $home")=="FALSE")
				{
					echo "Problems giving the permissions to FTP user " . $ftpusername . " line no 559";
					return false;
				}
			return true;
		}

   //--------------------------------------------------------------------------------------------------------------
   // Function to block ftp user;

		function blockFtpUser($ftpusername)
		{		
			if (!$handle = fopen("/etc/ftpusers", 'a')) 
					{
						echo "Cannot open file (\"httpd.include\") line no 572";
						return false;
					}

			// Write $somecontent to our opened file.
			if (!fwrite($handle, $ftpusername)) 
					{
						echo "Cannot write to file (\"httpd.include\") line no 579";
						return false;
					}
			fclose($handle);	
			return true;
		}//End Function

   //--------------------------------------------------------------------------------------------------------------
   // UnBlock FTP users

		function unblockFtpUser($ftpusername)
			{		
				$lines = file ("/etc/ftpusers");
				$ftpuserfile="";

				foreach ($lines as $line_num => $line) 
					{
						$ftpuserfile= $ftpuserfile . $line;
					}

				$ftpuserfile=str_replace ($ftpusername,"", $ftpuserfile);

				if (!$handle = fopen("/etc/ftpusers", 'w')) 
					{
						echo "Cannot open file (\"ftpusers\") line no 603";
						return false;
					}
			
				// Write $somecontent to our opened file.
				if (!fwrite($handle, $ftpuserfile)) 
					{
						echo "Cannot write to file (\"ftpusers\") line no 610";
						return false;
					}
				fclose($handle);
			}//End of function

	//--------------------------------------------------------------------------------------------------------------
	//This function gets the name of all the directories from the domain directory
	function GetDirs($sPath)
	{
	  $filesArr="";
	  //echo $sPath;
	  if ($handle = @opendir($sPath)) 
			{
				 while (false !== ($file = readdir($handle))) 
						{
							if ($file != "." && $file != ".." && is_dir($sPath .$file))
									{   
										if($filesArr=="")
											{
												$filesArr = trim($file);
											}
										else
											{
												$filesArr = $filesArr. "," . trim($file);
											}
									}				
						}
				closedir($handle);
			}
		else
			{
				$filesArr="";
				//closedir($handle);
			}
      return $filesArr;     
   }//End of the function

   //--------------------------------------------------------------------------------------------------------------

	//Function to put a password on the folder
	function PwdProtectDir($home,$username1,$passwd1,$DirName,$DomainName)
		{
			global $sCpHomeDir;
			global $sHostingDir;
			$FileStr="";
			$username=split(",",$username1);
			$passwd=split(",",$passwd1);

			$FileStr .= "<Directory " . $home . $DirName . ">" . "\n";
			$FileStr .= "options Indexes FollowSymlinks None" . "\n";
			$FileStr .= "AuthUserFile " . $home . "/pd/.htpasswd" . "\n";
			$FileStr .= "AuthGroupFile /dev/null" . "\n";
			$FileStr .= "AuthName " . $DomainName;
			$FileStr .= "\nAuthType Basic"; 
			$FileStr .= "<Limit GET POST PUT>" . "\n"; 
			for($i=0; $i<count($username);$i++)
					$FileStr .= "require user " . $username[$i] . "\n";
			echo $home;
			$FileStr .= "</Limit>"; 
			$FileStr .= "</Directory>";

			if(strlen($username1)==0)
				{
					myLog("The directory can not be password protected");
					myLog("The directory name is " . $DirName);
					myLog("The Domain name is " . $DomainName);
					return false;
				}
			else
				{
					$DomainConfPath=$home . "/conf/httpd.include";
					if (!$handle = fopen($DomainConfPath, 'a')) 
						{
								myLog("Cannot open file " . $DomainConfPath . " line no 685");
								return false;
						}
					if (!fwrite($handle, $FileStr)) 
						{
								myLog("Cannot write to file line no 690");
								return false;
						}
					fclose($handle);
				
					for($i=0; $i<count($username);$i++)
						{
							myLog("htpasswd -cbd " . $home . "/pd/.htpasswd " . $username[$i] . " " .$passwd[$i]);
							system("htpasswd -cbd " . $home . "/pd/.htpasswd " . $username[$i] . " " .$passwd[$i]);
						}
					return true;
				}			
		}





//-------------------------------------------------------------------------------------------------
	//New Function error catching
	Function errorCatch($errorMesg)
		{
			myLog($errorMesg);
			$_SESSION['errorMesg']=$errorMesg;
			?>
		 <script>
		 	 window.location.replace("../redirect.php");
		 </script>
			<?
			//header("Location: ../redirect.php");
		}//End of the function


//------------------------------------------------------------------------------------------------
	//Function to check whether  the database exists or not
	
	function IsExistsDB($dbname)
		{
			$query="create database " . $dbname;
			myLog($query);
			if(!mysql_query($query))
				{
					myLog(mysql_error());
					$err_num = mysql_errno();
					if($err_num==1007)
						{
							return false;
						}
				}
			return true;
		}


//--------------------------------------------------------------------------
	//Function to check whether  the user to a particular Db exists or not
	
	function IsUser($dbname,$username)
		{
			mysql_select_db("mysql");
			$query="SELECT User, Host,db FROM mysql.db ORDER BY User";
			if($mysqlresult=mysql_query($query))
				{
					while($fetch=mysql_fetch_array($mysqlresult))
						{
							if($fetch["User"]==$username && $fetch["db"] == $dbname)
								{
									echo "got u";
									return false;
								}
								//echo $fetch["User"];
						}
				}
			else
				{
					return false;
				}
			@mysql_select_db("webhostpanel");
			return true;
		}
//--------------------------------------------------------------------------
	//Function to delete the database
	function DeleteDatabase($dbname,$username)
		{
			$query="delete FROM mysql.db where Db='$dbname' and User='$username'";
			if(mysql_query($query))
				{	
					$query="delete FROM mysql.user where User='$username'";
						if(mysql_query($query))
							{
								$query="drop database " . $dbname;
								mysql_query($query);
								return true;
							}
						else
							{
								return false;
							}
				}
			else
					return false;
		}

//--------------------------------------------------------------------------
	//Function to test the table for uniqueness

	function testForUniqueness($tblname,$fieldname,$value)
		{

			$query = "select * from ".$tblname." where ".$fieldname."='".$value."'";
			myLog($query);
			$array=@mysql_query($query) or die(errorCatch(mysql_error()));
			
		 $totalid=mysql_num_rows($array);
		  if(!$totalid==0)
			return true;
		  else
			return true;
		}

//-------------------------------------------------------------------------------------------
	//Function to delete the entry of the domain from the "/etc/httpd/conf/httpd.include" file

	Function DeleteHttpdEntry($clientname,$domainname)
		{
			global $sHostingDir;
			$sEntry="Include " . $sHostingDir . "/" . $clientname . "/" . $domainname . "/conf/httpd.include";
			$lines = file ("/etc/httpd/conf/httpd.include");
				$ftpuserfile="";

				foreach ($lines as $line_num => $line) 
					{
						$ftpuserfile= $ftpuserfile . $line;
					}

				$ftpuserfile=str_replace ($sEntry,"", $ftpuserfile);

				if (!$handle = fopen("/etc/httpd/conf/httpd.include", 'w')) 
					{
						echo "Cannot open file (\"httpd.include\") line no 603";
						return false;
					}
			
				// Write $somecontent to our opened file.
				if (!fwrite($handle, $ftpuserfile)) 
					{
						echo "Cannot write to file (\"httpd.include\") line no 610";
						return false;
					}
				fclose($handle);
				return true;
		}//End of the function



//-------------------------------------------------------------------------------------------
//Function to delete the FTP user of the domain

	Function DelFTPUser($Username)
		{
			system("userdel -r " .$username);
		}


//-------------------------------------------------------------------------------------------
//Function to delete the DNS entries

	Function DeleteDNS($Domainname)
		{
			@unlink ("/var/named/" . $Domainname . ".dns");

			global $sHostingDir;
			$sEntry="zone \"" . $Domainname ."\" { type master; file \" /var/named/" . $Domainname . ".dns; };";
			$lines = file ("/etc/httpd/conf/httpd.include");
				$ftpuserfile="";

				foreach ($lines as $line_num => $line) 
					{
						$ftpuserfile= $ftpuserfile . $line;
					}

				$ftpuserfile=str_replace ($sEntry,"", $ftpuserfile);

				if (!$handle = fopen("/etc/named.conf", 'w')) 
					{
						echo "Cannot open file (\"httpd.include\") line no 603";
						return false;
					}
			
				// Write $somecontent to our opened file.
				if (!fwrite($handle, $ftpuserfile)) 
					{
						echo "Cannot write to file (\"httpd.include\") line no 610";
						return false;
					}
				fclose($handle);
				return true;

		}

?>

