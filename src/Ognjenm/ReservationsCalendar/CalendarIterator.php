<?php

namespace Ognjenm\ReservationsCalendar;

class CalendarIterator implements \Iterator
{
    private $_ = [];

    public function __construct($array = [])
    {
        $this->_ = $array;
    }

    public function __toString()
    {
        $result = '';
        foreach ($this->_ as $date) {
            $result .= $date . '<br />';
        }
        return $result;
    }

    public function rewind()
    {
        reset($this->_);
    }

    public function current()
    {
        return current($this->_);
    }

    public function key()
    {
        return key($this->_);
    }

    public function next()
    {
        return next($this->_);
    }

    public function prev()
    {
        return prev($this->_);
    }

    public function valid()
    {
        $key = key($this->_);
        $var = ($key !== null && $key !== false);
        return $var;
    }

    public function count()
    {
        return count($this->_);
    }

    public function first()
    {
        return array_shift($this->_);
    }

    public function last()
    {
        return array_pop($this->_);
    }

    public function nth($n)
    {
        $values = array_values($this->_);
        return isset($values[$n]) ? $values[$n] : null;
    }

    public function indexOf($needle)
    {
        return array_search($needle, array_values($this->_));
    }

    public function toArray()
    {
        return $this->_;
    }

    public function slice($offset = null, $limit = null)
    {
        if ($offset === null && $limit === null) {
            return $this;
        }
        return new CalendarIterator(array_slice($this->_, $offset, $limit));
    }

    public function limit($limit)
    {
        return $this->slice(0, $limit);
    }
}
