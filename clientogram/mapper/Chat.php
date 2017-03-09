<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace clientogram\mapper;

class Chat extends Mapper {

    private $insert;
    private $select;
    private $updateElect;
    private $lastMessage;
    private $mark;
    private $active;
    private $selectLastActive;

    function __construct() {
        parent::__construct();
        $this->select = self::$pdo->prepare("SELECT*FROM chat;");
        $this->insert = self::$pdo->prepare("INSERT IGNORE INTO chat(chat_id,first_name,last_name) VALUES(?, ?, ?);");
        $this->lastMessage = self::$pdo->prepare("SELECT;");
        $this->mark = self::$pdo->prepare("");
        $this->updateElect = self::$pdo->prepare('UPDATE  chat SET  `elect` = IF(`elect` > 0, 0, 1)WHERE  chat_id = ?;');
        $this->mark = self::$pdo->prepare('UPDATE  chat SET  `mark_new` = IF(`mark_new` > 0, 0, 1)WHERE  chat_id = ?;');
        $this->active = self::$pdo->prepare('UPDATE  chat SET  `active` = IF(`active` < 1, 1, 0)WHERE  chat_id = ?;');
    }

    /**
     * 
     * @return \clientogram\mapper\MessageCollection
     */
    function select() {

        $this->select->execute();
        $array = $this->select->fetchAll(\PDO::FETCH_ASSOC);
        $this->select->closeCursor();
        return $this->getCollection($array);
    }

    /**
     * 
     * @param \clientogram\domain\Chat $obj
     */
    function insert($obj) {
        //var_dump($obj);
        $this->insert->execute(array($obj->getChatId(), $obj->getFirstName(), $obj->getLastName()));
        $this->insert->closeCursor();
    }

    function updateElect($chat_id) {
        $this->updateElect->execute(array($chat_id));
        $this->updateElect->closeCursor();
    }

    public function doCreateObject(array $data) {
        // var_dump($data);
        extract($data);
        return new \clientogram\domain\Chat($id, $chat_id, $first_name, $last_name, $elect, $mark_new, $active);
    }

    public function active($chat_id) {


        self::$pdo->beginTransaction();
        self::$pdo->exec("
        UPDATE
            chat AS tl1
        INNER JOIN
         (
        SELECT
          chat_id
        FROM
         chat
         ORDER BY
           active = 1
         DESC
        LIMIT 1
        ) AS tb2
        SET
            tl1.active = 0
        WHERE
            tl1.chat_id = tb2.chat_id;");
        $this->active->execute(array($chat_id));
        self::$pdo->commit();
    }

    public function mark($chat_id) {
        $this->mark->execute(array($chat_id));
        $this->mark->closeCursor();
    }

    public function getCollection(array $array) {
        return new \clientogram\mapper\ChatCollection($array, $this);
    }

}
