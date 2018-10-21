<?php

namespace Ognjenm\ReservationsCalendar;

class CalendarYear extends CalendarObj
{
    public function __toString()
    {
        return $this->format('Y');
    }

    public function int()
    {
        return $this->yearINT;
    }

    public function months()
    {
        $array = [];
        foreach (range(1, 12) as $month) {
            $array[] = $this->month($month);
        }
        return new CalendarIterator($array);
    }

    public function month($month = 1)
    {
        return new CalendarMonth($this->yearINT, $month);
    }

    public function weeks()
    {
        $array = [];
        $weeks = (int)date('W', mktime(0, 0, 0, 12, 31, $this->int)) + 1;
        foreach (range(1, $weeks) as $week) {
            $array[] = new CalendarWeek($this, $week);
        }
        return new CalendarIterator($array);
    }

    public function week($week = 1)
    {
        return new CalendarWeek($this, $week);
    }

    public function countDays()
    {
        return (int)date('z', mktime(0, 0, 0, 12, 31, $this->yearINT)) + 1;
    }

    public function days()
    {
        $days = $this->countDays();
        $array = [];
        $ts = false;

        for ($x = 0; $x < $days; $x++) {
            $ts = (!$ts) ? $this->timestamp : strtotime('tomorrow', $ts);
            $month = date('m', $ts);
            $day = date('d', $ts);
            $array[] = $this->month($month)->day($day);
        }

        return new CalendarIterator($array);
    }

    public function next()
    {
        return $this->plus('1year')->year();
    }

    public function prev()
    {
        return $this->minus('1year')->year();
    }

    public function name()
    {
        return $this->int();
    }

    public function firstMonday()
    {
        $cal = new Calendar();
        return $cal->date(strtotime('first monday of ' . date('Y', $this->timestamp)));
    }

    public function firstSunday()
    {
        $cal = new Calendar();
        return $cal->date(strtotime('first sunday of ' . date('Y', $this->timestamp)));
    }
}
