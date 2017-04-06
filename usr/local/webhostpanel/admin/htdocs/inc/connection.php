<?php
	//This file let us establish connection to the database

    $link = mysql_connect("localhost", "webhostpanel", "ddR51x67")
        or die(errorCatch(mysql_error()));   
  #  mysql_close($link);
	@mysql_select_db("webhostpanel");
?>
