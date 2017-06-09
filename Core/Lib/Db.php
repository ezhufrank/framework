<?php

use Core\Lib\Config;
/**
 * 数据库操作中间控件
 * @author ezhu
 * @version 1.0
 *
 */


class Db{
    
    // 数据库实例对象
    static private $db;
    
    // 数据库操作表
    
    // 数据库查询条件
    
    private function __construct(){
        
    }
    
    
    /**
     * 实例化数据库连接对象，支持dsn连接
     * @param string $config
     * @throws \Exception
     */
    static public function getInstace($config=null){
        if(!is_object(static::$db)){
            $option = self::parseConfig($config);
            if(empty($option['type'])){
                throw new \Exception('Undefined Db Type!');
            }else{
                $class = '\Core\Lib\Db\\'.ucwords($option['type']);
                self::$db = new $class($option);
            }
        }
        return self::$db;
    }
    
    
    /**
     * 解析配置
     * @param unknown $config
     */
    static function parseConfig($config=null){
        if(empty($config)){
            $configure = new Config('Config');
            $config = $configure['Db'];
        }elseif(is_string($config) && strpos($config,'/') === true){
            $config = self::parseDsn($config);
        }
        return $config;
    }
    
    /**
     * DSN解析
     * 格式： mysql://username:passwd@localhost:3306/DbName?param1=val1&param2=val2#utf8
     * @param unknown $dsn
     */
    static function parseDsn($dsn){
        $info = parse_url($dsn);
        if(empty($info)){
            return array();
        }
        
        $dsn['type'] = $info['scheme'];
        $dsn['username'] = isset($info['user']) ? $info['user'] : '';
        $dsn['password'] = isset($info['pass']) ? $info['user'] : '';
        $dsn['hostname'] = isset($info['host']) ? $info['user'] : '';
        $dsn['hostport'] = isset($info['port']) ? $info['user'] : '';
        $dsn['database'] = !empty($info['path']) ? ltrim($info['path'] ,'/'): '';
        $dsn['charset'] = isset($info['fragment']) ? $info['fragment'] : 'utf8';
        return $dsn;
    }
    
    
    
    
    
    
}