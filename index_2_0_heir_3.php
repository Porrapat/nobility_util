<?php

	//Database Connection
	$dbhost="localhost";	
	$dbuser='root';			
	$dbpass='1234';			
	$dbname='nobility_2';			

	global $conn; 
	$conn=mysql_connect($dbhost,$dbuser,$dbpass) or die ("ไม่สามารถเชื่อมต่อโฮสต์ได้");
	mysql_select_db($dbname) or die ("ไม่สามารถเชื่อมต่อฐานข้อมูลได้");

	mysql_query( "SET NAMES UTF8", $conn );
	//End Database Connection
	
	
	
	// Update Heir table in field order to default 
	$sql = sprintf("SELECT personel_id FROM personel ORDER BY personel_id ASC");
	$result = mysql_query($sql);
	
	while($row = mysql_fetch_assoc($result))
	{
		$sql2 = sprintf("SELECT * FROM heir WHERE personel_id=%s",$row['personel_id']);
	
		$result2 = mysql_query($sql2);
		echo "<div style='border:1px solid black;margin:10px 0px'>";
		echo "<table>";
		$i = 1;
		while($row2 = mysql_fetch_assoc($result2))
		{
			echo "<tr>";
			
			echo "<td>".$row2['heir_id']."</td>";
			echo "<td>".$row2['heir_name']."</td>";
			echo "<td>".$row2['personel_id']."</td>";
			echo "<td>".$i."</td>";
			
			$sql3 = sprintf("UPDATE heir SET heir.heir_order=%s WHERE heir_id=%s",$i,$row2['heir_id']);
			
			echo "<td>".$sql3."</td>";
			
			$result3 = mysql_query($sql3);
			if($result3) {	echo "<td>"."OK"."</td>";	}
			
			echo "</tr>";
			$i++;
		}
		
		echo "</table>";
		echo "</div>";
		
	}
?>