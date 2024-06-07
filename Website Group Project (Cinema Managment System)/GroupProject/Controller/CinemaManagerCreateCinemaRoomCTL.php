<?php

include_once "Entity/CinemaRoom.php";
include_once "Entity/Cinema.php";


class CinemaManagerCreateCinemaRoomCTL
{

    public function createNewRoom($cinemaRoomNo, $cinemaName)
    {
        $CinemaRoom = new CinemaRoom();
        $result = $CinemaRoom->createNewCinemaRoom($cinemaRoomNo, $cinemaName);
        return $result;
    }

    // for dropdown list
    public function retrieveAllCinema()
    {
        $Cinema = new Cinema();
        $displayOption = $Cinema->retrieveCinemaName();
        return $displayOption;
    }
}
