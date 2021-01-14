<?php

namespace App\Service;

class Average
{
    public function average(Array $numberArray): int
    {
        $total = 0;
        foreach($numberArray as $key=>$value) {
            $total += $value;
        }
        $moyenne = $total/6;
        return $moyenne;
    }
}