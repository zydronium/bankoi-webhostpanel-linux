<?php
$cmd="cat `ls /etc/*release`";
$ver=`$cmd`;
/*$cmd="cat $ver";
$ver=`$cmd`;*/
echo $ver."<BR>";
$cmd="cat /proc/version | cut -d \" \" -f1-3";
$ker_ver=`$cmd`;
echo $ker_ver."<BR>";
$cmd="sh /root/cpustats.sh";
echo $cmd;
$uptime=`$cmd`;
print_r( $uptime);
?>