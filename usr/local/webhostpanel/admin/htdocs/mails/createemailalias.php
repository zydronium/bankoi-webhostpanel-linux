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
<?
	//---------VARIABLES----------------------------
		$domainid=$_SESSION["domainid"];
		$domainname=$_SESSION["domainname"];	
	//----------------------------------------------

	$aliasname = $_POST["aliasname"];
	$redirectadd = $_POST["redirectadd"];

	
	if($aliasname != "" && $redirectadd != "")
	{
		$query="select emailalias from tbldomainrights where domainid='$domainid'";
		$rs=mysql_query($query) or die(errorCatch("28: In creating Alias " . mysql_error()));
		$res=mysql_fetch_array($rs);
		$aliases=$res["emailalias"];

		$query="select count(*) as cnt from mail_alias where domain='".$domainname."'";
		$rs=mysql_query($query) or die(errorCatch("34: In creating Alias " . mysql_error()));
		$res=mysql_fetch_array($rs);
		$c=$res["cnt"];

		if($aliases==-1 || $aliases > $c)
			{
				$query="select * from mail_alias where address='".$aliasname."@".$domainname."' and domain='".$domainname."'";
				$result=mysql_query($query) or die(errorCatch("40: In creating Alias " . mysql_error()));
				$n=mysql_num_rows($result);

				if($n <= 0)
					{
						$query="select * from mail_mailbox where username='".$aliasname."@".$domainname."' and domain='".$domainname."'";
						$result=mysql_query($query) or die(errorCatch("46: In creating Alias " . mysql_error()));
						$n=mysql_num_rows($result);
						if($n <= 0)
							{
								$query="insert into mail_alias( address,goto,domain,created,modified,active)values('".$aliasname."@".$domainname."','".$redirectadd."','".$domainname."',NOW(),NOW(),1)";
								mysql_query($query) or die(errorCatch("51: In creating Alias " . mysql_error()));
							}
						else
							{
?>
									<script>
										alert("sorry this name already exist");
										history.back();
									</script>
<?
							}
					}
				else
					{
?>
						<script>
							alert("sorry this name already exist");
							history.back();
						</script>
<?
					}
			}
		else
			{
?>
				<script>
					alert("No sufficient alias to create new");
					history.back();
				</script>
<?
			}
	}
?>
<br>
<br>
<script>
	alert("Congratulation new alias has been created successfully")
	window.location="listmail.php";
</script>;
</body>
</html>