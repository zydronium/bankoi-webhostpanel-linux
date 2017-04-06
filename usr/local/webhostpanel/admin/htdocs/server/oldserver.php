<?$ACCESS_LEVEL=1;?>
<?include "../inc/connection.php"?>
<?include "../inc/params.php"?>
<?include "../inc/functions.php"?>
<?include "../inc/security.php"?>
<html>
<head>
</head>
<link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/general.css">
<link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/custom.css">
<link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/layout.css">
<body leftmargin=0 topmargin=0>
<script>
function reboot()
{
if(confirm("This will Reboot your system. You want to proceed"))
{
location.href = "../server/reboot.php";
}
}


function shutdown()
{
if(confirm("This will Shutdown your system. You want to proceed"))
{
location.href = "../server/shutdown.php";
}
}
</script>

<form name="mainform" action="" method="post">
  <?include "../inc/mainheader.php"?>
  <table width="80%" border="0" align="center" cellspacing="0" cellpadding="0">
    <?
	if(strtoupper($_SESSION["type"])=="A")
		{
?>
    <tr> 
      <td align="left" class="navigation">Administrator &gt; Servers</td>
    </tr>
    <?
		}
	elseif(strtoupper($_SESSION["type"])=="C")
		{
?>
    <?
		}
	elseif(strtoupper($_SESSION["type"])=="D")
		{
?>
    <?
		}
