<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Renaming\Rector\Name\RenameClassRector;

return static function (RectorConfig $rectorConfig): void {

    $moodle50renames = require __DIR__ . '/../extracted/renamed-classes/v5.0.0.php';
    $moodle45renames = require __DIR__ . '/../extracted/renamed-classes/v4.5.0.php';

    $newrenames = array_diff_key($moodle50renames, $moodle45renames);

    $rectorConfig->ruleWithConfiguration(
        RenameClassRector::class,
        $newrenames
    );

};
