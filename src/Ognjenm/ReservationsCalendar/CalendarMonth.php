<?php

namespace Ognjenm\ReservationsCalendar;

class CalendarMonth extends CalendarObj
{
    public function __toString()
    {
        return $this->format('Y-m');
    }

    public function int()
    {
        return $this->monthINT;
    }

    public function weeks($force = false)
    {
        $first = $this->firstDay();
        $week = $first->week();

        $currentMonth = $this->int();
        $nextMonth = $this->next()->int();

        $max = ($force) ? $force : 6;

        for ($x = 0; $x < $max; $x++) {

            // make sure not to add weeks without a single day in the same month
            if (!$force && $x > 0 && $week->firstDay()->month()->int() != $currentMonth) {
                break;
            }

            $array[] = $week;

            // make sure not to add weeks without a single day in the same month
            if (!$force && $week->lastDay()->month()->int() != $currentMonth) {
                break;
            }

            $week = $week->next();
        }

        return new CalendarIterator($array);
    }

    public function countDays()
    {
        return date('t', $this->timestamp);
    }

    public function firstDay()
    {
        return new CalendarDay($this->yearINT, $this->monthINT, 1);
    }

    public function lastDay()
    {
        return new CalendarDay($this->yearINT, $this->monthINT, $this->countDays());
    }

    public function days()
    {

        // number of days per month
        $days = date('t', $this->timestamp);
        $array = [];
        $ts = $this->firstDay()->timestamp();

        foreach (range(1, $days) as $day) {
            $array[] = $this->day($day);
        }

        return new CalendarIterator($array);
    }

    public function day($day = 1)
    {
        return new CalendarDay($this->yearINT, $this->monthINT, $day);
    }

    public function next()
    {
        return $this->plus('1month')->month();
    }

    public function prev()
    {
        return $this->minus('1month')->month();
    }

    public function name()
    {
        return strftime('%B', $this->timestamp);
    }

    public function shortname()
    {
        return strftime('%b', $this->timestamp);
    }

    public function past($month)
    {
        return $this->minus($month)->month();
    }
}
