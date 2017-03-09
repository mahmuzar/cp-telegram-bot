<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace clientogram\mapper;

class Message extends Mapper {

    private $selectByChat;

    /**
     *
     * @var \PDOStetmant
     */
    private $insert;
    private $selectLastMessageByChatId;
    private $selectActiveChatMessages;

    function __construct() {
        parent::__construct();
        $this->selectByChat = self::$pdo->prepare(
                "SELECT* FROM messages   WHERE chat_id = ? GROUP BY date_send DESC  LIMIT 20");
        $this->selectLastMessageByChatId = self::$pdo->prepare(
                "SELECT*FROM messages WHERE chat_id =? GROUP BY id DESC LIMIT 1 ");
        $this->insert = self::$pdo->prepare("INSERT INTO messages ("
                . "message_id, from_id, chat_id, date_send, text_message) "
                . "VALUES(?, ?, ?, ?, ?);");
        $this->selectActiveChatMessages = self::$pdo->prepare("
        SELECT
          *
        FROM
            messages
        WHERE
            chat_id =(
            SELECT
          chat_id
            FROM
          chat
            WHERE
                chat.active = 1
            
            )");
    }

    /**
     * 
     * @param \clientogram\domain\Message $obj
     */
    function insert($obj) {
        try {
            $this->insert->execute(array(
                $obj->getMessageId(), $obj->getFrom(), $obj->getChat(), $obj->getDateSend(), $obj->getTextMessage()));
            
        } catch (\PDOException $ex) {
            $this->insert->execute(array(
                $obj->getMessageId(), $obj->getFrom(), $obj->getChat(), $obj->getDateSend(), 'Смайлики не поддерживаются'));
            
            $this->insert->closeCursor();
        }
        
    }

    function selectByChat($chat_id) {
        //var_dump($chat_id);
        $this->selectByChat->execute(array($chat_id));
        $array = $this->selectByChat->fetchAll(\PDO::FETCH_ASSOC);
        //var_dump($array);
        $this->selectByChat->closeCursor();
        return $this->getCollection($array);
    }

    function selectByChatAjax($chat_id) {
        // var_dump($chat_id);
        //var_dump($chat_id);
        $this->selectByChat->execute(array($chat_id));
        $array = $this->selectByChat->fetchAll(\PDO::FETCH_ASSOC);
        //var_dump($array);
        $this->selectByChat->closeCursor();
        return array_reverse($array);
    }

    function selectLastMessageByChatId($chat_id) {
        //var_dump($chat_id);
        $this->selectLastMessageByChatId->execute(array($chat_id));
        $array = $this->selectLastMessageByChatId->fetch(\PDO::FETCH_ASSOC);
        //var_dump($array);
        $this->selectLastMessageByChatId->closeCursor();
        if (!is_array($array)) {
            return new \clientogram\domain\Message();
        }
        return $this->doCreateObject($array);
    }

    function selectActiveChatMessages() {
        $this->selectActiveChatMessages->execute(array());
        $array = $this->selectActiveChatMessages->fetchAll(\PDO::FETCH_ASSOC);
        $this->selectActiveChatMessages->closeCursor();
        return $this->getCollection(array_reverse($array));
    }

    /**
     * 
     * @param array $data
     * @return \clientogram\domain\Message
     */
    public function doCreateObject(array $data) {

        extract($data);
        $obj = new \clientogram\domain\Message($id, $message_id, $date_send, $text_message, $chat_id, $from_id);
        return $obj;
    }

    /**
     * 
     * @param array $array
     * @return \clientogram\mapper\MessageCollection
     */
    public function getCollection(array $array) {
        return new \clientogram\mapper\MessageCollection($array, $this);
    }

}
