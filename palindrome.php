<?php

class Palindrome
{
    public function isPalindrome($x)
    {
        $reverse = 0;
        $temp = $x;
        while ($temp > 0) {
            $reverse = ($reverse * 10) + ($temp % 10);
            $temp = (int) ($temp / 10);
        }
        if ($reverse == $x) {
            return true;
        } else {
            return false;
        }
    }
}

$a = new Palindrome();
echo  $a->isPalindrome('121');
