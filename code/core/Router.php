<?php

class Router extends Singleton {

    function __construct()
    {
        parent::__construct();
    }

    function process() {
        $request = SingletonRegistry::$registry['Request'];

        $controller = null;
        switch($request->page) {
            case("index"):
                header("Location: ".Config::$baseUrl."/login");
                break;
            case("login"):
                include(SingletonRegistry::$registry["Request"]->base."code/controller/LoginController.php");
                $controller = SingletonRegistry::$registry["Controller"];
                break;
            case("party"):
                include(SingletonRegistry::$registry["Request"]->base."code/controller/PartyController.php");
                $controller = SingletonRegistry::$registry["Controller"];
                break;
        }
        if ($controller) {
            $controller->process();
        }
    }
}

new Router();