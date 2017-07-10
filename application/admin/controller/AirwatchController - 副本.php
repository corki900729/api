<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/23
 * Time: 17:33
 */
namespace app\admin\controller;
use app\admin\model\Administrator;
use app\admin\model\Posts;
use app\admin\controller\AdminAuth;
use think\Validate;
use think\Image;
use think\Request;
class AirwatchController extends AdminAuth{
    private $data = array(
        'module_name' => '设备管理',
        'module_url'  => '/admin/Airwatch/',
        'module_slug' => 'Airwatch',
        'upload_path' => UPLOAD_PATH,
        'upload_url'  => '/public/uploads/',
        'ckeditor'    => array(
            'id'     => 'ckeditor_post_content',
            //Optionnal values
            'config' => array(
                'width'  => "100%", //Setting a custom width
                'height' => '400px',
                // 默认调用 Standard Package，以下代码为调用自定义工具栏，这些基础的主要用于前台用户富文本设置
                // 'toolbar'   =>  array(  //Setting a custom toolbar
                //     array('Source','-','Save','NewPage','DocProps','Preview','Print','-','Templates'),
                //     array('Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo'),
                //     array('Bold','Italic','Underline','Strike','Subscript','Superscript','-','RemoveFormat'),
                //     array('Styles','Format','Font','FontSize'),
                //     array('TextColor','BGColor')
                // )
            )
        ),
    );

    public function index(){
        // $conn=mssql_connect('139.199.29.249:1433','AirWatchAdmin','zap##123'); 
        $conn=mssql_connect('182.150.39.91:1433','sa','Scal123456'); 
        mssql_select_db('AirWatch',$conn);
        $sql = "SELECT DVC.DeviceID,SerialNumber,BatteryLifePercent from interrogator.PowerSample as PS
                    JOIN dbo.device as DVC
                    ON DVC.DeviceID = PS.DeviceID";
        $result = mssql_query($sql, $conn);     
        while($row = mssql_fetch_assoc($result)) {     
                $data[] = $row;    
        }     
        // var_dump($data);exit();
        // mssql_free_result($result);
        $this->assign('data',$data);
        // $this->assign('list',null);
        return $this->fetch();
    }
    public function version(){
        $reply = "https://console.emm-yuandingit.com/api/mdm/devices?searchby= Serialnumber&id=C7KR3JWUGRY8";
        $replyd = new \HttpClient($reply);
        // aw-tenant-code是restapi秘钥
        // Authorization是postman根据用户名密码生成的秘钥
        $replymsg = $replyd->setHeader('Content-Type', 'application/json')->setHeader('aw-tenant-code', 'o5vjF3Iro8pejRyz0trmZrh/VV5BdQiYNJutIYljfww=')->setHeader('Authorization', 'Basic YWRtaW5pc3RyYXRvcjoxcTJ3I0UkUg==')->get()->getResponseBody();
        $replymsg = json_decode($replymsg,true);
        dump($replymsg);
    }
    // 电量不足提示信息
    public function sent(){

        $id = $_REQUEST['id'];
        // echo $id;exit();
        $url = "https://console.emm-yuandingit.com/api/mdm/devices/serialnumber/".$id."/sendmessage/push";
        $cms = new \HttpClient($url);
        $data = array(
                'MessageBody' => "电量过低", 
                "MessageType"=> "电量", 
                "Application"=>"AirWatch Agent"
            );
        $data = json_encode($data, JSON_UNESCAPED_UNICODE);
        $cms->setHeader('Content-Type', 'application/json')->setHeader('aw-tenant-code', 'o5vjF3Iro8pejRyz0trmZrh/VV5BdQiYNJutIYljfww=')->setHeader('Authorization', 'Basic YWRtaW5pc3RyYXRvcjoxcTJ3I0UkUg==')->post($data)->getResponseBody();
        // echo $data;
        // $ch = curl_init($url); //请求的URL地址
        // curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        // curl_setopt($ch, CURLOPT_POSTFIELDS, $data);//$data JSON类型字符串
        // // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'aw-tenant-code: o5vjF3Iro8pejRyz0trmZrh/VV5BdQiYNJutIYljfww=' ,'Authorization: Basic YWRtaW5pc3RyYXRvcjoxcTJ3I0UkUg=='));
        // $data = curl_exec($ch);
        // echo $data;
        echo $cms->getResponseStatusCode();
    }

        public function test(){
        $conn=mssql_connect('139.199.29.249','AirWatchAdmin','zap##123'); 
           mssql_select_db('AirWatch',$conn); 
        //query语句   
         $Query="SELECT * from interrogator.PowerSample as PS
                JOIN dbo.device as DVC
                ON DVC.DeviceID = PS.DeviceID
                WHERE DVC.SerialNumber = 'DNQLX9TMFP6K'"; 
         $AdminResult=mssql_query($Query); 
        //输出结果 
         $Num=mssql_num_rows($AdminResult); 
         for($i=0;$i<$Num;$i++) 
           { 
         $Row=mssql_fetch_array($AdminResult); 
         echo($Row[1]); 
         echo("<br>"); 
           }    
    }
}