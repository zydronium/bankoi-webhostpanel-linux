<?/**
*	This page contains the list of constants which are used in other pages
*	*/


	/* Administrator Login */	
	$ACCESS_ADMIN = "a";
	/* Client Login */	
	$ACCESS_CLIENT ="c";
	/* Domain Login */	
	$ACCESS_DOMAIN ="d";
	/* Invalid Access */
	$ACCESS_DENIED = 5;

	/**	invalid user name */
	$INVALID_USERNAME = 24;
	/**	invalid password */
	$INVALID_PASSWORD = 25;
	

	/* Constants For Data Base Error & Success */
	$TRANS_SUCCESS = 6;
	$TRANS_FAILURE = 7;
	$TRANS_UNABLE = 8;
	$TRANS_ALREADY = 9;
	$TRANS_ERROR = 10;
	$TRANS_ADD_SUCCESS = 11;
	$TRANS_UPDATE_SUCCESS = 12;
	$TRANS_DELETE_SUCCESS = 13;
	$DEACTIVATESUCCESS = 14;
	$NO_SUCH_ENTRY = 15;

	/*UNKNOWN ERROR*/
	$UNKNOWN_ERROR = 16;
	$EMAIL_ALREADY = 17;
	$USERNAME_ALREADY = 18;
	$TRANS_MISMATCH = 19;
	$SESSION_EXPIRE = 20;	
	$CANNOT_DELETE = 21;	
	$CANNOT_EDIT = 22;	
	$BLOCKED = 23;	

	/**	active User */
	$STATUS_ACTIVE = 26;
	/**	Inactive User */
	$STATUS_INACTIVE = 27;
	/* User Blocked	 */
	$STATUS_BLOCKED = 28;


	/**	active User */
	$STATUS_ALIVE = 29;
	/**	Inactive User */
	$STATUS_DELETED = 30;


	/*CREATE FOLDER SUCCESS*/
	$CREATE_FOLDER_SUCCESS = 31;
	/*DELETE FOLDER SUCCESS*/
	$DELETE_FOLDER_SUCCESS = 32;
	/*UNABLE TO CREATE FOLDER*/
	$UNABLE_TO_CREATE_FOLDER = 33;
	/*UNABLE TO DELETE FOLDER*/
	$UNABLE_TO_DELETE_FOLDER = 34;
	
	/*CREATE FILE SUCCESS*/
	$CREATE_FILE_SUCCESS = 35;
	/*DELETE FILE SUCCESS*/
	$DELETE_FILE_SUCCESS = 36;
	/*UNABLE TO CREATE FILE*/
	$UNABLE_TO_CREATE_FILE = 37;
	/*UNABLE TO DELETE FILE*/
	$UNABLE_TO_DELETE_FILE = 38;

	$MAIL_TRANS_SUCCESS=39;


	// Log File Size
	$logFileSize=100000;


/* Messages */
$MESG_TRANS_SUCCESS = "Your Transaction has been Successfully Done";
$MESG_TRANS_FAILURE = "Error Occured due to Invalid Data";
$MESG_TRANS_UNABLE = "Unable to transfer Data to DataBase See your Permissions ";
$MESG_TRANS_ALREADY = "Already Exists";
$MESG_TRANS_ERROR = "Error occured during Transaction please Refresh your page & try again";
$MESG_TRANS_ADD_SUCCESS = "Your Data has been Successfully Added";
$MESG_TRANS_UPDATE_SUCCESS = "Your Data has been Successfully Updated";
$MESG_TRANS_UPDATE_FAILURE = "Your Data has not been Updated Please try again";
$MESG_TRANS_DELETE_SUCCESS = "Your Data has been Successfully Deleted";
$MESG_TRANS_DELETE_FAILURE = "Unable to Delete Data";
$MESG_DEACTIVATE_SUCCESS = "Successfully Deactivated";
$MESG_ACTIVATE_SUCCESS = "Successfully Activated";
$MESG_NO_SUCH_ENTRY = "No Such Entry Found";
$MESG_UNKNOWN_ERROR = "Unknown Error found please try this process after some times";
$MESG_EMAIL_ALREADY = "Email Already Exists";
$MESG_USERNAME_ALREADY = "Username Already Exists";
$MESG_TRANS_MISMATCH = "Given data doesn't match";
$MESG_SESSION_EXPIRE = "Session has been expired please Re-Login";
	
$MESG_INVALID_USERNAME = "Invalid User Name OR Password";
$MESG_INVALID_PASSWORD = "Invalid Password";
$MESG_LOGIN_FIRST = "Welcome to Online Billing Login for first time";

$MESG_CREATE_FOLDER_SUCCESS = "Folder Successfully Created";
$MESG_DELETE_FOLDER_SUCCESS = "Folder Successfully Deleted";
$MESG_UNABLE_TO_CREATE_FOLDER = "Unable to Create Folder";
$MESG_UNABLE_TO_DELETE_FOLDER = "Unable to Delete Folder";
	
$MESG_CREATE_FILE_SUCCESS = "File Successfully Created";
$MESG_DELETE_FILE_SUCCESS = "File Successfully Deleted";
$MESG_UNABLE_TO_CREATE_FILE = "Unable to Create File";
$MESG_UNABLE_TO_DELETE_FILE = "Unable to Delete File";

$MESG_MAIL_TRANS_SUCCESS = "Your Mail has been Successfully Send to Destination.";
$MESG_MAIL_TRANS_FAILURE = "Some Error Occured in Mailing your Message Please Try Again";
$MESG_MAIL_TRANS_UNABLE = "Unable to Mailing your Message Please Try Again ";

$MESG_PERMISSION_DENIED = "Permission Denied";
$MESG_CANNOT_DELETE="There is only single Admin user so you cannot delete it";
$MESG_CANNOT_EDIT="There is only single Admin user so you cannot make it non Admin it";
$MESG_BLOCKED="Your Login has been Blocked Please contact Admin";


///////////////////////////////////new entries////////////////////////
$PAGE_TITLE="Linux Hosting Control Panel";
$USERNAME_NOT_EXIST=40;
$MESG_USERNAME_NOT_EXIST="User Name you are trying does not exist";
$MAIL_TRANS_FAILURE=41;
$ADMIN_EMAIL="admin@hostbankoi.com";
$SEND_ERROR=42;
$LOG_OUT=43;
$USERNAME_EMAIL_NOT_EXIST=44;
$MESG_USERNAME_EMAIL_NOT_EXIST="User Name or Email you are trying does not exist";
$PASSWORD_SENT=45;
$MESG_PASSWORD_SENT="Your password has been sent to your mail";

?>