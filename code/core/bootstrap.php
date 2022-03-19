<?php
include('../Config.php');
include('../code/core/SingletonRegistry.php');

include("../code/dto/PartyDTO.php");

include('../code/dao/PartyDAO.php');

include('../code/core/Request.php');

SingletonRegistry::init();

print_r(SingletonRegistry::$registry);

