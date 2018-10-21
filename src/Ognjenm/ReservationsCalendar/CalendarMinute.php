<?php

namespace Ognjenm\ReservationsCalendar;

class CalendarMinute extends CalendarObj
{
    public function int()
    {
        return $this->minuteINT;
    }

    public function seconds()
    {
        $obj = $this;
        $array = [];

        while ($obj->minuteINT == $this->minuteINT) {
            $array[] = $obj;
            $obj = $obj->plus('1second')->second();
        }

        return new CalendarIterator($array);
    }

    public function next()
    {
        return $this->plus('1minute')->minute();
    }

    public function prev()
    {
        return $this->minus('1minute')->minute();
    }
}
