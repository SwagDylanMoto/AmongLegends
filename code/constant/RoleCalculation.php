<?php

interface RoleCalculation{

    public function calculPoints(EndStatDTO $endStatDTO, int $gameSessionId);//Renvoi int -> les points

}