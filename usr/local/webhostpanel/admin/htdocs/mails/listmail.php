<? $ACCESS_LEVEL=3 ?>
<?include "../inc/connection.php"?>
<?include "../inc/params.php"?>
<?include "../inc/functions.php"?>
<?include "../inc/security.php"?>
<html>
<head>
<title>Create Email Alias</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head><link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/general.css">
<link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/custom.css">
<link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/layout.css">
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=ISO-8859-1">
<META HTTP-EQUIV="EXPIRES" CONTENT="0">
</head>

<script>

function submit_form(f)
	{
				var counter;
				counter=0;
				for (i = 0 ; i < f.elements.length; i++) 
					{
					if ((f.elements[i].type == "checkbox") && (f.elements[i].name.indexOf("emails")==0)) 
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
					alert("No aliases to delete!");
					return false;
				}
				else
				{
					//alert();
					f.action='removealias.php';
					f.submit();
					return false;
				}
				
	}


function validate(f)
{
   //emailExp= /^\w+(\-\w+)*(\.\w+(\-\w+)*)*@\w+(\-\w+)*(\.\w+(\-\w+)*)+$/;
   if(f.aliasname.value=="")
	   {
			alert("Alias Name can not be blank");
			f.aliasname.focus();
			return false;
	   }

   //if (!(emailExp.test(f.redirectadd.value)))
  //    { 
	//	   alert("Email Address is not proper");
	//	   f.redirectadd.value="";
	//	   f.redirectadd.focus();
	//	   return false;  
	//  }

	if(f.aliasname.value=="")
	   {
			alert("Alias Name can not be blank");
			f.aliasname.focus();
			return false;
	   }
	return true
}
</script>

</head>
<body leftmargin=0 topmargin=0>
<?
	include "../inc/mainheader.php";
	
	if(strtoupper($_SESSION["type"])!="D")
		include "../clients/clientheader.php";

	include "../domains/domainheader.php";
	
	$domainid=$_SESSION["domainid"];
	$domainname=$_SESSION["domainname"];
?>
<form action="/mails/createemailalias.php" method="post" name="mainform" onSubmit="return validate(document.mainform)">
<!--  <table width="58%" border="0" align="center" cellspacing="0" cellpadding="0">
    <?
	if(strtoupper($_SESSION["type"])=="A")
		{
?>
    <tr> 
      <td align="left" class="navigation">Administrator &gt; 
        <?=$_SESSION["clientname"]?>
        &gt; 
        <?=$domainname?>
        &gt; Mail Alias</td>
    </tr>
    <?
		}
	elseif(strtoupper($_SESSION["type"])=="C")
		{
?>
    <tr> 
      <td align="left" class="navigation"> 
        <?=$_SESSION["clientname"]?>
        &gt; 
        <?=$domainname?>
        &gt; Mail Alias</td>
    </tr>
    <?
		}
	elseif(strtoupper($_SESSION["type"])=="D")
		{
?>
    <tr> 
      <td align="left" class="navigation"> 
        <?=$domainname?>
        &gt; Mail Alias</td>
    </tr>
    <?
		}