?>
    <tr> 
      <td>&nbsp;</td>
    </tr>
  </table>
  
  <table width="55%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#003366">
    <tr> 
      <td><table width="100%" border="0" align="center" cellspacing="0">
          <tr bgcolor="#DCDDF8"> 
            <td colspan="6" align="center"><div align="left"><strong><font color="#000000" size="2" face="Verdana, Arial, Helvetica, sans-serif">System</font></strong></div></td>
          </tr>
          <tr> 
            <td width="18%"  align="center"><div align="center"><a href="newserver.php"></a><a href="../server/serverip.php"><img src="../skins/<?=$_SESSION["skin"]?>/icons/btn_ip-pool_bg.gif" alt="Manage Ip" width="32" height="32" border="0"></a> 
              </div></td>
            <td width="13%"  ><div align="center"><img src="../skins/<?=$_SESSION["skin"]?>/icons/btn_system-time_bg.gif" alt="System Time" width="32" height="32"></div></td>
            <td width="17%"  ><div align="center"><img src="../skins/<?=$_SESSION["skin"]?>/icons/btn_statistics_bg.gif" alt="Statics" width="32" height="32"></div></td>
            <td width="16%"  ><div align="center"><img src="../skins/<?=$_SESSION["skin"]?>/icons/btn_support_bg.gif" alt="Support" width="32" height="32"></div></td>
            <td width="19%"  ><div align="center"><img src="../skins/<?=$_SESSION["skin"]?>/icons/btn_key-info_bg.gif" alt="Key Information" width="32" height="32"></div></td>
            <td width="17%"  ><div align="center"><img src="../skins/<?=$_SESSION["skin"]?>/icons/btn_comp-info_bg.gif" alt="Component Information" width="32" height="32"></div></td>
          </tr>
          <tr valign="top"> 
            <td align="center"><div align="center"><font color="#003366" size="1" face="Verdana, Arial, Helvetica, sans-serif"><a href="../server/serverip.php" style="text-decoration:none">ManageIP</a></font></div></td>
            <td> <div align="center"><font color="#003366" size="1" face="Verdana, Arial, Helvetica, sans-serif">System 
                Time &nbsp;</font></div></td>
            <td><div align="center"><font color="#003366" size="1" face="Verdana, Arial, Helvetica, sans-serif">Statistics</font></div></td>
            <td><div align="center"><font color="#003366" size="1" face="Verdana, Arial, Helvetica, sans-serif">support</font></div></td>
            <td><div align="center"><font color="#003366" size="1" face="Verdana, Arial, Helvetica, sans-serif">key 
                info</font></div></td>
            <td><div align="center"><font color="#003366" size="1" face="Verdana, Arial, Helvetica, sans-serif">component 
                info</font></div></td>
          </tr>
        </table></td>
    </tr>
  </table>
  <br>
  <br>
  <table width="55%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#003366">
    <tr>
      <td><table width="100%" border="0" align="center" cellspacing="0">
          <tr bgcolor="#DCDDF8"> 
            <td colspan="6" align="center"><div align="left"><strong><font color="#000000" size="2" face="Verdana, Arial, Helvetica, sans-serif">Services</font></strong></div></td>
          </tr>
          <tr> 
            <td align="center"><img src="../skins/<?=$_SESSION["skin"]?>/icons/btn_restart-services_bg.gif" alt="Manage Services" width="32" height="32"></td>
            <td align="center"><img src="../skins/<?=$_SESSION["skin"]?>/icons/btn_mail_bg.gif" alt="Mail" width="32" height="32"></td>
            <td align="center"><a href="dnsTemplate.php"><img src="../skins/<?=$_SESSION["skin"]?>/icons/btn_dns_bg.gif" alt="DNS" width="32" height="32" border="0"></a></td>
            <td align="center"><img src="../skins/<?=$_SESSION["skin"]?>/icons/btn_databases_bg.gif" alt="Databases" width="32" height="32"></td>
            <td  align="center"><img src="../skins/<?=$_SESSION["skin"]?>/icons/btn_crontab-win_bg.gif" alt="Manage Crontab" width="32" height="32"></td>
            <td  align="center"><img src="../skins/<?=$_SESSION["skin"]?>/icons/btn_certificates_bg.gif" alt="Certificates" width="32" height="32"></td>
          </tr>
          <tr valign="top"> 
            <td align="center"><font color="#003366" size="1" face="Verdana, Arial, Helvetica, sans-serif">Service 
              Management</font></td>
            <td align="center"><font color="#003366" size="1" face="Verdana, Arial, Helvetica, sans-serif">Mail</font></td>
            <td align="center"><font color="#003366" size="1" face="Verdana, Arial, Helvetica, sans-serif"><a href="dnsTemplate.php"  style="text-decoration:none">DNS</a></font></td>
            <td align="center"><font color="#003366" size="1" face="Verdana, Arial, Helvetica, sans-serif">Database</font></td>
            <td align="center"><font color="#003366" size="1" face="Verdana, Arial, Helvetica, sans-serif">Crontab 
              Manager</font></td>
            <td align="center"><font color="#003366" size="1" face="Verdana, Arial, Helvetica, sans-serif">Certificates</font></td>
          </tr>
          <tr> 
            <td align="center"><font color="#003366" size="2" face="Verdana, Arial, Helvetica, sans-serif">&nbsp;</font></td>
            <td align="center"><font color="#003366" size="2" face="Verdana, Arial, Helvetica, sans-serif">&nbsp;</font></td>
            <td align="center"><font color="#003366" size="2" face="Verdana, Arial, Helvetica, sans-serif">&nbsp;</font></td>
            <td align="center"><font color="#003366" size="2" face="Verdana, Arial, Helvetica, sans-serif">&nbsp;</font></td>
            <td align="center"><font color="#003366" size="2" face="Verdana, Arial, Helvetica, sans-serif">&nbsp;</font></td>
            <td align="center"><font color="#003366" size="2" face="Verdana, Arial, Helvetica, sans-serif">&nbsp;</font></td>
          </tr>
          <tr> 
            <td align="center"><font color="#003366" size="2" face="Verdana, Arial, Helvetica, sans-serif"><img src="../skins/<?=$_SESSION["skin"]?>/icons/btn_skeleton_bg.gif" alt="Skeleton" width="32" height="32"></font></td>
            <td align="center"><font color="#003366" size="2" face="Verdana, Arial, Helvetica, sans-serif"><img src="../skins/<?=$_SESSION["skin"]?>/icons/btn_maillists-disabled_bg.gif" alt="Mailman Settings" width="32" height="32"></font></td>
            <td align="center"><font color="#003366" size="2" face="Verdana, Arial, Helvetica, sans-serif"><img src="../skins/<?=$_SESSION["skin"]?>/icons/btn_cf-configure_bg.gif" alt="Cold Fusion" width="32" height="32"></font></td>
            <td align="center"><font color="#003366" size="2" face="Verdana, Arial, Helvetica, sans-serif"><img src="../skins/<?=$_SESSION["skin"]?>/icons/btn_site-apppkgs_bg.gif" alt="Application Vault" width="32" height="32"></font></td>
            <td align="center"><font color="#003366" size="2" face="Verdana, Arial, Helvetica, sans-serif"><img src="../skins/<?=$_SESSION["skin"]?>/icons/btn_spam-assassin_bg.gif" alt="SpamAssassin" width="32" height="32"></font></td>
            <td align="center"><font color="#003366" size="2" face="Verdana, Arial, Helvetica, sans-serif">&nbsp;</font></td>
          </tr>
          <tr> 
            <td align="center" valign="top"><font color="#003366" size="1" face="Verdana, Arial, Helvetica, sans-serif">Skeleton</font></td>
            <td align="center" valign="top"><font color="#003366" size="1" face="Verdana, Arial, Helvetica, sans-serif">Mailman 
              Setting</font></td>
            <td align="center" valign="top"><font color="#003366" size="1" face="Verdana, Arial, Helvetica, sans-serif">ColdFusion 
              Setting</font></td>
            <td align="center" valign="top"><font color="#003366" size="1" face="Verdana, Arial, Helvetica, sans-serif">Application 
              Vault</font></td>
            <td align="center" valign="top"><font color="#003366" size="1" face="Verdana, Arial, Helvetica, sans-serif">SpamAssassin</font></td>
            <td align="center"><font color="#003366" size="2" face="Verdana, Arial, Helvetica, sans-serif">&nbsp;</font></td>
          </tr>
        </table></td>
    </tr>
  </table>
  <br>
