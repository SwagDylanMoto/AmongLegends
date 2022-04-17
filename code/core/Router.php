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
                break;
            case("party"):
                include(SingletonRegistry::$registry["Request"]->base."code/controller/PartyController.php");
                break;
            case("logout"):
                include(SingletonRegistry::$registry["Request"]->base."code/controller/LogoutController.php");
                break;
            case("party/api"):
                include(SingletonRegistry::$registry["Request"]->base."code/controller/PartyAPIController.php");
                break;

        }
        $controller = SingletonRegistry::$registry["Controller"];

        if ($controller) {
            $controller->process();
        }
    }
}

new Router();