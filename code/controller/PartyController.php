<?php

class PartyController extends Controller{

    private $partyService;

    function __construct() {
        parent::__construct();

        $this->partyService = SingletonRegistry::$registry["PartyService"];
    }

    public function process() {
        if ($_POST["nickname"]) {
            $partyCode = "";
            if ($_GET["party"]) {
                if ($this->partyService->getPartyActiveByCode($_GET["party"])) {
                    $partyCode =  $_GET["party"];
                }
            }
            if ($partyCode == "") {
                print_r($this->partyService->createParty());
            }
            //header("Location: ".Config::$baseUrl."/game?party=".$partyCode);
        }

        $this->front();
    }

    private function front() {
        $base = SingletonRegistry::$registry["Request"]->base;
        include($base.'code/front/header.php');
        include($base.'code/front/page/party.php');
        include($base.'code/front/footer.php');
    }
}