<?php

// 应用级的常量
defined('APP_ROOT') or define('APP_ROOT', __DIR__);

require_once 'App.php';

$app = new App();
$app->run();
