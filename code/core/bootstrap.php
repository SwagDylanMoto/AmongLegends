<?php
include($base.'Config.php');
include($base.'code/core/SingletonRegistry.php');
include($base.'code/core/AbstractSingleton.php');


include($base.'code/dto/AbstractDTO.php');
include($base.'code/dto/AbstractIdentifierDTO.php');

include($base."code/dto/PartyDTO.php");
include($base."code/dto/GameDTO.php");
include($base."code/dto/SessionDTO.php");
include($base."code/dto/GameSessionDTO.php");
include($base."code/dto/EndVoteDTO.php");
include($base."code/dto/EndStatDTO.php");


include($base.'code/dao/AbstractDAO.php');
include($base.'code/dao/AbstractIdentifierDAO.php');

include($base.'code/dao/PartyDAO.php');
include($base."code/dao/GameDAO.php");
include($base."code/dao/SessionDAO.php");
include($base."code/dao/GameSessionDAO.php");
include($base."code/dao/EndVoteDAO.php");
include($base."code/dao/EndStatDAO.php");


include($base."code/service/PartyService.php");


include($base."code/controller/AbstractController.php");


include($base.'code/core/Request.php');
include($base."code/core/Router.php");


SingletonRegistry::init();


