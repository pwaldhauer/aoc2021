<?php

$f = file('input.txt');

$bingoFields = [];
$bingoFieldMarks = [];

$listOfNumbers = explode(',', trim($f[0]));

$c = 0;
for($i = 2; $i< count($f); $i++) {
    $line = trim($f[$i]);
    if(empty($line)) {
        $c++;
        continue;
    }

    $row = explode(' ', str_replace('  ', ' ', $line));

    if(!isset($bingoFields[$c])) {
        $bingoFields[$c] = [];
        $bingoFieldMarks[$c] = [];
    }

    $bingoFields[$c][] = $row;
    $bingoFieldMarks[$c][] = [0, 0, 0, 0, 0];
}

print_r($bingoFields);

var_dump($bingoFieldMarks);

foreach($listOfNumbers as $nr) {

    // Mark number
    foreach($bingoFields as $j => $bingoField) {
        foreach($bingoField as $i => $row) {
            foreach($row as $o => $f) {
                if($f === $nr) {
                    echo "marking a field";
                    $bingoFieldMarks[$j][$i][$o] = 1;
                }
            }
        }
    }


    // Check if we have a bingo
    foreach($bingoFieldMarks as $k => $marks) {
        $isBingo = checkForBingo($marks);
        if($isBingo) {
            echo "BINGO at field $k". PHP_EOL;
            var_dump($bingoFields[$k]);

            var_dump($marks);

            $sumOfUnmarked = 0;
            foreach($marks as $i => $row) {
                foreach($row as $j => $o) {
                    if($o === 0) {
                        echo "value of field $j is $o: ". $bingoFields[$k][$i][$j]. PHP_EOL;

                        $sumOfUnmarked += $bingoFields[$k][$i][$j];
                    }
                }
            }

            printf('%s , %s, Winning numbr is %s'. PHP_EOL, $sumOfUnmarked, $nr, $sumOfUnmarked * $nr);
            die;
        }
    }

}

function checkForBingo($marked) {
    foreach($marked as $row) {
        if(array_sum($row) === count($row)) {
            return true;
        }
    }

    array_unshift($marked, null);
    $marked = call_user_func_array('array_map', $marked);
    $marked = array_map('array_reverse', $marked);

    foreach($marked as $row) {
        if(array_sum($row) === count($row)) {
            return true;
        }
    }


    return false;
}


