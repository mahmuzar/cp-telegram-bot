<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace clientogram\mapper;

class Photo extends \clientogram\mapper\Mapper {

    private $select;
    private $udate;
    private $insert;
    private $selectByChatId;

    function __construct() {
        parent::__construct();
        $this->insert = self::$pdo->prepare(
                '
                INSERT
                INTO
                  photo(
                   file_name,
                   DATE_ADD,
                   chat_id,
                   user_id
                  )
                VALUES(
                   ?,
                   ?,
                   ?,
                   ?
                )
                ON DUPLICATE KEY
                UPDATE
                   DATE_ADD = NULL;'
        );
        $this->selectByChatId = self::$pdo->prepare(
                '
                SELECT
                  file_name
                FROM
                  photo
                WHERE
                  chat_id = ?
                ORDER BY
                  DATE_ADD
                DESC
                LIMIT 1;
                '
        );
    }

    public function insert($obj) {

        $this->insert->execute(array($obj->getFileName(), null, $obj->getChatId(), $obj->getUserId()));
        $this->insert->closeCursor();
    }

    public function getPhotoByChatId($chat_id) {
        $this->selectByChatId->execute(array($chat_id));
        $array = $this->selectByChatId->fetch(\PDO::FETCH_ASSOC);
        //var_dump($array);
        $this->selectByChatId->closeCursor();
        if (!is_array($array)) {
            return new \clientogram\domain\Photo();
        }
        return $this->doCreateObject($array);
    }

    public function doCreateObject(array $array) {
        extract($array);
        $obj = new \clientogram\domain\Photo(null, $file_name);
        return $obj;
    }

    public function getCollection(array $array) {
        return new PhotoCollection($array, $this);
    }

}
