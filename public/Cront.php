<?php 
require "http.php";
     $conn=mssql_connect('182.150.39.91:1433','sa','Scal123456'); 
        mssql_select_db('AirWatch',$conn);
        $sql = "SELECT DVC.DeviceID,SerialNumber,BatteryLifePercent from interrogator.PowerSample as PS
                    JOIN dbo.device as DVC
                    ON DVC.DeviceID = PS.DeviceID";
        $result = mssql_query($sql, $conn);  
          
        while($row = mssql_fetch_assoc($result)) { 
            if ($row['BatteryLifePercent']<50) {
                    $url = "https://scal.awemm.com/api/mdm/devices/serialnumber/".$row['SerialNumber']."/sendmessage/push";
                    $curl = new HttpClient($url);
            $data = array(
                    'MessageBody' => "电量过低", 
                    "MessageType"=> "电量", 
                    "Application"=>"AirWatch Agent"
            );
            $data = json_encode($data, JSON_UNESCAPED_UNICODE);
            $curl->setHeader('Content-Type', 'application/json')->setHeader('aw-tenant-code', 'Ok0gULrF1Lg5Q2as9k9AnUpRHH9lkksLfQZva/liHJM=')->setHeader('Authorization', 'Basic YWRtaW5pc3RyYXRvcjpTY2FsMTIzNDU2')->post($data)->getResponseBody();
                }     
        }  