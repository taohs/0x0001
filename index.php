<?php

// change the following paths if necessary
$yii=dirname(__FILE__).'/../framework/yii/framework/yiilite.php';
$config=dirname(__FILE__).'/protected/config/main.php';
define('ROOT',dirname(__FILE__));
define('UPLOAD_ADDRESS',ROOT.'/upload');
// remove the following lines when in production mode
error_reporting(0);
defined('YII_DEBUG') or define('YII_DEBUG',true);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

require_once($yii);
Yii::createWebApplication($config)->run();
