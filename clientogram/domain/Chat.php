<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace clientogram\domain;

class Chat extends DomainObject {

    private $id;
    private $chat_id;
    private $first_name;
    private $last_name;
    private $messages;
    private $mark_new = 0;
    private $lastMessage = '';
    private $lastMessageDate = '';
    private $elect;
    private $active;
    
    private $photo;

    function __construct($id = null, $chat_id = null, $first_name = null, $last_name = null, $elect = null, $mark_new = null, $active = null, $photo = null) {
        $this->setId($id);
        $this->setChatId($chat_id);
        $this->setFirstName($first_name);
        $this->setLastName($last_name);
        $this->setElect($elect);
        $this->setMarkNew($mark_new);
        $this->setActive($active);
        $this->setPhoto($photo);
        $req = \clientogram\base\RequestRegistry::getRequest();
        //var_dump($req);
        //$this->setMarkNew($req->getMark());
    }

    function setChatId($chat_id) {
        $this->chat_id = $chat_id;
    }

    function setPhoto($photo) {
        $this->photo = $photo;
    }
    function addPhoto(){
        $photo = new \clientogram\mapper\Photo();
       
        $this->photo = $photo->getPhotoByChatId($this->getChatId());
        
       
    }

    function getPhoto() {
        
        $this->addPhoto();
        return $this->photo;
    }

    function getChatId() {
        return $this->chat_id;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setFirstName($first_name) {
        $this->first_name = $first_name;
    }

    function setLastName($last_name) {
        $this->last_name = $last_name;
    }

    function getId() {
        return $this->id;
    }

    function getFirstName() {
        return $this->first_name;
    }

    function getLastName() {
        return $this->last_name;
    }

    function insert() {
        $chat = new \clientogram\mapper\Chat();
        $chat->insert($this);
        $chat->mark($this->getChatId());
    }

    function getMessages() {
        if ($this->getActive() == 1) {
            $message = new \clientogram\mapper\Message();
            $this->messages = $message->selectByChat($this->getChatId());
            return $this->messages;
        }
        return $this->messages;
    }

    function setMessages($messagess) {

        $this->messages = $messagess;
    }

    function getMarkNew() {
        return $this->mark_new;
    }

    function setMarkNew($mark_new) {

        $this->mark_new = $mark_new;
    }

    function setElect($elect) {
        $this->elect = $elect;
    }

    function getElect() {
        return $this->elect;
    }

    function setActive($active) {
        if ($active) {
            \clientogram\base\RequestRegistry::getRequest()->setParams('active_chat', $this->getChatId());
        }
        $this->active = $active;
    }

    function getActive() {
        return $this->active;
    }

    /**
     * 
     * @return \clientogram\domain\Message
     */
    function getLastMessage() {
        $message = new \clientogram\mapper\Message();
        $this->lastMessage = $message->selectLastMessageByChatId($this->getChatId());
        return $this->lastMessage;
    }

}
