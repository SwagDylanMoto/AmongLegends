<?php

class PartyController extends Controller{

    private $partyService;
    private $sessionManager;

    function __construct() {
        parent::__construct();

        $this->partyService = SingletonRegistry::$registry["PartyService"];
        $this->sessionManager = SingletonRegistry::$registry['SessionManager'];
    }

    public function process() {
        if ($this->sessionManager->currentSessionDTO) {
            $this->front();
        } else {
            header("Location: ".Config::$baseUrl."/login");
        }

    }

    private function front() {
        $base = SingletonRegistry::$registry["Request"]->base;
        include($base.'code/front/header.php');
        include($base.'code/front/page/party.php');
        include($base.'code/front/footer.php');
    }
}

new PartyController();