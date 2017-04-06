<?$ACCESS_LEVEL=2;?>
<?include "../inc/connection.php"?>
<?include "../inc/params.php"?>
<?include "../inc/security.php"?>
<?include "../inc/functions.php"?>
<?include "../inc/mainheader.php"?>
<html>
<head>
<title>Delete Domains</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head><link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/general.css">
<link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/custom.css">
<link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/layout.css">
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=ISO-8859-1">
<META HTTP-EQUIV="EXPIRES" CONTENT="0">
<?
	$deletecounter=0;
	$arraydelete="";
	//print_r($_POST["deletedomains"]);
	//die();
	for($i=0; $i< count($_POST["deletedomains"]); $i++)
		{
			//echo "The domain id is " . $_POST["deletedomains"][$i]. "<br>";
			$domainid=$_POST["deletedomains"][$i];

			$query="select domainname from tbldomain where domainid=$domainid";
			//myLog($query);
			$domainarray=mysql_query($query) or die(errorCatch(mysql_error()));
			$resultset=mysql_fetch_array($domainarray);
			$domainname=$resultset["domainname"];
			mysql_free_result($domainarray);

			$string1=$string1."<tr><td><font color=\"red\"><li>".$domainname."</fonr></li></td></tr>";
			$deletecounter=$deletecounter+1;
			$arraydelete=$arraydelete . $domainid .",";
		}//End of for loop
?>
<body>
<form name="mainform" action="../domains/deletedomain1.php" method="post">
  <ul>
    <!--<table width="63%" border="0" align="center" cellspacing="0" cellpadding="0">
      <?
	if(strtoupper($_SESSION["type"])=="A")
		{
?>
      <tr> 
        <td align="left" class="navigation">Administrator &gt; 
          <?=$_SESSION["clientname"]?>
          &gt; Domain Delete</td>
      </tr>
      <?
		}
	elseif(strtoupper($_SESSION["type"])=="C")
		{
?>
      <tr> 
        <td align="left" class="navigation"> 
          <?=$_SESSION["clientname"]?>
          &gt; Domain Delete</td>
      </tr>
      <?
		}
	elseif(strtoupper($_SESSION["type"])=="D")
		{
?>
      <tr> 
        <td align="left" class="navigation">&nbsp;</td>
      </tr>
      <?
		}
?>
      <tr> 
        <td>&nbsp;</td>
      </tr>
    </table>-->
    <table width="540" border="0" cellspacing="0" cellpadding="0" align="center">
      <tr> 
        <td width="593" height=35>&nbsp;</td>
      </tr>
      <?
	if($deletecounter > 0)
	{
	?>
      <tr> 
        <th>Domains will be deleted ( 
          <?=$deletecounter?>
          )</td></tr>
      <?=$string1?>
      <?}
	
	?>
      <input type="hidden" name="deldomain" value="<?=$arraydelete?>">
      <tr> 
        <td height="35">&nbsp;</td>
      </tr>
      <tr> 
        <td align=center> <input type="submit" class="commonButton" value="Proceed"> 
          &nbsp;&nbsp; <input type="button" class="commonButton" value="Cancel" onclick="location.href='../domains/clientdomains.php'"></td>
      </tr>
    </table>
  </ul>

</form>
</body>
</html><br>
<br>
<?include "../inc/footer.php"?>