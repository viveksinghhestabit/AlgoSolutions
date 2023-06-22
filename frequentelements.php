<?php

class Frequent
{
    function getFrequent($array = [1, 1, 1, 2, 2, 3])
    {

        for ($i = 0; $i < count($array) - 1; $i++) {
            for ($j = $i + 1; $j < count($array); $j++) {
                if ($array[$i] == $array[$j]) {
                    continue;
                }
            }
        }
        START:
        $data = $array;
        for ($j = $i + 1; $j < count($data); $j++) {
            if ($array[$j] == $array[$j++]) {
                continue;
            }
        }
    }
}
