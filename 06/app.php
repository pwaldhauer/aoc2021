<?php

$ll = trim(file_get_contents('input.txt'));

$fish = array_map('intval', explode(',', $ll));

print_r($fish);

$days = 256;

$fishCounts = [
    0 => 0,
    1 => 0,
    2 => 0,
    3 => 0,
    4 => 0,
    5 => 0,
    6 => 0,
    7 => 0,
    8 => 0
];

foreach($fish as $f) {
    $fishCounts[$f]++;
}

print_r($fishCounts);

for($i = 0; $i < $days; $i++) {

    
    $newCounts = [
        0 => 0,
        1 => 0,
        2 => 0,
        3 => 0,
        4 => 0,
        5 => 0,
        6 => 0,
        7 => 0,
        8 => 0
    ];

    for($state = 0; $state < 9; $state++) {

        if($state == 0) {
            $newCounts[6] += $fishCounts[0];
            $newCounts[8] += $fishCounts[0];

            $fishCounts[0] = 0;
            continue;
        }

        $newCounts[$state] -= $fishCounts[$state];
        $newCounts[$state - 1] += $fishCounts[$state];
    }

    foreach($newCounts as $st => $c) {
        $fishCounts[$st] += $c;
    }
  


    echo "day $i: ". PHP_EOL;
    print_r($newCounts);
}

$c = array_sum(array_values($fishCounts));

printf('how much is the fish: %s' .PHP_EOL, $c );