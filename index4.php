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
	$sql = sprintf("SELECT * FROM personel WHERE surname = '' ORDER BY personel_id");
	
	$result = mysql_query($sql);
	
	echo "<table>";
	
	while($row = mysql_fetch_assoc($result))
	{
		echo "<tr>";
		
		echo "<td>".$row['personel_id']."</td>";
		echo "<td>".$row['prefix_name_id']."</td>";
		echo "<td>".$row['name']."</td>";
		
		if(preg_match("/^(.+?)\s+(.+)$/",$row['name'],$match))
		{
			echo "<td>".trim($match[1])."</td>";
			echo "<td>".trim($match[2])."</td>";
			
			//$sql2 = sprintf("UPDATE personel SET personel.name = '%s', personel.surname = '%s' WHERE personel.personel_id = '%s'",$match[1],$match[2],$row['personel_id']);
			//$result2 = mysql_query($sql2);
			//if($result2)
			//{
			//	echo "<td style='color:green'>OK</td>";
			//}	
			//else
			//{
			//	echo "<td style='color:red'>Fail !!</td>";
			//}
		}
		else
		{
			echo "<td>"."---------"."</td>";
			echo "<td>"."No Result"."</td>";
		}

		echo "</tr>";
	}
	echo "</table>";
?>