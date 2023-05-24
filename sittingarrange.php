<?php
ini_set('display_errors', 1);
class Plane
{
    protected $totalsection;
    protected $arrayMatrix;
    public function __construct($totalsection, $arrayMatrix)
    {
        $this->totalsection = $totalsection;
        $this->arrayMatrix = $arrayMatrix;
    }

    public function createGloblaArray($maxRow)
    {
        $globalArray = [];
        $totalsection = $this->totalsection;

        for ($i = 0; $i < $maxRow; $i++) {
            $detail = [];
            for ($j = 0; $j < $totalsection; $j++) {
                $array = $this->getArray($j + 1);
                $column = $this->getColumnCount($array);
                for ($k = 0; $k < $column; $k++) {
                    $seatType = $this->getSeatType($j, $k, $column, $totalsection);
                    $available = isset($array[$i][$k]) ? 'true' : 'false';
                    $position = array('row' => $i, 'column' => $k);
                    $detail[] = array(
                        'array' => $j + 1,
                        'seatType' => $seatType,
                        'available' => $available,
                        'position' => $position,
                        'fill' => 'false',
                    );
                }
            }
            $globalArray[] = $detail;
        }
        return $globalArray;
    }

    public function getSeatType($section, $column, $columnCount, $totalsection)
    {
        $seatType = '';
        $window = 'Window';
        $middle = 'Middle';
        $aisle = 'Aisle';
        if ($section == 0) {
            if ($column == 0) {
                $seatType = $window;
            } elseif ($column == $columnCount - 1) {
                $seatType = $aisle;
            } else {
                $seatType = $middle;
            }
        } elseif ($section == $totalsection - 1) {
            if ($column == 0) {
                $seatType = $aisle;
            } elseif ($column == $columnCount - 1) {
                $seatType = $window;
            } else {
                $seatType = $middle;
            }
        } else {
            if ($column == 0 || $column == $columnCount - 1) {
                $seatType = $aisle;
            } else {
                $seatType = $middle;
            }
        }
        return $seatType;
    }

    public function getColumnCount($array)
    {
        $column = 0;
        foreach ($array as $value) {
            $column = count($value);
            break;
        }
        return $column;
    }

    public function getArray($section)
    {
        $rowColumn = $this->arrayMatrix[$section - 1];
        $row = $rowColumn[1];
        $column = $rowColumn[0];
        $array = [];
        for ($i = 0; $i < $row; $i++) {
            for ($j = 0; $j < $column; $j++) {
                $array[$i][$j] = 'null';
            }
        }
        return $array;
    }

    public function generateSeatNumber($groupDetailedArray, $totalseattofill)
    {
        $totalMiddleSeat = $this->totalMiddle();
        $totalWindowSeat = $this->totalWindow();
        $totalAisleSeat = $this->totalAisle();
        $totalseat = $totalAisleSeat + $totalMiddleSeat + $totalWindowSeat;
        $organisedArray = [];
        for ($i = 1; $i < $totalseat + 1; $i++) {
            for ($j = 0; $j < count($groupDetailedArray); $j++) {
                $insightArray = $groupDetailedArray[$j];
                for ($k = 0; $k < count($insightArray); $k++) {

                    $available = $insightArray[$k]['available'];
                    $fill = $insightArray[$k]['fill'];
                    if ($available == 'true' && $fill == 'false') {
                        $section = $insightArray[$k]['array'];
                        $row = $insightArray[$k]['position']['row'];
                        $column = $insightArray[$k]['position']['column'];
                        $seatnumber = $i;
                        if ($totalseattofill < $i) {
                            $seatnumber = 'null';
                        }
                        $organisedArray[$section][$row][$column] = $seatnumber;
                        if ($totalAisleSeat > 0) {
                            if ($insightArray[$k]['seatType'] == 'Aisle') {
                                $totalAisleSeat--;
                                $groupDetailedArray[$j][$k]['fill'] = 'true';
                                break 2;
                            }
                        } elseif ($totalWindowSeat > 0) {
                            if ($insightArray[$k]['seatType'] == 'Window') {
                                $totalWindowSeat--;
                                $groupDetailedArray[$j][$k]['fill'] = 'true';
                                break 2;
                            }
                        } elseif ($totalMiddleSeat > 0) {
                            if ($insightArray[$k]['seatType'] == 'Middle') {
                                $totalMiddleSeat--;
                                $groupDetailedArray[$j][$k]['fill'] = 'true';
                                break 2;
                            }
                        }
                    }
                }
            }
        }
        return $organisedArray;
    }

    public function totalMiddle()
    {
        $totalMiddleSeat = 0;
        foreach ($this->arrayMatrix as $value) {
            $totalMiddleSeat += (($value[0] - 2) * $value[1]);
        }
        return $totalMiddleSeat;
    }

    public function totalWindow()
    {
        $totalWindowSeat = 0;
        $loop = 1;
        foreach ($this->arrayMatrix as $value) {
            if ($loop == 1 || $loop == count($this->arrayMatrix)) {
                $totalWindowSeat += $value[1];
            }
            $loop++;
        }
        return $totalWindowSeat;
    }

    public function totalAisle()
    {
        $totalseat = $this->totalseat();
        $totalWindowSeat = $this->totalWindow();
        $totalMiddleSeat = $this->totalMiddle();
        return $totalseat - ($totalWindowSeat + $totalMiddleSeat);
    }

    public function totalseat()
    {
        $totalseat = 0;
        foreach ($this->arrayMatrix as $value) {
            $totalseat += $value[0] * $value[1];
        }
        return $totalseat;
    }
}
$groupDetailedArray = [];
$totalsection = 5;
$arrayMatrix = [[3, 4], [3, 2], [4, 3], [2, 3], [3, 4]];
$plane = new Plane($totalsection, $arrayMatrix);
$maxRow = max(array_column($arrayMatrix, 1));

$groupDetailedArray = $plane->createGloblaArray($maxRow);
$result = $plane->generateSeatNumber($groupDetailedArray, 30);
echo '<pre>';
print_r($result);
