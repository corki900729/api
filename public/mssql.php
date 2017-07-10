<?php
	header("Content-type: text/html; charset=utf-8");
	ini_set('display_errors','ON');
	ini_set('error_reporting',E_ALL&~E_NOTICE);
$conn=mssql_connect('182.150.39.91:1433','sa','Scal123456'); 
	// $conn=mssql_connect('139.199.29.249:1433','AirWatchAdmin','zap##123'); 
mssql_select_db('AirWatch',$conn);
$result = mssql_query("SELECT top 5 * FROM telecom.ApplicationGroup", $conn);     
while($row = mssql_fetch_array($result)) {     
        var_dump($row);     
}     
mssql_free_result($result);
