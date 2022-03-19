<?php
include('../Config.php');
include('../code/core/SingletonRegistry.php');
include('../code/core/AbstractSingleton.php');


include('../code/dto/AbstractDTO.php');
include('../code/dto/AbstractIdentifierDTO.php');

include("../code/dto/PartyDTO.php");
include("../code/dto/GameDTO.php");
include("../code/dto/SessionDTO.php");
include("../code/dto/GameSessionDTO.php");
include("../code/dto/EndVoteDTO.php");
include("../code/dto/EndStatDTO.php");


include('../code/dao/AbstractDAO.php');
include('../code/dao/AbstractIdentifierDAO.php');

include('../code/dao/PartyDAO.php');
include("../code/dao/GameDAO.php");
include("../code/dao/SessionDAO.php");
include("../code/dao/GameSessionDAO.php");
include("../code/dao/EndVoteDAO.php");
include("../code/dao/EndStatDAO.php");


include('../code/core/Request.php');
include("../code/core/Router.php");


SingletonRegistry::init();


