<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include 'autoload.php';
//header("Content-type: application/json");
$controller = new clientogram\controller\Controller();
$controller->ajaxProcessing();