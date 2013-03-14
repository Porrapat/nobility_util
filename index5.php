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
		royal.royal_id,
		royal.royal_name,
		royal_decoration.monogram,
		royal_decoration.royal_decoration_id
		FROM
		royal
		Inner Join royal_plus_decoration ON royal.royal_id = royal_plus_decoration.royal_id
		Inner Join royal_decoration ON royal_plus_decoration.royal_decoration_id = royal_decoration.royal_decoration_id
		");
	
	$result = mysql_query($sql);
	
	echo "<table>";
	
	while($row = mysql_fetch_assoc($result))
	{
		echo "<tr>";
		
		echo "<td>".$row['royal_id']."</td>";
		echo "<td style='width:400px'>".$row['royal_name']."</td>";
		echo "<td>".$row['monogram']."</td>";
		
		if(preg_match("/^(.+?)\s*(\d+)\s*$/",$row['monogram'],$match))
		{
		
			$monogram = trim($match[1]);
			$year = trim($match[2]);
			
			if(preg_match("/^\d\d$/",$year))
			{
				$year = "25".$year;
			}
			
			echo "<td>".$row['royal_decoration_id']."</td>";
			echo "<td>".$monogram."</td>";
			echo "<td>".$year."</td>";
			

			$sql2 = sprintf("SELECT * FROM decoration WHERE decoration.decoration_monogram = '%s'",$monogram);
			$result2 = mysql_query($sql2);
			if($result2 && mysql_num_rows($result2) > 0)
			{
				$row2 = mysql_fetch_assoc($result2);
				echo "<td>".$row2['decoration_id']."</td>";
				echo "<td>".$row2['decoration_name']."</td>";
				
				/*
				$sql3 = sprintf("INSERT INTO royal_plus_decoration_new VALUES('%s','%s','%s')",$row['royal_id'],$row2['decoration_id'],$year);
				
				$result3 = mysql_query($sql3);
				if($result3)
				{
					echo "<td style='color:green'>"."Success!!"."</td>";
					
					$sql4 = sprintf("DELETE FROM royal_decoration WHERE royal_decoration_id = '%s'",$row['royal_decoration_id']);
					$result4 = mysql_query($sql4);
					$sql5 = sprintf("DELETE FROM royal_plus_decoration WHERE royal_decoration_id = '%s'",$row['royal_decoration_id']);	
					$result5 = mysql_query($sql5);
				
					if($result4 && $result5)
					{
						echo "<td style='color:orange'>"."Delete OK"."</td>";
					}
				}
				*/
			}
			else
			{
				echo "<td style='color:red'>Error Result</td>";
			}
		}
		else
		{
			echo "<td style='color:red'>"."---------"."</td>";
			echo "<td style='color:red'>"."---------"."</td>";
			echo "<td style='color:red'>"."---------"."</td>";
			echo "<td style='color:red'>"."---------"."</td>";
		}

		echo "</tr>";
	}
	echo "</table>";
?>