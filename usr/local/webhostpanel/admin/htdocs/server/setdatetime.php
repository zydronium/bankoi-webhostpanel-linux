d>
<title>Set System Date And Time</title>

<script language="JavaScript">
function chkfrm(f)
	{
		if(parseInt(f.tmonth.value) == 1 || parseInt(f.tmonth.value) == 3 || parseInt(f.tmonth.value) == 5 || parseInt(f.tmonth.value) == 7 || parseInt(f.tmonth.value) == 9 || parseInt(f.tmonth.value) == 11)
			{
				if(parseInt(f.tdate.value) > 31)
					{
						alert("The max date for this month is 31");
						f.tdate.value = "";
						f.tdate.focus();
						return false;
					}
				if(parseInt(f.tdate.value) < 1)
					{
						alert("The min date for this month is 1");
						f.tdate.value = "";
						f.tdate.focus();
						return false;
					}
			}
			
			
		if(parseInt(f.tmonth.value) == 4 || parseInt(f.tmonth.value) == 6 || parseInt(f.tmonth.value) == 8 || parseInt(f.tmonth.value) == 10 || parseInt(f.tmonth.value) == 12)
			{
				if(parseInt(f.tdate.value) > 30)
					{
						alert("The max date for this month is 30");
						f.tdate.value = "";
						f.tdate.focus();
						return false;
					}
				if(parseInt(f.tdate.value) < 1)
					{
						alert("The min date for this month is 1");
						f.tdate.value = "";
						f.tdate.focus();
						return false;
					}
			}
			
		if(parseInt(f.tmonth.value) == 2)
			{
				if((parseInt(f.tyear.value) % 4 == 0 && parseInt(f.tyear.value) % 100 != 0) || parseInt(f.tyear.value) % 400 == 0)
					{
						if(parseInt(f.tdate.value) > 29)	
							{
								alert("Sorry the year you provided is a leap year and the month is 2 , \nso the date should be less then 30");
								f.tdate.value = "29";
								f.tdate.focus();
								return false;
							}
					}
			}
		if(confirm("Do you want to set the system date and time!"))
			{
				f.action = "setdatetime1.php";
				f.submit();
				return true;
			}
		else
			{
				return false
			}
	}
</script>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head><link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/general.css">
<link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/custom.css">
<link rel="stylesheet" type="text/css" href="/skins/<?=$_SESSION["skin"]?>/css/layout.css">
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=ISO-8859-1">
<META HTTP-EQUIV="EXPIRES" CONTENT="0">
<body topmargin="0">
<?
	include "../inc/mainheader.php";
