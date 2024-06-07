<?php

include_once "Entity/CinemaRoom.php";

class CinemaManagerSearchCinemaRoomCTL
{

    public function searchCinemaRoom($cinemaRoomNo)
    {
        $CinemaRoom = new CinemaRoom();
        $tableContent = $CinemaRoom->searchCinemaRoom($cinemaRoomNo);
        return $tableContent;
    }
}
