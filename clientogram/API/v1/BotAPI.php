<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace clientogram\API\v1;

class BotAPI {

    /**
     * Response status
     * @var boolean
     */
    private $status;
    private $APIURI = "https://api.telegram.org/bot";
    private $FILEURI = "https://api.telegram.org/file/bot";
    private $file_path;

    /**
     * метод запроса к API
     * @var string
     */
    private $method = '';

    /**
     * параметры http запроса
     * Например: 'user_id'=>3
     * @var array
     */
    private $params = array();

    /**
     * telegram api json data
     * @var json
     */
    private $response = '';
    private $token = "348216871:AAEZD62aXaeDD0hWxdATloM-kLekLYXnyqw";
    private $requestURI = '';

    function __construct($method = null, $params = null) {
        if (is_null($method)) {
            $this->method = 'getUpdates';
        } else {
            $this->method = $method;
        }
        if (!is_null($params)) {
            $this->setParams($params);
        }
    }

    function request() {
        $this->generateURI();
        $opts = array(
            'http' => array(
                'method' => "POST",
                'header' => array("Content-type: application/x-www-form-urlencoded;"),
                'content' => $this->getParams()
            )
        );

        $context = stream_context_create($opts);
        $this->response = file_get_contents($this->getRequestURI(), FALSE, $context);
    }

    function response() {
        if (!empty($this->response->result)) {
            
        }
        return $this->response;
    }

    function setParams($params) {
        $this->params = http_build_query($params);
    }

    function getParams() {
        if (empty($this->params)) {
            return;
        }
        return $this->params;
    }

    function getToken() {
        return $this->token;
    }

    function getMethod() {
        return $this->method;
    }

    function setMethod($method) {
        $this->method = $method;
    }

    function getApiUri() {
        return $this->APIURI;
    }

    function setApiUri($uri) {
        $this->APIURI = $uri;
    }

    function setFileApiUri($file_api_uru) {
        $this->FILEURI = $file_api_uru;
    }

    function getFileApiUri() {
        return $this->FILEURI;
    }

    function getRequestURI() {
        return $this->requestURI;
    }

    function setRequestURI($uri) {
        $this->requestURI = $uri;
    }

    function setFilePath($file_path) {
        $this->file_path = $file_path;
    }

    function getFilePath() {
        return $this->file_path;
    }

    function generateURI() {
        $this->setRequestURI($this->getApiUri() . $this->getToken() . '/' . $this->getMethod());
    }

    /**
     * 
     * @param \clientogram\API\v1\file\File $file_id
     */
    function getFile($file_id) {
        $this->setMethod('getFile');
        $this->setParams(array('file_id' => $file_id));
         $this->request();
        return $this->response();
    }

    function setStatus($status) {
        $this->status = $status;
    }

}
