<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace clientogram\base;

class RequestRegistry extends \clientogram\base\Registry {

    private $values = array();
    private static $instance;

    private function __construct() {
        
    }

    static function instance() {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    protected function get($key) {
        if (isset($this->values[$key])) {
            return $this->values[$key];
        }
        return NULL;
    }

    protected function set($key, $val) {
        $this->values[$key] = $val;
    }

    /**
     * 
     * @return type \woo\controller\Request
     */
    static function getRequest() {
        return self::instance()->get('request');
    }

    static function setRequest(\clientogram\controller\Request $request) {
        return self::instance()->set("request", $request);
    }

}
