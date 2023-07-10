<?php

class longestCommonPrefix
{
    public function longestCommonPrefix($strs)
    {
        $prefix = '';

        if (count($strs) == 0) {
            return $prefix;
        }

        for ($i = 0; $i < strlen($strs[0]); $i++) {
            $char = $strs[0][$i];

            for ($j = 1; $j < count($strs); $j++) {
                if ($i == strlen($strs[$j]) || $strs[$j][$i] != $char) {
                    return $prefix;
                }
            }

            $prefix .= $char;
        }

        return $prefix;
    }
}

$a = new longestCommonPrefix();
echo $a->longestCommonPrefix(["flower", "flow", "flight"]);