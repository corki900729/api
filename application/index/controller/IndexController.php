<?php
namespace app\index\controller;

use think\Controller;
use think\Db;

class IndexController extends Controller
{
    public function index()
    {
        $data= array(
          'id'=>1,
            'data'=>'何'
        );
        $this->assign('result',$data);
        return $this->fetch();
    }
}
