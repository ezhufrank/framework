<?php

/**
 * 默认控制器
 * @author ezhu
 * @version 1.0
 */
namespace App\Controller;
use \Core\Lib\Controller;
use \App\Model\UserModel;

class IndexController extends Controller{
	
	public function index(){
		$data = array('id'=>1,'name'=>'framework');
		//$model = new UserModel();
		$this->assign('data',$data);
		$this->display();
	}
}