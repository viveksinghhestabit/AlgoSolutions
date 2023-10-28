<?php
ini_set('error_reporting', 1);
class FindPath
{
    public $arr = [];
    public $start = [];
    public $end = [];
    public $visited = [];
    public $path = [];
    public $isFound = '0';

    public function __construct($arr, $start, $end)
    {
        $this->visited = [];
        $this->path = [];
        $this->isFound = '0';

        $this->arr = $arr;
        $this->start = $start;
        $this->end = $end;

        for ($i = 0; $i < count($arr); $i++) {
            $this->visited[$i] = [];
            for ($j = 0; $j < count($arr[$i]); $j++) {
                $this->visited[$i][$j] = false;
            }
        }
    }

    public function findPath($x, $y)
    {
        if ($x < 0 || $y < 0 || $x >= count($this->arr) || $y >= count($this->arr)) {
            return false;
        }
        if ($this->arr[$x][$y] == '#' || $this->visited[$x][$y]) {
            return false;
        }
        if ($x == $this->end[0] && $y == $this->end[1]) {
            $this->isFound = '1';
            return true;
        }
        $this->visited[$x][$y] = true;
        if ($this->findPath($x, $y + 1)) {
            array_push($this->path, "$x" . ($y + 1));
            return true;
        }
        if ($this->findPath($x + 1, $y)) {
            array_push($this->path, ($x + 1) . "$y");
            return true;
        }

        if ($this->findPath($x, $y - 1)) {
            array_push($this->path, "$x" . ($y - 1));
            return true;
        }
        if ($this->findPath($x - 1, $y)) {
            array_push($this->path, ($x - 1) . "$y");
            return true;
        }
        return false;
    }
}

$maze = [
    ['#', '#', '#', '#', '#', '#', '#', '#', '#'],
    ['#', 'S', '#', '#', '#', '#', '#', '#', '#'],
    ['#', '.', '.', '.', '.', '.', '#', '#', '#'],
    ['#', '.', '#', '#', '#', '.', '#', '#', '#'],
    ['#', '.', '#', '#', '#', '.', '#', '#', '#'],
    ['#', '.', '.', '.', '.', '.', '.', '.', '#'],
    ['#', '#', '#', '#', '#', '#', '#', '.', '#'],
    ['#', '#', '#', '#', '#', '#', '#', 'E', '#'],
];

$start = [1, 1];
$end = [7, 7];
$findpath = new FindPath($maze, $start, $end);
$findpath->findPath($start[0], $start[1]);
echo '<pre>';
$traversePath = array_reverse($findpath->path);
$startkey = $start[0] . $start[1];
for ($i = 0; $i < count($maze); $i++) {
    for ($j = 0; $j < count($maze[$i]); $j++) {
        $key = "$i" . "$j";
        if (in_array($key, $traversePath)) {
            echo ">";
        } else if ($key == $start[0] . $start[1]) {
            echo "S";
        } else {
            echo "#";
        }
    }
    echo "<br>";
}
?>