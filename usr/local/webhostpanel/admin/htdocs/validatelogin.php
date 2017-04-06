<?php
	include "inc/connection.php";
	include "inc/params.php";
	include "inc/constants.php";
	include "inc/MyLogger.php";


	$loginname=$_POST["loginname"];
	$toemail=$_POST["email"];

	$query="select * from tblloginmaster where username='$loginname'";
	//echo $query;
	$result = mysql_query($query) or die (errorCatch(mysql_error())); 

	if(!$row = mysql_fetch_array($result)) 
		{
			header("Location: get_password.php?mode=$USERNAME_EMAIL_NOT_EXIST");
		}
	else
		{
			$id=$row["typeid"];
			$pass=$row["password"];
			$type=$row["usertype"];
			
			//echo $id;
			//echo $pass;
			//echo $type;

			if(strtoupper($type)=="C")
				{
					$query="select email from tblclientcontact where resellerid=$id and email='$toemail'";
					//echo $query;
					$mailResult = mysql_query($query) or die (errorCatch(mysql_error())); 
					if(mysql_num_rows($mailResult)==0) 
						{
							header("Location: get_password.php?mode=$USERNAME_EMAIL_NOT_EXIST");
						}
				}
			if(strtoupper($type)=="D")
				{
					$query="select email from tbldomaincontact where domainid=$id and email='$toemail'";
					//echo $query;
					$mailResult = mysql_query($query) or die (errorCatch(mysql_error())); 
					if(mysql_num_rows($mailResult)==0) 
					{
						header("Location: get_password.php?mode=$USERNAME_EMAIL_NOT_EXIST");
					}
				}
			if(strtoupper($type)=="A")
				{
					$query="select email from tbladmincontact where adminid=$id and email='$toemail'";
					//echo $query;
					$mailResult = mysql_query($query) or die (errorCatch(mysql_error())); 
					if(mysql_num_rows($mailResult)==0) 
					{
						header("Location: get_password.php?mode=$USERNAME_EMAIL_NOT_EXIST");
					}
				}
			else
				{
					$body="<font face='verdana' size='2' color='blue'>Dear </font><font face='verdana' size='2' color='red'>" . $loginname . ",</font><font face='verdana' size='2' color='blue'><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Your username and password are:-<br><br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>USERNAME=</b> </font><font face='verdana' size='2' color='red'>" . $loginname . "</font><font face='verdana' size='2' color='blue'><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Password=</b> </font><font face='verdana' size='2' color='red'>" . $pass . "<br><br>&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp Thankyou</font>";	
				
					//$body="Username = " . $loginname . "\n Password = " . $pass  . "\nThank You";
		
	
					//-------------------------------------------------------------------------------------------------------
					$mail_subject="Linux Control Panel password";
					$mail_body=$body;
					$mail_from="admin@linuxcp.com";
					$mail_to = $toemail;
					$mail_headers = "Content-type: text/html; charset=iso-8859-1\n";
					$mail_headers .= "From: $mail_from\n";

					if(@mail($mail_to, $mail_subject, $mail_body, $mail_headers))
						{
							echo "<center><font face='verdana' size='2' color='red'>The mail has been successfully send   to </font><font face='verdana' size='2' color='blue'>" . $toemail . "</font></center>";
?>
					<script>
						alert("The password is send to your email.Kindly check your mail for the password!");
						window.location="login.php";
					</script>
<?
						}
					else
						  echo "Sorry unable to send mail";
				}
		}
?>
