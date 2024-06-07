<?php
include_once 'Entity\CinemaRoom.php';

class CinemaManagerSuspendCinemaRoomCTL
{

    public function suspendRoom($cinemaRoomNo)
    {
        $CinemaRoom = new CinemaRoom();
        $result = $CinemaRoom->suspendCinemaRoom($cinemaRoomNo);
        return $result;
    }
}
