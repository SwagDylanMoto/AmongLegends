<?php

class PartyAdminAPIController extends Controller {

    private SessionManager $sessionManager;
    private SessionService $sessionService;
    private PartyService $partyService;
    private GameService $gameService;

    private $error = false;

    function __construct() {
        parent::__construct();

        $this->sessionManager = SingletonRegistry::$registry["SessionManager"];
        $this->sessionService = SingletonRegistry::$registry["SessionService"];
        $this->partyService = SingletonRegistry::$registry["PartyService"];
        $this->gameService = SingletonRegistry::$registry["GameService"];
    }

    public function process() {
        $currentSessionDTO = $this->sessionManager->currentSessionDTO;

        if($currentSessionDTO && $currentSessionDTO->admin && $_GET['action']){
            $currentPartyDTO = $this->partyService->get($currentSessionDTO->partyId);

            $currentGameDTO = null;

            if ($currentPartyDTO->activeGameId) {
                $currentGameDTO = $this->gameService->get($currentPartyDTO->activeGameId);
            }

            switch ($_GET['action']) {
                case("kickSession"):
                    if ($_POST['sessionId']) {
                        $this->kickSession($_POST['sessionId']);
                    } else {
                        $this->error('WRONG_PARAMETER');
                    }
                    break;
                default:
                    $this->error("WRONG_ACTION");
                    break;
            }

            if (!$this->error) {
                $this->ok();
            }

        } elseif (!$_GET['action']) {

            $this->error("NO_ACTION");

        } elseif ($currentSessionDTO && !$currentSessionDTO->admin) {

            $this->error("NOT_ADMIN");

        } elseif ($_SESSION['token']) {

            $this->error("NO_ACTIVE_SESSION");

        } else {

            $this->error("NO_SESSION");

        }
    }

    private function kickSession($id) {
        $session = $this->sessionService->get($id);
        if ($session && !$session->admin) {
            $this->sessionService->delete($session);
        } else {
            $this->error('WRONG_PARAMETER');
        }
    }

    private function ok() {
        echo('Ok');
    }

    private function error($error_code) {
        $this->error = true;
        switch($error_code) {
            case("NO_SESSION"):
                header('HTTP/1.0 401 Unauthorized');
                echo 'Aucune session trouvée';
                break;
            case("NO_ACTIVE_SESSION"):
                header('HTTP/1.0 403 Forbidden');
                echo 'Session morte';
                break;
            case("NOT_ADMIN"):
                header('HTTP/1.0 403 Forbidden');
                echo 'Vous n\'êtes pas admin';
                break;
            case("NO_ACTION"):
                header('HTTP/1.0 400 Bad Request');
                echo 'Le paramètre "action" est manquant';
                break;
            case("WRONG_ACTION"):
                header('HTTP/1.0 418 I’m a teapot');
                echo 'Action non reconnue';
                break;
            case("WRONG_PARAMETER"):
                header('HTTP/1.0 400 Bad Request');
                echo 'Mauvais paramètres';
                break;
            default:
                header('HTTP/1.0 400 Bad Request');
                echo 'Erreur';
                break;
        }
    }
}

new PartyAdminAPIController();