<?php
/**
 * 系统模块文件
 */

namespace Core\Lib;

class Model{
    
    private $option = array();
    private $table = '';
    
    // 数据库连接实例化
    static private $db;
    
    
    public function __construct(){
        if(!is_object(self::$db)){
            self::$db = Db::getInstace();
        }
        if(empty($this->table)){
            $table = get_class($this);
            $name = str_replace('\\', '/', $table);
            $suffix     = basename(dirname($name));
            $this->table = ucfirst(substr($table,0,-strlen($suffix)));
        }
    }
    
    /**
     * 查询数据库
     */
    public function select(){
        return self::$db->select($this->table,$this->option);
    }
    
    
    public function table($table){
        $this->table = $table;
        return $this;
    }
    
    
    
}