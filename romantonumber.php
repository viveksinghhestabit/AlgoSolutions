<?php
ini_set('error_reporting', 1);
class Roman
{
    public function getNumber($roman)
    {
        $num = 0;
        for ($i = 0; $i < strlen($roman); $i++) {
            $current = $this->romantonumber($roman[$i]);
            $next = $this->romantonumber($roman[$i+1]);
            if($current<$next){
                $num = $num - $current;
            }else{
                $num = $num + $next;
            }
        }
        return $num;
    }

    public function romantonumber($char)
    {
        $value = [
            "I" => 1,
            "V" => 5,
            "X" => 10,
            "L" => 50,
            "C" => 100,
            "D" => 500,
            "M" => 1000,
        ];
        return $value[$char];
    }
}

$a = new Roman();
echo $a->getNumber('MCMXCIV');

