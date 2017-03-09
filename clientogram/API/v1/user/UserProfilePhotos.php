<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace clientogram\API\v1\user;

class UserProfilePhotos extends \clientogram\API\v1\BotAPI {

    /**
     *
     * @var int
     */
    private $total_count;

    /**
     *
     * @var array
     */
    private $photos;

    function __construct($method = null, $params = null) {
        parent::__construct($method, $params);
    }

    function getPhotos() {
        return $this->photos;
    }

    function getTotalCount() {
        return $this->total_count;
    }

    function setPhotos($photos) {
        
        $this->photos = $photos[0][0];
        
    }

    function setTotalCount($total_count) {
        $this->total_count = $total_count;
    }

    function init() {
        $data = json_decode($this->response());
        $this->setStatus($data->ok);
        $this->setTotalCount($data->result->total_count);
        $this->setPhotos($data->result->photos);
    }

}
