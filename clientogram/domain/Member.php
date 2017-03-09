<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace clientogram\domain;

class Member extends DomainObject {

    private $id;
    private $user_id;
    private $first_name;
    private $last_name;
    private $messages;
    private $markNew = 0;
    private $profile_photo;

    function __construct($id = null, $user_id = null, $first_name = null, $last_name = null, $messages = null) {
        $this->setId($id);
        $this->setUserId($user_id);
        $this->setFirstName($first_name);
        $this->setLastName($last_name);
        $req = \clientogram\base\RequestRegistry::getRequest();
        //var_dump($req);
        $this->setMarkNew($req->getMark());
    }

    function setUserId($user_id) {
        $this->user_id = $user_id;
    }

    function getUserId() {
        return $this->user_id;
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
        $member = new \clientogram\mapper\Member();
        $member->insert($this);
    }

    function getMessages() {
        $message = new \clientogram\mapper\Message();
        $this->messages = $message->selectByChat($this->getUserId());
        return $this->messages;
    }

    function setMessages($messagess) {

        $this->messages = $messagess;
    }

    function getMarkNew() {
        return $this->markNew;
    }

    function setMarkNew($array) {
        //var_dump($this->getUserId());
        //var_dump($array);
        if (array_search($this->getUserId(), $array) !== FALSE) {
            $this->markNew = "mark";
        }
    }
    function getProfilePhoto(){
        if(empty($this->profile_photo)){
            return "/clientogram/images/user.png";
        }
    }

}
