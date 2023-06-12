<?php

class MaximumIdenticalBowls
{
    protected $bowls;
    protected $bowlcookie;

    public function __construct($bowls, $bowlcookie)
    {
        $this->bowls = $bowls;
        $this->bowlcookie = $bowlcookie;
    }

    public function maxFullyDivisibleNumber($sum, $bowls)
    {
        $max = 0;
        for ($i = 1; $i <= $sum; $i++) {
            if ($sum % $i == 0 && $i != $sum) {
                $max = $i;
            }
        }
        return $max;
    }
}
$cookie = [3, 1, 5];
$bowl = new MaximumIdenticalBowls(count($cookie), $cookie);
echo $bowl->maxFullyDivisibleNumber(array_sum($cookie), count($cookie));
