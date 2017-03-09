<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace clientogram\mapper;

class Member extends Mapper {

    private $insert;
    private $select;

    function __construct() {
        parent::__construct();
        $this->select = self::$pdo->prepare("SELECT*FROM users;");
        $this->insert = self::$pdo->prepare("INSERT IGNORE INTO users("
                . "user_id,first_name,last_name) VALUES(?, ?, ?);"
        );
    }

    function select() {
        $this->select->execute();
        $array =  $this->select->fetchAll(\PDO::FETCH_ASSOC);
        $this->select->closeCursor();
        return $this->getCollection($array);
    }

    /**
     * 
     * @param \clientogram\domain\Member $obj
     */
    function insert($obj) {
        $this->insert->execute(array(
            $obj->getUserId(), $obj->getFirstName(), $obj->getLastName()));
        $this->insert->closeCursor();
    }

    public function doCreateObject(array $data) {
        extract($data);
        return new \clientogram\domain\Member($id, $user_id, $first_name, $last_name);
    }

    public function getCollection(array $array) {
        return new \clientogram\mapper\MemberCollection($array, $this);
    }

}
