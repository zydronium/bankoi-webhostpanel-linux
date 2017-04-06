<?
# 0-59/10 * * * * /usr/bin/php /home/netstatus/status.php > /dev/null 2>&1
$serverName="gic209";
$aspPath="http://www.kumarpal.com/server/server.asp";
$queryString = "?servername=$serverName";


$httpdStats = system("/etc/init.d/httpd status");
$pos = strpos($httpdStats,"run");
$status=1;
$mailText="";

if($pos === false){
        $mailText .= "HTTPD=0";
        $status=0;
}
else
        $mailText .= "HTTPD=1";


$httpdStats = system("/etc/init.d/psa status");
$pos = strpos($httpdStats,"run");
if($pos === false){
        $mailText .= "&PLESK=0";
        $status=0;
}
else
        $mailText .= "&PLESK=1";

$httpdStats = system("/etc/init.d/named status");
$pos = strpos($httpdStats,"run");
if($pos === false){
        $mailText .= "&DNS=0";
        $status=0;
}
else
        $mailText .= "&DNS=1";

$httpdStats = system("/etc/init.d/mysqld status");
$pos = strpos($httpdStats,"run");
if($pos === false){
        $mailText .= "&mysql=0";
        $status=0;
}
else
        $mailText .= "&mysql=1";

$httpdStats = system("  /etc/init.d/qmail status");
$pos = strpos($httpdStats,"run");
if($pos === false){
        $mailText .= "&qmail=0";
        $status=0;
}
else
        $mailText .= "&qmail=1";



$conn_id = ftp_connect("localhost"); 
if (!$conn_id) { 
        $mailText .= "&ftp=0";
        $status=0;
} else {
        $mailText .= "&ftp=1";
}
ftp_quit($conn_id); 

$queryString .= "&status=".$status;
if( $status==0){
        $queryString .= "&$mailText";
        mail("k_jain@hostbankoi.com","Net Status: Service down",$queryString ,"From: k_jain@hostbankoi.com\n");
}else{
         $queryString .= "&PLESK=1";
}
$handle = fopen ("$aspPath".$queryString, "r");
if(is_resource($handle)){
        fclose($handle);
}

?>