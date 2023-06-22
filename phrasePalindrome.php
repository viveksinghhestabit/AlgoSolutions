<?php

class PhrasePalindrome
{
    public function isPalindrome($s)
    {
        $new_s  = preg_replace("/[^A-Za-z0-9]/", '', $s);
        $reverse = '';
        for ($i = strlen($new_s) - 1; $i >= 0; $i--) {
            $reverse = $reverse . $new_s[$i];
        }
        return strtolower($new_s) == strtolower($reverse);
    }
}

$a = new PhrasePalindrome();
var_dump($a->isPalindrome("0P"));
