<?php
ini_set('display_errors', 1);

class Repeat
{
    public function lengthOfLongestSubstring($s)
    {
        $map = [];
        $max = 0;
        $start = 0;
        $end = 0;

        while ($end < strlen($s)) {
            if (isset($map[$s[$end]])) {
                $start = max($start, $map[$s[$end]] + 1);
            }

            $map[$s[$end]] = $end;
            $max = max($max, $end - $start + 1);
            $end++;
        }

        return $max;
    }

}

$a = new Repeat();
$sub =  $a->lengthOfLongestSubstring('  ');
echo $sub;
