<?php

// part 1

$f = file('input.txt');

$state = [
    'x' => 0,
    'z' => 0,
];

foreach($f as $line) {
    list($cmd, $v) = explode(' ', $line);
    switch($cmd) {
        case 'forward':
            $state['x'] += intval($v);
            break;
        case 'down':
            $state['z'] += intval($v);
            break;
        case 'up':
            $state['z'] -= intval($v);
            break;
    }
}

echo $state['x'] * $state['z'] . PHP_EOL;

// part 2

$state = [
    'x' => 0,
    'z' => 0,
    'aim' => 0,
];

foreach($f as $line) {
    list($cmd, $v) = explode(' ', $line);
    switch($cmd) {
        case 'forward':
            $state['x'] += intval($v);
            $state['z'] += $state['aim'] * intval($v);
            break;
        case 'down':
            $state['aim'] += intval($v);
            break;
        case 'up':
            $state['aim'] -= intval($v);
            break;
    }
}

echo $state['x'] * $state['z'] . PHP_EOL;