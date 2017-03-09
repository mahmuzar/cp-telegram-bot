<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
error_reporting(E_ALL);
ini_set("display_errors", 1);
include 'autoload.php';
echo "<pre>";
$user = new \clientogram\API\v1\user\UserProfilePhotos(
        'getUserProfilePhotos', array(
    'user_id' => 99856315,
        ));
$user->request();
$user->init();
echo "<pre>";
//var_dump(json_decode($user->response()));
$photo = $user->getPhotos();
$res = $user->getFile($photo->file_id);
var_dump($photo);
/* Пытаемся открыть */
$res = json_decode($res);
//$file = new \clientogram\API\v1\file\File($res->result);

//var_dump($file);
