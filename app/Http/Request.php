<?php

namespace App\Http;

class Request{
    protected $segments = [];
    protected $controller;
    protected $method;

    public function __construct(){
        $this->segments = explode('/', $_SERVER['REQUEST_URI']);
        var_dump($this->segments);

        $this->setCOntroller();
        $this->setMethod();
    }

    public function setController(){
        $this->controller = empty($this->segments[1])
        ? 'home'
        : $this->segments[1];
    }

    public function setMethod(){
        $this->controller = empty($this->segments[2])
        ? 'index'
        : $this->segments[2];
    }
}