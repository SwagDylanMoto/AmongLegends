<?php
namespace {
    class GameEndGameDTO extends DTO {

        public $userList = [];
    }
}

namespace GameEndGameDTO {
    class UserDTO {

        public $nickname;

        public $points;

        public $role;

        public $vote = [];
    }
}