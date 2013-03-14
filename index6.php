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
				personel.name,
				personel.surname,
				decoration_old.decoration_id,
				decoration_old.monogram_cut,
				decoration_old.full_year
				FROM
				personel
				Inner Join personel_decoration ON personel.personel_id = personel_decoration.personel_id
				Inner Join decoration_old ON personel_decoration.decoration_id = decoration_old.decoration_id
			");
	
	$result = mysql_query($sql);
	
	echo "<table>";
	
	while($row = mysql_fetch_assoc($result))
	{
		echo "<tr>";
		
		echo "<td>".$row['personel_id']."</td>";
		echo "<td>".$row['name']." ".$row['surname']."</td>";
		echo "<td>".$row['decoration_id']."</td>";
		echo "<td>".$row['monogram_cut']."</td>";
		echo "<td>".$row['full_year']."</td>";
		
		$sql2 = sprintf("SELECT * FROM decoration WHERE decoration.decoration_monogram = '%s'",$row['monogram_cut']);
		$result2 = mysql_query($sql2);
		if($result2 && mysql_num_rows($result2) > 0)
		{
			$row2 = mysql_fetch_assoc($result2);
			echo "<td>".$row2['decoration_id']."</td>";
			echo "<td>".$row2['decoration_name']."</td>";
			
			
			$sql3 = sprintf("INSERT INTO personel_plus_decoration VALUES('%s','%s','%s')",$row['personel_id'],$row2['decoration_id'],$row['full_year']);
			$result3 = mysql_query($sql3);
			if($result3)
			{
					echo "<td style='color:green'>"."Success!!"."</td>";
					
					$sql4 = sprintf("DELETE FROM personel_decoration WHERE decoration_id = '%s'",$row['decoration_id']);
					$result4 = mysql_query($sql4);
					$sql5 = sprintf("DELETE FROM decoration_old WHERE decoration_id = '%s'",$row['decoration_id']);	
					$result5 = mysql_query($sql5);
				
					if($result4 && $result5)
					{
						echo "<td style='color:orange'>"."Delete OK"."</td>";
					}
			}
			else
			{
				echo "<td style='color:red'>Error Adding</td>";
			}
			
			
		}
		else
		{
			echo "<td style='color:red'>Error Result</td>";
		}
		/*
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
		
		*/

		echo "</tr>";
	}
	echo "</table>";
?>