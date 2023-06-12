<?php

class TwoSum
{
    public function twosum($array, $target)
    {
        for ($i = 0; $i < count($array) - 1; $i++) {
            for ($j = $i + 1; $j < count($array); $j++) {
                if (($array[$i] + $array[$j]) == $target) {
                    return 'array[' . $i . '] - array[' . $j . ']';
                }
            }
        }
    }
}

$sum = new TwoSum();
echo $sum->twosum([3, 2, 4], 6);
