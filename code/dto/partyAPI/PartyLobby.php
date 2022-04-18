<?php

namespace {
    class PartyLobbyDTO extends DTO {

        public $userList = [];
    }
}

namespace PartyLobbyDTO {
    class UserDTO {

        public $nickname;

        public $points = 0;

        public $admin = false;

        public $id = null;
    }
}