<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace clientogram\domain;

class Message extends DomainObject {

    private $messate_id;

    /**
     *
     * @var Member
     */
    private $from;

    /**
     *
     * @var type 
     */
    private $chat_id;

    /**
     * Create message date
     * @var timestamp
     */
    private $date_send;

    /**
     *
     * @var type
     */
    private $text_message;
    private $entities;
    private $photo;

    function __construct($id = null, $message_id = null, $date_send = null, $text_message = null, $chat_id = null, $from = null) {
        parent::__construct($id);
        $this->setMessageId($message_id);
        $this->setDateSend($date_send);
        $this->setTextMessage($text_message);
        $this->setChat($chat_id);
        $this->setFrom($from);
    }

    function setMessageId($message_id) {
        $this->messate_id = $message_id;
    }

    function setFrom($from) {
        $this->from = $from;
    }

    function setChat($chat) {

        $this->chat_id = $chat;
    }

    function setDateSend($date) {
        $this->date_send = $date;
    }

    function setTextMessage($text) {

        if (is_string($text)) {
            $this->text_message = $text;
            return;
        }
        $this->text_message = 'Тип содержимого не поддерживается.';
    }

    function setEntities($entities) {
        $this->entities = $entities;
    }

    function getMessageId() {
        return $this->messate_id;
    }

    function getType() {
        return $this->text_message;
    }

    function getChat() {

        return $this->chat_id;
    }

    function getDateSend($format = null) {
        if (!is_null($format)) {
            $datetime = new \DateTime($this->date_send);
            return $datetime->format($format);
        }
        return $this->date_send;
    }

    function getTextMessage($substr = false) {

        if ($substr) {
            $str = mb_substr($this->text_message, 0, 20);
            $str = trim($str);
            return $str . "..";
        }
        return $this->text_message;
    }

    function getEntities() {
        return $this->entities;
    }

    function getFrom() {
        return $this->from;
    }

    function setPhoto($photo) {
        $this->photo = $photo;
    }

    function addPhoto() {
        $photo = new \clientogram\mapper\Photo();
        $this->photo = $photo->getPhotoByChatId($this->getFrom());
    }

    function getPhoto() {
        $this->addPhoto();
        return $this->photo;
    }

    function insert() {
        $message = new \clientogram\mapper\Message();
        $message->insert($this);
    }

}
