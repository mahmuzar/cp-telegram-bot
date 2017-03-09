<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace clientogram\mapper;

class ChatCollection extends \clientogram\mapper\Collection{
    
    public function targetClass() {
        return '\clientogram\domain\Chat';
    }

}