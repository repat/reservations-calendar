<?php

namespace Ognjenm\ReservationsCalendar;

class CalendarDay extends CalendarObj
{
    public function __toString()
    {
        return $this->format('Y-m-d');
    }

    public function int()
    {
        return $this->dayINT;
    }

    public function week()
    {
        $week = date('W', $this->timestamp);
        $year = ($this->monthINT == 1 && $week > 5) ? $this->year()->prev() : $this->year();
        return new CalendarWeek($year->int(), $week);
    }

    public function next()
    {
        return $this->plus('1day');
    }

    public function prev()
    {
        return $this->minus('1day');
    }

    public function weekday()
    {
        return date('N', $this->timestamp);
    }

    public function name()
    {
        return strftime('%A', $this->timestamp);
    }

    public function shortname()
    {
        return strftime('%a', $this->timestamp);
    }

    public function isToday()
    {
        $cal = new Calendar();
        return $this == $cal->today();
    }

    public function isYesterday()
    {
        $cal = new Calendar();
        return $this == $cal->yesterday();
    }

    public function isTomorrow()
    {
        $cal = new Calendar();
        return $this == $cal->tomorrow();
    }

    public function isInThePast()
    {
        return ($this->timestamp < Calendar::$now) ? true : false;
    }

    public function isInTheFuture()
    {
        return ($this->timestamp > Calendar::$now) ? true : false;
    }

    public function isWeekend()
    {
        $num = $this->format('w');
        return ($num == 6 || $num == 0) ? true : false;
    }

    public function hours()
    {
        $obj = $this;
        $array = [];

        while ($obj->int() == $this->int()) {
            $array[] = $obj->hour();
            $obj = $obj->plus('1hour');
        }

        return new CalendarIterator($array);
    }
}
