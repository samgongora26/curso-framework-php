<?php

namespace App\Http\Controllers;
// use App\Http\Response;

class ContactController{
    public function index(){
        return new \App\Http\Response('contact');
    }
}