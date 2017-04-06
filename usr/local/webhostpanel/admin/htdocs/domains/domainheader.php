<body>
<?
	include "../inc/connection.php";
	$flagCheck = 0;
	$dmnid = $_SESSION["domainid"];
	$query = "Select * from tbldomainrights where domainid='$dmnid'";
	$ResultArr = @mysql_query($query);
	if(mysql_num_rows($ResultArr) == 0)
		{
?>
			<script>
				//alert("Sorry no entry found in the database for this Domain");
				//window.location = "../domains/showdomaindetails.php";
			</script>
<?
		}
	else
		{
			$ArrayRes = mysql_fetch_array($ResultArr);
			$pwdProtect = strtoupper($ArrayRes["pwdprotectdir"]);
			$CgiSuppo = strtoupper($ArrayRes["cgisupport"]);
			$FpExt = strtoupper($ArrayRes["frontpageext"]);
			$webst = strtoupper($ArrayRes["webstart"]);

		}
?>
<table width="72%" border="0" align="center">
  <tr>
    <td><div align="center">Domain 
         
        <font color="#FF0000" size="2" face="Verdana, Arial, Helvetica, sans-serif"><?=strtoupper($_SESSION["domainname"])?></font>
        of <font color="#FF0000" size="2" face="Verdana, Arial, Helvetica, sans-serif"><?=strtoupper($_SESSION["clientname"])?></font> </div></td>
  </tr>
</table>
<table width="564" border="0" align="center">
  <tr> 

    <td width="121" align="center"> <div align="left"> 
        <input type="button" name="Button" value="Domain Home" onClick="window.location='../domains/showdomaindetails.php'" class="commonbutton" title="Domain Home">
      </div></td>
    <td width="115"  align="center"><div align="right"> 
        <input type="button" name="Button2" value="Mail Account" onClick="window.location='../mails/newmail.php'" class="commonbutton" title="Mail Account">
      </div></td>
    <td width="99" align="center"><div align="right"> 
        <input type="button" name="Button3" value="Mail Alias" onClick="window.location='../mails/listmail.php'" class="commonbutton" title="Mail Alias">
      </div></td>
    <?
if(strtoupper($_SESSION["type"])=="A" || strtoupper($_SESSION["type"])=="C")
		{    
?>
    <td width="121" align="center"><div align="right"> 
        <input type="button" name="Button4" value="DNS" onClick="window.location='../domains/dnsEntry.php'" class="commonbutton" title="DNS">
      </div></td>
    <?
		}
		
		
	if(strtoupper($_SESSION["type"])=="D")
		{
			
			if($pwdProtect == "Y")
				{
?>
    <td width="91"  align="center"> <div align="left">
        <input type="button" name="Button5" value="Directory" onClick="window.location='../domains/explorer.php'" class="commonbutton" title="Directory">
      </div></td>
    <?
				}
			else
				{
?>
    <td width="131"  align="center"> <div align="left">
        <input type="button" name="Button6" value="Directory" onClick="window.location='#'" class="commonbutton" title="Directory">
      </div></td>
    <?
				}
		}
	
	if(strtoupper($_SESSION["type"])=="A" || strtoupper($_SESSION["type"])=="C")
		{
?>
    <td width="68"  align="center"><div align="right"> 
        <input type="button" name="Button7" value="Directory" onClick="window.location='../domains/explorer.php'" class="commonbutton" title="Directory">
      </div></td>
    <?
		}
?>
<tr><td width="78" align="center"> <input type="button" name="Button8" value="Databases" onClick="window.location='../domains/managedatabase.php'" class="commonbutton" title="Databases"> 
    </td>
    <td width="115" align="center"><div align="right"> 
        <input type="button" name="Button9" value="Crontab Manager" onClick="window.location='../domains/crontabmanager.php'" class="commonbutton" title="Crontab Manager">
      </div></td>
    <td width="99" align="center"><div align="right"> 
        <input type="button" name="Button10" value="FP-Webadmin" onClick="window.location='../domains/fplogin.php'" class="commonbutton" title="FP-Webadmin">
      </div></td>

 
    <td width="121" align="center"><div align="right"> 
        <input type="button" name="Button11" value="Change Password" onClick="window.location='../domains/changepassword.php'" class="commonbutton" title="Change Password">
      </div></td>
    <td width="91" align="center"><div align="right"> 
        <input type="button" name="Button12" value="Log Manager" onClick="window.location='../domains/logrotate.php'" class="commonbutton" title="Log Manager">
      </div></td>
<tr>    <td width="131" align="center"><div align="right"> 
        <input type="button" name="Button13" value="Manage Subdomain" onClick="window.location='../domains/managesubdomain.php'" class="commonbutton" title="Manage Subdomain">
      </div></td>
  </tr>
</table>
</body>
