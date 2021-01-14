<?php

namespace App\Service;

class Compare
{
    public function compare(Array $statRequired, Array $statHero): bool
    {
        foreach($statHero as $statName => $value) {
            if ($value === "null") {
                return false;
            } else {
                foreach($statHero as $statName => $value) {
                    $statsHero[]= $value;
                }

                foreach($statRequired as $statName => $value) {
                    $statsRequired[]=$value;
                }

                $i=0;
                do {
                    if($statsHero[$i] > $statsRequired[$i]) {
                        $i++;
                    } else {
                        return false;
                    }
                } while ($i < 5);
                return true;
            }
        }
    }
}