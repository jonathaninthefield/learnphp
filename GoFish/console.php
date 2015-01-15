<?php
require('include.php');
use LearnPhp\GoFish\PlayGameCommand;
use LearnPhp\GoFish\IoUtils;

$command = new PlayGameCommand();
$command->run();

IoUtils::finish();