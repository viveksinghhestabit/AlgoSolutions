<?php

class Duplicate
{
    public function cantains($nums)
    {
        for ($i = 0; $i < count($nums); $i++) {
            for ($j = $i + 1; $j < count($nums); $j++) {
                if ($nums[$i] == $nums[$j]) {
                    return true;
                }
            }
        }
        return false;
    }
}

$a = new Duplicate();
echo $a->cantains([1, 2, 3]);
