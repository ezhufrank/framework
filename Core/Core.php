<?php
/**
 * 系统核心文件
 * @author ezhu
 * @version 1.0
 */

namespace Core;

class Core{
    
    /**
     * 初始化
     * 1、定义系统自动加载函数
     * 2、路由规则
     */
    // 类变量保存
    static private $classArr = array();
    
    static public function run(){
        spl_autoload_register('self::load');
        
        $whoops = new \Whoops\Run;
        $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
        $whoops->register();
        // 路由类实现
        $route = new \Core\Lib\Route();
        $action = $route->action;
        $classFile = APP.'/Controller/'.$route->controller.'Controller.php';
        $class = '\App\Controller\\'.$route->controller.'Controller';
        if(is_file($classFile)){
            $ctr = new $class();
            if(!method_exists($ctr,$action)){
                throw new \Exception('未定义的方法'.$action);
            }
            $ctr->$action();
        }else{
            throw new \Exception('控制器'.$route->controller.'不存在');
        }
    }
    
    
    /**
     * 系统自动加载类
     */
    static public function load($class){
        // new \core\core;
        // core/core.php
        $class = str_replace('\\','/',$class);
        $file = ROOT.'/'.$class.'.php';
        if(isset(self::$classArr[$class])){
            return true;
        }
        
        if(is_file($file)){
            include $file;
            self::$classArr[$class] = $class;
        } else {
            return false;
        }
        
    }
    
}
