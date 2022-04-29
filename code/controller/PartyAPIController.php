<?php

class PartyAPIController extends Controller {

    private SessionManager $sessionManager;
    private SessionService $sessionService;
    private PartyService $partyService;
    private GameService $gameService;
    private GameSessionService  $gameSessionService;
    private EndVoteService $endVoteService;
    private $partyStatutEnum;

    function __construct() {
        parent::__construct();

        $this->sessionManager = SingletonRegistry::$registry["SessionManager"];
        $this->sessionService = SingletonRegistry::$registry["SessionService"];
        $this->partyService = SingletonRegistry::$registry["PartyService"];
        $this->gameService = SingletonRegistry::$registry["GameService"];
        $this->gameSessionService = SingletonRegistry::$registry["GameSessionService"];
        $this->endVoteService = SingletonRegistry::$registry["EndVoteService"];
        $this->partyStatutEnum = SingletonRegistry::$registry["PartyStatut"]->partyStatutEnum;
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
                $partyWorkflowDTO->state = $this->partyStatutEnum[0];//Lobby
                $partyWorkflowDTO->data = $this->getPartyLobbyDTO($currentPartyDTO);
            } elseif($currentGameDTO->statut === $this->partyStatutEnum[1]) { //InGame
                $partyWorkflowDTO->state = $this->partyStatutEnum[1];
                if($_GET['maxiData']) {
                    $partyWorkflowDTO->data = $this->getGameInGameDTO($currentSessionDTO, $currentGameDTO);
                }
            } elseif($currentGameDTO->statut === $this->partyStatutEnum[2]) { //EndStat
                $partyWorkflowDTO->state = $this->partyStatutEnum[2];
                if($_GET['maxiData'] && $currentSessionDTO->admin) {
                    $partyWorkflowDTO->data = $this->getGameEndStatDTO($currentGameDTO);
                }
            } elseif($currentGameDTO->statut === $this->partyStatutEnum[3]) { //Voting
                $currentGameSessionDTO = $this->gameSessionService->getBySessionAndGame($currentSessionDTO->identifier, $currentGameDTO->identifier);
                $endVotes = $this->endVoteService->getAllByVotingGS($currentGameSessionDTO->identifier);

                if (count($endVotes) < 4) { //-> Voting
                    $partyWorkflowDTO->state = $this->partyStatutEnum[3];
                    if($_GET['maxiData']) {
                        $partyWorkflowDTO->data = $this->getGameVotingDTO($currentGameSessionDTO, $currentGameDTO);
                    }
                } else { //-> Voted
                    $partyWorkflowDTO->state = 'Voted';
                    $partyWorkflowDTO->data = $this->getGameVotedDTO($currentGameDTO);
                }
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

            if($this->sessionManager->currentSessionDTO->admin) {
                $userDTO->id = $session->identifier;
            }

            $partyLobbyDTO->userList[] = $userDTO;
        }

        return $partyLobbyDTO;
    }

    private function getGameInGameDTO($currentSessionDTO, $currentGameDTO) {
        $gameInGameDTO = new GameInGameDTO();

        $gameSession = $this->gameSessionService->getBySessionAndGame($currentSessionDTO->identifier, $currentGameDTO->identifier);

        $gameInGameDTO->role = $gameSession->role;
        $gameInGameDTO->roleAddInfos = $gameSession->roleAddInfos;

        return $gameInGameDTO;
    }

    private function getGameEndStatDTO(GameDTO $currentGameDTO) {
        $gameEndStatDTO = new GameEndStatDTO();

        $gameSessions = $this->gameSessionService->getAllByGame($currentGameDTO->identifier);

        foreach($gameSessions as $gameSession) {
            $newUserDTO = new GameEndStatDTO\UserDTO();

            $newUserDTO->nickname = $gameSession->nickname;
            $newUserDTO->gs_id = $gameSession->identifier;

            $gameEndStatDTO->userList[] = $newUserDTO;
        }

        return $gameEndStatDTO;
    }

    private function getGameVotingDTO(GameSessionDTO $currentGameSessionDTO, GameDTO $currentGameDTO) {
        $gameVotingDTO = new GameVotingDTO();

        foreach(SingletonRegistry::$registry['Roles']->rolesEnum as $role) {
            if ($role !== $currentGameSessionDTO->role) {
                $gameVotingDTO->roleList[] = $role;
            }
        }

        $gameSessions = $this->gameSessionService->getAllByGame($currentGameDTO->identifier);
        foreach($gameSessions as $gameSession) {
            if ($gameSession->identifier !== $currentGameSessionDTO->identifier) {
                $user = new GameVotingDTO\UserDTO();

                $user->gs_id = $gameSession->identifier;
                $user->nickname = $gameSession->nickname;

                $gameVotingDTO->userList[] = $user;
            }
        }

        return $gameVotingDTO;
    }

    private function getGameVotedDTO(GameDTO $currentGameDTO) {
        $gameVotedDTO = new GameVotedDTO();

        $gameSessions = $this->gameSessionService->getAllByGame($currentGameDTO->identifier);
        foreach ($gameSessions as $gameSession) {
            if (count($this->endVoteService->getAllByVotingGS($gameSession->identifier)) < 4) {
                $gameVotedDTO->peopleLeft[] = $gameSession->nickname;
            }
        }

        return $gameVotedDTO;
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