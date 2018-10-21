<?php

namespace Ognjenm\ReservationsCalendar;

class CalendarSecond extends CalendarObj
{
    public function int()
    {
        return $this->secondINT;
    }

    public function next()
    {
        return $this->plus('1second')->second();
    }

    public function prev()
    {
        return $this->minus('1second')->second();
    }
}
