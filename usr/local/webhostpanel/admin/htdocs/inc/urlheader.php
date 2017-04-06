<?//echo "the name is " .$_SESSION["logoname"]?>
<table width="86%" border="0" align="center" cellspacing="0" cellpadding="0">
  <?
	if(strtoupper($_SESSION["type"])=="A")
		{
?>
		<tr> 
			<td width="30%" align="left" background="../Icons/top_bg.jpg"><font color="#FFFFFF" face="Verdana"><strong>LINUX 
			  Control Panel </strong></font></td>
			<td width="70%" align="right" background="../Icons/top_bg.jpg"><font color="#FFFFFF" face="Verdana"><strong><font size="1">[Welcome ADMIN ]</font></strong></font></td>
		</tr>
  <?
		}
	elseif(strtoupper($_SESSION["type"])=="C")
		{
?>
		<tr> 
			<td width="30%" align="left" background="../Icons/top_bg.jpg"><font color="#FFFFFF" face="Verdana"><strong>LINUX 
			  Control Panel </strong></font></td>
			<td width="70%" align="right" background="../Icons/top_bg.jpg"><font color="#FFFFFF" face="Verdana"><strong><font size="1">[WELCOME <?=$_SESSION["clientname"]?> ]</font></strong></font></td>
		</tr>

<?
		}
	elseif(strtoupper($_SESSION["type"])=="D")
		{
?>
		<tr> 
			<td width="30%" align="left" background="../Icons/top_bg.jpg"><font color="#FFFFFF" face="Verdana"><strong>LINUX 
			  Control Panel </strong></font></td>
			<td width="70%" align="right" background="../Icons/top_bg.jpg"><font color="#FFFFFF" face="Verdana"><strong><font size="1">[WELCOME <?=$_SESSION["domainname"]?> ]</font></strong></font></td>
		</tr>

<?
		}
?>
  <tr> 
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr> 
    <td height="98" colspan="2" valign="top"><table width="100%" border="0">
        <!--DWLayoutTable-->
        <tr> 
          <td width="175" rowspan="4" align="left" bgcolor="#FFFFFF"> <p><img src="<?=$_SESSION["logoname"]?>" alt="LOGO"  width="88" height="86"></p></td>
          <?
	if(strtoupper($_SESSION["type"])=="A")
		{
?>
          <td width="106" height="36" align="center"><div align="center"><a href="../clients/clients.php"><img alt="Clients" border="0" src="../Icons/btn_client-templates_bg.gif" width="32" height="32"></a></div></td>
          <?
		}
	else
?>
          <td width="11" align="center"><div align="center"></div></td>
          <?
	if(strtoupper($_SESSION["type"])=="A")
		{
?>
          <td width="91" align="center"><div align="center"><a href="../clients/newclient.php"><img border="0" alt="Add New Client" src="../Icons/btn_new-client_bg.gif" width="32" height="32"></a></div></td>
          <?
		}
	else
?>
          <td width="8" align="center"><div align="center"></div></td>
          <?
	if(strtoupper($_SESSION["type"])=="A")
		{
?>
          <td width="107" align="center"> <div align="center"><a href="../domains/domains.php"><img  alt="View All Domains" border="0" src="../Icons/btn_domain-user_bg.gif" width="32" height="32"></a></div></td>
          <?
		}
	elseif(strtoupper($_SESSION["type"])=="C")
		{
?>
          <td width="6"><div align="center"></div></td>
          <td width="96" align="center" valign="top"> <div align="center"><a href="../domains/clientdomains.php"><img  alt="View All Domains" border="0" src="../Icons/btn_domain-user_bg.gif" width="32" height="32"></a></div></td>
          <?
		}
	if(strtoupper($_SESSION["type"])=="A")
		{

?>
          <td width="0"><div align="center"></div></td>
          <td width="20"><div align="center"><a href="../server/server.php"><img src="../Icons/btn_site-apppkgs_bg.gif" width="32" height="32" border="0"></a></div></td>
          <td width="-1"><!--DWLayoutEmptyCell-->&nbsp;</td><?}?>
          <td width="130" align="center" valign="top"><div align="center"><a href="../logout.php"><img alt="Logout"  border="0" src="../Icons/btn_backup_bg.gif" width="32" height="32"></a></div></td>
          <!--     <td width="130" align="center" valign="top"><img src="../Icons/btn_extras_bg.gif" alt="Extras" width="32" height="32"></td>
          <td width="130" align="center" valign="top"><img src="../Icons/btn_traffic_bg.gif" alt="Traffic" width="32" height="32"></td>
         -->
        </tr>
        <tr> 
          <?
	if(strtoupper($_SESSION["type"])=="A")
		{
?>
          <td height="21" align="center" valign="top"><div align="center"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><a href="/clients/clients.php" style="text-decoration:none">Clients</a></font></div></td>
          <?
		}
	else
?>
          <td width="11" align="center" valign="top"><div align="center"><font size="1"><font face="Verdana, Arial, Helvetica, sans-serif"><font size="1"></font></font></font></div></td>
          <?
	if(strtoupper($_SESSION["type"])=="A")
		{
?>
          <td align="center" valign="top"><div align="center"><font color="#003366" size="1" face="Verdana, Arial, Helvetica, sans-serif"><a href="../clients/newclient.php" style="text-decoration:none">New 
              Client</a></font></div></td>
          <?
		}
	else
?>
          <td width="8" align="center" valign="top"><div align="center"><font size="1"><font face="Verdana, Arial, Helvetica, sans-serif"><font size="1"></font></font></font></div></td>
          <?
	if(strtoupper($_SESSION["type"])=="A")
		{
?>
          <td align="center" valign="top"> <div align="center"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><a href="../domains/domains.php" style="text-decoration:none">All 
              Domains</a></font></div></td>
          <?
		}
	elseif(strtoupper($_SESSION["type"])=="C")
		{
?>
          <td align="center" valign="top"> <div align="center"><font size="1"><font face="Verdana, Arial, Helvetica, sans-serif"><font size="1"></font></font></font></div></td>
          <td align="center" valign="top"><div align="center"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><a href="../domains/clientdomains.php" style="text-decoration:none">All 
              Domains</a></font></div></td>
          <?
		}
	
	if(strtoupper($_SESSION["type"])=="A")
		{
?>
          <td align="center" valign="top"><div align="center"><font size="1"><font face="Verdana, Arial, Helvetica, sans-serif"><font size="1"> 
              </font></font></font></div></td>
          <td width="20" align="center" valign="top"><div align="center"><font size="1"><font face="Verdana, Arial, Helvetica, sans-serif"><font size="1"><a href="../server/server.php" style="text-decoration:none">Manage 
              Server</a></font></font></font></div></td>
 
          <td align="center" valign="top"><!--DWLayoutEmptyCell-->&nbsp;</td><?}?>
          <td align="center" valign="top"><font color="#003366" size="1" face="Verdana, Arial, Helvetica, sans-serif"><a href="../logout.php" style="text-decoration:none">Logout</a></font></td>
          <td align="center" valign="top"><!--DWLayoutEmptyCell-->&nbsp;</td>
         
        </tr>
        <tr> 
          <td height="21" colspan="14" align="center" valign="top" background="/Icons/line.jpg"></td>
        </tr>
      </table></td>
  </tr>
</table>
