<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function __autoload($name) {
   //  var_dump($name);
    $str = str_replace('\\', "/", $name);
    require_once __DIR__ . DIRECTORY_SEPARATOR . $str . ".php";
    //var_dump($name);
}

session_start();
