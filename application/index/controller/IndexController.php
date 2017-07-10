<?php
namespace app\index\controller;

use think\Controller;
use think\Db;

class IndexController extends Controller
{
	//发送电量接口
    public function index()
    {
//         $result = Db::query('select * from think_posts');
// dump($result);
    	// $sql = "SELECT BatteryLifePercent from interrogator.PowerSample as PS
     //            JOIN dbo.device as DVC
     //            ON DVC.DeviceID = PS.DeviceID
     //            WHERE DVC.SerialNumber = 'DNQLX9TMFP6K'";
     //     $result = Db::execute($sql);       
     //     dump($result);
    $this->success('跳转到项目', 'admin/index/index');
        // $data= array(
        //   'id'=>1,
        //     'data'=>'何'
        // );
        // $this->assign('result',$data);
        // return $this->fetch();
    }
    // 获取版本接口
    public function hello(){
    	$reply = "https://console.emm-yuandingit.com/api/mdm/devices?searchby= Serialnumber&id=DNQLX9TMFP6K";
	    $replyd = new \HttpClient($reply);
		$replymsg = $replyd->setHeader('Content-Type', 'application/json')->get()->getResponseBody();
		echo $replymsg;
    }
}
