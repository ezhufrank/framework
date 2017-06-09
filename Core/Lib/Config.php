<?php
/**
 * 系统配置文件自动加载类
 * @author ezhu 
 * @version 1.0
 */

namespace Core\Lib;


class Config implements \ArrayAccess{
    // 配置文件目录
    protected $path = '';
    // 配置值
    protected $config;
    
    public function __construct($path){
        $path && $this->path = $path;
    }
    
    /**
     * 获取配置内容
     */
    public function offsetGet($key){
        if(!isset($this->config[$key])){
            $file = $this->path.'/'.$key.'.php';
            $config = include $file;
            $this->config[$key] = $config;
        }
        return $this->config[$key];
    }
    
    
    /**
     * 设置配置内容
     */
    public function offsetSet($key, $value){
        if(isset($this->config[$key])){
            $this->config[$key] = $value;
        }
    }
    
    /**
     * 删除配置
     */
    public function offsetUnset($key){
        unset($this->config[$key]);
    }
    
    
    /**
     * 查看配置内容是否存在
     */
    public function offsetExists($key){
        return isset($this->config[$key]);
    }
}