<br>
  <table width="55%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#003366">
    <tr>
      <td><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr bgcolor="#DCDDF8"> 
            <td colspan="6" align="center"><div align="left"><strong><font color="#000000" size="2" face="Verdana, Arial, Helvetica, sans-serif">Control 
                Panel</font></strong></div></td>
          </tr>
          <tr> 
            <td align="center"><img src="../skins/<?=$_SESSION["skin"]?>/icons/btn_logo_bg.gif" alt="Loop Seup" width="32" height="33" border="0"></td>
            <td align="center"><img src="../skins/<?=$_SESSION["skin"]?>/icons/btn_session-setup_bg.gif" alt="Session Setting" width="32" height="32"></td>
            <td  align="center"><img src="../skins/<?=$_SESSION["skin"]?>/icons/btn_preferences_bg.gif" alt="Preferences" width="32" height="32"></td>
            <td align="center"><img src="../skins/<?=$_SESSION["skin"]?>/icons/btn_add-services_bg.gif" alt="Add Services" width="32" height="32"></td>
            <td align="center"><img src="../skins/<?=$_SESSION["skin"]?>/icons/btn_notifications_bg.gif" alt="Notifications" width="32" height="32"></td>
            <td align="center"><img src="../skins/<?=$_SESSION["skin"]?>/icons/btn_action-log_bg.gif" alt="Action Log" width="32" height="32"></td>
          </tr>
          <tr valign="top"> 
            <td align="center"><font color="#003366" size="1" face="Verdana, Arial, Helvetica, sans-serif">Loop 
              Seup</font></td>
            <td align="center"><font color="#003366" size="1" face="Verdana, Arial, Helvetica, sans-serif">Session 
              Setting</font></td>
            <td align="center"><font color="#003366" size="1" face="Verdana, Arial, Helvetica, sans-serif">Preferences</font></td>
            <td align="center"><font color="#003366" size="1" face="Verdana, Arial, Helvetica, sans-serif">Add 
              Services</font></td>
            <td align="center"><font color="#003366" size="1" face="Verdana, Arial, Helvetica, sans-serif">Notifications</font></td>
            <td align="center"><font color="#003366" size="1" face="Verdana, Arial, Helvetica, sans-serif">Action 
              Log</font></td>
          </tr>
          <tr> 
            <td align="center"><font color="#003366" size="2" face="Verdana, Arial, Helvetica, sans-serif">&nbsp;</font></td>
            <td align="center"><font color="#003366" size="2" face="Verdana, Arial, Helvetica, sans-serif">&nbsp;</font></td>
            <td align="center">&nbsp;</td>
            <td align="center">&nbsp;</td>
            <td align="center">&nbsp;</td>
            <td align="center">&nbsp;</td>
          </tr>
          <tr> 
            <td align="center"><font color="#003366" size="2" face="Verdana, Arial, Helvetica, sans-serif"><img src="../skins/<?=$_SESSION["skin"]?>/icons/btn_custom-buttons_bg.gif" alt="Custom Button" width="32" height="32"></font></td>
            <td align="center"><font color="#003366" size="2" face="Verdana, Arial, Helvetica, sans-serif">&nbsp;</font></td>
            <td align="center">&nbsp;</td>
            <td align="center">&nbsp;</td>
            <td align="center">&nbsp;</td>
            <td align="center">&nbsp;</td>
          </tr>
          <tr> 
            <td valign="top" ><div align="center"><font color="#003366" size="1" face="Verdana, Arial, Helvetica, sans-serif">Custom 
                Button</font></div></td>
            <td ><font color="#003366" size="2" face="Verdana, Arial, Helvetica, sans-serif">&nbsp;</font></td>
            <td >&nbsp;</td>
            <td >&nbsp;</td>
            <td >&nbsp;</td>
            <td >&nbsp;</td>
          </tr>
        </table></td>
    </tr>
  </table>
  <br>
  <br>
  <br>
  <br>
  <table width="55%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#003366">
    <tr>
      <td><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr bgcolor="#DCDDF8"> 
            <td colspan="4" align="center"><div align="left"><font color="#000000" size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong>Administrator 
                information</strong></font></div></td>
            <td colspan="2" align="center"><div align="left"><font color="#000000" size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong>Power 
                management</strong></font></div></td>
          </tr>
          <tr> 
            <td width="16%"  align="center"><div align="center"><a href="newserver.php"></a><a href="admincontact.php"><img src="../skins/<?=$_SESSION["skin"]?>/icons/btn_edit_bg.gif" alt="Edit Admin Info" width="32" height="32" border="0"></a> 
              </div></td>
            <td width="19%" ><div align="center"><a href="adminpassword.php"><img src="../skins/<?=$_SESSION["skin"]?>/icons/btn_change-passwd_bg.gif" alt="Change Password" width="32" height="32" border="0"></a></div></td>
            <td width="17%" ><div align="center"><img src="../skins/<?=$_SESSION["skin"]?>/icons/btn_access_bg.gif" alt="Access" width="32" height="32"></div></td>
            <td width="5%" ><div align="center"></div></td>
            <td width="16%" ><div align="center"><a href="javascript:onClick=reboot();"><img src="../skins/<?=$_SESSION["skin"]?>/icons/btn_reboot_bg.gif" alt="Reboot" width="32" height="32" border="0"></a></div></td>
            <td width="27%" ><div align="center"><a href="javascript:onClick=reboot();"><img src="../skins/<?=$_SESSION["skin"]?>/icons/btn_shutdown_bg.gif" alt="Shut Down" width="32" height="32" border="0"></a></div></td>
          </tr>
          <tr> 
            <td align="center" valign="top"><div align="center"><font color="#003366" size="1" face="Verdana, Arial, Helvetica, sans-serif"><a href="admincontact.php"  style="text-decoration:none">Edit 
                Admin Info</a></font></div></td>
            <td> <div align="center"><font color="#003366" size="1" face="Verdana, Arial, Helvetica, sans-serif"><a href="adminpassword.php"  style="text-decoration:none">Change 
                Password</a> &nbsp;</font></div></td>
            <td valign="top"><div align="center"><font color="#003366" size="1" face="Verdana, Arial, Helvetica, sans-serif">Access</font></div></td>
            <td valign="top"><div align="center"><font size="2"><font face="Verdana, Arial, Helvetica, sans-serif"><font size="1"><font face="Verdana, Arial, Helvetica, sans-serif"><font size="1"></font></font></font></font></font></div></td>
            <td valign="top"><div align="center"><font color="#003366" size="1" face="Verdana, Arial, Helvetica, sans-serif"><a href="javascript:onClick=reboot();">Reboot</a></font></div></td>
            <td valign="top"><div align="center"><font color="#003366" size="1" face="Verdana, Arial, Helvetica, sans-serif"><a href="javascript:onClick=shutdown();">Shut Down</a></font></div></td>
          </tr>
        </table></td>
    </tr>
  </table>
  <br>
  <br>
  <p>&nbsp;</p>
</form>
</head>
</html>
<? include "../inc/footer.php" ?>