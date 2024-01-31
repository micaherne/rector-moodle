<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\Console\Application;
use RectorMoodle\Console\Command\ExtractRenamedClasses;

$app = new Application("rector-moodle", "1.0");

$app->add(new ExtractRenamedClasses());

$app->run();