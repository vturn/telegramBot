<?php

class telegramBot {

    private $token = null;
    private $file = null;

    public function __construct($config){
        if (!isset($config['file'])){
            die('No file given!');
        }
        if (!isset($config['token'])){
            die('Please update Telegram token!');
        }
        $this->file = $config['file'];
        $this->token = $config['token'];
    }

    public function callAPI($method = null, $params = array()){
        if (strlen($method) == null){
            die('Call method is required.');
        }
        $postfix = array();
        foreach ($params as $key => $value){
            $postfix[] = $key . '=' . $value;
        }
        $url = 'https://api.telegram.org/bot' . $this->token . '/' . $method . '?' . implode('&', $postfix);
        return file_get_contents($url);
    }

    public function sendMessage ($chatId, $message) {
        return $this->callAPI('sendMessage', array('chat_id' => $chatId, 'text' => urlencode($message)));
    }

    public function sendHTMLMessage ($chatId, $message) {
        return $this->callAPI('sendMessage', array('chat_id' => $chatId, 'text' => urlencode($message), 'disable_web_page_preview' => 'true', 'parse_mode' => 'html'));
    }

    public function updateChatList($chatID = null){
        if ($chatID == null){
            return;
        }
        $chatids = $this->getChatList();
        if (!in_array($chatID, $chatids)){
            $chatids[] = $chatID;
        }
        $this->saveFile($chatids);
    }

    public function getChatList(){
        if (file_exists($this->file)){
            return json_decode(file_get_contents($this->file), false);
        }
        return array();
    }

    public function saveFile($array){
        $file = fopen($this->file,"w");
        $result = fwrite($file,json_encode($array));
        if (!$result){
            die('ERROR writing file!');
        }
        fclose($file);
    }

    public function getChatInfo(){
        // read incoming info and grab the chatID
        $update = json_decode(file_get_contents("php://input"), true);
        $chatID = $update["message"]["chat"]["id"];
        $message = $update["message"]["text"];
        $this->updateChatList($chatID);

        return array('chatID' => $chatID, 'message' => $message);
    }

    public function setWebhook($https_url){
        $result = $this->callAPI('setWebhook', array('url' =>$https_url));
        return json_decode($result, true);
    }

    public function broadcastMessage($message){
        // read incoming info and grab the chatID
        $chatids = $this->getChatList();
        foreach ($chatids as $chatid){
            $this->sendMessage($chatid, $message);
        }
    }
}