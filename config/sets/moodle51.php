<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Renaming\Rector\Name\RenameClassRector;

return static function (RectorConfig $rectorConfig): void {

    $moodle51renames = require __DIR__ . '/../extracted/renamed-classes/v5.1.0.php';
    $moodle50renames = require __DIR__ . '/../extracted/renamed-classes/v5.0.0.php';

    $newrenames = array_diff_key($moodle51renames, $moodle50renames);

    $rectorConfig->ruleWithConfiguration(
        RenameClassRector::class,
        $newrenames
    );

};
