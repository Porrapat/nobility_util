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
	$sql = sprintf("SELECT
				personel.personel_id,
				personel.image
				FROM
				personel
			");
	
	$result = mysql_query($sql);
	
	echo "<table>";
	
	while($row = mysql_fetch_assoc($result))
	{
		echo "<tr>";
		
		echo "<td>".$row['personel_id']."</td>";
		echo "<td>".$row['image']."</td>";
		
		/*
		if(preg_match("/^Thumbnails_(.+)$/",$row['image'],$match))
		{
			echo "<td>".$match[1]."</td>";
			$sql2 = sprintf("UPDATE personel SET personel.image = '%s' WHERE personel.personel_id = '%s'",$match[1],$row['personel_id']);
			mysql_query($sql2);
		}
		*/
		
		echo "</tr>";
	}
	echo "</table>";
?>