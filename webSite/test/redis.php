<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$redis = new Redis();
$redis->connect('fatih13101990_cache_1', 6379);
$redis->auth('password');
$redis->set("tutorial-name", "Redis deneme value");
echo $redis->get("tutorial-name");