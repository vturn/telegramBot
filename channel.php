<?php
require_once "config.php";
$tb = new telegramBot($config);
$channel = ""; //add channel name here
if (strlen($channel)==0){
    die("Please add channel name!");
}

$message = "This is a bot message.";
$result = $tb->sendMessage($channel, $message);var_dump($result);
var_dump($result);
