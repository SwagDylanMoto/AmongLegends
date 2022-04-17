<?php

class PartyAPIController extends Controller {

    private SessionManager $sessionManager;
    private SessionService $sessionService;
    private PartyService $partyService;
    private GameService $gameService;

    function __construct() {
        parent::__construct();

        $this->sessionManager = SingletonRegistry::$registry["SessionManager"];
        $this->sessionService = SingletonRegistry::$registry["SessionService"];
        $this->partyService = SingletonRegistry::$registry["PartyService"];
        $this->gameService = SingletonRegistry::$registry["GameService"];
    }

    public function process() {
        $currentSessionDTO = $this->sessionManager->currentSessionDTO;

        if($currentSessionDTO){
            $currentPartyDTO = $this->partyService->get($currentSessionDTO->partyId);

            $currentGameDTO = null;

            if ($currentPartyDTO->activeGameId) {
                $currentGameDTO = $this->gameService->get($currentPartyDTO->activeGameId);
            }

            $partyWorkflowDTO = new PartyWorkflowDTO();

            if(!$currentGameDTO) {
                $partyWorkflowDTO->state = SingletonRegistry::$registry["PartyStatut"]->partyStatutEnum[0];//Lobby
                $partyWorkflowDTO->data = $this->getPartyLobbyDTO($currentPartyDTO);
            } else {

            }

            $this->json($partyWorkflowDTO);

        } elseif ($_SESSION['token']) {

            $this->error("NO_ACTIVE_SESSION");

        } else {

            $this->error("NO_SESSION");

        }
    }

    private function getPartyLobbyDTO($currentPartyDTO) {
        $partyLobbyDTO = new PartyLobbyDTO();

        $sessions = $this->sessionService->getPartySessions($currentPartyDTO->identifier);
        foreach($sessions as $session) {
            $userDTO = new PartyLobbyDTO\UserDTO();

            $userDTO->nickname = $session->nickname;
            $userDTO->admin = $session->admin;
            $userDTO->points = $session->points;

            $partyLobbyDTO->userList[] = $userDTO;
        }

        return $partyLobbyDTO;
    }

    private function json($object) {
        echo(json_encode($object));
    }

    private function error($error_code) {
        switch($error_code) {
            case("NO_SESSION"):
                header('HTTP/1.0 401 Unauthorized');
                echo 'Aucune session trouvée';
                break;
            case("NO_ACTIVE_SESSION"):
                header('HTTP/1.0 403 Forbidden');
                echo 'Session morte';
                break;
        }
    }
}

new PartyAPIController();