<?php

	//Database Connection
	$dbhost="localhost";	
	$dbuser='root';			
	$dbpass='1234';			
	$dbname='nobility';			

	global $conn; 
	$conn=mysql_connect($dbhost,$dbuser,$dbpass) or die ("ไม่สามารถเชื่อมต่อโฮสต์ได้");
	mysql_select_db($dbname) or die ("ไม่สามารถเชื่อมต่อฐานข้อมูลได้");

	mysql_query( "SET NAMES UTF8", $conn );
	//End Database Connection

	//Start Query Data Here
	$sql = sprintf("SELECT
				personel_heir.personel_id,
				personel_heir.heir_id
				FROM
				personel_heir
			");
	
	$result = mysql_query($sql);
	
	echo "<table>";
	
	while($row = mysql_fetch_assoc($result))
	{
		echo "<tr>";
		
		echo "<td>".$row['personel_id']."</td>";
		echo "<td>".$row['heir_id']."</td>";
		
		/*
		if(preg_match("/^Thumbnails_(.+)$/",$row['image'],$match))
		{
			echo "<td>".$match[1]."</td>";
			$sql2 = sprintf("UPDATE personel SET personel.image = '%s' WHERE personel.personel_id = '%s'",$match[1],$row['personel_id']);
			mysql_query($sql2);
		}
		*/
		
		$sql2 = sprintf("UPDATE heir SET heir.personel_id = '%s' WHERE heir.heir_id = '%s'",$row['personel_id'],$row['heir_id']);
		
		/*
		if(mysql_query($sql2))
		{
		
			$sql3 = sprintf("DELETE FROM personel_heir WHERE personel_heir.personel_id = '%s' AND personel_heir.heir_id = '%s'",$row['personel_id'],$row['heir_id']);
			
			if(mysql_query($sql3))
			{
				echo "<td style='color:green'>OK!!</td>";
			}
		}
		*/
		
		echo "</tr>";
	}
	echo "</table>";
?>