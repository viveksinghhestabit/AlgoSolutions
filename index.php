<?php

class Sorting
{
    /**
     * @param $array
     * @return array
     * Quick Sort
     */
    public function quickSort($array)
    {
        $count = count($array);
        if ($count <= 1) {
            return $array;
        }
        $pivot = $array[0];
        $left = $right = [];
        for ($i = 1; $i < $count; $i++) {
            if ($array[$i] < $pivot) {
                $left[] = $array[$i];
            } else {
                $right[] = $array[$i];
            }
        }
        return array_merge($this->quickSort($left), [$pivot], $this->quickSort($right));
    }

    /**
     * @param $array
     * @return array
     * Bubble Sort
     */
    public function bubbleSort($array)
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

    /**
     * @param $array
     * @return array
     * Selection Sort
     */
    public function selectionSort($array)
    {
        $count = count($array);
        for ($i = 0; $i < $count; $i++) {
            $min = $i;
            for ($j = $i + 1; $j < $count; $j++) {
                if ($array[$j] < $array[$min]) {
                    $min = $j;
                }
            }
            $temp = $array[$i];
            $array[$i] = $array[$min];
            $array[$min] = $temp;
        }
        return $array;
    }

    /**
     * @param $array
     * @return array
     * Insertion Sort
     */
    public function insertionSort($array)
    {
        $count = count($array);
        for ($i = 1; $i < $count; $i++) {
            $temp = $array[$i];
            $j = $i - 1;
            while ($j >= 0 && $array[$j] > $temp) {
                $array[$j + 1] = $array[$j];
                $j--;
            }
            $array[$j + 1] = $temp;
        }
        return $array;
    }

    /**
     * @param $array
     * @return array
     * Shell Sort
     */
    public function shellSort($array)
    {
        $count = count($array);
        $gap = floor($count / 2);
        while ($gap > 0) {
            for ($i = $gap; $i < $count; $i++) {
                $temp = $array[$i];
                $j = $i;
                while ($j >= $gap && $array[$j - $gap] > $temp) {
                    $array[$j] = $array[$j - $gap];
                    $j -= $gap;
                }
                $array[$j] = $temp;
            }
            $gap = floor($gap / 2);
        }
        return $array;
    }

    /**
     * @param $array
     * @return array
     * Heap Sort
     */
    public function heapSort($array)
    {
        $count = count($array);
        $this->heapify($array, $count);
        $end = $count - 1;
        while ($end > 0) {
            $temp = $array[0];
            $array[0] = $array[$end];
            $array[$end] = $temp;
            $end--;
            $this->siftDown($array, 0, $end);
        }
        return $array;
    }

    /**
     * @param $array
     * @param $count
     * Heapify the array
     */
    public function heapify(&$array, $count)
    {
        $start = floor(($count - 2) / 2);
        while ($start >= 0) {
            $this->siftDown($array, $start, $count - 1);
            $start--;
        }
    }

    /**
     * @param $array
     * @param $start
     * @param $end
     * Sift down the array
     */
    public function siftDown(&$array, $start, $end)
    {
        $root = $start;
        while ($root * 2 + 1 <= $end) {
            $child = $root * 2 + 1;
            $swap = $root;
            if ($array[$swap] < $array[$child]) {
                $swap = $child;
            }
            if ($child + 1 <= $end && $array[$swap] < $array[$child + 1]) {
                $swap = $child + 1;
            }
            if ($swap != $root) {
                $temp = $array[$root];
                $array[$root] = $array[$swap];
                $array[$swap] = $temp;
                $root = $swap;
            } else {
                return;
            }
        }
    }

    /**
     * @param $array
     * @return array
     * Counting Sort
     */
    public function countingSort($array)
    {
        $count = count($array);
        $max = max($array);
        $min = min($array);
        $range = $max - $min + 1;
        $countArray = array_fill(0, $range, 0);
        $outputArray = array_fill(0, $count, 0);
        for ($i = 0; $i < $count; $i++) {
            $countArray[$array[$i] - $min]++;
        }
        for ($i = 1; $i < $range; $i++) {
            $countArray[$i] += $countArray[$i - 1];
        }
        for ($i = $count - 1; $i >= 0; $i--) {
            $outputArray[$countArray[$array[$i] - $min] - 1] = $array[$i];
            $countArray[$array[$i] - $min]--;
        }
        for ($i = 0; $i < $count; $i++) {
            $array[$i] = $outputArray[$i];
        }
        return $array;
    }

