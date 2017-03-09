<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace clientogram\domain;

abstract class DomainObject {

    private $id;

    function __construct($id = NULL) {
        if (!is_null($id)) {
            $this->id = $id;
        }
    }

    function getId() {
        return $this->id;
    }

    static function getCollection($type) {
        return new $type;
    }

    function collection() {
        return self::getCollection(get_class($this));
    }

}
