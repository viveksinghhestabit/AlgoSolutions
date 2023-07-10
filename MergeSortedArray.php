<?php

class MergeSortedArray
{
    public function merge(&$nums1, $m, $nums2, $n)
    {
        $i = $m - 1;
        $j = $n - 1;

        while ($i >= 0 && $j >= 0) {
            if ($nums1[$i] > $nums2[$j]) {
                $nums1[$i + $j + 1] = $nums1[$i];
                $i--;
            } else {
                $nums1[$i + $j + 1] = $nums2[$j];
                $j--;
            }
        }

        while ($j >= 0) {
            $nums1[$j] = $nums2[$j];
            $j--;
        }
    }
}

$a = new MergeSortedArray();
$nums1 = [1, 2, 3, 0, 0, 0];
$m = 3;
$nums2 = [2, 5, 6];
$n = 3;
$a->merge($nums1, $m, $nums2, $n);
print_r($nums1);