    /**
     * @param $array
     * @return array
     * Bucket Sort
     */
    public function bucketSort($array)
    {
        $count = count($array);
        $max = max($array);
        $min = min($array);
        $range = $max - $min + 1;
        $bucket = array_fill(0, $range, []);
        for ($i = 0; $i < $count; $i++) {
            $bucket[$array[$i] - $min][] = $array[$i];
        }
        $k = 0;
        for ($i = 0; $i < $range; $i++) {
            $bucketCount = count($bucket[$i]);
            if ($bucketCount > 0) {
                for ($j = 0; $j < $bucketCount; $j++) {
                    $array[$k] = $bucket[$i][$j];
                    $k++;
                }
            }
        }
        return $array;
    }

    /**
     * @param $array
     * @return array
     * Radix Sort
     */
    public function radixSort($array)
    {
        $count = count($array);
        $max = max($array);
        $exp = 1;
        while ($max / $exp > 0) {
            $this->countingSortForRadix($array, $count, $exp);
            $exp *= 10;
        }
        return $array;
    }

    public function countingSortForRadix(&$array, $count, $exp)
    {
        $outputArray = array_fill(0, $count, 0);
        $countArray = array_fill(0, 10, 0);
        for ($i = 0; $i < $count; $i++) {
            $countArray[($array[$i] / $exp) % 10]++;
        }
        for ($i = 1; $i < 10; $i++) {
            $countArray[$i] += $countArray[$i - 1];
        }
        for ($i = $count - 1; $i >= 0; $i--) {
            $outputArray[$countArray[($array[$i] / $exp) % 10] - 1] = $array[$i];
            $countArray[($array[$i] / $exp) % 10]--;
        }
        for ($i = 0; $i < $count; $i++) {
            $array[$i] = $outputArray[$i];
        }
    }

    /**
     * @param $array
     * @return array
     * Merge Sort
     */
    public function mergeSort($array)
    {
        $count = count($array);
        if ($count == 1) {
            return $array;
        }
        $mid = floor($count / 2);
        $left = array_slice($array, 0, $mid);
        $right = array_slice($array, $mid);
        $left = $this->mergeSort($left);
        $right = $this->mergeSort($right);
        return $this->merge($left, $right);
    }

    /**
     * @param $left
     * @param $right
     * @return array
     * Merge two arrays
     */
    public function merge($left, $right)
    {
        $result = [];
        while (!empty($left) && !empty($right)) {
            if ($left[0] > $right[0]) {
                $result[] = $right[0];
                $right = array_slice($right, 1);
            } else {
                $result[] = $left[0];
                $left = array_slice($left, 1);
            }
        }
        while (!empty($left)) {
            $result[] = $left[0];
            $left = array_slice($left, 1);
        }
        while (!empty($right)) {
            $result[] = $right[0];
            $right = array_slice($right, 1);
        }
        return $result;
    }
}
if ($_POST) {
    $array = $_POST['array'];
    $array = explode(',', $array);
    $sort = new Sorting();
    $sortType = $_POST['sortType'];
    switch ($sortType) {
        case 1:
            $result = $sort->bubbleSort($array);
            break;
        case 2:
            $result = $sort->insertionSort($array);
            break;
        case 3:
            $result = $sort->selectionSort($array);
            break;
        case 4:
            $result = $sort->heapSort($array);
            break;
        case 5:
            $result = $sort->countingSort($array);
            break;
        case 6:
            $result = $sort->bucketSort($array);
            break;
        case 7:
            $result = $sort->radixSort($array);
            break;
        case 8:
            $result = $sort->mergeSort($array);
            break;
        default:
            echo "Please choose a sort type";
            break;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sorting ALgorithm</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

</head>

<body>
    <div class="container my-5">
        <form action="index.php" method="post" class="form-group">
            <div class="form-group">
                <label>Please Input An Array Like(Comma seperated values)</label>
                <input type="text" name="array" class="form-control" placeholder="1,4,2,7,3">
            </div>
            <div class="form-group">
                <label>Select Sorting Type:</label>
                <select name="sortType" class="form-control">
                    <option value="1">Bubble Sort</option>
                    <option value="2">Insertion Sort</option>
                    <option value="3">Selection Sort</option>
                    <option value="4">Heap Sort</option>
                    <option value="5">Counting Sort</option>
                    <option value="6">Bucket Sort</option>
                    <option value="7">Radix Sort</option>
                    <option value="8">Merge Sort</option>

                </select>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>

        </form>
    </div>

    <?php if (isset($result)) : ?>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3>Output Result</h3>
                    <pre>
                    <?php
                    print_r($result);
                    ?>
                </pre>
                </div>
            </div>
        </div>
    <?php endif; ?>
</body>

</html>