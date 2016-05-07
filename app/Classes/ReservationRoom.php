<?php
namespace App\Classes;

    class ReservationRoom extends Subject
    {

        function clearSession()
        {
            $this->setState("clearSession");
        }
    }

