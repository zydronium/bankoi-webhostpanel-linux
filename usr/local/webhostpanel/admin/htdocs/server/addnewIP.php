<? $ACCESS_LEVEL=1 ?>
<?include "../inc/connection.php"?>
<?include "../inc/params.php"?>
<?include "../inc/functions.php"?>
<?include "../inc/security.php"?>
<?include "../inc/constants.php"?>

<title>Add New IP Address</title>
<html>
<head>
</head>
<link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/general.css">
<link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/custom.css">
<link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/layout.css">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<?
$output=`ifconfig | grep "eth[0-100][^:]" | tr -s " " | cut -d " " -f1`;
$arr=split ("\n", $output);
?>
<body>
<script>
function goback()
{

location.href = "../server/serverip.php";

}
</script>
<body topmargin="0">
<form name="form1" method="post" action="../server/addIP.php" onSubmit="return checkData(document.form1)">
  <?include "../inc/mainheader.php"?>
  <!--<table width="56%" border="0" align="center" cellspacing="0" cellpadding="0">
    <?
	if(strtoupper($_SESSION["type"])=="A")
		{
?>
    <tr> 
      <td align="left" class="navigation">Administrator &gt; Servers &gt; Add 
        Server IP Address</td>
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
  </table>-->
 
  <table width="52%" border="0" align="center">
    <tr> 
      <th height="21" colspan="4"><div align="center" class="clientheading">Add New IP</div>
    </tr>
    <tr> 
      <td width="33%"><div align="right" class="headings">Interface </div></td>
      <td width="3%" class="headings">&nbsp; </td>
      <?
		$flag=0;
		$query="select * from tblserverip where iptype='Shared'";
		//myLog($query);
		$rs=mysql_query($query) or die(errorCatch(mysql_error()));;
		$n=mysql_affected_rows();
		if($n>0)
		$flag=1;
		?>
      <td colspan="2"> <select name="interface" id="interface" class="dropdown">
          <? for($i=0; $i<=count($arr)-2;$i++){?>
          <option value="<?=$arr[$i]?>"> 
          <?=$arr[$i]?>
          </option>
          <? }?>
        </select> </td>
    </tr>
    <tr> 
      <td><div align="right" class="headings">IP Address </div></td>
      <td class="headings">&nbsp; </td>
      <td colspan="2"><strong> 
        <input name="ip1" type="text" id="ip1" size="5" class="textboxclass" onBlur = "return CheckIP(document.form1.ip1)">
        . 
        <input name="ip2" type="text" id="ip2" size="5"  class="textboxclass" onBlur = "return CheckIP(document.form1.ip2)">
        . 
        <input name="ip3" type="text" id="ip3" size="5" class="textboxclass" onBlur = "return CheckIP(document.form1.ip3)">
        . 
        <input name="ip4" type="text" id="ip4" size="5" class="textboxclass" onBlur = "return CheckIP(document.form1.ip4)">
        </strong> </td>
    </tr>
    <tr> 
      <td><div align="right" class="headings">Subnet Mask </div></td>
      <td class="headings">&nbsp; </td>
      <td colspan="2"><strong> 
        <input name="sn1" type="text" id="sn1" size="5" class="textboxclass" onBlur = "return CheckIP(document.form1.sn1)">
        . 
        <input name="sn2" type="text" id="sn2" size="5" class="textboxclass" onBlur = "return CheckIP(document.form1.sn2)">
        . 
        <input name="sn3" type="text" id="sn3" size="5" class="textboxclass" onBlur = "return CheckIP(document.form1.sn3)">
        . 
        <input name="sn4" type="text" id="sn4" size="5" class="textboxclass" onBlur = "return CheckIP(document.form1.sn4)">
        </strong> </td>
    </tr>
    <tr> 
      <td><div align="right" class="headings">IP Type </div></td>
      <td class="headings">&nbsp; </td>
      <td colspan="2"><select name="iptype" class="dropdown">
          <?
		if($flag==0)
			{
?>
          <option value="Shared">Shared</option>
          <?
			}
?>
          <option value="Exclusive">Exclusive</option>
        </select> </td>
    </tr>
    <tr> 
      <td><div align="right" class="headings">SSL Certificate </div></td>
      <td class="headings">&nbsp; </td>
      <td colspan="2"><select name="certificate" id="certificate" class="dropdown">
          <option value="0">default Certificate</option>
        </select> </td>
    </tr>
    <tr> 
      <td colspan="4" class="headings"> <div align="center"><font color="#006666"><img src="/skins/<?=$_SESSION["skin"]?>/elements/line.gif" width=500 height=1 border=0></font></div></td>
    </tr>
    <tr> 
      <td colspan="4" class="headings"> <div align="center"> 
          <input class="commonButton" type="submit" name="Submit" value="Add IP">
          <input class="commonButton" type="button" name="Cancel" value="Cancel" onClick="goback()">
        </div></td>
    </tr>
  </table>

</form>
</body>
</html>
<br>
<?include "../inc/footer.php" ?>


<script>
	function CheckIP(a)
		{
			if(a.value != "")
				{
					if(isNaN(a))
						{
								if(parseInt(a.value) > 255)
									{
										alert("The value must be less than 255!!!");
										a.value = "";
										a.focus();
										return false;
									}
						}
				}
		}


	function checkData(f)
		{
			if(f.ip1.value == "")
				{
					alert("The field can not be blank!!!")
					f.ip1.focus();
					return false;
				}
            

			if(f.ip2.value == "")
				{
					alert("The field can not be blank!!!")
					f.ip2.focus();
					return false;
				}
            

			if(f.ip3.value == "")
				{
					alert("The field can not be blank!!!")
					f.ip3.focus();
					return false;
				}
            

			if(f.ip4.value == "")
				{
					alert("The field can not be blank!!!")
					f.ip4.focus();
					return false;
				}
            

			if(f.sn1.value == "")
				{
					alert("The field can not be blank!!!")
					f.sn1.focus();
					return false;
				}
            

			if(f.sn2.value == "")
				{
					alert("The field can not be blank!!!")
					f.sn2.focus();
					return false;
				}
            

			if(f.sn3.value == "")
				{
					alert("The field can not be blank!!!")
					f.sn3.focus();
					return false;
				}
            

			if(f.sn4.value == "")
				{
					alert("The field can not be blank!!!")
					f.sn4.focus();
					return false;
				}
            




			if(isNaN(f.ip1.value))
				{
					alert("Please provide numbers only!!!");
					f.ip1.value = "";
					f.ip1.focus();
					return false;
				}
            

			if(isNaN(f.ip2.value))
				{
					alert("Please provide numbers only!!!")
					f.ip2.value = "";
					f.ip2.focus();
					return false;
				}
            

			if(isNaN(f.ip3.value))
				{
					alert("Please provide numbers only!!!")
					f.ip3.value = "";
					f.ip3.focus();
					return false;
				}
            

			if(isNaN(f.ip4.value))
				{
					alert("Please provide numbers only!!!")
					f.ip4.value = "";
					f.ip4.focus();
					return false;
				}
            

			if(isNaN(f.sn1.value))
				{
					alert("Please provide numbers only!!!")
					f.sn1.value = "";
					f.sn1.focus();
					return false;
				}
            

			if(isNaN(f.sn2.value))
				{
					alert("Please provide numbers only!!!")
					f.sn2.value = "";
					f.sn2.focus();
					return false;
				}
            

			if(isNaN(f.sn3.value))
				{
					alert("Please provide numbers only!!!")
					f.sn3.value = "";
					f.sn3.focus();
					return false;
				}
            

			if(isNaN(f.sn4.value))
				{
					alert("Please provide numbers only!!!")
					f.sn4.value = "";
					f.sn4.focus();
					return false;
				}
return true;

		}
</script>