<?php

include_once "Entity/CinemaRoom.php";

class CinemaManagerViewCinemaRoomCTL
{

    public function retrieveAllCinemaRoom()
    {
        $CinemaRoom = new CinemaRoom();
        $tableContent = $CinemaRoom->retrieveCinemaRoom();
        return $tableContent;
    }
}
