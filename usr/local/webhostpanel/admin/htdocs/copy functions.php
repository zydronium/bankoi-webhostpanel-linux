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
		echo "The path is ".$sPath;
		if(rmdir($sPath))
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
		@mkdir($mailDir,0700);
		@mkdir($web_users);
		@chmod($mailDir,0700);
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

		//Now we create the directories here
		//------------------------------------------------------------------------------------------------------
		
		//system("cd " . $cgibin);
		//system("rm *");
		@unlink($cgibin . "/*.*");
		@unlink($cgibin . "/*");
		rmdir($cgibin);

		//------------------------------------------------------------------------------------------------------
		//system("cd " . $conf);
		//system("rm *");
		@unlink($conf . "/*.*");
		@unlink($conf . "/*");
		@unlink($conf . "/httpd.include");
		rmdir($conf);

		//------------------------------------------------------------------------------------------------------
		//system("cd " . $errordocs);
		//system("rm *");
		@unlink($errordocs . "/*.*");
		@unlink($errordocs . "/*");
		@rmdir($errordocs);

		//------------------------------------------------------------------------------------------------------
		//system("cd " . $web_users);
		//system("rm *");
		@unlink($web_users . "/*.*");
		@unlink($web_users . "/*");
		@rmdir($web_users);

		//------------------------------------------------------------------------------------------------------
		//system("cd " . $httpdocs);
		//system("rm *");
		@unlink($httpdocs . "/*.*");
		@unlink($httpdocs . "/*");
		@rmdir($httpdocs);

		//------------------------------------------------------------------------------------------------------
		//system("cd " . $httpsdocs);
		//system("rm *");
		@unlink($httpsdocs . "/*.*");
		@unlink($httpsdocs . "/*");
		@rmdir($httpsdocs);

		//------------------------------------------------------------------------------------------------------
		//system("cd " . $pd);
		//system("rm *");
		@unlink($pd . "/*.*");
		@unlink($pd . "/*");
		@rmdir($pd);

		//------------------------------------------------------------------------------------------------------
		//system("cd " . $logs);
		//system("rm *");
		@unlink($logs . "/*.*");
		@unlink($logs . "/*");
		@rmdir($logs);

		//------------------------------------------------------------------------------------------------------
		//system("cd " . $webstat);
		//system("rm *");
		@unlink($webstat . "/*.*");
		@unlink($webstat . "/*");
		@rmdir($webstat);

		//------------------------------------------------------------------------------------------------------
		//system("cd " . $webstatssl);
		//system("rm *");
		@unlink($webstatssl . "/*.*");
		@unlink($webstatssl . "/*");
		@rmdir($webstatssl);

		//------------------------------------------------------------------------------------------------------
		//system("cd " . $ftpstat);
		//system("rm *");
		@unlink($ftpstat . "/*.*");
		@unlink($ftpstat . "/*");
		@rmdir($ftpstat);

		//------------------------------------------------------------------------------------------------------
		//system("cd " . $statistics);
		//system("rm *");
		@unlink($statistics . "/*.*");
		@unlink($statistics . "/*");
		@rmdir($statistics);

		//------------------------------------------------------------------------------------------------------
		//system("cd " . $DomainPath);
		//system("rm *");
		@unlink($DomainPath . "/*.*");
		@unlink($DomainPath . "/*");
		rmdir($DomainPath);
	}
	//--------------------------------------------------------------------------------------------------------------
	//This function gets the name of all the skins from the directory "skins"
	function GetSkins()
	{
	  global $sCpHomeDir;
	  $filesArr="";
	  $dirPath=$sCpHomeDir . "/admin/htdocs/skins/";
	  //echo "the dir is ".$dirPath;
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
          //echo "The directories are ". $filesArr;
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
		
		echo "Clientname is " . $clientname . "<br>";
		echo "Domainname is " . $domainname . "<br>";
		echo "Ftpusername is " . $ftpusername . "<br>";
		echo "IPaddress is " . $IPaddress . "<br>";

		

		

		$wwwdomainname="www." . $domainname;
		$httpdinclude=str_replace ("/home/httpd/vhosts", $SetPathinHttpdInclude, $httpdinclude);
		$httpdinclude=str_replace ("www.fotolab30.com", $wwwdomainname, $httpdinclude);
		$httpdinclude=str_replace ("fotolab30.com", $domainname, $httpdinclude);
		$httpdinclude=str_replace ("fotolab30", $ftpusername, $httpdinclude);
		$httpdinclude=str_replace ("217.76.147.5", $IPaddress, $httpdinclude);
		
		if (!$handle = fopen($DomainConfPath. "httpd.include", 'w')) 
			{
				print "Cannot open file (\"httpd.include\")";
				exit;
			}

		// Write $somecontent to our opened file.
		if (!fwrite($handle, $httpdinclude)) 
			{
				print "Cannot write to file (\"httpd.include\")";
				exit;
			}
			//echo $httpdinclude;
			//die();
		fclose($handle);



		//This puts an entry to the httpd.include file of the apache
		//Include /home/clients/Bankoi/kk.com/conf/httpd.include
		//---------------------------------------------------------------------------
		$httpdincludepath="/etc/httpd/conf/";
		if (!$handle = fopen($httpdincludepath. "httpd.include", 'a')) 
			{
				print "Cannot open file (\"httpd.include\")";
				exit;
			}

		if (!fwrite($handle, "Include " . $DomainConfPath . "httpd.include \n")) 
			{
				print "Cannot write to file (\"httpd.include\")";
				exit;
			}
		fclose($handle);

		//here we are creating the user
		$CreateUsr="useradd -d " . $clientPath . "/" . $domainname . " -g webhost -s /bin/false -p" . $Password . " " . $ftpusername;

		system($CreateUsr);

		//Now we give rights to the domain folder
		$GrantRights="chmod 755 -R " . $clientPath . "/" . $domainname;
		system($GrantRights);


		


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
				print "Cannot open file (\"index.htm\")";
				exit;
			}

		// Write $somecontent to our opened file.
		if (!fwrite($handle, $httpdinclude)) 
			{
				print "Cannot write to file (\"index.htm\")";
				exit;
			}
			//echo $httpdinclude;
			//die();
		fclose($handle);
	}
	//--------------------------------------------------------------------------------------------------------------
	Function MakeDNSEntries($DomainId,$DimainName,$IPAddress,$isWWW)
		{
			echo "<br>domain id in dns " . $DomainId;
			echo "<br>domainname id in dns " . $DimainName;
			echo "<br>domainip id in dns " . $IPAddress;
			$mainStr="";
			$StrToFile="";
			$query="select * from tbldnstemplate";
			$DnsArray=mysql_query($query) or die("Sorry could not retrieve the DNS templates");
			$num=mysql_num_rows($DnsArray);
			if($num==0)
				{
					echo "Sorry there is no DNS template to create";
					return true;
				}
			else
				{
					$mainStr=htmlspecialchars("\$TTL    86400") . "\n\n";
					$mainStr .= htmlspecialchars("@	IN	SOA	ns.") . $DimainName . htmlspecialchars(". admin.linuxcp.com. (") . "\n1066802227 \n30 \n4	 \n604800\n	86400 )\n";

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
								mysql_query($querystr);
								
								$StrToFile .= htmlspecialchars($DomainHost);
								$StrToFile .= "\t" . htmlspecialchars($RecordType);
								$StrToFile .= "\t" . htmlspecialchars($value) . "\n";

								$mainStr .= htmlspecialchars($StrToFile);
								$StrToFile="";

							}

					$StrToFile="";
					echo "is www" . $isWWW;
					if($isWWW)
						{
							$StrToFile .= "www." . htmlspecialchars($DimainName) . ".";
							$StrToFile .= "\t" . "CNAME";
							$StrToFile .= "\t" . htmlspecialchars($DimainName) . ".\n";
							$mainStr .= htmlspecialchars($StrToFile);
						}
					

					if (!$handle = fopen("/var/named/" . $DimainName .".dns", 'w')) 
						{
							print "Cannot create file ($DimainName .\"dns\")";
							exit;
						}

					
					if (!fwrite($handle, htmlspecialchars($mainStr))) 
						{
							print "Cannot write to file ($DimainName .\"dns\")";
							exit;
						}
					fclose($handle);


					if (!$handle = fopen("/etc/named.conf", 'a')) 
						{
							print "Cannot Write to file /etc/named.conf";
							exit;
						}

					$StrToFile="";
					$StrToFile="\n zone \"".htmlspecialchars($DimainName)."\" { type master; file \"/var/named".htmlspecialchars($DimainName).".dns\"; };";
					if (!fwrite($handle, $StrToFile)) 
						{
							print "Cannot write to file /etc/named.conf";
							exit;
						}
					fclose($handle);



					
				}
				
		}

	//--------------------------------------------------------------------------------------------------------------

// Function for creating ftp user

		function addFtpUser($ftpusername,$password,$home,$shell,$group)
		{
		$CreateUsr="useradd -d " .$home." -g ".$group." -s ".$shell." -p" . $Password . " " . $ftpusername;

		system($CreateUsr);

		//Now we give rights to the domain folder
		$GrantRights="chmod 755 -R " . $clientPath . "/" . $domainname;
		system($GrantRights);
		}

?>