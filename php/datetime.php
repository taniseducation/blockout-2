<?php
  class DatetimeConversion {
    private $datetime, $date, $year, $month, $day, $time, $hours, $minutes, $timeExt;
    private $months = ["", "Jan", "Feb", "Mar", "Apr", "May", "June", "July", "Aug", "Sep", "Oct", "Nov", "Dec"];

    public function __construct($datetime) {
      $this->datetime = $datetime;
    }

    public function getDate() {
      $this->date = explode(' ', $this->datetime)[0];
      $this->date = explode('-', $this->date);
      $this->year = $this->date[0];
      $this->month = $this->months[(int) $this->date[1]];
      $this->day = (int) $this->date[2];

      return $this->month.' '.$this->day.', '.$this->year;
    }

    public function getTime() {
      $this->time = explode(' ', $this->datetime)[1];
      $this->time = explode(':', $this->time);
      $this->hours = (int) $this->time[0];
      ($this->hours < 12) ? $this->timeExt = "AM" : $this->timeExt = "PM";
      if($this->hours > 12) {
        $this->hours -= 12;
      } else if($this->hours == 0) {
        $this->hours += 12;
      }
      $this->minutes = $this->time[1];

      return $this->hours.':'.$this->minutes.' '.$this->timeExt;
    }
  }
?>