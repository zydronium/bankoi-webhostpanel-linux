<?$ACCESS_LEVEL=1;?>
<?include "../inc/connection.php"?>
<?include "../inc/params.php"?>
<?include "../inc/functions.php"?>
<?include "../inc/security.php"?>

<html>
<head>
<title>Add Client</title>
<link rel="stylesheet" type="text/css" href="/skins/default/css/general.css">
<link rel="stylesheet" type="text/css" href="/skins/default/css/custom.css">
<link rel="stylesheet" type="text/css" href="/skins/default/css/layout.css">
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=ISO-8859-1">
<META HTTP-EQUIV="EXPIRES" CONTENT="0">
</head>
<body leftmargin=0 topmargin=0 >

<?
  $companyname=$_POST["companyname"];
  $contactname=$_POST["contactname"];
  $phone=$_POST["phone"];
  $fax=$_POST["fax"];
  $email=$_POST["email"];
  $address=$_POST["address"];
  $city=$_POST["city"];
  $state=$_POST["state"];
  $pcode=$_POST["pcode"];
  $country=$_POST["country"];
  $skinname=$_POST["language"];

  //------------------------------------------------------------------


$query="update tbladmincontact set companyname='".$companyname."',contactname='".$contactname."',phone='".$phone."',fax='".$fax."',email='".$email."',address='".$address."',city='".$city."',state='".$state."',zipcode='".$pcode."',country='".$country."' where adminid='0'";
//myLog($query);
mysql_query($query) or die(errorCatch(mysql_error()));
		  
		  ?>
		  <script>
		  alert("Admin Contact Successfully Edited");
		  window.location.replace("server.php");
		  </script>
</body>
</html>
