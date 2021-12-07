<?php

$ll = trim(file_get_contents('input.txt'));

$crabs = array_map('intval', explode(',', $ll));

print_r($crabs);


$fuels = [];

for($i = 0; $i < count($crabs); $i++) {

    $totalFuel = 0;
    
    foreach($crabs as $crab) {
        $fuelToMoveThisCrab = abs($crab - $i);
        $totalFuel += $fuelToMoveThisCrab;
    }

    $fuels[$i] = $totalFuel;
}

rsort($fuels);
print_r($fuels);

// part 2



$fuels = [];

for($i = 0; $i < count($crabs); $i++) {

    $totalFuel = 0;
    
    foreach($crabs as $crab) {
        $steps = abs($crab - $i);
        $crabFuel = 0;
        
        for($o = 1; $o <= $steps; $o++) {
            $crabFuel += $o;
        }
        
        printf("Move crab %s to %s: %s fuel". PHP_EOL, $crab, $i, $crabFuel);

        $totalFuel += $crabFuel;
    }

   printf('tofu %s'. PHP_EOL, $totalFuel);


    $fuels[$i] = $totalFuel;
}

rsort($fuels);
print_r($fuels);