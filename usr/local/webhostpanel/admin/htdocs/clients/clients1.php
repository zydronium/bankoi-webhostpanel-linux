<? $ACCESS_LEVEL=1; ?>
<?
include "../inc/connection.php";
include "../inc/params.php";
include "../inc/functions.php";
include "../inc/security.php";
include "../inc/constants.php";
?>

<html>
<head>
<title>Clients Listing</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head><link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/general.css">
<link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/custom.css">
<link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/layout.css">
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=ISO-8859-1">
<META HTTP-EQUIV="EXPIRES" CONTENT="0">
<script>
function invertChecked()
			{
				f = document.mainform;
				for (i = 0 ; i < f.elements.length; i++) {
					if ((f.elements[i].type == "checkbox") && (f.elements[i].name.indexOf("delclients")==0)) {
						if (f.elements[i].checked || (f.elements[i].value == "DISABLED") || f.elements[i].disabled) {
							f.elements[i].checked = false;
						} else {
							f.elements[i].checked = true;
						}
					}
				}
			}
function chk_frm(f)
			{
				var counter;
				counter=0;
				for (i = 0 ; i < f.elements.length; i++) 
					{
					if ((f.elements[i].type == "checkbox") && (f.elements[i].name.indexOf("delclients")==0)) 
						{
						if (f.elements[i].checked) 
							{
								counter=counter+1;
							}
						}
					}
					//alert();
				if(counter==0)
				{
					alert("No clients to delete");
					//f.action="../clients/clients.php";
					//f.submit();
					return false;
				}
				else
				{
					//alert();
					f.action="../clients/deleteclients.php";
					f.submit();
					return false;
				}
				
			}
			
	function searchclient()
	{
	document.mainform.action="searchclients.php";
	document.mainform.submit();
	}		
	function showall()
	{
	document.mainform.action="clients.php";
	document.mainform.submit();
	}					
			
</script>
</head>
<body leftmargin=0 topmargin=0>
<?include "../inc/mainheader.php"?><form name="mainform" action="searchclients.php" method="post"> 
<table width="80%" border="0" align="center" cellpadding="0" cellspacing="0" >
  <?
	if(strtoupper($_SESSION["type"])=="A")
		{
?>
  <tr> 
    <td width="54%" align="left"  class="navigation">Administrator&gt;Clients 
      Listing</td>
    <td width="46%" align="right" ></td>
  </tr>
  <?
		}
	elseif(strtoupper($_SESSION["type"])=="C")
		{
?>
  <tr> 
    <td width="54%" align="left" class="navigation">&nbsp;</td>
    <td width="46%" align="right"class="navigation"></td>
  </tr>
  <?
		}
	elseif(strtoupper($_SESSION["type"])=="D")
		{
?>
  <?
		}
?>
  <tr> 
    <td colspan="2">&nbsp;</td>
  </tr>
</table>

<table width="80%" border="0" align="center">
  <tr align="left" valign="top"> 
    
  <td colspan="7" bgcolor="#FFFFFF" class="navigation">&nbsp;&nbsp;<img src="../skins/default/icons/btn_client-templates_bg.gif" width="24" height="22">Client 
    Listing </font></strong> 
    <table width="33%" border="0" align="right">
        <tr> 
          <td width="60%" align="right" valign="middle" class="navigation"><a href="" style="text-decoration:none"><img src="../skins/default/icons/btn_delete_bg.gif" border="0" width="24" height="22" onClick="return chk_frm(document.mainform)"></a></td>
          <td width="40%" align="left" valign="middle" class="navigation"><a href="" style="text-decoration:none" onClick="return chk_frm(document.mainform)">Delete 
            Clients</a></td>
        </tr>
      </table>
      <br>
      <input name="clientsearch" type="text" id="clientsearch2" class="textboxclass">
      &nbsp; 
      <input  class="commonButton" type="button" name="Button" value="Search" onClick="searchclient()">
      &nbsp;&nbsp; 
      <input class="commonButton" type="button" name="Submit2" value="Show all" onClick="showall()">
      </td>
  </tr>
  <tr align="center"> 
    <td width="6%" bgcolor="#CAE1EC" class="tableheadings">Passwd</td>
    <td width="2%" bgcolor="#CAE1EC"  class="tableheadings">S</td>
    <td width="41%" align="left" bgcolor="#FFE2C6" class="tableheadings">Client Name</td>
    <td width="17%" align="left" bgcolor="#CFECF1" class="tableheadings">Company Name</td>
    <td width="18%" bgcolor="#CFECF1" class="tableheadings">Creation Date</td>
    <td width="10%" bgcolor="#CFECF1" class="tableheadings">Domains</td>
    <td width="6%" bgcolor="#CFECF1" class="tableheadings"><a href="javascript:invertChecked()" style="text-decoration:none">Sel</a></td>
  </tr>
<?
@mysql_free_result($numclients);
$query="select * from tblreseller order by resellername";
//myLog($query);
$arrayclient=mysql_query($query) or die(errorCatch(mysql_error()));
$numclients=mysql_num_rows($arrayclient);
if($numclients==0)
	{
		echo "Sorry no client to show";
	}
else
	{
		$count=1;
		while($clients=@mysql_fetch_object($arrayclient))
			{
				//This query gets the total number of clients for the selected client
				$query="select * from tbldomain where resellerid=$clients->resellerid";
				//myLog($query);
				$array=mysql_query($query) or die(errorCatch(mysql_error()));
				$numdomains=0;
				$numdomains=mysql_num_rows($array);
				//echo "The domain count is ".$numdomains;

				//This query gets the company name from the tblclientcontact for the selected client
				$query="select companyname from tblclientcontact where resellerid='$clients->resellerid'";
				//myLog($query);
				$array=mysql_query($query) or die(errorCatch(mysql_error()));
				$company=mysql_fetch_array($array);
				$companyname=$company["companyname"];

				//This query gets the creation date for the selected client
				$query="select regdate from tblloginmaster where ucase(usertype)=ucase('c') and typeid='$clients->resellerid'";
				//myLog($query);
				$array=mysql_query($query) or die(errorCatch(mysql_error()));
				$dt=mysql_fetch_array($array);
				$regdate=$dt["regdate"];
				
				if($count % 2==0)
				   {
						$bgcol="#F9F2E3";
						$count=$count+1;
				   }
				else
				   {
						$bgcol="";
						$count=$count+1;
				   }
?>
						<tr align="center"  height="1" bgcolor="<?=$bgcol?>" onmouseover="bgColor='#DDDDDD'" onmouseout="bgColor='<?=$bgcol?>'"> 
							
  							<td height="20" class="clientheading"><a href="resetpassword.php?clid=<?=$clients->resellerid?>&usertype=c&name=<?=$clients->resellername?>"><img src="../skins/default/icons/ok.gif" width="16" height="16" border="0"></a></td>
							<td><img src="../skins/default/icons/on.gif" width="16" height="16"></td>
							<td align="left" class="clientheading"><a href="../clients/choose.php?clid=<?=$clients->resellerid?>"> <?=$clients->resellername?> </a></td>
							<td align="left" class="clientheading"><?=$companyname?></td>
							<td class="clientheading"><?=$regdate?></td>
							<td class="clientheading"><?=$numdomains?></td>
							<td> 
							  <input type="checkbox" name="delclients[]" value="<?=$clients->resellerid?>">
							 </td>
						  </tr>
<?
			}
	}

?>
</table>
<p>&nbsp;</p>
</body>
</form>
</html>
<? include "../inc/footer.php" ?>

