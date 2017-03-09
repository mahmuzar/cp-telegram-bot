<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace clientogram\controller;

class Request {

    private $params;
    private $markNew = array();

    function __construct() {
        $this->params = $_REQUEST;
        //var_dump($this->params);
    }

    function get($key) {
        if (empty($key)) {
            return NULL;
        }
        return $this->params[$key];
    }

    function set($key, $val) {
        $this->params[$key] = $val;
    }

    function getMethod() {
        return $this->params['method'];
    }

    function getParams($key) {
        if (isset($this->params[$key])) {
            return $this->params[$key];
        }
        return NULL;
    }

    function setParams($key, $val) {
        $this->params[$key] = $val;
    }

    function setMark($chat_id) {
        $this->markNew[] = $chat_id;
    }

    function getMark() {
        return $this->markNew;
    }

}
