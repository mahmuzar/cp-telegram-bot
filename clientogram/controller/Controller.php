<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace clientogram\controller;

class Controller {

    private $messages;
    private $reqMethod;
    private $reqParams;
    private $request;
    private $newMessage = array();
    private $last_id;

    function __construct() {
        $this->request = new Request();
        \clientogram\base\RequestRegistry::setRequest($this->request);
    }

    function run() {
        file_put_contents('json.php', json_encode(0));
        //сохраним последний id обновлений от API, чтобы задавать offset для метода getUpdates
        if (!isset($_SESSION['last_id'])) {
            $_SESSION['last_id'] = 0;
        }
        if (!isset($_SESSION['last_profile_photo_id'])) {
            $_SESSION['last_profile_photo_id'] = 0;
        }
        if (is_null($this->request->getParams('method'))) {
            $bot = new \clientogram\API\v1\BotAPI('getUpdates', $this->getUpdates());
        } else {
            $bot = new \clientogram\API\v1\BotAPI($this->request->getMethod(), $this->{$this->request->getMethod()}());
        }


        $bot->request();
        $data = json_decode($bot->response());
        if (!empty($data->result)) {
            $_SESSION['last_id'] = $data->result[count($data->result) - 1]->update_id;
            foreach ($data->result as $res) {
                file_put_contents('json.php', json_encode(1));
                $this->request->setMark($res->message->chat->id);
                $message = new \clientogram\domain\Message();
                $message->setMessageId($res->message->message_id);
                $message->setFrom($res->message->from->id);
                $message->setChat($res->message->chat->id);
                $date = new \DateTime();
                $date->setTimestamp($res->message->date);
                $message->setDateSend($date->format('Y-m-d H:i:s'));
                $message->setTextMessage($res->message->text);
                $message->insert();
                //
                $member = new \clientogram\domain\Member();
                $member->setUserId($message->getFrom());
                $member->setFirstName(!empty($res->message->from->first_name) ? $res->message->from->first_name : null);
                $member->setLastName(!empty($res->message->from->last_name) ? $res->message->from->last_name : NULL);
                $member->insert();
                //
                $chat = new \clientogram\domain\Chat();
                $chat->setChatId($message->getChat());
                $chat->setFirstName($res->message->chat->first_name);
                $chat->setLastName(!empty($res->message->chat->last_name) ? $res->message->chat->last_name : NULL);
                //$chat->setPhoto($this->getProfilePhoto($message->getChat()));
                $chat->insert();
                //
                $photo = new \clientogram\domain\Photo();
                $photo->setFileName($this->getProfilePhoto($chat->getChatId()));
                $photo->setDateAdd(NULL);
                $photo->setChatId($chat->getChatId());
                $photo->setUserId($chat->getChatId());
                $photo->insert();
            }
            unset($data->result);
        }

        //$this->init();

        
    }

    /** некоторые запросы ajax шлются на этот метод.
     * Он определяет дальше какой метод вызывать
     */
    function ajaxProcessing() {
        $this->{$this->request->getMethod()}($this->request->getParams('chat_id'));
    }

    function sendMessage($data) {
        $obj = new \clientogram\domain\Message(NULL, 0, NULL, $data['text'], $data['chat_id'], 1);
        $message = new \clientogram\mapper\Message();
        $message->insert($obj);
        $bot = new \clientogram\API\v1\BotAPI($this->request->getMethod(), array('chat_id' => $data['chat_id'], 'text' => $data['text']));
        $bot->request();
    }

    function chatFrame() {
        $this->init();
    }

    function getChat() {
        return array('chat_id' => 99856315);
    }

    function getUpdates() {
        return array('offset' => $_SESSION['last_id'] + 1);
    }

    function getUpdate() {
        
    }

    function getOffset() {
        
    }

    function getUserProfilePhotos() {
        return array('user_id' => 99856315);
    }

    function generateJson() {
        
    }

    /**
     * Добавляем чат в "избранные"
     * 
     * @param int|string $chat_id
     */
    function updateElect($chat_id) {
        $chat = new \clientogram\mapper\Chat();
        $chat->updateElect($chat_id);
    }

    function mark($chat_id) {
        $chat = new \clientogram\mapper\Chat();
        $chat->mark($chat_id);
    }

    /**
     * Метод для ajax запроса
     * @param json $chat_id
     */
    function getChatMessages($chat_id) {
        $message = new \clientogram\mapper\Message();
        $data = $message->selectByChatAjax($chat_id);
        header("Content-type: application/json");
        echo json_encode($data);
    }

    function init() {
        $chat = new \clientogram\mapper\Chat();
        $collection = $chat->select();
        $this->request->setParams('data', $collection);
        //$this->mesageFrame();
    }

    function getProfilePhoto($user_id) {
        $user = new \clientogram\API\v1\user\UserProfilePhotos(
                'getUserProfilePhotos', array('user_id' => $user_id));
        $user->request();
        $user->init();
        $photo = $user->getPhotos();
        //var_dump($photo);
        $result = $user->getFile($photo->file_id);
        //echo $photo->file_id;
        $result = json_decode($result);
        $file = new \clientogram\API\v1\file\File($result->result);
        $resource = imagecreatefromstring($file->getFileData());
        $filename = __DIR__ . '/../images/' . $file->getFileName() . '.jpg';
        if (!file_exists($filename)) {
            imagejpeg($resource, $filename);
        }
        return $file->getFileName() . '.jpg   ';
    }

    function active($chat_id) {
        $chat = new \clientogram\mapper\Chat();
        $chat->active($chat_id);
    }

    function mesageFrame() {
        $message = new \clientogram\mapper\Message();
        $messages = $message->selectActiveChatMessages();
        $this->request->setParams('messages', $messages);
    }

}
