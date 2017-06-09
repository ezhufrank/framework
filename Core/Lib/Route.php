<?php

/**
 * 系统路由文件
 * @author ezhu
 * @version 1.0
 */

namespace Core\Lib;


class Route
{
    
    // 控制器
    public $controller;
    
    // 控制器中的方法
    public $action;
    
    public function __construct()
    {
        // 加载配置
        $config = new Config(APP.'/Config');
        $defaultCtl = $config['Config']['DEFAULT_CONTROLLER'];
        $defaultAct = $config['Config']['DEFAULT_ACTION'];
        
        if(isset($_SERVER['REQUEST_URI']) && $_SERVER['REQUEST_URI'] != '/'){
            // 1、/Index/index
            $pathArr = explode('/',trim($_SERVER['REQUEST_URI'],'/'));
            
            if(isset($pathArr[0])){
                $this->controller = $pathArr[0];
                unset($pathArr[0]);
            }
            if(isset($pathArr[1])){
                $this->action = $pathArr[1];
                unset($pathArr[1]);
            }else{
                $this->action = $defaultAct;
            }
            
            $count = count($pathArr);
            if($count){
                $count += 2;
                $i = 2;
                while($i < $count){
                    if(isset($pathArr[$i+1])){
                        $_GET[$pathArr[$i]] = $pathArr[$i+1];
                    }
                    $i += 2;
                }
            }
        }else{
            // 1、设置默认的路由
            $this->controller = $defaultCtl;
            $this->action = $defaultAct;
        }
    }
    
    
    
}