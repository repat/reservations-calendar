<?php

namespace Ognjenm\ReservationsCalendar;

class CalendarHour extends CalendarObj
{
    public function int()
    {
        return $this->hourINT;
    }

    public function minutes()
    {
        $obj = $this;
        $array = [];

        while ($obj->hourINT == $this->hourINT) {
            $array[] = $obj;
            $obj = $obj->plus('1minute')->minute();
        }

        return new CalendarIterator($array);
    }

    public function next()
    {
        return $this->plus('1hour')->hour();
    }

    public function prev()
    {
        return $this->minus('1hour')->hour();
    }
}
