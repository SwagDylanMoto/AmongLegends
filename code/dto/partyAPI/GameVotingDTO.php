<?php

namespace  {
    class GameVotingDTO extends DTO {

        public $roleList = [];

        public $userList = [];
    }
}

namespace GameVotingDTO {
    class UserDTO {

        public $nickname;

        public $gs_id;
    }
}