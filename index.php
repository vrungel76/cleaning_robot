<?php

declare(strict_types=1);

use app\ControlSystem;
use app\Navigation\MapController;
use app\Robot\Battery\Battery;
use app\ControlSystem\State\StateObject;

require_once __DIR__ . '/vendor/autoload.php';

$inputFile = $argv[1];
$outputFile = $argv[2];

$input = json_decode(file_get_contents($inputFile));

$map = $input->map;
$commands = $input->commands;

$state = new StateObject();
$state->battery = new Battery($input->battery);
$state->face = $input->start->facing;
$state->x = $input->start->X;
$state->y = $input->start->Y;

$map = new MapController($map);

$control = new ControlSystem($map, $state);


foreach ($commands as $key => $command) {
    if (!$control->doCommand($command)) {
        break;
    }
}

file_put_contents($outputFile, $control->getData());
echo 'done!';

