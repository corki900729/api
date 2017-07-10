<?php
  //   $url = "https://console.emm-yuandingit.com/api/mdm/devices/messages/push?searchby= Udid&id=83D11AB306C1681869EDCDEF9A891D81F48BD23A";
  //       $cms = new \HttpClient($url);
		// $data = '{
		// 	"MessageBody":"电量过低",
		// 	"MessageType":"电量",
		// 	"Application":"AirWatch Agent"
		// 	}';
  //        $replymsg = $cms->setHeader('Content-Type', 'application/json')->setHeader('aw-tenant-code', 'o5vjF3Iro8pejRyz0trmZrh/VV5BdQiYNJutIYljfww=')->setHeader('Authorization', 'Basic YWRtaW5pc3RyYXRvcjoxcTJ3I0UkUg==')->post($data)->getResponseBody();
        
// 创建连接
$servername = "localhost";
$username = "admin";
$password = "admin";
 
try {
    $conn = new PDO("mysql:host=$servername;dbname=thinkphp", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT electric FROM think_ele"); 
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
    $rec = $stmt->fetch();
    // var_dump($rec['electric']);

}
catch(PDOException $e)
{
    echo $e->getMessage();
}
require "http.php";
     $conn=mssql_connect('182.150.39.91:1433','sa','Scal123456'); 
        mssql_select_db('AirWatch',$conn);
        $sql = "SELECT DVC.DeviceID,SerialNumber,BatteryLifePercent from interrogator.PowerSample as PS
                    JOIN dbo.device as DVC
                    ON DVC.DeviceID = PS.DeviceID";
        $result = mssql_query($sql, $conn);  
          
        while($row = mssql_fetch_assoc($result)) { 
            if ($row['BatteryLifePercent']<$rec['electric']) {
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