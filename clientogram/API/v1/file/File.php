<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace clientogram\API\v1\file;

class File extends \clientogram\API\v1\BotAPI {

    private $file_id;
    private $file_size;
    private $file_path;
    protected $file_name;
    private $file_data;

    function __construct($method = null, $params = null) {
        $this->setApiUri($this->getFileApiUri());
        $this->setMethod($method->file_path);
        $this->generateURI();
        ob_start();
        readfile($this->getRequestURI());
        $c = ob_get_clean();
        $this->file_name = $method->file_id;
        $this->file_data = $c;
       
    }

    function setFileId($file_id) {
        $this->file_id = $file_id;
    }

    function setFileSize($file_size) {
        $this->file_size = $file_size;
    }

    function setFilePath($file_path) {
        $this->file_path = $file_path;
    }

    function getFileId() {
        return $this->file_id;
    }

    function getFileSize() {
        return $this->file_size;
    }

    function getFilePath() {
        return $this->file_path;
    }

    function getFileName(){
        return $this->file_name;
    }
    function getFileData(){
        return $this->file_data;
    }
}
