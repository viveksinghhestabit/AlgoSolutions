<?php

class Duplicate
{
    public function containsDuplicate($nums)
    {
        $map = [];
        for ($i = 0; $i < count($nums); $i++) {
            if (isset($map[$nums[$i]])) {
                return true;
            } else {
                $map[$nums[$i]] = 1;
            }
        }

        return false;
    }
}

$a = new Duplicate();
echo $a->containsDuplicate([1, 2, 3]);
