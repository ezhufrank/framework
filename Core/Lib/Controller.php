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
        
        $loader = new \Twig_Loader_Filesystem(APP.'/View');
        $twig = new \Twig_Environment($loader, array(
                'cache' => CACHE.'/Template',
                'debug' => APP_DEBUG
        ));
        
        echo $twig->render($file.'.html',$this->assign);
    }
    
}