<?php

class Anagram
{
    public function isAnagram($s, $t)
    {
        $map = [];

        for ($i = 0; $i < strlen($s); $i++) {
            if (isset($map[$s[$i]])) {
                $map[$s[$i]]++;
            } else {
                $map[$s[$i]] = 1;
            }
        }

        for ($i = 0; $i < strlen($t); $i++) {
            if (isset($map[$t[$i]])) {
                $map[$t[$i]]--;
            } else {
                return false;
            }
        }

        foreach ($map as $key => $value) {
            if ($value != 0) {
                return false;
            }
        }

        return true;
    }
}

$a = new Anagram();
echo $a->isAnagram('anagram', 'nagaram');
