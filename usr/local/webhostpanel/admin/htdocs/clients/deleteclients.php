<?$ACCESS_LEVEL=1 ;?>
<?include "../inc/connection.php"?>
<?include "../inc/security.php"?>
<?include "../inc/params.php"?>
<?include "../inc/functions.php"?>
<?include "../inc/mainheader.php"?>
<html>
<head>
<title>Clients Listing</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head><link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/general.css">
<link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/custom.css">
<link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/layout.css">
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=ISO-8859-1">
<META HTTP-EQUIV="EXPIRES" CONTENT="0">
<?
	$deletecounter=0;
	$nodeletecounter=0;
	$arraydelete="";
	$arraynodelete="";
	if(strlen($_POST["delclients"]) == 0)
		{
?>
			<script>
					alert("No clients to delete!");
					window.location = "../clients/clients.php";
			</script>
<?
			response.end;
		}
		
	for($i=0; $i < count($_POST["delclients"]); $i++)
		{
			//echo $_POST["delclients"][$i];
			$reselid=$_POST["delclients"][$i];

			$query="select resellername from tblreseller where resellerid=$reselid";
			//myLog($query);
			$reselarray=mysql_query($query) or die(errorCatch(mysql_error()));
			$resultset=mysql_fetch_array($reselarray);
			$reselname=$resultset["resellername"];
			mysql_free_result($reselarray);

			$query="select count(domainname) as domaincount from tbldomain where resellerid=$reselid";
			//myLog($query);
			$array=mysql_query($query) or die(errorCatch(mysql_error()));
			$res=mysql_fetch_array($array);

			if($res["domaincount"]<=0)
				{
					$string1=$string1."<tr><td><font color=\"red\"><li>".$reselname."</fonr></li></td></tr>";
					$deletecounter=$deletecounter+1;
					$arraydelete=$arraydelete.$reselid.",";
				}
			else
				{
					$string2=$string2."<tr><td><font color=\"blue\"><li>".$reselname."</font></li></td></tr>";
					$nodeletecounter=$nodeletecounter+1;
					$arraynodelete=$arraynodelete.$reselid.",";
				}
			mysql_free_result($array);
		}//End of for loop
?>
<body topmargin="0">
<form name="mainform" action="../clients/deleteclients1.php" method="post">
  <ul>
    <!--<table width="80%" border="0" align="center" cellspacing="0" cellpadding="0">
      <?
	if(strtoupper($_SESSION["type"])=="A")
		{
?>
      <tr> 
        <td align="left" class="navigation">Administrator 
          &gt;Delete Client</td>
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
      <tr> 
        <td align="left" ><strong></strong></td>
      </tr>
      <?
		}
?>
    </table>-->
    <p>&nbsp;</p>
    <table width="594" border="0" cellspacing="0" cellpadding="0" align="center">
      <tr> 
        <td width="627" height=35>&nbsp;</td>
      </tr>
      <?
	if($deletecounter > 0)
	{
	?>
      <tr> 
        <th  class="navigation">Clients will be deleted ( 
          <?=$deletecounter?>
          )</td></tr>
      <?=$string1?>
      <?}
	if($nodeletecounter > 0)
	{
	?>
      <tr> 
        <td height="35">&nbsp;</td>
      </tr>
      <tr> 
        <th  class="navigation">Clients can not be deleted ( 
          <?=$nodeletecounter?>
          ), you need to delete domains of these clients first </td></tr>
      <?=$string2?>
      <?}?>
      <tr> 
        <td height="35">&nbsp;</td>
      </tr>
      <tr> 
        <td align=center> 
          <?
  if($deletecounter!=0)
  {
?>
          <input type="submit" class="commonButton" value="Proceed"> &nbsp;&nbsp; 
          <input type="button" class="commonButton" value="Cancel" onclick="location.href='../clients/clients.php'"> 
          <?}else{?>
          <input type="button" class="commonButton" value="OK" onclick="location.href='../clients/clients.php'"> 
          <?}?>
        </td>
      </tr>
    </table>
  </ul>
<input type="hidden" name="delclients" value="<?=$arraydelete?>">
</form>
</body>
</html><br>
<br>
<?include "../inc/footer.php"?>