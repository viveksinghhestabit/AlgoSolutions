<?php
ini_set('display_errors', 1);

class Repeat
{
    public function checksubstring($s)
    {
        $length = strlen($s);
        if (str_replace(' ', '', $s) != '') {
            for ($main = $length - 1; $main > 0; $main--) {
                $total = ($length - $main + 1);
                for ($i = 0; $i < $total; $i++) {
                    $startsub = substr($s, $i, ($main));
                    if ($this->havingRepeatedCharacter($startsub) == 0) {
                        return strlen($startsub);
                    }
                }
            }
        }
        return 0;
    }

    public function havingRepeatedCharacter($word)
    {
        for ($i = 0; $i < strlen($word); $i++) {
            for ($j = $i + 1; $j < strlen($word); $j++) {
                if ($word[$i] == $word[$j]) {
                    return 1;
                }
            }
        }
        return 0;
    }
}

$a = new Repeat();
$sub =  $a->checksubstring('  ');
echo $sub;
