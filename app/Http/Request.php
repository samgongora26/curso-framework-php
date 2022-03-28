<?php

namespace App\Http;

class Request{
    protected $segments = [];
    protected $controller;
    protected $method;

    // Definimos que se requiere un controlador y un metodo, aunque esten vacios es importante que se inicialice
    public function __construct(){
        $this->segments = explode('/', $_SERVER['REQUEST_URI']);
        // var_dump($this->segments);

        $this->setController();
        $this->setMethod();
    }

    // Con el primer parametro pasado en la URL lo tomamos como el controlador
    public function setController(){
        $this->controller = empty($this->segments[1])
        ? 'home'
        : $this->segments[1];
    }

    // Con el segundo parametro pasado en la URL lo tomamos como el metodo
    public function setMethod(){
        $this->method = empty($this->segments[2])
        ? 'index'
        : $this->segments[2];
    }

    // Busca el controlador con lo que se haya obtenido en setController
    public function getController(){
        //si se obtiene home conviertelo a Home
        $controller = ucfirst($this->controller);

        return "App\Http\Controllers\\{$controller}Controller";
    }

    // Busca el metodo con lo que se haya obtenido en setMethod
    public function getMethod(){
        return $this->method;
    }

    // Funcion como accionador que ejecuta la peticion del usuario
    public function send(){
        $controller = $this->getController();
        $method = $this->getMethod();

        $response = call_user_func([
            new $controller,
            $method
        ]);

        $response->send();
    }

    /*  Con la función call_user_func() se puede ejecutar un método de una clase, 
        ver el siguiente ejemplo:
        <?php
        class miclase {
            static function saludar()
            {
                echo "¡Hola!\n";
            }
        }
        call_user_func(['miclase', 'saludar']); 
    */
}