<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace clientogram\domain;

class Photo extends \clientogram\domain\DomainObject {

    private $file_name;
    private $date_add;
    private $chat_id;
    private $user_id;

    function __construct($id = NULL, $file_name = null, $date_add = null, $chat_id = null, $user_id = null) {
        parent::__construct($id);
        $this->setFileName($file_name);
        $this->setDateAdd($date_add);
        $this->setChatId($chat_id);
        $this->setUserId($user_id);
    }

    function setFileName($file_name) {
        $this->file_name = $file_name;
    }

    function setDateAdd($date_add) {
        $this->date_add = $date_add;
    }

    function setChatId($chat_id) {
        $this->chat_id = $chat_id;
    }

    function setUserId($user_id) {
        $this->user_id = $user_id;
    }

    function getFileName() {
        return $this->file_name;
    }

    function getDateAdd() {
        return $this->date_add;
    }

    function getChatId() {
        return $this->chat_id;
    }

    function getUserId() {
        return $this->user_id;
    }

    function insert() {
        $photo = new \clientogram\mapper\Photo();
        $photo->insert($this);
    }

}
