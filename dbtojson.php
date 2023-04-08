<?php
//fix conf/nginx.conf later because tile server doesn't work properly
//change parameters here:
$DATABASE_HOST= "localhost:3306";
$DATABASE_USERNAME = "root";
$DATABASE_PASSWORD = "Qwe123456";
$DATABASE_NAME = "test_db";
$table_name = "test";
$real_id_name = "Real_Id";
$id_name = "Id";
$timestamp_name = "Timestamp";
$lat_name = "Latitude";
$lon_name = "Longitude";
$hgt_name = "High";
$spd_name = "Speed";
$dir_name = "Direction";
//connection to db
mysql_connect($DATABASE_HOST, $DATABASE_USERNAME, $DATABASE_PASSWORD);
mysql_select_db($DATABASE_NAME);
if (!($file = "$table_name.json")) //output path
{
	$myfile = fopen("$table_name.json","w"); //output path
}
$select_query = "SELECT * FROM $table_name ORDER BY $real_id_name DESC;";
$result = mysql_query($select_query);	
$maxid = mysql_result($result, 0, "$id_name");
$select_query = "SELECT * FROM $table_name WHERE $id_name = $maxid ORDER BY $real_id_name DESC;";
$result = mysql_query($select_query);	
$real_maxid = mysql_result($result, 0, "$real_id_name");
$real_minid = mysql_result($result, 1, "$real_id_name");
$per_page = $real_maxid - $real_minid;
$select_query = "SELECT * FROM $table_name ORDER BY $real_id_name DESC LIMIT $per_page;";
$result = mysql_query($select_query);	
for($i = 0;$i <= ($per_page - 1);$i++){ 
	if ($i == 0) { 
		$current .= "[{\"clientId\":\"".mysql_result($result, $i, "$id_name")."\",\"gpsTime\":\"".mysql_result($result, $i, "$timestamp_name")."\",\"lat\":\"".mysql_result($result, $i, "$lat_name")."\",\"lon\":\"".mysql_result($result, $i, "$lon_name")."\",\"hgt\":\"".mysql_result($result, $i, "$hgt_name")."\",\"speed\":\"".mysql_result($result, $i, "$spd_name")."\",\"dir\":\"".mysql_result($result, $i, "$dir_name")."\"},";
		file_put_contents($file, $current); 
		//echo $current;
	}	
	else {
		if($i == ($per_page - 1)){
			$current = file_get_contents($file);
			$current .= "{\"clientId\":\"".mysql_result($result, $i, "$id_name")."\",\"gpsTime\":\"".mysql_result($result, $i, "$timestamp_name")."\",\"lat\":\"".mysql_result($result, $i, "$lat_name")."\",\"lon\":\"".mysql_result($result, $i, "$lon_name")."\",\"hgt\":\"".mysql_result($result, $i, "$hgt_name")."\",\"speed\":\"".mysql_result($result, $i, "$spd_name")."\",\"dir\":\"".mysql_result($result, $i, "$dir_name")."\"}]\n";
			file_put_contents($file, $current); 
			//echo $current;
		}
		else { 
			$current = file_get_contents($file);
			$current .= "{\"clientId\":\"".mysql_result($result, $i, "$id_name")."\",\"gpsTime\":\"".mysql_result($result, $i, "$timestamp_name")."\",\"lat\":\"".mysql_result($result, $i, "$lat_name")."\",\"lon\":\"".mysql_result($result, $i, "$lon_name")."\",\"hgt\":\"".mysql_result($result, $i, "$hgt_name")."\",\"speed\":\"".mysql_result($result, $i, "$spd_name")."\",\"dir\":\"".mysql_result($result, $i, "$dir_name")."\"},";
			file_put_contents($file, $current); 
			//echo $current;
		}
	} 
}
echo $current;
?>