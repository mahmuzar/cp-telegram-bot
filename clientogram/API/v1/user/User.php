<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace clientogram\API\v1\user;

class User extends \clientogram\API\v1\BotAPI {

    private $user_id;
    private $first_name;
    private $last_name;

    /**
     * This object represent a user's profile pictures.
     * 
     * @var UserProfilePhotos This object represent a user's profile pictures.
     */
    private $userProfilePhotos;

    /**
     * 
     * @param User $user
     */
    function __construct($method = null, $params = null) {
        parent::__construct($method, $params);
    }

    function setId($id) {
        $this->user_id = $id;
    }

    function setFirstName($first_name) {
        $this->first_name = $first_name;
    }

    function setLastName($last_name) {
        $this->last_name = $last_name;
    }

    function getId() {
        return $this->user_id;
    }

    function getFirstName() {
        return $this->first_name;
    }

    function getLastName() {
        return $this->last_name;
    }

    function getProfilePhotos() {
        $photos = new \clientogram\API\v1\user\UserProfilePhotos(
                'getUserProfilePhotos', array(
            'user_id' => $this->getId(),
            'limit' => 1
        ));
        $photos->request();
        $data = json_decode($photos->response());
        $userProfilePhotos = new \clientogram\API\v1\user\UserProfilePhotos('getUserProfilePhotos', array('file_id' => $this->getId()));
        $userProfilePhotos->request();
        $userProfilePhotos->init();
        $this->userProfilePhotos = $userProfilePhotos;
    }

}
