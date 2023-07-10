<?php 

class ValidParanthesis
{
    public function isValid($s)
    {
        $stack = [];
        $map = [
            ')' => '(',
            '}' => '{',
            ']' => '['
        ];

        for ($i = 0; $i < strlen($s); $i++) {
            if (array_key_exists($s[$i], $map)) {
                $topElement = empty($stack) ? '#' : array_pop($stack);
                if ($topElement != $map[$s[$i]]) {
                    return false;
                }
            } else {
                array_push($stack, $s[$i]);
            }
        }

        return empty($stack);
    }
}

$a = new ValidParanthesis();
echo $a->isValid('()[]{}');