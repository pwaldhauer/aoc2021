<?php

$f = file('input.txt');

$c = 0;
for($i = 1; $i < count($f); $i++) {
    
    if($f[$i] > $f[$i - 1]) {
        $c++;
    }

}

echo $c . PHP_EOL;

$c = 0;
$lastWindow = PHP_INT_MAX;
for($i = 0; $i < count($f) - 2; $i++) {
    $window = array_sum([$f[$i], $f[$i + 1], $f[$i +2]]);

    echo $window .PHP_EOL;
    
    if($window > $lastWindow) {
        $c++;
    }

    $lastWindow = $window;

}

echo $c . PHP_EOL;