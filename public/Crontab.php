<?php 
require "http.php";
     $conn=mssql_connect('139.199.29.249:1433','AirWatchAdmin','zap##123'); 
        mssql_select_db('AirWatch',$conn);
        $sql = "SELECT DVC.DeviceID,SerialNumber,BatteryLifePercent from interrogator.PowerSample as PS
                    JOIN dbo.device as DVC
                    ON DVC.DeviceID = PS.DeviceID";
        $result = mssql_query($sql, $conn);  
          
        while($row = mssql_fetch_assoc($result)) { 
            if ($row['BatteryLifePercent']<50) {
                    $url = "https://console.emm-yuandingit.com/api/mdm/devices/serialnumber/".$row['SerialNumber']."/sendmessage/push";
                    $curl = new HttpClient($url);
            $data = array(
                    'MessageBody' => "电量过低", 
                    "MessageType"=> "电量", 
                    "Application"=>"AirWatch Agent"
            );
            $data = json_encode($data, JSON_UNESCAPED_UNICODE);
            $curl->setHeader('Content-Type', 'application/json')->setHeader('aw-tenant-code', 'o5vjF3Iro8pejRyz0trmZrh/VV5BdQiYNJutIYljfww=')->setHeader('Authorization', 'Basic YWRtaW5pc3RyYXRvcjoxcTJ3I0UkUg==')->post($data)->getResponseBody();
                }     
        }  