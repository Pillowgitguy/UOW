<?php

include_once "Entity/CinemaRoom.php";

class CinemaManagerUpdateCinemaRoomCTL
{

    public function updateCinemaRoom($cinemaRoomNo, $cinemaName, $suspend)
    {
        $CinemaRoom = new CinemaRoom();
        $result = $CinemaRoom->updateCinemaRoomInfo($cinemaRoomNo, $cinemaName, $suspend);
        return $result;
    }
}
