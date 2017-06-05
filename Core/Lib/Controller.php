<?php
/**
 * 系统控制文件
 */

namespace Core\Lib;

class Controller
{
	public $assign = array();
	public function __construct()
	{
		
	}
	
	
	/**
	 * 参数赋值
	 */
	public function assign($key,$val)
	{
		$this->assign[$key] = $val;
	}
	
	
	/**
	 * 模板展示页面
	 */
	public function display($file='index')
	{
		$filePath = APP.'/View/'.$file.'.html';
		extract($this->assign);
		if(is_file($filePath)){
			include $filePath;
		}else{
			throw new \Exception('模板文件'.$file.'不存在');
		}
	}
	
}