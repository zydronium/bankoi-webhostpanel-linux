<?$ACCESS_LEVEL=1 ;?>
<?include "../inc/connection.php"?>
<?include "../inc/params.php"?>
<?include "../inc/functions.php"?>
<?include "../inc/security.php"?>
<link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/general.css">
<link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/custom.css">
<link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/layout.css">
<body leftmargin=0 topmargin=0>
<?

	if(strlen($_GET["ip"])==0)
	{
?>
	<script>
		alert("IP Assignment Failure");
		window.location="newserver.php";
	</script>
<?
}
else{
	
			$ip=$_GET["ip"];
			
			$outputip=`ifconfig | grep "inet addr" | cut -d ":" -f2 | cut -d " " -f1`;
			$outputmask=`ifconfig | grep "Mask" | cut -d ":" -f4`;
			$outputint=`ifconfig | grep "eth" | tr -s " " | cut -d " " -f1`;
			$arrip=split ("\n",$outputip);
			$arrmask=split ("\n",$outputmask);
			$arrint=split ("\n",$outputint);								
			
			for($i=0; $i<=count($arrint)-2;$i++)
				{
					if($ip==$arrip[$i])
					{
						$setip=$arrip[$i];
						$setmask=$arrmask[$i];
						$setint=$arrint[$i]; 
					}
				}
			
			$_SESSION["setip1"]=$setip;
			$_SESSION["setmask1"]=$setmask;
			$_SESSION["setint1"]=$setint;
			
}

?>
<script>
	location.replace('addnewIP.php');
</script>