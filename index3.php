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
	$sql = sprintf("SELECT * FROM personel WHERE prefix_name_id = 0 ORDER BY personel_id");
	
	$result = mysql_query($sql);
	
	echo "<table>";
	
	while($row = mysql_fetch_assoc($result))
	{
		echo "<tr>";
		
		echo "<td>".$row['personel_id']."</td>";
		echo "<td>".$row['prefix_name_id']."</td>";
		echo "<td>".$row['name']."</td>";
		
		
		
		
		
		$sql2 = sprintf("SELECT * FROM prefix_name ORDER BY LENGTH(prefix_name) DESC");
		$result2 = mysql_query($sql2);

		while($row2 = mysql_fetch_assoc($result2))
		{

			//echo "<td>".$row2['prefix_name_id']."</td>";
			//echo "<td>".$row2['prefix_name']."</td>";

			if(preg_match("/^(".$row2['prefix_name'].")\s*(.+)$/",$row['name'],$match))
			{
				//echo "<tr>";
				echo "<td>".trim($match[1])."</td>";
				echo "<td>".$row2['prefix_name_id']."</td>";
				echo "<td>".trim($match[2])."</td>";
				
				
				//beware this code
				//$sql3 = sprintf("UPDATE personel SET personel.prefix_name_id = '%s', personel.name = '%s' WHERE personel.personel_id = '%s'",$row2['prefix_name_id'],trim($match[2]),$row['personel_id']);
				//$result3 = mysql_query($sql3);
				//if($result3)
				//{
				//	echo "<td style='color:green'>OK</td>";
				//}	
				//else
				//{
				//	echo "<td style='color:red'>Fail !!</td>";
				//}
				
				//echo "</tr>";
				break;
			}
			else
			{
				//echo "<td>No Result</td>";
			}
		}
		echo "</tr>";
	}
	
	echo "</table>";




?>