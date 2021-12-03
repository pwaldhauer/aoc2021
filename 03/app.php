<?php

// part 1, die unperformanteste version u_u

$f = file('input.txt');

$mostCommon = '';
$leastCommon = '';

$counts = [];
$cols = strlen(trim($f[0]));
for($i = 0; $i < $cols; $i++) {

    foreach($f as $line) {
        $bit = $line[$i];

        if(!isset($counts[$i])) {
            $counts[$i] = ['0' => 0, '1' => 0];
        }

        $counts[$i][$bit]++;
    }

    if($counts[$i]['0'] > $counts[$i]['1']) {
        $mostCommon .= '0';
        $leastCommon .= '1';
    } else {
        $mostCommon  .= '1';
        $leastCommon .= '0';
    }


}

printf('Most common: %s, least common: %s' .PHP_EOL, $mostCommon, $leastCommon);


printf('r: %s'. PHP_EOL, bindec($mostCommon) * bindec($leastCommon));

// part 2

$oxygen = 0;
$co2 = 0;

$matrix = array_map('str_split', array_map('trim', $f));

$bit = 0;
while(true) {

    $common = getMostCommonInMatrix($matrix, $bit);


    var_dump(count($matrix));
    var_dump($common);

    $matrix = array_values(array_filter($matrix, function($i) use($common, $bit) {
        return $i[$bit] == $common;
    }));


    var_dump(count($matrix));

    if(count($matrix) === 1) {
        $oxygen = $matrix[0];
        break;
    }

    $bit++;
    if($bit == $cols) {
        break;
    }

}

$matrix = array_map('str_split', array_map('trim', $f));

$bit = 0;
while(true) {

    $common = getMostCommonInMatrix($matrix, $bit) == '1' ? '0' : '1';


    var_dump(count($matrix));
    var_dump($common);

    $matrix = array_values(array_filter($matrix, function($i) use($common, $bit) {
        return $i[$bit] == $common;
    }));


    var_dump(count($matrix));

    if(count($matrix) === 1) {
        $co2 = $matrix[0];
        break;
    }

    $bit++;
    if($bit == $cols) {
        break;
    }

}

printf('oxy: %s, co2: %s' .PHP_EOL, implode('', $oxygen), implode('', $co2));

$a = bindec(implode('', $oxygen));
$b = bindec(implode('', $co2));

echo $a*$b . PHP_EOL;

function getMostCommonInMatrix($matrix, $col) {
    array_unshift($matrix, null);
    $matrix = call_user_func_array('array_map', $matrix);
    $matrix = array_map('array_reverse', $matrix);

    $ones = count(array_filter($matrix[$col], function($item) {
        return $item === '1';
    }));
    return $ones >= (count($matrix[$col]) / 2) ? '1' : '0';
 
}