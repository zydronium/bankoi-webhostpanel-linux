<?//echo "the name is " .$_SESSION["logoname"]?>
<table width="564" border="0" align="center" cellspacing="0" cellpadding="0" class="topHead">

  <tr> 
    <td width="100%"><div align="center">
        <p>&nbsp;</p>
        </div></td>
  </tr>
  <tr>
    <td valign="top"><div align="center"><img src="<?=$_SESSION["logoname"]?>" alt="LOGO"  width="88" height="66"></div></td>
  </tr>
  <tr> 
    <td height="42" valign="top"><table width="98%" border="0" align="center">
        <!--DWLayoutTable-->
        <tr valign="top"> 
          <td width="60" height="62" rowspan="4" align="left" bgcolor="#FFFFFF"> <p>
<?
	if(strtoupper($_SESSION["type"])=="A")
		{
?>     <input type="button" name="Button" value="Clients" onClick="window.location='../clients/clients.php'" class="navigationButton" title="Clients">
<?
		}
?>            </p>
            </td>
 <?
	if(strtoupper($_SESSION["type"])=="A")
		{
?>
          <!--<td width="97" align="center"><div align="center"> 
              <input type="button" name="Button2" value="New Client" onClick="window.location='../clients/newclient.php'" class="navigationButton" title="New Client">
            </div></td>-->

				  <td width="89" align="center"><div align="center"></div>
					<div align="center"> 
					  <input type="button" name="Button22" value="All Domains" onClick="window.location='../domains/domains.php'" class="navigationButton" title="All Domains">
					</div>
					<div align="center"></div></td>
<?
		}
	elseif(strtoupper($_SESSION["type"])=="C")
		{
?>
          <td width="89" align="center"> <div align="center"> 
              <input type="button" name="Button222" value="All Domains" onClick="window.location='../domains/clientdomains.php'" class="navigationButton" title="All Domains">
            </div>
            <div align="center"></div></td>
          <?
		}
	if(strtoupper($_SESSION["type"])=="A")
		{

?>
          <td width="199"> <div align="left">
              <input type="button" name="Button2222" value="Server" onClick="window.location='../server/server.php'" class="navigationButton" title="Manage Server">
            </div></td>
          <?}?>
          <td width="94" align="center"><div align="left"> 
              <input type="button" name="Button22222" value="Logout" onClick="window.location='../logout.php'" class="navigationButton" title="Logout">
            </div></td>
          <!--     <td width="130" align="center" valign="top"><img src="../skins/<?=$_SESSION["skin"]?>/icons/btn_extras_bg.gif" alt="Extras" width="32" height="32"></td>
          <td width="130" align="center" valign="top"><img src="../skins/<?=$_SESSION["skin"]?>/icons/btn_traffic_bg.gif" alt="Traffic" width="32" height="32"></td>
         -->
        </tr>
      </table></td>
  </tr>
</table>