?>
    <tr> 
      <td>&nbsp;</td>
    </tr>
  </table>-->
  <table width=581 border=0 cellpadding=0 cellspacing=0 align="center">
    <?
	$query="select * from mail_alias where domain='$domainname' order by address";
	$AliasArr=mysql_query($query) or die(errorCatch(mysql_error()));
	$num=mysql_num_rows($AliasArr);
	if($num > 0)
		{
?>
    <tr> 
      <th height="21" colspan="6" align="center" class="clientheading"> Existing Email Alias 
    </tr>
    <tr> 
      <td width="390" height="6" ><div align="right" class="headings">Alias Name 
        </div></td>
      <td width="23" height="6" align="center" class="headings">&nbsp;</td>
      <td colspan="3" align="center"><div align="left" class="headings">Redirect 
          Address </div></td>
    </tr>
    <tr> 
      <td height="5" colspan="5"  align="center"><div align="right"></div>
        <div align="center"><img src="/skins/<?=$_SESSION["skin"]?>/elements/line.gif" width=560 height=1 border=0> 
        </div></td>
    </tr>
    <?
    while($ResultSet=mysql_fetch_array($AliasArr))
			{
?>
    <tr> 
      <td width="390"  align="left" valign="top"><div align="right"  class="btntext"> 
          <?=$ResultSet["address"]?>
          <br>
        </div></td>
      <td width="23" align="center" valign="top"><font color="#FF0000">---</font></td>
      <td width="187" align="center" valign="top"> <div align="left"><font color="#004080"> 
          </font> <font color="#004080"> 
          <?=str_replace("," ,", ",$ResultSet["goto"])?>
          </font><font color="#004080"> </font></div></td>
      <td width="71" align="center" valign="top"> <div align="left"  class="btntext"> 
          <input type="checkbox" name="emails[]" value="<?=$ResultSet["id"]?>">
        </div></td>
      <td width="103" align="center"><div align="left"></div></td>
    </tr>
    <?
			}
?>
    <tr valign="top"> 
      <td height="50" colspan="6" align="center"> <div align="center"></div>
        <div align="center"> <br>
          <input type="button" name="Button1352" value="Remove Selected" class="commonButton" onClick="return submit_form(document.mainform)">
        </div></td>
    </tr>
    <tr> 
      <td height="11" colspan="6" align="center"><div align="center"><img src="/skins/<?=$_SESSION["skin"]?>/elements/line.gif" width=560 height=1 border=0> 
        </div></td>
    </tr>
    <?
		}

		

				$query = "select count(*) as domainMailCount from mail_alias where domain = '$domainname'"; 			
				$rsDomainAlias = @mysql_query($query);
				$rsDomainAliasResult = @mysql_fetch_array($rsDomainAlias);
				$usedDomainAlias = $rsDomainAliasResult["domainMailCount"];


				$query = "select emailalias from tbldomainrights where domainid = '$domainid'"; 			
				$rsDomainEmailalias = @mysql_query($query);
				$rsDomainEmailaliasResult = @mysql_fetch_array($rsDomainEmailalias);
				$usedDomainEmailaliasAccount = $rsDomainEmailaliasResult["emailalias"];

				if($usedDomainAlias < $usedDomainEmailaliasAccount)
				{
?>
    <tr> 
      <th height="20" colspan="5" align="center" class="clientheading">EMAIL ALIAS </td> 
    </tr>
    <tr> 
      <td height="28" colspan="4"><div align="right"  class="headings"> </div>
        <div align="center" class="clientheading">Redirect address must be comma 
          separated. 
          <table width="99%" border="0" align="center">
            <tr> 
              <td width="47%"><div align="right" class="headings">Alias Name: 
                </div></td>
              <td width="5%">&nbsp;</td>
              <td width="48%"> <input name="aliasname" type="text" class="textboxclass"> 
                &nbsp;&nbsp;<font color="red" size="1"> 
                <?="@" . $domainname?>
                </font></td>
            </tr>
            <tr> 
              <td valign="top"><div align="right" class="headings">Redirect Address: 
                </div></td>
              <td>&nbsp;</td>
              <td><textarea name="redirectadd" rows="8" id="textarea2" class="textboxclass"></textarea></td>
            </tr>
            <tr> 
              <td colspan="3" valign="top"><img src="/skins/<?=$_SESSION["skin"]?>/elements/line.gif" width=560 height=1 border=0></td>
            </tr>
          </table>
        </div></td>
    </tr>
    <tr> 
      <td colspan="4"><div align="center"> 
          <input type="submit" name="Button35" value="Create Alias" class="commonButton" >
        </div></td>
    </tr>
    <?
				}
		else
			echo "<tr><td colspan=5><center><div  class=\"navigation\">The domain has used all its MAIL ALIAS accounts</div></center></td></tr>";
?>
  </table>
</form>
<br><br>
<? include "../inc/footer.php"?>
</body>
</html>
