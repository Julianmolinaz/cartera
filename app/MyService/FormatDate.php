<?php
namespace App\MyService;

use Carbon\Carbon;
use Exception;

class FormatDate 
{

    protected $date;

    public function __construct($date)
    {
        if ($date) 
            $this->date = $date;
        else 
            throw new Exception("Error Processing Request $date", 1);
            
    }

    public function carbon()
    {
        return Carbon::create($this->getYear(), $this->getMonth(), $this->getDay());
    }


    public function getDay()
    {
        // position 2 y 5 hay - o /
        if (substr($this->date,2,1) == '-'|| substr($this->date,2,1) == '/') {
            return substr($this->date,0,2);
        } 
        elseif (substr($this->date,4,1) == '-' || substr($this->date,4,1) == '/') {
            return substr($this->date,8,2);
        } else {
            throw new Exception("Error processing the day", 1);   
        }

        // position 4 y 7 hay - o /

        //return day
    }

    public function getMonth()
    {
        if (substr($this->date,2,1) == '-'|| substr($this->date,2,1) == '/') {
            return substr($this->date,3,2);
        } 
        elseif (substr($this->date,4,1) == '-' || substr($this->date,4,1) == '/') {
            return substr($this->date,5,2);
        } else {
            throw new Exception("Error processing the month", 1);   
        }
    }

    public function getYear()
    {
        if (substr($this->date,2,1) == '-'|| substr($this->date,2,1) == '/') {
            return substr($this->date,6,4);
        } 
        elseif (substr($this->date,4,1) == '-' || substr($this->date,4,1) == '/') {
            return substr($this->date,0,4);
        } else {
            throw new Exception("Error processing the year", 1);   
        }
    }



}