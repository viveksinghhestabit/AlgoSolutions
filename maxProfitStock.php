<?php 

class MaxProfitStock
{
    public function maxProfit($prices)
    {
        $maxProfit = 0;
        $minPrice = PHP_INT_MAX;

        for ($i = 0; $i < count($prices); $i++) {
            if ($prices[$i] < $minPrice) {
                $minPrice = $prices[$i];
            } else if ($prices[$i] - $minPrice > $maxProfit) {
                $maxProfit = $prices[$i] - $minPrice;
            }
        }

        return $maxProfit;
    }
}

$a = new MaxProfitStock();
echo $a->maxProfit([7,1,5,3,6,4]);