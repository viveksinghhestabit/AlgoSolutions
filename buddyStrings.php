<?php

class BuddyString
{
    public function buddyStrings($s, $goal)
    {
        if (strlen($s) != strlen($goal)) {
            return false;
        }

        $diff = [];
        for ($i = 0; $i < strlen($s); $i++) {
            if ($s[$i] != $goal[$i]) {
                $diff[] = $i;
            }
        }

        if (count($diff) == 2) {
            if ($s[$diff[0]] == $goal[$diff[1]] && $s[$diff[1]] == $goal[$diff[0]]) {
                return true;
            }
        }

        if (count($diff) == 0) {
            $count = array_count_values(str_split($s));
            foreach ($count as $key => $value) {
                if ($value > 1) {
                    return true;
                }
            }
        }

        return false;
    }
}

$s = new BuddyString();
echo $s->buddyStrings("ab", "ba");