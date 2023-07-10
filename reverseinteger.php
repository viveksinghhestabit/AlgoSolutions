<?php

class ReverseInteger
{
    public function reverse($x)
    {
        $result = 0;

        while ($x != 0) {
            $result = $result * 10 + $x % 10;
            $x = (int)($x / 10);
        }

        if ($result > pow(2, 31) - 1 || $result < pow(-2, 31)) {
            return 0;
        }

        return $result;
    }
}

$a = new ReverseInteger();
echo $a->reverse(123);