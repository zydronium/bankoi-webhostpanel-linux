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
<form name="form1" action="" method="post">
       <?include "../inc/mainheader.php"?>
	  <table align="center" cellspacing="2">
	  <tr>
      <td class="clientheading">IP Listing</td>
    </tr>
		<tr><td><img src="/skins/<?=$_SESSION["skin"]?>/elements/line.gif" width=564 height=1 border=0></td></tr>
		<tr><td><table width="341" align="center">
		<?
		$query="select * from tblserverip";
		//myLog($query);
		$rs=mysql_query($query) or die(errorCatch(mysql_error()));;
		$n=mysql_affected_rows();
		$flag=0;
		if($n>0){
		for($i=0;$i<$n;$i++){
		$result=mysql_fetch_array($rs);
		if(strtoupper($result["iptype"])=="SHARED") $flag=1;
		?>
		<tr>
            <td width="136"> <font color="#3366FF" size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
              <?=$result["ipaddress"];?>
              </font></td>
			      <td width="22"> <font color="#FF0000" size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
              <?=$result["iptype"];?>
              </font></td>
			      
            <td width="50"> <div align="right"><font color="#3366FF" size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
                <input name="id[]" type="checkbox" id="id[]" value="<?=$result['Id'];?>">
                </font></div></td>
          </tr>
		<?
		}
		?>
		<tr><td colspan="3" align="right"><input name="Submit" type="submit" class="commonButton" id="bid-up-level"  onClick="chk_frm(document.form1);" value="Remove"></td></tr>
		<?}
		else{
		?>
		<tr><td colspan="3">No IP Adresses found</td></tr>
		<?
		}
		?>
		
		</table></td></tr>
		<tr><td><img src="/skins/default/elements/line.gif" width=564 height=1 border=0></td></tr>
      <tr>
      <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><br>Add new IP address</font></td>
    </tr>
		<tr><td><img src="/skins/default/elements/line.gif" width=564 height=1 border=0></td></tr>
		  <tr>
      <td align="center"><font color="#FF0000" size="1" face="Verdana, Arial, Helvetica, sans-serif">There 
        should be only one</font><font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 
        <font color="#3333FF">shared</font> <font color="#FF0000">IP</font></font></td>
    </tr>
  <tr><td><table width="56%" border="0" align="center" cellspacing="2">
    <tr>
      <td><div align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">New 
                IP Address</font></div></td>
      <td><input name="ipaddress" type="text" id="ipaddress"></td>
    </tr>
    <tr>
      <td><div align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">IP 
                Type</font></div></td>
      <td><select name="iptype">
<?
		if($flag==0)
			{
?>
	  <option value="Shared">Shared</option>
<?
			}
?>
  	  <option value="Exclusive">Exclusive</option>
        </select></td>
    </tr>
  </table>
	</td></tr>
	<tr><td><img src="/skins/default/elements/line.gif" width=564 height=1 border=0></td></tr>
</table>


  <p align="center"> 
    <input type="submit" class="commonButton" name="Submit" value="Add IP"  onClick="document.form1.action='addIP.php';if(document.form1.ipaddress.value=='') {alert('provide value for IP address');document.form1.ipaddress.focus();return false;} else if(!chk_ip(document.form1.ipaddress.value)){ alert('IP address is not proper'); return false;}">
    <input type="button" class="commonButton" name="Submit2" value="Cancel" onclick="javascript:history.back();">
  </p>
</form>
</head>
</html>
<? include "../inc/footer.php" ?>
<script>
function chk_frm(f)
			{
				var counter;
				counter=0;
				for (i = 0 ; i < f.elements.length; i++) 
					{
					if ((f.elements[i].type == "checkbox") && (f.elements[i].name.indexOf("id")==0)) 
						{
						if (f.elements[i].checked) 
							{
								counter=counter+1;
							}
						}
					}
				if(counter==0)
				{
					alert("No IPs to delete");
					return false;
				}
				else
				{
					f.action="removeIP.php";
				}
			}
</script>
<script>
function chk_ip(ip)
{
	re = /^(\d{1,3})\.(\d{1,3})\.(\d{1,3})\.(\d{1,3})$/;
	found = ip.match(re);
	if (!found)
		return false;
	for (i = found.length; i-- > 1;)  {
		if ((found[i] < 0) || (found[i] > 255))
			return false;
	}
	return true;
}
</script>