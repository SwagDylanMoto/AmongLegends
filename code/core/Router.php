<?php

class Router extends Singleton {

    private $sessionManager;

    function __construct()
    {
        parent::__construct();
        $this->sessionManager = SingletonRegistry::$registry['SessionManager'];
    }

    function process() {
        $request = SingletonRegistry::$registry['Request'];

        $this->sessionManager->initSession();

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
            print_r($this->sessionManager->currentSessionDTO);
        }
    }
}

new Router();