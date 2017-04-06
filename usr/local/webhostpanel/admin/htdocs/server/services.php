<?$ACCESS_LEVEL=1;?>
<?include "../inc/connection.php"?>
<?include "../inc/params.php"?>
<?include "../inc/functions.php"?>
<?include "../inc/security.php"?>


<?
	//echo "The service name is " . $_GET["service"] . "<br>";
	//echo "The action is " . $_GET["action"];
	
	$service = $_GET["service"];
	$action = $_GET["action"];
	
	if($action == "start")
		{
			if($service == "APACHE")
				{
					$toStart = "httpd"; 
					$st = StartService($toStart);
					if($st == 1)
						{
							?>
								<script>
									alert("APACHE started");
									location.replace("../server/servicemgt.php");
								</script>
							<?
						}
					else
						{
							?>
								<script>
									alert("Sorry there were some problems starting the service!")
									location.replace("../server/servicemgt.php");
								</script>
							<?
						}
				}
			elseif($service == "DNS")
				{
					$toStart = "named"; 
					$st = StartService($toStart);
					echo "<br>the status is " . $st;
					if($st == 1)
						{
							?>
								<script>
									alert("DNS started");
									location.replace("../server/servicemgt.php");
								</script>
							<?
						}
					else
						{
							?>
								<script>
									alert("Sorry there were some problems starting the service!")
									location.replace("../server/servicemgt.php");
								</script>
							<?
						}
				}
			elseif($service == "POSTFIX")
				{
					$toStart = "postfix"; 
					$st = PostfixStart();
					//echo "The value while staarting POSTFIX " .$st;
					if($st == 1)
						{
							?>
								<script>
									alert("POSTFIX started");
									location.replace("../server/servicemgt.php");
								</script>
							<?
						}
					else
						{
							?>
								<script>
									alert("Sorry there were some problems starting the service!")
									location.replace("../server/servicemgt.php");
								</script>
							<?
						}
				}
			
			else
				{
					?>
						<script>
							alert("Sorry there were some problems starting the service!")
							location.replace("../server/servicemgt.php");
						</script>
					<?
				}
		}
	elseif($action == "stop")
		{
			if($service == "APACHE")
				{
					$toStart = "httpd"; 
					$st = StopService($toStart);
					if($st == "1")
						{
							?>
								<script>
									alert("APACHE stopped");
									location.replace("../server/servicemgt.php");
								</script>
							<?
						}
					else
						{
							?>
								<script>
									alert("Sorry there were some problems stopping the service!")
									location.replace("../server/servicemgt.php");
								</script>
							<?
						}
				}
			elseif($service == "DNS")
				{
					$toStart = "named"; 
					$st = StopService($toStart);
					if($st == "1")
						{
							?>
								<script>
									alert("DNS stopped");
									location.replace("../server/servicemgt.php");
								</script>
							<?
						}
					else
						{
							?>
								<script>
									alert("Sorry there were some problems stopping the service!")
									location.replace("../server/servicemgt.php");
								</script>
							<?
						}
				}
			elseif($service == "POSTFIX")
				{
					$toStart = "postfix"; 
					$st = PostfixStop();
					if($st == "1")
						{
							?>
								<script>
									alert("POSTFIX stopped");
									location.replace("../server/servicemgt.php");
								</script>
							<?
						}
					else
						{
							?>
								<script>
									alert("Sorry there were some problems stopping the service!")
									location.replace("../server/servicemgt.php");
								</script>
							<?
						}
				}
			
			else
				{
					?>
						<script>
							alert("Sorry there were some problems stopping the service!")
							location.replace("../server/servicemgt.php");
						</script>
					<?
				}
		}
	elseif($action == "restart")
		{
			if($service == "APACHE")
				{
					$toStart = "httpd"; 
					$st = RestartService($toStart);
					if($st == "1")
						{
							?>
								<script>
									alert("APACHE restarting");
									location.replace("../server/servicemgt.php");
								</script>
							<?
						}
					else
						{
							?>
								<script>
									alert("Sorry there were some problems restarting the service!")
									location.replace("../server/servicemgt.php");
								</script>
							<?
						}
				}
			elseif($service == "DNS")
				{
					$toStart = "named"; 
					$st = RestartService($toStart);
					if($st == "1")
						{
							?>
								<script>
									alert("DNS restarting");
									location.replace("../server/servicemgt.php");
								</script>
							<?
						}
					else
						{
							?>
								<script>
									alert("Sorry there were some problems restarting the service!")
									location.replace("../server/servicemgt.php");
								</script>
							<?
						}
				}
			elseif($service == "POSTFIX")
				{
					$toStart = "postfix"; 
					$st = PostfixReStart();
					if($st == "1")
						{
							?>
								<script>
									alert("POSTFIX restarting");
									location.replace("../server/servicemgt.php");
								</script>
							<?
						}
					else
						{
							?>
								<script>
									alert("Sorry there were some problems restarting the service!")
									location.replace("../server/servicemgt.php");
								</script>
							<?
						}
				}
			
			else
				{
					?>
						<script>
							alert("Sorry there were some problems restarting the service!")
							location.replace("../server/servicemgt.php");
						</script>
					<?
				}
		}
	else
		{
			?>
				<script>
					alert("Sorry there were some problems while handling the services!")
					location.replace("../server/servicemgt.php");
				</script>
			<?
		}
?>