<?php

/**
 * 入口文件
 * @author ezhu
 * @version 1.0
 */

/**
 * 1、定义常量
 * 2、加载系统函数
 * 3、启动
 * @var unknown
 */

define('ROOT',str_replace('\\','/',dirname(__FILE__)));
define('APP',ROOT.'/App');
define('CORE',ROOT.'/Core');


// 加载composer
include ROOT.'/vendor/autoload.php';

include CORE.'/common/functions.php';

include CORE.'/Core.php';

\Core\Core::run();

