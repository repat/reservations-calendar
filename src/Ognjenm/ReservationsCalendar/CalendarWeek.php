<?php

namespace Ognjenm\ReservationsCalendar;

class CalendarWeek extends CalendarObj
{
    public function __toString()
    {
        return $this->firstDay()->format('Y-m-d') . ' - ' . $this->lastDay()->format('Y-m-d');
    }

    public $weekINT;

    public function int()
    {
        return $this->weekINT;
    }

    public function __construct($year = false, $week = false)
    {
        if (!$year) {
            $year = date('Y');
        }
        if (!$week) {
            $week = date('W');
        }

        $this->yearINT = intval($year);
        $this->weekINT = intval($week);

        $ts = strtotime('Thursday', strtotime($year . 'W' . $this->padded()));
        $monday = strtotime('-3days', $ts);

        parent::__construct(date('Y', $monday), date('m', $monday), date('d', $monday), 0, 0, 0);
    }

    public function years()
    {
        $array = [];
        $array[] = $this->firstDay()->year();
        $array[] = $this->lastDay()->year();

        // remove duplicates
        $array = array_unique($array);

        return new CalendarIterator($array);
    }

    public function months()
    {
        $array = [];
        $array[] = $this->firstDay()->month();
        $array[] = $this->lastDay()->month();

        // remove duplicates
        $array = array_unique($array);

        return new CalendarIterator($array);
    }

    public function firstDay()
    {
        $cal = new Calendar();
        return $cal->date($this->timestamp);
    }

    public function lastDay()
    {
        $first = $this->firstDay();
        return $first->plus('6 days');
    }

    public function days()
    {
        $day = $this->firstDay();
        $array = [];

        for ($x = 0; $x < 7; $x++) {
            $array[] = $day;
            $day = $day->next();
        }

        return new CalendarIterator($array);
    }

    public function next()
    {
        $next = strtotime('Thursday next week', $this->timestamp);
        $year = date('Y', $next);
        $week = date('W', $next);

        return new CalendarWeek($year, $week);
    }

    public function prev()
    {
        $prev = strtotime('Monday last week', $this->timestamp);
        $year = date('Y', $prev);
        $week = date('W', $prev);

        return new CalendarWeek($year, $week);
    }
}
