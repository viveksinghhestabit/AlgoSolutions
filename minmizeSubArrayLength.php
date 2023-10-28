<?php

class minSubArrayLength
{
    public function minSubArrayLen($s, $nums)
    {
        $sum = 0;
        $left = 0;
        $right = 0;
        $min = PHP_INT_MAX;

        while ($right < count($nums)) {
            $sum += $nums[$right];

            while ($sum >= $s) {
                $min = min($min, $right - $left + 1);
                $sum -= $nums[$left];
                $left++;
            }

            $right++;
        }

        return $min == PHP_INT_MAX ? 0 : $min;
    }
}

$a = new minSubArrayLength();
echo $a->minSubArrayLen(11, [1,1,1,1,1,1,1,1]);