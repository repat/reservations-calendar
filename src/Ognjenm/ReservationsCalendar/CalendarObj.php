<?php

namespace Ognjenm\ReservationsCalendar;

class CalendarObj
{
    public $yearINT;
    public $monthINT;
    public $dayINT;
    public $hourINT;
    public $minuteINT;
    public $secondINT;
    public $timestamp = 0;

    public function __construct($year = false, $month = 1, $day = 1, $hour = 0, $minute = 0, $second = 0)
    {
        if (!$year) {
            $year = date('Y');
        }
        if (!$month) {
            $month = date('m');
        }
        if (!$day) {
            $day = date('d');
        }

        $this->yearINT = intval($year);
        $this->monthINT = intval($month);
        $this->dayINT = intval($day);
        $this->hourINT = intval($hour);
        $this->minuteINT = intval($minute);
        $this->secondINT = intval($second);

        // convert this to timestamp
        $this->timestamp = mktime($hour, $minute, $second, $month, $day, $year);
    }

    public function year($year = false)
    {
        if (!$year) {
            $year = $this->yearINT;
        }
        return new CalendarYear($year, 1, 1, 0, 0, 0);
    }

    public function month($month = false)
    {
        if (!$month) {
            $month = $this->monthINT;
        }
        return new CalendarMonth($this->yearINT, $month, 1, 0, 0, 0);
    }

    public function day($day = false)
    {
        if (!$day) {
            $day = $this->dayINT;
        }
        return new CalendarDay($this->yearINT, $this->monthINT, $day, 0, 0, 0);
    }

    public function hour($hour = false)
    {
        if (!$hour) {
            $hour = $this->hourINT;
        }
        return new CalendarHour($this->yearINT, $this->monthINT, $this->dayINT, $hour, 0, 0);
    }

    public function minute($minute = false)
    {
        if (!$minute) {
            $minute = $this->minuteINT;
        }
        return new CalendarMinute($this->yearINT, $this->monthINT, $this->dayINT, $this->hourINT, $minute, 0);
    }

    public function second($second = false)
    {
        if (!$second) {
            $second = $this->secondINT;
        }
        return new CalendarSecond($this->yearINT, $this->monthINT, $this->dayINT, $this->hourINT, $this->minuteINT, $second);
    }

    public function timestamp()
    {
        return $this->timestamp;
    }

    public function __toString()
    {
        return date('Y-m-d H:i:s', $this->timestamp);
    }

    public function format($format)
    {
        return date($format, $this->timestamp);
    }

    public function iso()
    {
        return date(DATE_ISO, $this->timestamp);
    }

    public function cookie()
    {
        return date(DATE_COOKIE, $this->timestamp);
    }

    public function rss()
    {
        return date(DATE_RSS, $this->timestamp);
    }

    public function atom()
    {
        return date(DATE_ATOM, $this->timestamp);
    }

    public function mysql()
    {
        return date('Y-m-d H:i:s', $this->timestamp);
    }

    public function time()
    {
        return strftime('%T', $this->timestamp);
    }

    public function ampm()
    {
        return strftime('%p', $this->timestamp);
    }

    public function modify($string)
    {
        $ts = (is_int($string)) ? $this->timestamp + $string : strtotime($string, $this->timestamp);

        list($year, $month, $day, $hour, $minute, $second) = explode('-', date('Y-m-d-H-i-s', $ts));
        return new CalendarDay($year, $month, $day, $hour, $minute, $second);
    }

    public function plus($string)
    {
        $modifier = (is_int($string)) ? $string : '+' . $string;
        return $this->modify($modifier);
    }

    public function add($string)
    {
        return $this->plus($string);
    }

    public function minus($string)
    {
        $modifier = (is_int($string)) ? -$string : '-' . $string;
        return $this->modify($modifier);
    }

    public function sub($string)
    {
        return $this->minus($string);
    }

    public function dmy()
    {
        return $this->format('d.m.Y');
    }

    public function padded()
    {
        return str_pad($this->int(), 2, '0', STR_PAD_LEFT);
    }
}
