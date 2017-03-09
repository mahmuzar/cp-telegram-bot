<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Chat {

    /**
     * Идентификатор чата
     * @var int
     */
    private $id = 0;
    private $first_name;
    private $last_name;
    private $type;

    function __construct() {
        
    }

    function setId($id) {
        $this->id = $id;
    }

    function setFirstName($first_name) {
        $this->first_name = $first_name;
    }

    function setLastName($last_name) {
        $this->last_name;
    }

    function setType($type) {
        $this->type = $type;
    }
    function getType(){
        return $this->type;
    }
    function getId(){
        return $this->id;
    }
    function getFirstName(){
        return $this->first_name;
    }
    function getLastName(){
        return $this->last_name;
    }

}
