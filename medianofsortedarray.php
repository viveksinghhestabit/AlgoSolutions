<?php

class Mediun
{
    public function sortArray($array)
    {
        $count = count($array);
        for ($i = 0; $i < $count; $i++) {
            for ($j = 0; $j < $count - 1; $j++) {
                if ($array[$j] > $array[$j + 1]) {
                    $temp = $array[$j + 1];
                    $array[$j + 1] = $array[$j];
                    $array[$j] = $temp;
                }
            }
        }
        return $array;
    }

    public function mergeArrays($array1, $array2)
    {
        return array_merge($array1, $array2);
    }

    public function mediun($num1, $num2)
    {
        $array = $this->mergeArrays($num1, $num2);
        $sortedArray = $this->sortArray($array);
        if (count($sortedArray) % 2 == 0) {
            $index = (count($sortedArray) / 2) - 1;
            $result = ($sortedArray[$index] + $sortedArray[$index + 1]) / 2;
        } else {
            $index = (count($sortedArray) / 2);
            $result = $sortedArray[$index];
        }
        return $result;
    }
}

$abc = new Mediun();
print_r($abc->mediun([1, 2], [3,3]));
