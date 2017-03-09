<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace clientogram\mapper;

abstract class Mapper {

    /**
     *
     * @var \PDO
     */
    protected static $pdo;

    function __construct() {
        if (!isset(self::$pdo)) {
            self::$pdo = new \PDO("mysql:dbname=clientogram;host=127.0.0.1;charset=utf8", 'clientogram', 'clientogram123');
            self::$pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        }
    }
    /**
     * 
     * @param array $data
     * @return \clientogram\domain\DomainObject
     */
    function createObject(array $data) {
       $obj= $this->doCreateObject($data);
       return $obj;
    }

    abstract function doCreateObject(array $data);
    abstract  function getCollection(array $array);
}
