<?php
#from address which will be used to send emails
$mailfrom="support@bankoi.com";
#Root Directory for Hosting
$sHostingDir = "/home/clients";
#Control panel Home Directory
$sCpHomeDir = "/usr/local/webhostpanel";
# Name of the computer
$sComputerName =  "kplinux";
$maildomainpath="/var/postfix/maildomains/";
//$maildomainpath="/var/virtual/maildomains/";
$linix_user  = "webuser";
$linix_group = "webuser";
$PathToPostfix = "/usr/sbin/postfix";
$dbUserRoot = "root";
$dbPassRoot = "ddR51x67";

#*----------------------------------No Need To Edit Below -------------------------------
# New domain Files must be copied from
$newDomFiles = $sCpHomeDir . "/www/newdomfiles/";
# Log file must be copied from
$cpLogFilePath = $sCpHomeDir . "/admin/logs/cplog.txt";
#Webalizer Configuartion Files Dir for all domains
$sWebalizerConfDir = $sCpHomeDir . "/webalizer/";
#Webalizer Conf File Template
$sWebalizerTempFile = $sCpHomeDir . "/stattemplate/demo.conf";
////////////
$LOGO_FILE="../logos/logo.gif";
?>
