<?php
require_once "config.php";
$https_url = '';  //enter the HTTPS webhook url
if (strlen($https_url) == 0){
    die('Enter the HTTPS webhook url!');
}
$tb = new telegramBot($config);
$result = $tb->setWebhook($https_url);

var_dump($result);