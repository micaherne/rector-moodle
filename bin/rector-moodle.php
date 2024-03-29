<?php declare(strict_types=1);

use RectorMoodle\Console\Command\ExtractRenamedClasses;
use Symfony\Component\Console\Application;

$app = new Application('Rector Moodle', '1.0.0');

$app->addCommands([
    new ExtractRenamedClasses()
]);

$app->run();