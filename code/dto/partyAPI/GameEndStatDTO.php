<?php

namespace {
    class GameEndStatDTO extends DTO {

        public $userList = [];
    }
}

namespace GameEndStatDTO {
    class UserDTO {

        public $nickname;

        public $gs_id;
    }
}