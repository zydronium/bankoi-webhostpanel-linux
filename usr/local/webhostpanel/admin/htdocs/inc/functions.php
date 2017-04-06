<?	//-------------------------------------------------------------------------------------------------------------
	//Function to create Directory
	function CreateDir($FolderName)
	{
		$sPath=$FolderName;
		//echo "The path is ".$sPath;
		if(mkdir($sPath, 0755))
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	//-------------------------------------------------------------------------------------------------------------
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

	//-------------------------------------------------------------------------------------------------------------
	//Function to delete Directory
	function DeleteDir($FolderName)
	{
		$sPath=$FolderName;
		$cmd="rm -rf " . $sPath . " 2>&1";
		$output = `$cmd`;
		//myLog($output);
		return true;
	}

	//-------------------------------------------------------------------------------------------------------------
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

	//-------------------------------------------------------------------------------------------------------------
	//This function creates all the needed directories for the domain
	function CreateDomainDirs($domainname,$clientname)
	{
		global $sHostingDir;
		global $sCpHomeDir;


		//First make the domain folder
		$DomainPath=$sHostingDir."/".$clientname . "/" . $domainname;
		@mkdir($DomainPath);

		//This is path where the file should be copied
		//-----------------------------------------------------------------------------------
		$DomainPath=$sHostingDir . "/" . $clientname . "/" . $domainname . "/";
		
		//This is the path from where the files are to be copied
		//-----------------------------------------------------------------------------------
		$SelFolder = $sCpHomeDir . "/admin/htdocs/.skel/*";

		//This command copies the foledrs and the files in the folder to the domain directory
		//-----------------------------------------------------------------------------------
		$cmd = "cp -R " . $SelFolder . "  " . $DomainPath . " 2>&1";
		$output = `$cmd`;
		if($output != "")
			{
				echo "<script>alert(\"Sorry some error occured\");history.go(-1);</script>>";
				die();
			}

		$dirPath=$sHostingDir . "/" . $clientname . "/" . $domainname . "/";
		if ($handle = opendir($dirPath)) 
			{
			while (false !== ($file = readdir($handle))) 
				{
					if ($file != "." && $file != ".." && is_dir($dirPath .$file))
						{   
							$filesArr = trim($file);
							//echo "The Dir name is " . $filesArr ."<br>";
							if ($handlefile = opendir($dirPath . $filesArr . "/")) 
								{
								while (false !== ($file1 = readdir($handlefile))) 
									{
										if ($file1 != "." && $file1 != ".." && (!is_dir($dirPath . $filesArr . "/" . $file1)))
											{
													$filenm = trim($file1);
													//echo "The file name is " . $filenm ."<br>";
													//*************************************************************
													$lines = file ($dirPath . $filesArr ."/" . $filenm);
													
													$httpdinclude="";

													// Loop through our array, show html source as html source; and line numbers too.
													foreach ($lines as $line_num => $line) 
															{
																$httpdinclude= $httpdinclude . $line;
															}
													
													$httpdinclude=str_replace ("@domain_name@", $domainname, $httpdinclude);
													
													if (!$handle1 = @fopen($dirPath . $filesArr ."/" . $filenm, 'w')) 
														{
															//echo "Cannot open file $filenm line no 114";
															return false;
														}

													// Write $somecontent to our opened file.
													if (!fwrite($handle1, $httpdinclude)) 
														{
															//echo "Cannot write to file $filenm line no 121";
															return false;
														}
													fclose($handle1);
													//*************************************************************
											}
									}
									closedir($handlefile);
								}
							
						}				
				}
				closedir($handle);
			}  
	}
	//-------------------------------------------------------------------------------------------------------------
	//This function creates all the needed directories for the domain
	function RemoveDomainDirs($domainname,$clientname)
	{
		global $sHostingDir;
		$clientPath=$sHostingDir."/".$clientname;

		//Creating the path for various folders to be created
		//---------------------------------------------------
		$DomainPath=$clientPath."/".$domainname;
		$cmd="rm -rf " . $DomainPath . " 2>&1";
		$output=`$cmd`;
		if($output != "")
			{
				echo "";
				die();
			}
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
	//Function which sets the HTTPD.INCLUDE file to the conf folder for the domain by ashish

/*function SethttpsIncludeFile($clientname,$domainname,$IPaddress,$cgi_sup,$webstat)
{		$perl_supp='Y';
		$python_sup='Y';
		global $sCpHomeDir;
		global $sHostingDir;
		$dirPath=$sCpHomeDir . "/admin/htdocs/";
		$clientPath=$sHostingDir . "/" . $clientname;
		$DomainConfPath=$clientPath . "/" . $domainname . "/conf/";
		$SetPathinHttpdInclude=$sHostingDir . "/" . $clientname;

//------------------------------------------------------------------------------------------------
//file httpd.include Begins

			$file_str="<IfModule mod_ssl.c>\n\n";
			$file_str.="<VirtualHost ".$IPaddress.":443>\n";
			$file_str.="\tServerName\t".$domainname."\n";
			$file_str.="\tServerAlias\twww.".$domainname."\n";
			$file_str.="\tUseCanonicalName Off\n\n";
			$file_str.="\tDocumentRoot\t".$SetPathinHttpdInclude."/".$domainname."/httpsdocs\n";
			$file_str.="\tCustomLog\t".$SetPathinHttpdInclude."/".$domainname."/statistics/logs/access_ssl_log combined\n";
			$file_str.="\tErrorLog\t".$SetPathinHttpdInclude."/".$domainname."/statistics/logs/error_ssl_log\n";
			$file_str.="\t<IfModule mod_userdir.c>\n";
			$file_str.="\t\t UserDir ".$SetPathinHttpdInclude."/".$domainname."/web_users\n";
			$file_str.="\t </IfModule>\n";
			if($cgi_sup=='Y')
			{
				$file_str.="\tScriptAlias  /cgi-bin/ ".$SetPathinHttpdInclude."/".$domainname."/cgi-bin/\n";
			}
			if($webstat=='Y')
			{
				$file_str.="\t Alias  /webstat ".$SetPathinHttpdInclude."/".$domainname."/statistics/webstat/\n";
			}

			$file_str.="\tAlias  /webstat-ssl ".$SetPathinHttpdInclude."/".$domainname."/statistics/webstat-ssl/\n";
			$file_str.="\tAlias  /ftpstat ".$SetPathinHttpdInclude."/".$domainname."/statistics/ftpstat/\n";

			$file_str.="\tSSLEngine on\n";
			$file_str.="\tSSLVerifyClient none\n";
			$file_str.="\tSSLCertificateFile ".$sCpHomeDir."/var/certificates/cert\n";
			$file_str.="\t<Directory ".$SetPathinHttpdInclude."/".$domainname."/httpsdocs>\n";

			if($perl_supp=='Y')
			{
			$file_str.="\t<IfModule mod_perl.c>\n";
			$file_str.="\t<Files ~ (\.pl)>\n";
			$file_str.="\t\t SetHandler perl-script\n";
			$file_str.="\t\t PerlHandler ModPerl::Registry\n";
			$file_str.="\t\t Options ExecCGI\n";
			$file_str.="\t\t allow from all\n";
			$file_str.="\t\t PerlSendHeader On\n";
			$file_str.="\t</Files>\n";
			$file_str.="\t </IfModule>\n";

			$file_str.="\t <IfModule mod_perl.c>\n";
			$file_str.="\t <Files ~ (\.asp)>\n";
			$file_str.="\t\t SetHandler perl-script\n";
			$file_str.="\t\t PerlHandler Apache::ASP\n";
			$file_str.="\t\t PerlSetVar Global /tmp\n";
			$file_str.="\t</Files>\n";
			$file_str.="\t </IfModule>\n";
			}
			 $file_str.="\t <IfModule sapi_apache2.c>\n";
			 $file_str.="\t\t php_admin_flag engine on\n";
			 $file_str.="\t\t php_admin_value open_basedir \"".$SetPathinHttpdInclude."/".$domainname."/httpsdocs:/tmp\"\n";
			 $file_str.="\t </IfModule>\n";
			 
			 if($python_sup=='Y')
			 {
			  $file_str.="\t <IfModule mod_python.c>\n";
			  $file_str.="\t <Files ~ (\.py)>\n";
			  $file_str.="\t\t SetHandler python-program\n";
			  $file_str.="\t\t PythonHandler   mod_python.cgihandler\n";
			  $file_str.="\t </Files>\n";
			  $file_str.="\t </IfModule>\n";
			 }
			  $file_str.="\t\t SSLRequireSSL\n";
			  $file_str.="\t\t Options +Includes +ExecCGI\n";
			  $file_str.="\t </Directory>\n";
			$file_str.="\t  Alias \"/error_docs\" \"".$SetPathinHttpdInclude."/".$domainname."/error_docs\"\n";
			$file_str.="\t  ErrorDocument 400 /error_docs/bad_request.html\n";
			$file_str.="\t  ErrorDocument 403 /error_docs/forbidden.html\n";
			$file_str.="\t  ErrorDocument 404 /error_docs/not_found.html\n";
			$file_str.="\t  ErrorDocument 500 /error_docs/internal_server_error.html\n";
			$file_str.="</VirtualHost>\n";
			$file_str.="</IfModule>\n\n";
			//---------------------------------------------------------------------------------------------------
			//next entry
			$file_str.="<VirtualHost ".$IPaddress.":80>\n";
			$file_str.="\tServerName\t".$domainname."\n";
			$file_str.="\tServerAlias\twww.".$domainname."\n";
			$file_str.="\tUseCanonicalName Off\n\n";
			$file_str.="\tDocumentRoot\t".$SetPathinHttpdInclude."/".$domainname."/httpsdocs\n";
			$file_str.="\tCustomLog\t".$SetPathinHttpdInclude."/".$domainname."/statistics/logs/access_ssl_log combined\n";
			$file_str.="\tErrorLog\t".$SetPathinHttpdInclude."/".$domainname."/statistics/logs/error_ssl_log\n";
			$file_str.="\t<IfModule mod_userdir.c>\n";
			$file_str.="\t\t UserDir ".$SetPathinHttpdInclude."/".$domainname."/web_users\n";
			$file_str.="\t</IfModule>\n";
			if($cgi_sup=='Y')
			{
				$file_str.="\tScriptAlias  /cgi-bin/ ".$SetPathinHttpdInclude."/".$domainname."/cgi-bin/\n";
			}
			if($webstat=='Y')
			{
				$file_str.="\t Alias  /webstat ".$SetPathinHttpdInclude."/".$domainname."/statistics/webstat/\n";
			}

			$file_str.="\tAlias  /webstat-ssl ".$SetPathinHttpdInclude."/".$domainname."/statistics/webstat-ssl/\n";
			$file_str.="\tAlias  /ftpstat ".$SetPathinHttpdInclude."/".$domainname."/statistics/ftpstat/\n";
			$file_str.="\t<IfModule mod_ssl.c>\n";
			$file_str.="\t\tSSLEngine off\n";
			$file_str.="\t</IfModule>\n";
			$file_str.="\t<Directory ".$SetPathinHttpdInclude."/".$domainname."/httpsdocs>\n";

			if($perl_supp=='Y')
			{
			$file_str.="\t<IfModule mod_perl.c>\n";
			$file_str.="\t<Files ~ (\.pl)>\n";
			$file_str.="\t\t SetHandler perl-script\n";
			$file_str.="\t\t PerlHandler ModPerl::Registry\n";
			$file_str.="\t\t Options ExecCGI\n";
			$file_str.="\t\t allow from all\n";
			$file_str.="\t\t PerlSendHeader On\n";
			$file_str.="\t</Files>\n";
			$file_str.="\t </IfModule>\n";

			$file_str.="\t <IfModule mod_perl.c>\n";
			$file_str.="\t  <Files ~ (\.asp)>\n";
			$file_str.="\t\t SetHandler perl-script\n";
			$file_str.="\t\t PerlHandler Apache::ASP\n";
			$file_str.="\t\t PerlSetVar Global /tmp\n";
			$file_str.="\t</Files>\n";
			$file_str.="\t </IfModule>\n";
			}
			 $file_str.="\t <IfModule sapi_apache2.c>\n";
			 $file_str.="\t\t php_admin_flag engine on\n";
			 $file_str.="\t\t php_admin_value open_basedir \"".$SetPathinHttpdInclude."/".$domainname."/httpsdocs:/tmp\"\n";
			 $file_str.="\t </IfModule>\n";
			 
			 if($python_sup=='Y')
			 {
			  $file_str.="\t <IfModule mod_python.c>\n";
			  $file_str.="\t <Files ~ (\.py)>\n";
			  $file_str.="\t\t SetHandler python-program\n";
			  $file_str.="\t\t PythonHandler   mod_python.cgihandler\n";
			  $file_str.="\t </Files>\n";
			  $file_str.="\t </IfModule>\n";
			 }
			 $file_str.="\t Options +Includes +ExecCGI\n";
			  $file_str.="\t </Directory>\n";
			$file_str.="\t  Alias \"/error_docs\" \"".$SetPathinHttpdInclude."/".$domainname."/error_docs\"\n";
			$file_str.="\t  ErrorDocument 400 /error_docs/bad_request.html\n";
			$file_str.="\t  ErrorDocument 403 /error_docs/forbidden.html\n";
			$file_str.="\t  ErrorDocument 404 /error_docs/not_found.html\n";
			$file_str.="\t  ErrorDocument 500 /error_docs/internal_server_error.html\n";
			$file_str.="</VirtualHost>\n";
// End of httpd.include
//--------------------------------------------------------------------------------------------------------------

if (!$handle = fopen($DomainConfPath. "httpd.include", 'w')) 
			{
				print "Cannot open file (\"httpd.include\")";
				return false;
			}

		// Write the string to our opened file.
		if (!fwrite($handle, $file_str)) 
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

 
}


    //--------------------------------------------------------------------------------------------------------------
	//Function which sets the HTTPD.INCLUDE file to the conf folder for the domain original
	function SethttpsIncludeFile1($clientname,$domainname,$ftpusername,$Password)
	{
		global $sCpHomeDir;
		global $sHostingDir;

		$dirPath=$sCpHomeDir . "/admin/htdocs/";
		$clientPath=$sHostingDir . "/" . $clientname;
		$DomainConfPath=$clientPath . "/" . $domainname . "/conf/";
		$SetPathinHttpdInclude=$sHostingDir . "/" . $clientname;


		//------------------------------------------------------------------------------------------------

				$strout = addFtpUser($ftpusername,$Password,$clientPath . "/" . $domainname,"/bin/bash","webuser");
				//echo "<br>The returned status is (2)" . $strout;
				if($strout != 0)
					{
						return "user problem";
					}
		//------------------------------------------------------------------------------------------------
		
		
		//here we are creating the user
		//$CreateUsr="useradd -d " . $clientPath . "/" . $domainname . " -g webhost -s /bin/false -p" . //$Password . " " . $ftpusername;
		//echo $CreateUsr;
		//system($CreateUsr);

		//These are the folders on which the domain will have the rights
		//------------------------------------------------------------------------------------------------
		$DomainPath=$clientPath . "/" . $domainname;		
		$cgibin=$DomainPath . "/cgi-bin";
		$httpdocs=$DomainPath . "/httpdocs";
		$httpsdocs=$DomainPath . "/httpsdocs";
		$web_users=$DomainPath . "/web_users";

		$GrantRights="chmod 755 -R " . $httpdocs;
		$output = `$GrantRights`;

		$GrantRights="chmod 755 -R " . $httpsdocs;
		$output = `$GrantRights`;

		$GrantRights="chmod 755 -R " . $web_users;
		$output = `$GrantRights`;

		$GrantRights="chmod 755 -R " . $cgibin;
		$output = `$GrantRights`;
		
		//Now we are restarting the apache so that we may see the new domain site running
		$cmd="/etc/init\.d/httpd restart";
		$output=`$cmd`;
	}//End of the function*/


	//--------------------------------------------------------------------------------------------------------------
	//Function which sets the HTTPD.INCLUDE file to the conf folder for the domain
	function SethttpsIncludeFile($clientname,$domainname,$ftpusername,$IPaddress,$Password)
	{
		global $sCpHomeDir;
		global $sHostingDir;

		$dirPath=$sCpHomeDir . "/admin/htdocs/";
		$clientPath=$sHostingDir . "/" . $clientname;
		$DomainConfPath=$clientPath . "/" . $domainname . "/conf/";
		$SetPathinHttpdInclude=$sHostingDir . "/" . $clientname;


		//------------------------------------------------------------------------------------------------

				$strout = addFtpUser($ftpusername,$Password,$clientPath . "/" . $domainname,"/bin/bash","webuser");
				//echo "<br>The returned status is (2)" . $strout;
				if($strout != 0)
					{
						return "user problem";
					}
		//------------------------------------------------------------------------------------------------
		
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
		$httpdinclude=str_replace ("domainpathtoinclude", $clientPath . "/" . $domainname, $httpdinclude);
		$httpdinclude .= "\n\t#qwertyuiop";
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
		$DomainPath=$clientPath . "/" . $domainname;		
		$cgibin=$DomainPath . "/cgi-bin";
		$httpdocs=$DomainPath . "/httpdocs";
		$httpsdocs=$DomainPath . "/httpsdocs";
		$web_users=$DomainPath . "/web_users";

		$GrantRights="chmod 755 -R " . $httpdocs;
		$output = `$GrantRights`;

		$GrantRights="chmod 755 -R " . $httpsdocs;
		$output = `$GrantRights`;

		$GrantRights="chmod 755 -R " . $web_users;
		$output = `$GrantRights`;

		$GrantRights="chmod 755 -R " . $cgibin;
		$output = `$GrantRights`;
		
		//Now we are restarting the apache so that we may see the new domain site running
		$cmd="/etc/init\.d/httpd restart";
		$output=`$cmd`;
	}//End of the function
	


	//--------------------------------------------------------------------------------------------------------------
    //This function makes the DNS entries for the particular domain

	Function MakeDNSEntries($DomainId,$DomainName,$IPAddress,$isWWW,$resid)
		{
			
			$mainStr="";
			$StrToFile="";
			$query="select * from tbldnstemplate where resellerid='$resid'";
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
					$mainStr .= htmlspecialchars("@	IN	SOA	ns.") . $DomainName . htmlspecialchars(". admin.linuxcp.com. (" . "\n1066802227; \n30; \n	10800; \n604800;\n	86400 );\n");

					while($DNStemplateRecord=mysql_fetch_object($DnsArray))
							{
								$DomainHost=htmlspecialchars($DNStemplateRecord->host);
								$DomainHost=(str_replace (htmlspecialchars("<domain>"), $DomainName, $DomainHost));
								$DomainHost=(str_replace (htmlspecialchars("<ip>"), $IPAddress, $DomainHost));

								$RecordType=htmlspecialchars($DNStemplateRecord->recordtype);

								$value=htmlspecialchars($DNStemplateRecord->value);
								$value=str_replace (htmlspecialchars("<domain>"), $DomainName, $value);
								$value=str_replace (htmlspecialchars("<ip>"), $IPAddress, $value);

								$querystr="Insert into tbldnsdomain set domainid='$DomainId',host='$DomainHost',recordtype='$RecordType',value='$value'";
								myLog($querystr);
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
							$StrToFile .= "www." . htmlspecialchars($DomainName) . ".";
							$StrToFile .= "\t IN \t" . "CNAME";
							$StrToFile .= "\t" . htmlspecialchars($DomainName) . ".\n";
							$mainStr .= htmlspecialchars($StrToFile);

							$host="www." . $DomainName . ".";
							$Val2=$DomainName . "." ;
							$query="insert into tbldnsdomain set domainid=$DomainId,host='$host',recordtype='CNAME',value='$Val2'";
							mysql_query($query);
						}
					
						
					if (!$handle = fopen("/var/named/" . $DomainName .".dns", 'w')) 
						{
							return false;
						}

					
					if (!fwrite($handle, htmlspecialchars($mainStr))) 
						{
							return false;
						}
					fclose($handle);
                                   }

					if (!$handle = fopen("/etc/named.conf", 'a')) 
						{
							return false;
						}

					$StrToFile="";
					$StrToFile="\n zone \"".htmlspecialchars($DomainName)."\" { type master; file \"/var/named/".htmlspecialchars($DomainName).".dns\"; };";
					
					if (!fwrite($handle, $StrToFile)) 
						{
							echo "Cannot write to file /etc/named.conf line no 532";
							return false;
						}
					
					fclose($handle);
			
			return True;				
		}//End of function

	//--------------------------------------------------------------------------------------------------------------


   //--------------------------------------------------------------------------------------------------------------
   // Function for creating ftp user

   function addFtpUser($ftpusername,$password,$home,$shell,$group)
		{
			$password=crypt($password,"\$1\$9");
			$cmd="useradd -d " .$home." -g ".$group." -s ".$shell." -p'" . $password . "' " . $ftpusername;

			exec ($cmd,$output,$return_var);
			
			myLog("the useradd command returned " . $php_errormsg);
			myLog("useradd -d " .$home." -g ".$group." -s ".$shell." -p'" . $password . "' " . $ftpusername);
			system("chown -R " .$ftpusername. " " . $home);
			return $return_var;
		}

   //--------------------------------------------------------------------------------------------------------------
   // Function to block ftp user;

		function blockFtpUser($ftpusername)
		{		
			if (!$handle = fopen("/etc/ftpusers", 'a')) 
					{
						//echo "Cannot open file (\"httpd.include\") line no 572";
						return false;
					}

			// Write $somecontent to our opened file.
			if (!fwrite($handle, $ftpusername)) 
					{
						//echo "Cannot write to file (\"httpd.include\") line no 579";
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
						//echo "Cannot open file (\"ftpusers\") line no 603";
						return false;
					}
			
				// Write $somecontent to our opened file.
				if (!fwrite($handle, $ftpuserfile)) 
					{
						//echo "Cannot write to file (\"ftpusers\") line no 610";
						return false;
					}
				fclose($handle);
				return true;
			}//End of function

	//-------------------------------------------------------------------------------------------------------------
	//This function gets the name of all the directories from the domain directory
	function GetDirs($sPath)
	{
	  $filesArr="";
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
			$DirName1=$DirName;
			for($i=0; $i<count($username);$i++)
			{
				$dir_name_only=split("/",$DirName1);
			$num_dir=count($dir_name_only);
			$dirname="";
			if($num_dir>2)
				{
				for($x=2;$x<$num_dir;$x++)
				$dirname=$dirname.".".$dir_name_only[$x];
				//echo $dirname;
				}
			else
				{
				$dirname="";
				}
			$dir[$i]=$dirname;
			$dir=$dirname;

			$FileStr .= "\n<Directory " . $home . $DirName . ">" . "\n";
			$FileStr .= "options Indexes FollowSymlinks None" . "\n";
			$FileStr .= "AuthUserFile " . $home . "/pd/".$dir[$i].".htpasswd" . "\n";
			$FileStr .= "AuthGroupFile /dev/null \n";
			$FileStr .= "AuthName " . $DomainName;
			$FileStr .= "\nAuthType Basic\n"; 
			$FileStr .= "<Limit GET POST PUT>" . "\n"; 
			$FileStr .= "Require valid-user \n";
			$FileStr .= "</Limit>\n"; 
			$FileStr .= "</Directory>\n";
			}
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
								myLog("Cannot open file " . $DomainConfPath . " line no 558 function.php");
								return false;
						}
					if (!fwrite($handle, $FileStr)) 
						{
								myLog("Cannot write to file line no 563 function.php");
								return false;
						}
					fclose($handle);
					
					//Executing the htpasswd command that sets the password to the file
					//-------------------------------------------------------------------
					for($i=0; $i<count($username);$i++)
						{
							
							$cmd=" [ -f ". $home . "/pd/".$dir[$i].".htpasswd ] && htpasswd -bd " . $home . "/pd/".$dir[$i].".htpasswd " . $username[$i] . " " .$passwd[$i] . " 2>&1";
							$output=`$cmd`;
							myLog($output);
							$cmd=" [ ! -f ". $home . "/pd/".$dir[$i].".htpasswd ] && htpasswd -cbd " . $home . "/pd/".$dir[$i].".htpasswd " . $username[$i] . " " .$passwd[$i] . " 2>&1";
							$output=`$cmd`;
							myLog($output);
							$cmd="chmod 644 " . $home . "/pd/".$dir[$i].".htpasswd ";
							$output=`$cmd`;
							myLog($output);
						}
					//------------------------------------------------------------------

					//Restarting the Apache server
					//-------------------------------
					$cmd="/etc/init\.d/httpd restart" . " 2>&1";
					$output=`$cmd`;
					myLog($output);
					//------------------------------------------------------------------
					return true;
				}			
		}

