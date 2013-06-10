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

	//Start Query Data Here
	$sql = sprintf("SELECT * FROM personel");
	
	$result = mysql_query($sql);
	
	echo "<table>";
	
	while($row = mysql_fetch_assoc($result))
	{
		echo "<tr>";
		
		echo "<td>".$row['personel_id']."</td>";
		//echo "<td>".$row['royal_name']."</td>";
		//echo "<td>".$row['birth_date_old']."</td>";
		//echo "<td>".$row['dead_date_old']."</td>";
		
		if(preg_match("/^-$/",$row['birth_date_old']))
		{
			echo "<td>-</td>";
		}
		else if(preg_match("/^(\d+)\s+(.+)\s+(\d+)\s*(.*)$/",$row['birth_date_old'],$match))
		{
			//echo "<td>".$match[1]."</td>";	//dd
			//echo "<td>".$match[2]."</td>";
			
			//echo "<td>".$match[3]."</td>";	//yyyy+543
			//echo "<td>".$match[4]."</td>";
			
			$dd = $match[1];
			$yyyy = (int)$match[3] - 543;
			
			$month_array = array("null","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน"
			,"กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
			if(in_array(trim($match[2]), $month_array)) {
				$mm = array_search(trim($match[2]), $month_array);
			}
			else
			{
				$mm = -1;
			}

			if($mm != -1)
			{
				$full_mysql_date = $yyyy."-".$mm."-".$dd;
			}
			else
			{
				$full_mysql_date = "error";
			}
			
			echo "<td>".$full_mysql_date."</td>";
			echo "<td>".$match[4]."</td>";
			if($full_mysql_date != "error")
			{
				//Update Here
				$sql3 = sprintf("UPDATE personel SET birth_date='%s' WHERE personel_id=%s",$full_mysql_date,$row['personel_id']);
				$result3 = mysql_query($sql3);
				
				echo "<td>".$sql3."</td>";
				if($match[4] != "")
				{
					$sql4 = sprintf("UPDATE personel SET birth_place='%s' WHERE personel_id=%s",$match[4],$row['personel_id']);
					$result4 = mysql_query($sql4);
					echo "<td>".$sql4."</td>";
				}
			}
		}
		else
		{
			echo "<td>"."No Result"."</td>";
		}

		

		if(preg_match("/^-$/",$row['dead_date_old']))
		{
			echo "<td>-</td>";
		}
		else if(preg_match("/^(\d+)\s+(.+)(\d{4})$/",$row['dead_date_old'],$match))
		{
			//echo "<td>".$match[1]."</td>";	//dd
			//echo "<td>".$match[2]."</td>";
			//echo "<td>".$match[3]."</td>";	//yyyy+543
			
			$dd = $match[1];
			$yyyy = (int)$match[3] - 543;
			
			$month_array = array("null","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย."
			,"ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
			if(in_array(trim($match[2]), $month_array)) {
				$mm = array_search(trim($match[2]), $month_array);
			}
			else
			{
				$mm = -1;
			}

			if($mm != -1)
			{
				$full_mysql_date = $yyyy."-".$mm."-".$dd;
			}
			else
			{
				$full_mysql_date = "error";
			}
			
			echo "<td>".$full_mysql_date."</td>";
			if($full_mysql_date != "error")
			{
				//Update Here
				$sql5 = sprintf("UPDATE personel SET dead_date='%s' WHERE personel_id=%s",$full_mysql_date,$row['personel_id']);
				$result5 = mysql_query($sql5);
			}
		}
		else
		{
			echo "<td>"."No Result"."</td>";
		}
		echo "</tr>";

	}
	
	echo "</table>";





?>