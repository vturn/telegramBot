<?php
require_once "config.php";
$tb = new telegramBot($config);
$tb->broadcastMessage('Welcome');