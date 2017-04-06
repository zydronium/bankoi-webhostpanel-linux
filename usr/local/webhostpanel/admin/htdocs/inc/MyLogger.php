<?php
include "params.php";
include "constants.php";


Function myLog($message)
{
	global $cpLogFilePath;
	global $sCpHomeDir;
	// ------------------------Checking for Log File Size -------------------
		//$line_count=0;
		//$line_count=(filesize ($cpLogFilePath))/1024;

	// ---------------- Rename it if large size ----------------------- 
	//	if($line_count >300)
	//	{
	//		copy($cpLogFilePath, $sCpHomeDir . "/admin/logs/cplog-".time().".txt");
	//		unlink($cpLogFilePath);
	//		touch($cpLogFilePath);
	//	}


	// --------------- Logging Of Message ----------------------------
	$message="\n[" . date("Y/m/d h:i:s", mktime()) . "]  " . $message;
	error_log($message,3,$cpLogFilePath);
}

?>