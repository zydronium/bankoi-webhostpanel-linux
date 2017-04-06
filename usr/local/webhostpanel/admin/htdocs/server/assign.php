<?$ACCESS_LEVEL=2;?>
<?include "../inc/connection.php"?>
<?include "../inc/params.php"?>
<?include "../inc/functions.php"?>
<?include "../inc/security.php"?>
<html>
<head>
<title>Manage IP for Client</title>
</head>
<link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/general.css">
<link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/custom.css">
<link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/layout.css">
<body leftmargin=0 topmargin=0>
<form name="form1" action="assignIP.php" method="post">
  <?include "../inc/mainheader.php"?>
  <?include "../clients/clientheader.php"?>
  <!--<table width="61%" border="0" align="center" cellspacing="0" cellpadding="0">
    <?
	if(strtoupper($_SESSION["type"])=="A")
		{
?>
    <tr> 
      <td align="left" class="navigation">Administrator &gt; 
        <?=$_SESSION["clientname"]?>
        &gt; Manage IP Address</td>
    </tr>
    <?
		}
	elseif(strtoupper($_SESSION["type"])=="C")
		{
?>
    <tr> 
      <td align="left" class="navigation"> 
        <?=$_SESSION["clientname"]?>
        &gt; Manage IP Address</td>
    </tr>
    <?
		}
	elseif(strtoupper($_SESSION["type"])=="D")
		{
?>
    <tr> 
      <td align="left" class="navigation"></td>
    </tr>
    <?
		}
?>
    <tr> 
      <td>&nbsp;</td>
    </tr>
  </table>-->
  <table align="center" cellspacing="2">
    <tr> 
      <th colspan="3" class="headings"><div align="center">The IP addresses assigned 
          to <font color="#FF0000"><strong><?=$_SESSION["clientname"]?></strong> 
          </font></div></tr>
    <tr> 
      <td colspan="3"><table width="288" align="center">
          <?
		
		$query="select tblserverip.* from tblserverip,tblresellerip where tblserverip.Id=tblresellerip.ipaddress and resellerid='".$_SESSION["clientid"]."'";
		//myLog($query);
		$rs=mysql_query($query) or die(errorCatch(mysql_error()));
		$n=mysql_affected_rows();
		$flag=0;
		if($n>0){
		while($result=mysql_fetch_array($rs))
			{		
				if($result["iptype"]=="Shared") $flag=1;
		?>
          <tr> 
            <td width="88" class="headings" align="right"><font color="blue""><strong>
              <?=$result["ipaddress"];?></strong></font> 
            </td>
            <td width="60" class="headings" align="right"> 
              <?=$result["iptype"];?>
              <div align="center"></div>
              <div align="center"></div>
              <div align="center"></div></td>
            <td width="124"> <div align="center" class="headings"> 
<?
         if(strtoupper($_SESSION["type"])=="A")
					{
?>
                <input name="id[]" type="checkbox" id="id[]" value="<?=$result['Id'];?>">
                <? 
					} 
?>
              </div>
              <? 
					} 
?>
            </td>
          </tr>
          <?

         if(strtoupper($_SESSION["type"])=="A")
					{
?>
          <tr> 
            <td colspan="3" align="right"><input class="commonButton" type="button" value="Remove" onClick="chk_frm(document.form1);"></td>
          </tr>
          <?
					}
?>
          <?}
		else{
		?>
          <tr> 
            <td colspan="3" class="headings">No IP Adresses assigned</td>
          </tr>
          <?
		}
		?>
        </table></td>
    </tr>
    <tr> 
      <td colspan="3">&nbsp;</td>
    </tr>
    <?
			if($flag==0){
				$query ="select * from tblserverip where isavailable='y'";
            }
			else{
				$query ="select * from tblserverip where isavailable='y' and iptype <> 'Shared'";
			}
			//myLog($query);
			$rs=mysql_query($query) or die(errorCatch(mysql_error()));
			$n=mysql_affected_rows();
			
			if($n>0){
				if(strtoupper($_SESSION["type"])=="A")
					{
?>
    <tr> 
      <td colspan="3" class="headings"><br>
      </td>
    </tr>
    <tr> 
      <th height="21" colspan="3">Assign IP address to <font color="#FF0000"><strong><?=$_SESSION["clientname"]?></strong></font></td>
    </tr>
    <tr valign="middle"> 
      <td width="290" align="center" valign="top" ><div align="right" class="headings">Select 
          IP Address </div></div>
        <div align="right"></div></td>
      <td width="29" align="center" valign="top" >&nbsp;</td>
      <td width="328" align="center" valign="top" ><div align="left"> 
          <select name="ips[]" size="6" multiple id="ips" class="dropdown">
            <?
			while($result=mysql_fetch_array($rs))
				{
			?>
            <option value="<?=$result['Id']?>"> 
            <?=$result['ipaddress']?>
            / 
            <?=$result['iptype']?>
            </option>
            <?
				}
			?>
          </select>
        </div></td>
    </tr>
    <tr> 
      <td colspan="3"><img src="/skins/default/elements/line.gif" width=564 height=1 border=0></td>
    </tr>
  </table>


  <p align="center"> 
    <input type="submit" class="commonButton" name="Submit" value="Assign"  onClick="if(document.all.ips.selectedIndex==-1){alert('plz select IP address');return false;}">
    <input type="button" class="commonButton" name="Submit2" value="Cancel" onclick="window.location='../domains/clientdomains.php'">
  </p>
			
<?
}}
?>
</form>
</head>
</html>
<br><br>
<? include "../inc/footer.php"?>
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
					f.action="removeAssignedIP.php";
					f.submit();
				}
			}
</script>
