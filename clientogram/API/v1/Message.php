<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace clientogram\API\v1;

class Message {

    private $messate_id;

    /**
     *
     * @var User
     */
    private $from;

    /**
     *
     * @var type 
     */
    private $chat;

    /**
     * Create message date
     * @var timestamp
     */
    private $date;

    /**
     *
     * @var type
     */
    private $text;
    private $entities;

    function __construct() {
        
    }

    function setMessageId($message_id) {
        $this->messate_id = $message_id;
    }

    function setFrom($from) {
        $this->from = $from;
    }

    function setChat($chat) {

        $this->chat = $chat;
    }

    function setDate($date) {
        $this->date = $date;
    }

    function setText($text) {
        $this->text = $text;
    }

    function setEntities($entities) {
        $this->entities = $entities;
    }

    function getMessageId() {
        return $this->messate_id;
    }

    function getType() {
        return $this->text;
    }

    function getChat() {

        return $this->chat;
    }

    function getDate() {
        return $this->date;
    }

    function getText() {
        return $this->text;
    }

    function getEntities() {
        return $this->entities;
    }

}
