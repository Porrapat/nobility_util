<?php

	//Database Connection
	$dbhost="localhost";	
	$dbuser='root';			
	$dbpass='1234';			
	$dbname='nobility_clean';			

	global $conn; 
	$conn=mysql_connect($dbhost,$dbuser,$dbpass) or die ("ไม่สามารถเชื่อมต่อโฮสต์ได้");
	mysql_select_db($dbname) or die ("ไม่สามารถเชื่อมต่อฐานข้อมูลได้");

	mysql_query( "SET NAMES UTF8", $conn );
	//End Database Connection

	
	
	
	//Start Query Data Here
	$sql2 = sprintf("SELECT * FROM prefix_name");
	$result = mysql_query($sql2);
		
	echo "<table>";
	while($row2 = mysql_fetch_assoc($result))
	{
		echo "<tr>";
		echo "<td>".$row2['prefix_name_id']."</td>";
		echo "<td>".$row2['prefix_name']."</td>";
		echo "</tr>";
	}
	echo "</table>";




?>