//Function to put a password on the folder
	function RemovePwdProtectDir($home,$DomainName)
		{
			$flag = 1;
			$DomainConfPath = $home . "/conf/httpd.include";
			$lines = file ($DomainConfPath);
			$pwdDir == "";
			foreach ($lines as $line_num => $line) 
				{
						if((strpos($line,"#qwertyuiop")) > 0)
							{
									$flag = 0;
									$pwdDir .= "\n\t#qwertyuiop";									
							}
						elseif($flag==1)
							{
									$flag==1;
									$pwdDir .= $line;
							}
				}
					
					if (!$handle = fopen($DomainConfPath, "w")) 
						{
								echo "Cannot open file " . $DomainConfPath;
								return false;
						}
					if (!fwrite($handle, $pwdDir)) 
						{
								echo "Cannot write to file in function.php";
								return false;
						}
					fclose($handle);

					$cmd = "rm -rf " . $home . "/pd/.htpasswd";
					$output=`$cmd`;

					//Restarting the Apache server
					//-------------------------------
				//Restarting the Apache server
                                        //-------------------------------
                                        $cmd="/etc/init\.d/httpd restart" . " 2>&1";
                                        $output=`$cmd`;
                                        myLog($output);	
					//------------------------------------------------------------------
			}


	//-------------------------------------------------------------------------------------------------
	//New Function error catching
	
	Function errorCatch($errorMesg)
		{
			//myLog($errorMesg);
			$_SESSION['errorMesg']=$errorMesg;
			echo(" <script>window.location.replace('/redirect.php');</script>");
		}//End of the function


	//------------------------------------------------------------------------------------------------
	//Function to check whether  the database exists or not
	
	Function IsExistsDB($dbname)
		{
			global $dbUserRoot;
			global $dbPassRoot;

			//mysql_connect("localhost", $dbUserRoot, $dbPassRoot);
			$query="create database " . $dbname;
			if(!mysql_query($query))
				{
					myLog("Database creation error " . mysql_error());
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
			$query="SELECT User, Host,db FROM mysql.db ORDER BY User";
			if($mysqlresult=mysql_query($query))
				{
					while($fetch=mysql_fetch_array($mysqlresult))
						{
							if($fetch["User"]==$username && $fetch["db"] == $dbname)
								{
									return false;
								}
						}
				}
			else
				{
					return false;
				}
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
			$array=@mysql_query($query) or die(errorCatch(mysql_error()));
			$totalid=mysql_num_rows($array);
			if($totalid!=0)
				return false;
			else
				return true;
		}

	//--------------------------------------------------------------------------
	//Function to test the table for uniqueness

	function getFieldValue($tblname,$fieldname,$value,$getfield)
		{

			$query = "select ".$getfield." from ".$tblname." where ".$fieldname."='".$value."'";
			//myLog($query);
		   $rs=mysql_query($query) or die(errorCatch(mysql_error()));
		   $res=mysql_fetch_array($rs);			

		return $res[$getfield];
		}

	//-------------------------------------------------------------------------------------------
	//Function to delete the entry of the domain from the "/etc/httpd/conf/httpd.include" file

	Function DeleteHttpdEntry($clientname,$domainname)
		{
			global $sHostingDir;
			$sEntry="\nInclude " . $sHostingDir . "/" . $clientname . "/" . $domainname . "/conf/httpd.include";
			$sEntry1="Include " . $sHostingDir . "/" . $clientname . "/" . $domainname . "/conf/httpd.include";
			//echo $sEntry;
			$lines = file("/etc/httpd/conf/httpd.include");
				$ftpuserfile="";
				foreach ($lines as $line_num => $line) 
					{
						$ftpuserfile = $ftpuserfile . $line;
					}

				$ftpuserfile=str_replace($sEntry ,"", $ftpuserfile);
				$ftpuserfile=str_replace($sEntry1 ,"", $ftpuserfile);

				if (!$handle = fopen("/etc/httpd/conf/httpd.include", 'w')) 
					{
						echo "Cannot open file (\"httpd.include\") line no 715";
						return false;
					}
			//echo $ftpuserfile;
				// Write $somecontent to our opened file.
				if (!fwrite($handle, $ftpuserfile)) 
					{
						echo "Cannot write to file (\"httpd.include\") line no 722";
						return false;
					}
				fclose($handle);
				return true;
		}//End of the function


	
	
	//-------------------------------------------------------------------------------------------
	
	function EditHttpdEntry($clientname,$domainname)
		{		
			global $sHostingDir;
			$clientPath=$sHostingDir."/".$clientname;
			$DomainConfPath=$clientPath."/".$domainname . "/conf/";
			$httpdincludepath="/etc/httpd/conf/";

			if (!$handle = fopen($httpdincludepath. "httpd.include", 'a')) 
				{
					//print "Cannot open file (\"httpd.include\")";
					return false;
				}

			if (!fwrite($handle, "Include " . $DomainConfPath . "httpd.include \n")) 
				{
					//print "Cannot write to file (\"httpd.include\")";
					return false;
				}
			fclose($handle);
			return true;
		}//End of function



//-------------------------------------------------------------------------------------------
//Function to delete the FTP user of the domain

	Function DelFTPUser($Username)
		{
			$cmd="userdel " .$Username;
			$output=`$cmd`;
			myLog($output);
			myLog($cmd);
		}


//-------------------------------------------------------------------------------------------
//Function to delete the DNS entries

	Function DeleteDNS($Domainname)
		{
			@unlink ("/var/named/" . $Domainname . ".dns");

			global $sHostingDir;
			$sEntry="zone \"" . $Domainname ."\" { type master; file \" /var/named/" . $Domainname . ".dns; };";
			
			$lines = file ("/etc/named.conf");
				$ftpuserfile="";

				foreach ($lines as $line_num => $line) 
					{
						$ftpuserfile= $ftpuserfile . $line;
					}

				$ftpuserfile=str_replace ($sEntry,"", $ftpuserfile);

				if (!$handle = fopen("/etc/named.conf", 'w')) 
					{
						echo "Cannot open file (\"named.conf\") line no 603";
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
	//-------------------------------------------------------------------------------------------
	//Function to change the user working shell
	function ChangeShell($Username,$shell)
		{
			$output=system("usermod -s " . escapeshellarg($shell) . " " . escapeshellarg($Username));
		}

	//-------------------------------------------------------------------------------------------
	//Function to change the user working shell
	function GetDomainSpace($HomeDir)
		{
			$com = "du -sh " . $HomeDir . "| tr -s \"\t\" \":\" | cut -d \":\" -f1";
			return strtoupper(`$com`);
		}


	//-----------------------------------------------------------------------
	// Search Function

	function search($tblname,$fieldname,$pattern)
		{
			$pattern="%".$pattern."%";
			$query = "select * from ".$tblname." where ".$fieldname." like '".$pattern."' order by ".$fieldname;
			$array=@mysql_query($query) or die(errorCatch(mysql_error()));
			return $array;
		}


	//-------------------------------------------------------------------------------------------
	//Function to Reboot server 
	function reboot()
		{
			$cmd="reboot";
			$output=`$cmd`;
			//myLog($output);
			return $output;
			
		}


	//-----------------------------------------------------------------------
	//Function to shut down server 
	function shutdown()
		{
			$cmd="halt";
			$output=`$cmd`;
			//myLog($output);
			return $output;
		}


	//-----------------------------------------------------------------------
	//Function to shut down server 
	function CreateMailDir($Path)
		{
			mkdir($Path,0700);
			mkdir($Path."/cur",0700);
			mkdir($Path."/new",0700);
			mkdir($Path."/tmp",0700);
			
			chmod($Path,0700);
			chown($Path,"postfix");
			chgrp($Path,"postfix");
			chmod($Path."/cur",0700);
			chown($Path."/cur","postfix");
			chgrp($Path."/cur","postfix");
			chmod($Path."/new",0700);
			chown($Path."/new","postfix");
			chgrp($Path."/new","postfix");
			chmod($Path."/tmp",0700);
			chown($Path."/tmp","postfix");
			chgrp($Path."/tmp","postfix");
		}


	//-----------------------------------------------------------------------
	//Function to shut down server 
	function DeleteMailDir($Path)
		{
			$cmd="rm -rf " . $Path;
			$output=`$cmd`;
		}
	


	//-----------------------------------------------------------------------
	//Function to shut down server 
	function DeleteDomainMailDir($Path)
		{
			$cmd="rm -rf " . $Path;
			$output=`$cmd`;
			//myLog($output);
		}
	
	
	//-----------------------------------------------------------------------
	//Function to make the file which the FP will read for each domain
	//The home directory is the path up till the domains conf folder with forward slash at the end
	Function DomainFP($domainname,$homeDir,$IpAddress,$FtpUserName)
		{
				global $sCpHomeDir;
				global $sHostingDir;

				$dirPath=$sCpHomeDir . "/admin/htdocs/";
				$httpdinclude = "";
				$lines = file ($dirPath . "domainfp.conf");
				foreach ($lines as $line_num => $line) 
					{
						$httpdinclude= $httpdinclude . $line;
					}
				$httpdinclude=str_replace ("/home/httpd/vhosts/fotolab30.com/httpdocs", $homeDir . "/conf/httpdocs", $httpdinclude);
				$httpdinclude=str_replace ("ftp", $FtpUserName, $httpdinclude);
				$httpdinclude=str_replace ("help.com", $domainname, $httpdinclude);
				$httpdinclude=str_replace ("217.76.147.5", $IpAddress, $httpdinclude);

				//echo "The output is here " . $httpdinclude;
				if (!$handle = fopen($homeDir . "/conf/" .$domainname . ".conf", 'w')) 
					{
						echo "Cannot open file line no 925 function.php";
						return false;
					}
				if (!fwrite($handle, $httpdinclude)) 
					{
						echo "Cannot write to file line no 930 function.php";
						return false;
					}
				fclose($handle);
				return true;	
		}

	//---------------------------------------------------------------------------------------------
	//Function to enable Front page support for the selected client
	Function EnableFrontPageExt($domainname,$username,$passwd,$HomeDir)
		{
			global $linix_user;
			global $linix_group;

			$dir = "/usr/local/frontpage/version5.0/bin/";
			$cmd = $dir . "owsadm.exe -o install -p 80 -m " . $domainname . " -xu " . $username . " -xg " . "webhost" . " -s " . $HomeDir . " -u " . $username . " -pw " . $passwd . "-t apache-2.0";
			$output = `$cmd`;
			return true;
		}

	//---------------------------------------------------------------------------------------------
	//Function to disable Front page support for the selected client
	Function DisableFrontPageExt($domainname,$HomeDir)
		{
			$dir = "/usr/local/frontpage/version5.0/bin/";
			$cmd = $dir . "owsadm.exe -o uninstall -p 80 -m " . $domainname . " -s " . $HomeDir;
			$output = `$cmd`;
			return true;
		}

	//---------------------------------------------------------------------------------------------
	//Function to change the Front page support for the selected client
	Function ChangeFrontPageExt($domainname,$username,$passwd,$HomeDir)
		{
			global $linix_user;
			global $linix_group;
			$dir = "/usr/local/frontpage/version5.0/bin/";

			//First uninstall the support having old password
			$cmd = $dir . "owsadm.exe -o uninstall -p 80 -m " . $domainname . " -s " . $HomeDir;
			$output = `$cmd`;

			//here install the extensions with new password
			$cmd = $dir . "owsadm.exe -o install -p 80 -m " . $domainname . " -xu " . $linix_user . " -xg " . $linix_group . " -s " . $HomeDir . " -u " . $username . " -pw " . $passwd;
			$output = `$cmd`;
			return true;
		}




	//---------------------------------------------------------------------------------------------
	//Function to make the creation of the log files for the domain
	Function CreateDomainLogFiles($resellername,$domainname,$size,$time,$compress,$numberoffiles)
		{	

			global $sCpHomeDir;
			global $sHostingDir;
			//echo "size= " . $size ."<br>";
			//echo "time= " . $time ."<br>";
			//echo "numberoffiles= " . $numberoffiles ."<br>";
			//echo "compressfiles= " . $compress ."<br>";

			$path=$sHostingDir . "/" . $resellername . "/" .$domainname . "/statistics/logs/";
			
			//For the files *.processed
			//------------------------------------------------------------------------------
			$filecontent = $path . "*.processed\n";
			$filecontent .= "{\n";
			
			if($size != "")
				{
					$filecontent .= "\t size=" . $size . "\n";
				}
			
			if($time != "")
				{
					$filecontent .= "\t " . $time . "\n";
				}
			
			$filecontent .= "\t rotate " . $numberoffiles . "\n";
			
			if(strtoupper($compress) == "1")
				{
					$filecontent .= "\t compress " . "\n";
				}
			$filecontent .= "\t missingok " . "\n";
			$filecontent .= "\t copytruncate " . "\n";
			$filecontent .= "}\n\n\n";
			//--------------------------------------------------------------------------------

			//For the files error_log
			//------------------------------------------------------------------------------
			$filecontent .= $path . "error_log\n";
			$filecontent .= "{\n";
			
			if($size != "")
				{
					$filecontent .= "\t size=" . $size . "\n";
				}
			
			if($time != "")
				{
					$filecontent .= "\t " . $time . "\n";
				}
			
			$filecontent .= "\t rotate " . $numberoffiles . "\n";
			
			if(strtoupper($compress) == "1")
				{
					$filecontent .= "\t compress " . "\n";
				}
			$filecontent .= "\t missingok " . "\n";
			$filecontent .= "\t copytruncate " . "\n";
			$filecontent .= "}\n\n\n";
			//--------------------------------------------------------------------------------

			//For the files error_ssl_log
			//------------------------------------------------------------------------------
			$filecontent .= $path . "error_ssl_log\n";
			$filecontent .= "{\n";
			
			if($size != "")
				{
					$filecontent .= "\t size=" . $size . "\n";
				}
			
			if($time != "")
				{
					$filecontent .= "\t " . $time . "\n";
				}
			
			$filecontent .= "\t rotate " . $numberoffiles . "\n";
			
			if(strtoupper($compress) == "1")
				{
					$filecontent .= "\t compress " . "\n";
				}
			$filecontent .= "\t missingok " . "\n";
			$filecontent .= "\t copytruncate " . "\n";
			$filecontent .= "}\n";
			//--------------------------------------------------------------------------------
			$pathtofile = "/usr/local/webhostpanel/etc/logrotate.d/";
			if (!$handle = fopen($pathtofile . $domainname, 'w')) 
					{
						echo "Cannot open file line no 1078 function.php";
						return false;
					}
			if (!fwrite($handle, $filecontent)) 
					{
						echo "Cannot write to file line no 1083 function.php";
						return false;
					}
			fclose($handle);
		}

	//---------------------------------------------------------------------------------------------------------
	//This function creates all the needed directories for the domain
	function RemoveLogFiles($domainname)
	{
		global $sHostingDir;
		$pathtofile = "/usr/local/webhostpanel/etc/logrotate.d/" . $domainname;
		$cmd="rm -rf " . $pathtofile;
		$output=`$cmd`;
	}//End of the function



	//---------------------------------------------------------------------------------------------------------
	//This function checks the status for the httpd service
	Function CheckStatus($service)
		{
			if($service != "named")
			{
				$httpdStats ="/etc/init.d/" . $service . " status";
				$output = `$httpdStats`;
				//echo $output;
					$pos = strpos($output,"run");
					//echo "<br>THE POS IS " . $pos;
					if($pos === false)
						{
							$status=0;
						}
					else
						{
							$status=1;
						}
			}
			else
				{
					$httpdStats="service named status | grep \"up and running\" > /dev/null && echo $?";
					$output=`$httpdStats`;
					//echo "the output is " . $output;
					
					if($output != 0 || $output == "")
						{
							$status=0;
						}
					else
						{
							$status = 1;
						}
					
				}
			return $status;
		}


	//---------------------------------------------------------------------------------------------------------
	//This function start the postfix service
	Function StartService($service)
		{
			$httpdStats ="/etc/init.d/" . $service . " start";
			$output = `$httpdStats`;
			//echo "Starting the service " . $output;
			$pos = strpos($output,"OK");
			$pos1 = strpos($output,"FAILED");
			$pos2 = strpos($output,"running");

			
			if($pos >= 0)
					$status=1;
			else
					$status=0;

			if($pos1 >= 0)
					$status=0;
			else
					$status=1;

			if($pos2 >= 0)
					$status=1;
			else
					$status=0;

			return $status;
		}
	//---------------------------------------------------------------------------------------------------------
	//This function Stop the postfix service
	Function StopService($service)
		{	if($service == "named")
			{
				$output=`killall -9 named`;
				$status=1;
			}

			else
			{
			$httpdStats ="/etc/init.d/" . $service . " stop";
			//echo $httpdStats ;
			$output = `$httpdStats`;
			//echo "The value of pos1 is " . $pos1;
			if($pos ===false)
				{
					$status=0;
				}
			else
				{
					$status=1;
				}
			}
			return $status;
		}

	
	//---------------------------------------------------------------------------------------------------------
	//This function restart the postfix service
	Function RestartService($service)
		{
			if($service == "named")
			{
				$httpdStats="kill -HUP `cat /var/named/named.pid`";
				$output=`$httpdStats`;
				$status=1;
			}
			else
			{
			$httpdStats ="/etc/init.d/" . $service . " restart";
			$output = `$httpdStats`;
			//echo "Restarting the service " . $output;
			$pos = strpos($output,"OK");
			$pos1 = strpos($output,"FAILED");
			//echo "The value of pos1 is " . $pos1;
			if($pos < 0 || $pos == "" || $pos1 != "")
				{
					$status=0;
				}
			else
				{
					$status=1;
				}
			}
			return $status;
		}



	//---------------------------------------------------------------------------------------------------------
	//This function delets the /etc/named.conf entry of the domain when the domain is deleted
	function DeleteNamedEntry($DomainName)
		{
			$entry = "zone \"" .$DomainName . "\" { type master; file \"/var/named/" . $DomainName . ".dns\"; };";
			$lines = file("/etc/named.conf");
				$ftpuserfile="";
				foreach ($lines as $line_num => $line) 
					{
						$pos=strpos($line, $entry);
						if($pos === false){
							$ftpuserfile = $ftpuserfile . $line;
						}
					}

				//$ftpuserfile=str_replace($entry ,"", $ftpuserfile);

				if (!$handle = fopen("/etc/named.conf", 'w')) 
					{
						//echo "Cannot open file (\"named.conf\") line no 1209";
						return false;
					}

				if (!fwrite($handle, $ftpuserfile)) 
					{
						//echo "Cannot write to file (\"named.conf\") line no 1215";
						return false;
					}
				fclose($handle);
				return true;
		}

	//---------------------------------------------------------------------------------------------------------
	//This function sets the system date.
	Function SetDateTime($DateTime)
	{
		//echo $DateTime . "<br>" ;
		$str="date -u -s " . $DateTime ;
		//echo $str ;
		//$i=system($str,$retval);
	$output = `$str`;
		return true;
	}


	//---------------------------------------------------------------------------------------------------------
	//This function deletes the POSTFIX mails that have arrived in the POSTFIX folder "/var/spool/postfix/".
	Function PostfixDelMails($Argument)
		{
			$cmd="postsuper -d All " . $Argument;
			$output = `$cmd`;
			return true;
		}

	//---------------------------------------------------------------------------------------------------------
	//This function checks the status of the mail queue "/var/spool/postfix/".
	Function PostfixQueue()
		{
			$cmd="mailq";
			$output = `$cmd`;
			return $output;
		}


	//---------------------------------------------------------------------------------------------------------
	//This function checks the status of the mail queue "/var/spool/postfix/".
	function DeleteDomainDatabase($domainid)
		{
			$query="select * from tbldatabase where domainid='$domainid'";
			$recodrDb = mysql_query($query) or die(errorCatch(mysql_error()));
			if(mysql_num_rows($recodrDb) != 0)
				{
					while($DbDomain = mysql_fetch_array($recodrDb))
							{
								$DbName = $DbDomain["databasename"];
								$UserName = $DbDomain["dbusername"];
								
								$query = "drop database " . $DbName;
								mysql_query($query);
								//HEre we are deleting  the users made by the domain and the databases for that user
								//--------------------------------------------------
								$str = "DELETE FROM mysql.user WHERE User='$UserName'";
								//echo $str;
								@mysql_query($str) or die(errorCatch(mysql_error()));
								$str = "DELETE FROM mysql.db WHERE User='$UserName'";
								//echo $str;
								@mysql_query($str) or die(errorCatch(mysql_error()));
								$str = "DELETE FROM mysql.tables_priv WHERE User='$UserName'";
								//echo $str;
								@mysql_query($str) or die(errorCatch(mysql_error()));
								$str = "DELETE FROM mysql.columns_priv WHERE User='$UserName'";
								//echo $str;
								@mysql_query($str) or die(errorCatch(mysql_error()));
							}
				}
				return true;
		}

	//---------------------------------------------------------------------------------------------------------



	//---------------------------------------------------------------------------------------------------------
	//This function checks the status of the mail queue "/var/spool/postfix/".
	function DeleteDomainDB($domainID,$DatabaseName)
		{
			$query="select * from tbldatabase where domainid='$domainID' and databasename='$DatabaseName'";
			$recodrDb = mysql_query($query) or die(errorCatch(mysql_error()));
			if(mysql_num_rows($recodrDb) != 0)
				{
					while($DbDomain = mysql_fetch_array($recodrDb))
							{
								$DbName = $DbDomain["databasename"];
								$UserName = $DbDomain["dbusername"];
								
								$query = "drop database " . $DbName;
								mysql_query($query);
								//HEre we are deleting  the users made by the domain and the databases for that user
								//--------------------------------------------------
								$str = "DELETE FROM mysql.user WHERE User='$UserName'";
								//echo $str;
								@mysql_query($str) or die(errorCatch(mysql_error()));
								$str = "DELETE FROM mysql.db WHERE User='$UserName'";
								//echo $str;
								@mysql_query($str) or die(errorCatch(mysql_error()));
								$str = "DELETE FROM mysql.tables_priv WHERE User='$UserName'";
								//echo $str;
								@mysql_query($str) or die(errorCatch(mysql_error()));
								$str = "DELETE FROM mysql.columns_priv WHERE User='$UserName'";
								//echo $str;
								@mysql_query($str) or die(errorCatch(mysql_error()));
							}
				}
				return true;
		}

	//---------------------------------------------------------------------------------------------------------



	function PostfixStart()
		{
				global $PathToPostfix;
				$cmd = $PathToPostfix . " start";
				$output = `$cmd`;
				//echo "the output is " . $output;
				$pos = strpos($output,"running");
				//echo "the pos is " . $pos;
				if($pos === false)
					{
						$status=1;
					}
				else
					{
						$status=0;
					}
				return $status;
		}


	//---------------------------------------------------------------------------------------------------------
	//Function to stop POSTFIX /usr/sbin/postfix/
	function PostfixStop()
		{
				global $PathToPostfix;
				$cmd = $PathToPostfix . " stop";
				$output = `$cmd`;
				//echo "the output is " . $output;
				$pos = strpos($output,"stop");
				if($pos === false)
					{
						$status=1;
					}
				else
					{
						$status=0;
					}
				return $status;
		}

	//---------------------------------------------------------------------------------------------------------
	//Function to check the status of the POSTFIX
	function CheckPostfixStatus()
		{
				global $PathToPostfix;
				$cmd = $PathToPostfix . " status";
				//echo $cmd;
				$output = `$cmd`;
				$pos = strpos($output,"running");
				if($pos === false)
					{
						$status=0;
					}
				else
					{
						$status=1;
					}
				return $status;
		}


	//---------------------------------------------------------------------------------------------------------
	//Function to restart the POSTFIX server
	function PostfixReStart()
		{
				global $PathToPostfix;
				$cmd = $PathToPostfix . " reload";
				$output = `$cmd`;
				$pos = strpos($output,"fatal");
				if($pos === false)
					{
						$status=1;
					}
				else
					{
						$status=0;
					}
				return $status;
		}



	//---------------------------------------------------------------------------------------------------------
	//Function to add New IP to the server
	function AddIP($Interface,$IP,$subnetMask,$id)
		{
			$ftpuserfile = "DEVICE=" . $Interface . ":" . $id . "\n";
			$ftpuserfile .= "ONBOOT=yes\n";
			$ftpuserfile .= "BOOTPROTO=static\n";
			$ftpuserfile .= "IPADDR=" . $IP . "\n";
			$ftpuserfile .= "NETMASK=$subnetMask\n";


			if (!$handle = fopen("/etc/sysconfig/network-scripts/ifcfg-" . $Interface . ":" . $id, 'w')) 
					{
						echo "Cannot open file";
						return false;
					}

			if (!fwrite($handle, $ftpuserfile)) 
				{
					echo "Cannot write to file";
					return false;
				}
			fclose($handle);
			RestartEth();  //This restarts the network interfaces
		}


	//---------------------------------------------------------------------------------------------------------
	//Function removes the IP from the server
	function RemoveIP($Interface,$id)
		{
			
			$FileName= "/etc/sysconfig/network-scripts/ifcfg-" . $Interface . ":" . $id;
			$cmd="rm -rf " . $FileName . " 2>&1";
			$output = `$cmd`;
			RestartEth();	//This restarts the network interfaces
			return true;
		}


	//---------------------------------------------------------------------------------------------------------
	//This function restarts the ethernet services
	function RestartEth()
		{
			$cmd="/etc/init.d/network restart";
			$output = `$cmd`;
			return true;
		}


    function AddDomainTemplate($DomainName,$NewDnsEntry)
		{		
			$lines = file ("/var/named/" . $DomainName .".dns");
			
			$DNSEntry="";

			foreach ($lines as $line_num => $line) 
				{
					$DNSEntry= $DNSEntry . $line;
				}

			$DNSEntry = $DNSEntry . $NewDnsEntry . "\n";

			if (!$handle = fopen("/var/named/" . $DomainName .".dns", 'w')) 
					{
						return false;
					}

				
			if (!fwrite($handle, htmlspecialchars($DNSEntry))) 
				{
					return false;
				}
			fclose($handle);


			return true;
		}//End of function.






	function DeleteDNSEntryDomain($DomainName,$NewDnsEntry)
		{

			//echo "The entry to be deleted is " . $NewDnsEntry;
			//echo "<br> The domain name is " . $DomainName . "<br><br>";
			$lines = file("/var/named/" . $DomainName . ".dns");
			$DNSEntry="";
			foreach ($lines as $line_num => $line) 
				{
					//echo "Line ==> " . $line . "<br>";
					$DNSEntry = $DNSEntry . $line;
				}
			
			$DNSEntry = str_replace ($NewDnsEntry . "\n", "", $DNSEntry);

			if (!$handle = fopen("/var/named/" . $DomainName . ".dns", 'w')) 
					{
						return false;
					}

			if (!fwrite($handle, htmlspecialchars($DNSEntry))) 
				{
					return false;
				}
			fclose($handle);
			return true;
		}//End of function.


// Function by Ashish


function DeleteSlaveDNS($Domainname,$ip)
		{
			@unlink ("/var/named/" . $Domainname . ".dns");
			$da = $ip;
			list($a1, $a2, $a3, $a4 ,$a5) = split('[/.-]', $da);
			$Str="";
			$Str="\n\n\nallow-transfer (".$ip.")";
			$Str.=" zone \"".$a3.".".$a2.".".$a1.". in-addr.arpa"."\" {  type slave;  file \"slave.".$a1.".".$a2.".".$a3."\";  masters {".htmlspecialchars($ip)."}  };";
			$Str.=" zone \"".htmlspecialchars($Domainname)."\" {  type slave;  file \"slave.".htmlspecialchars($Domainname)."\";  masters {".htmlspecialchars($ip)."} };";
			//echo $Str;
			$lines = file ("/etc/named.conf");
				$ftpuserfile="";

				foreach ($lines as $line_num => $line) 
					{
						$ftpuserfile= $ftpuserfile . $line;
					}

				$ftpuserfile=str_replace ($Str."\n","", $ftpuserfile);

				if (!$handle = fopen("/etc/named.conf", 'w')) 
					{
						echo "Cannot open file (\"named.conf\") line no 603";
						return false;
					}
			
				// Write $somecontent to our opened file.
				if (!fwrite($handle, $ftpuserfile)) 
					{
						echo "Cannot write to file (\"named.conf\") line no 610";
						return false;
					}
				fclose($handle);
				return true;

		}


	Function MakeSlaveDNS($Domainname,$ip)	
			{
						$date = $ip;
						list($a1, $a2, $a3, $a4 ,$a5) = split('[/.-]', $date);
						
					//echo "<br>a=".$a1."<br>b=".$a2."<br>c="."<br>c=".$a3."<br>d=".$a4."<br>e=".$a5;
	
						if (!$handle = fopen("/etc/named.conf", 'a')) 
							{
								return false;
							}
	
									$Str="";
									$Str="\n\n\nallow-transfer (".$ip.")";
									$Str.=" zone \"".$a3.".".$a2.".".$a1.". in-addr.arpa"."\" {  type slave;  file \"slave.".$a1.".".$a2.".".$a3."\";  masters {".htmlspecialchars($ip)."}  };";
									$Str.=" zone \"".htmlspecialchars($Domainname)."\" {  type slave;  file \"slave.".htmlspecialchars($Domainname)."\";  masters {".htmlspecialchars($ip)."} };\n";
				
						
						if (!fwrite($handle, $Str)) 
							{
								echo "Cannot write to file /etc/named.conf line no 532";
								return false;
							}
				
						fclose($handle);
						//	echo "<br>".$Str;
						
	return true;
	}



//Subdomain Functions

//Function to create Directory
	function CreatesubdomainDir($FolderName)
	{
		$sPath=$FolderName;
		
		if(mkdir($sPath, 0755))
		{
			return true;
		}
		else
		{
			return false;
		}
	}




//Function which sets the HTTPD.INCLUDE file to the conf folder for the domain
	function subDomainhttpFile($clientname,$domainName,$subdomainname,$ftpusername,$IPaddress,$Password)
	{
		
		global $sCpHomeDir;
		global $sHostingDir;

		$dirPath=$sCpHomeDir . "/admin/htdocs/";
		$clientPath=$sHostingDir . "/" . $clientname;
		$DomainConfPath=$clientPath . "/" . $domainName . "/conf/";
		
		//------------------------------------------------------------------------------------------------

				$strout = addFtpUser($ftpusername,$Password,$clientPath . "/" . $domainName. "/" . "subdomains" . "/" . $subdomainname,"/bin/bash","webuser");
				if($strout != 0)
					{
						return "user problem";
					}
		//------------------------------------------------------------------------------------------------

		if(!copy($dirPath . "subdomainhttp.include", $DomainConfPath . $subdomainname . ".include") )
			{
				echo "can nto copy";
				//die();
			}

		$SetPathinHttpdInclude=$sHostingDir . "/" . $clientname . "/" . $domainName . "/subdomains";

		
		// Get a file into an array.
		$lines = file ($dirPath . "subdomainhttp.include");
		$httpdinclude="";

		// Loop through our array, show html source as html source; and line numbers too.
		foreach ($lines as $line_num => $line) 
				{
					$httpdinclude= $httpdinclude . $line;
				}
		$wwwdomainname="www." . $subdomainname;
		$httpdinclude=str_replace ("/home/httpd/vhosts", $SetPathinHttpdInclude, $httpdinclude);
		$httpdinclude=str_replace ("www.fotolab30.com", $wwwdomainname, $httpdinclude);
		$httpdinclude=str_replace ("fotolab30.com", $subdomainname, $httpdinclude);
		$httpdinclude=str_replace ("fotolab30", $ftpusername, $httpdinclude);
		$httpdinclude=str_replace ("217.76.147.5", $IPaddress, $httpdinclude);
		$httpdinclude=str_replace ("domainpathtoinclude", $clientPath . "/" . $domainName . "/" . "subdomains" . "/" . $subdomainname, $httpdinclude);

		if (!$handle = fopen($DomainConfPath . $subdomainname . ".include", 'w')) 
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

		//This puts an entry to the httpd.include file of the apache
		//Include /etc/httpd/conf/httpd.include
		//---------------------------------------------------------------------------
		$httpdincludepath="/etc/httpd/conf/";
		if (!$handle = fopen($httpdincludepath. "httpd.include", 'a')) 
			{
				print "Cannot open file (\"httpd.include\")";
				return false;
			}

		if (!fwrite($handle, "Include " . $DomainConfPath . $subdomainname . ".include\n")) 
			{
				print "Cannot write to file (\"httpd.include\")";
				return false;
			}
		fclose($handle);
		copySubDomainFiles("bankoiindex.html", $subdomainname,$clientname,$domainName);
		copySubDomainFiles("undercons.gif", $subdomainname,$clientname,$domainName);

		$endPath = $sHostingDir . "/" . $clientname  . "/" . $domainName . "/subdomains/" . $subdomainname . "/";
		rename($endPath . "bankoiindex.html", $endPath . "index.html");
	}





	Function copySubDomainFiles($filename,$subdomainname, $clientname,$domainName)
	{
			global $sCpHomeDir;
			global $sHostingDir;

			$dirPath=$sCpHomeDir . "/admin/htdocs/";
			$SetPathinHttpdInclude=$sHostingDir . "/" . $clientname . "/" . $domainName . "/subdomains/" . $subdomainname;

			/*if(!copy($dirPath . $filename, $SetPathinHttpdInclude . "/" . $subdomainname . $filename) )
			{
				echo "can nto copy";
				//die();
			}*/
			$lines = file ($dirPath . $filename);
			$httpdinclude="";

			foreach ($lines as $line_num => $line) 
				{
						$httpdinclude= $httpdinclude . $line;
				}
														
			$httpdinclude=str_replace ("@domain_name@", $subdomainname, $httpdinclude);
														
			if (!$handle1 = @fopen($SetPathinHttpdInclude ."/" . $filename, 'w')) 
				{
						return false;
				}

			if (!fwrite($handle1, $httpdinclude)) 
				{
						return false;
				}

			fclose($handle1);	

			RestartService("httpd");
			RestartService("named");
	}




	Function addCron($domainID,$DomainName,$minute,$cronhour,$day,$month,$week,$command)
	{

		
		$query = " select * from tblftpinfo where domainid='$domainID' and type='D'";
		$Res1 = @mysql_query($query);
    	
			while($arr=@mysql_fetch_array($Res1))
		{
		$username=$arr["ftpusername"];
		}
		$cmd="[ -f /etc/cron.allow ]  && ! grep $username /etc/cron.allow  && echo $username >> /etc/cron.allow ";
		$output=`$cmd`;


		$str = $minute . " " . $cronhour . " " . $day . " " . $month . " " .  $week . " " . $username . " " . $command;		

		$cmd="[ -f /etc/crontab ]  && echo \"$str\" >> /etc/crontab";
			//	echo $cmd;
		$output=`$cmd`;
	}

	Function deleteCron($domainID,$DomainName,$id)
	{
		$query = "select * from tblftpinfo where domainid='$domainID' and type='D'";
		$Res1 = @mysql_query($query);
		
		while($arr1=@mysql_fetch_array($Res1))
		{
		$username=$arr1["ftpusername"];
		}	
    	$query = "select * from tblcron where id='$id'";
		$Res1 = @mysql_query($query);
    	while($arr1=@mysql_fetch_array($Res1))
			{
			$minute=$arr1["cronminute"];
			$cronhour=$arr1["cronhour"];
			$day=$arr1["cronday"];
			$month=$arr1["cronmonth"];
			$week=$arr1["cronweek"];
			$command=$arr1["croncommand"];
		}
		
$str =$str . $minute . " " . $cronhour . " " . $day . " " . $month . " " .  $week . " " . $username . " " . $command;		
		$cmd="grep -v \"$str\" /etc/crontab > /tmp/.crntab ";//; mv /tmp/.crntab /etc/crontab";
		$outout=`$cmd`;
		$cmd="mv /tmp/.crntab /etc/crontab";
		$output=`$cmd`;
	}


	Function addcronuser($domainID)
	{
		$query = "select * from tblftpinfo where domainid='$domainID' and type='D'";
		$Res1 = @mysql_query($query);
		
		while($arr1=@mysql_fetch_array($Res1))
		{
		$username=$arr1["ftpusername"];
		}	

		$cmd="[ -f /etc/cron.allow ]  && ! grep $username /etc/cron.allow  && echo $username >> /etc/cron.allow ";
		$output=`$cmd`;


	}
	
	Function DeleteCronUser($domainID)
	{
		$query = "select * from tblftpinfo where domainid='$domainID' and type='D'";
		$Res1 = @mysql_query($query);
		
		while($arr1=@mysql_fetch_array($Res1))
		{
		$username=$arr1["ftpusername"];
		}	
		$cmd="[ -f /etc/cron.allow ]  &&  grep -v $username /etc/cron.allow > /tmp/.crnallow";
		$output=`$cmd`;
		$cmd="mv /tmp/.crnallow /etc/cron.allow";
		$output=`$cmd`;
	}
?>
