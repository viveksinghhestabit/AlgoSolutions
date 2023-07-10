<?php

class removeDuplicates
{
    public function removeDuplicates(&$nums)
    {
        $i = 0;
        $j = 1;

        while ($j < count($nums)) {
            if ($nums[$i] != $nums[$j]) {
                $i++;
                $nums[$i] = $nums[$j];
            }

            $j++;
        }

        return $i + 1;
    }
}

$a = new removeDuplicates();
$nums = [1, 1, 2];
echo $a->removeDuplicates($nums);