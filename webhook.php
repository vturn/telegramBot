<?php
require_once "config.php";

$tb = new telegramBot($config);
$chatInfo = $tb->getChatInfo();

switch ($chatInfo['message']) {
    case "/test":
        $tb->sendMessage($chatInfo['chatID'], 'Testing now.');
        break;
    case "/hi":
        $tb->sendMessage($chatInfo['chatID'], 'Hey!');
        break;
    default:
        sendMessage($chatInfo['chatID'], $chatInfo['message']);
}