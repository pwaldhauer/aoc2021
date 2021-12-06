<?php

$ll = file('input.txt');

$lines = [];

$verticalLines = 0;
$maxX = 0;
$maxY= 0;

foreach($ll as $l) {
    [$left, $right] = explode(' -> ', trim($l));
    [$x1, $y1] = explode(',', $left);
    [$x2, $y2] = explode(',', $right);

    $lines[] = [intval($x1), intval($y1), intval($x2), intval($y2)];

    if($x1 > $maxX) {
        $maxX = $x1;
    }


    if($x2 > $maxX) {
        $maxX = $x2;
    }


    if($y1 > $maxY) {
        $maxY = $y1;
    }
    if($y2 > $maxY) {
        $maxY = $y2;
    }
}

print_r($lines);

$map = [];

for($x = 0; $x < $maxX; $x++) {

    for($y = 0; $y < $maxY; $y++) {
        $map[$y][$x] = 0;
    }
}

var_dump($maxX);
var_dump($maxY);


foreach($lines as [$x1, $y1, $x2, $y2]) {

    printf('LINE: %s, %s -> %s, %s'.PHP_EOL, $x1,$y1,$x2,$y2);

    if($x1 == $x2 || $y1 == $y2) {
        $xs = $x1 > $x2 ? $x2 : $x1;
        $ys = $y1 > $y2 ? $y2 : $y1;


        $xe = $x1 > $x2 ? $x1 : $x2;
        $ye = $y1 > $y2 ? $y1 : $y2;
        
        for($x = $xs; $x <= $xe; $x++) {

            for($y = $ys; $y <= $ye; $y++) {
                if(!isset($map[$y -1])) {
                    $map[$y -1] = [];
                }
    
                if(!isset($map[$y -1][$x -1])) {
                    $map[$y -1][$x -1] = 0;
                }
    
                $map[$y -1][$x -1]++;
                
            }
        }

        continue;
    }

    //diagonal
    $xs = $x1 > $x2 ? $x2 : $x1;
    $ys = $y1 > $y2 ? $y2 : $y1;


    $xe = $x1 > $x2 ? $x1 : $x2;
    $ye = $y1 > $y2 ? $y1 : $y2;

    for($x = $xs; $x <= $xe; $x++) {

        $y = (($y2 - $y1)/($x2 - $x1))*($x - $x1) + $y1;

        printf('y value: %s.%s %s, %s'. PHP_EOL, $xs, $ys, $x, $y);

            if(!isset($map[$y -1])) {
                $map[$y -1] = [];
            }

            if(!isset($map[$y -1][$x -1])) {
                $map[$y -1][$x -1] = 0;
            }

            $map[$y -1][$x -1]++;
            
        
    }

    
}


printMap($map);
dumpMap($map);

function printMap($map) {
    foreach($map as $y => $row) {
        foreach($row as $x => $col) {
            echo $col > 0 ? $col : '.';
        }

        echo PHP_EOL;
    }
}

function dumpMap($map) {
    $maxCol = 0;
    $cc =0;
    $im = imagecreatetruecolor(1000, 1000);
    foreach($map as $y => $row) {
        foreach($row as $x => $col) {
                if($col > $maxCol) {
                    $maxCol = $col;
                }

                if($col >= 2) {
                    $cc++;
                }

            imagesetpixel($im, $y, $x, $col > 0 ? imagecolorallocate($im, 233, (50 * $col) % 255, 91) : imagecolorallocate($im, 0, 0, 0));
        }
    }

    imagepng($im, 'test.png');

    echo $maxCol . PHP_EOL;
    echo $cc . PHP_EOL;
    

}