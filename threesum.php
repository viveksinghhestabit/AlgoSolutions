<?php 

class ThreeSum
{
    public function threeSum($nums)
    {
        $result = [];
        sort($nums);

        for ($i = 0; $i < count($nums) - 2; $i++) {
            if ($i == 0 || $nums[$i] > $nums[$i - 1]) {
                $j = $i + 1;
                $k = count($nums) - 1;

                while ($j < $k) {
                    if ($nums[$i] + $nums[$j] + $nums[$k] == 0) {
                        $result[] = [$nums[$i], $nums[$j], $nums[$k]];
                        $j++;
                        $k--;

                        while ($j < $k && $nums[$j] == $nums[$j - 1]) {
                            $j++;
                        }

                        while ($j < $k && $nums[$k] == $nums[$k + 1]) {
                            $k--;
                        }
                    } else if ($nums[$i] + $nums[$j] + $nums[$k] < 0) {
                        $j++;
                    } else {
                        $k--;
                    }
                }
            }
        }

        return $result;
    }
}

$a = new ThreeSum();
print_r($a->threeSum([-1, 0, 1, 2, -1, -4]));
