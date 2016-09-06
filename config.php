<?php
$config = array(
    'token' => '';    //enter token here
    'file' => 'tele.txt';    //storing chat IDs for broadcast
);

if (strlen($config['token']) == 0){
    die('Please update Telegram token in config.php!');
}