?><form name="mainform" action="" method="post" onSubmit="return chkfrm(document.mainform)"> 
<!--<table width="80%" border="0" align="center" cellspacing="0" cellpadding="0">
    <?
	if(strtoupper($_SESSION["type"])=="A")
		{
?>
    <tr> 
      <td align="left" class="navigation">Administrator &gt; Servers &gt; Set Date and Time</td>
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
  </table>--><table width="85%" border="0" align="center">
<tr> 
  <td colspan="3"><div align="center"class="clientheading"> 
  <td colspan="3" class="navigation" align="center"><div align="center"></div></td>
  <td class="clientheading"><div align="center"> 
      <table width="63%" border="0" cellpadding="0" cellspacing="0">
        <tr valign="top"> 
          <td width="44%" height="26"><div align="right" class="navigation"><font color="#003366"><strong>Current 
              Date And Time </strong></font></div></td>
          <td width="6%"><font color="#003366">&nbsp;</font></td>
          <td width="50%" class="clientheading"> <font color="red"> 
            <? $i=system("date",$retval) ?>
            </font></td>
        </tr>
      </table>
    </div></td>
  <table width="58%" border="0" align="center">
    <tr bgcolor="#C8DCFB"> 
      <th colspan="3" bgcolor="#FFFFFF"><div align="center"> 
          <p align="center"><font color="#003366"><strong>Enter the Date &amp; 
            Time</strong></font> </div></td>
        </tr>
    <tr bgcolor="#C8DCFB"> 
      <td width="43%" bgcolor="#FFFFFF"><div align="right" class="headings"><font color="#003366"><strong><font size="2" face="Verdana, Trebuchet MS">Month:</font></strong></font></div></td>
      <?
	  	$Month = date("m");
		$Date = date("d");
		$Hour = date("H");
		$Minutes = date("i");
		$Seconds = date("s");
		$Year = date("Y");
	  ?>
	  <td width="2%" bgcolor="#FFFFFF">&nbsp;</td>
      <td width="55%" bgcolor="#FFFFFF" class="headings"> <select name="tmonth" id="tmonth">
          <?
			for($i=1; $i<13;$i++)
				{
					if($i < 10)
						{
							$y = "0" . $i;
							if($Month == $y)
								{
									echo "<option value='$y' selected>$y</option>";
								}
							else
								{
									echo "<option value='$y'>$y</option>";
								}						
						}
					else
						{
							if($Month == $i)
								{
									echo "<option value='$i' selected>$i</option>";
								}
							else
								{
									echo "<option value='$i'>$i</option>";
								}
						}

				}
		?>
        </select> </td>
    </tr>
    <tr> 
      <td><div align="right"><font color="#003366"><strong><font size="2" face="Verdana, Trebuchet MS">Date:</font></strong></font></div></td>
      <td>&nbsp;</td>
      <td> <select name="tdate" id="tdate">
          <?
			for($i=1; $i<32;$i++)
				{
					if($i < 10)
						{
							$y = "0" . $i;
							if($Date == $y)
								{
									echo "<option value='$y' selected>$y</option>";
								}
							else
								{
									echo "<option value='$y'>$y</option>";
								}						
						}
					else
						{
							if($Date == $i)
								{
									echo "<option value='$i' selected>$i</option >";
								}
							else
								{
									echo "<option value='$i'>$i</option>";
								}
						}

				}
		?>
        </select> </td>
    </tr>
    <tr> 
      <td class="clientheading"><div align="right"><font color="#003366"><strong><font size="2" face="Verdana, Trebuchet MS">Hour:</font></strong></font></div></td>
      <td class="clientheading">&nbsp;</td>
      <td class="clientheading"> <select name="thour" id="thour">
          <?
			for($i=0; $i<24;$i++)
				{
					if($i < 10)
						{
							$y = "0" . $i;
							if($Hour == $y)
								{
									echo "<option value='$y' selected>$y</option>";
								}
							else
								{
									echo "<option value='$y'>$y</option>";
								}						
						}
					else
						{
							if($Hour == $i)
								{
									echo "<option value='$i' selected>$i</option>";
								}
							else
								{
									echo "<option value='$i'>$i</option>";
								}
						}

				}
		?>
        </select></td>
    <tr> 
      <td class="clientheading"><div align="right"><font color="#003366"><strong><font size="2" face="Verdana, Trebuchet MS">Minutes:</font></strong></font></div></td>
      <td class="clientheading">&nbsp;</td>
      <td class="clientheading"> <select name="tminute" id="tminute">
          <?
			for($i=0; $i < 60;$i++)
				{
					if($i < 10)
						{
							$y = "0" . $i;
							if($Minutes == $y)
								{
									echo "<option value='$y' selected>$y</option>";
								}
							else
								{
									echo "<option value='$y'>$y</option>";
								}						
						}
					else
						{
							if($Minutes == $i)
								{
									echo "<option value='$i' selected>$i</option>";
								}
							else
								{
									echo "<option value='$i'>$i</option>";
								}
						}

				}
		?>
        </select></td>
    <tr> 
      <td class="clientheading"><div align="right"><font color="#003366"><strong><font size="2" face="Verdana, Trebuchet MS">Seconds:</font></strong></font></div></td>
      <td class="clientheading">&nbsp;</td>
      <td class="clientheading"> <select name="tsec" id="tsec">
          <?
			for($i=0; $i<60;$i++)
				{
					if($i < 10)
						{
							$y = "0" . $i;
							if($Seconds == $y)
								{
									echo "<option value='$y' selected>$y</option>";
								}
							else
								{
									echo "<option value='$y'>$y</option>";
								}						
						}
					else
						{
							if($Seconds == $i)
								{
									echo "<option value='$i' selected>$i</option>";
								}
							else
								{
									echo "<option value='$i'>$i</option>";
								}
						}
				}
		?>
        </select> </td>
    <tr> 
      <td class="clientheading"><div align="right"><font color="#003366"><strong><font size="2" face="Verdana, Trebuchet MS">Year:</font></strong></font></div></td>
      <td class="clientheading">&nbsp;</td>
      <td class="clientheading"> <select name="tyear" id="tyear">
          <?
			for($i=date("Y"); $i < (date("Y") + 10);$i++)
				{
					if($Year == $i)
						{
							echo "<option value='$i' selected>$i</option>";
						}
					else
						{
							echo "<option value='$i'>$i</option>";
						}
				}
		?>
        </select></td>
    <tr> 
      <td colspan="3" class="clientheading"> <div align="center"><font color="#006666"><img src="/skins/<?=$_SESSION["skin"]?>/elements/line.gif" width=600 height=1 border=0></font></div></td>
    <tr> 
      <td colspan="3" class="clientheading"> <div align="right"> 
          <input type="submit" class="commonbutton" name="Add" value="Set Date & Time">
          <input type="button" class="commonbutton" name="Add2" value="Back" onClick="window.location='../server/server.php'">
        </div></td>
  </table>  
  <br><? include "../inc/footer.php" ?>

