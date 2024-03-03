<?php
declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Renaming\Rector\Name\RenameClassRector;

return static function (RectorConfig $rectorConfig): void {

    $moodle43renames = require __DIR__ . '/../extracted/renamed-classes/v4.3.0.php';
    $moodle42renames = require __DIR__ . '/../extracted/renamed-classes/v4.2.0.php';

    $newrenames = array_diff_key($moodle43renames, $moodle42renames);

    $rectorConfig->ruleWithConfiguration(
        RenameClassRector::class,
        $newrenames
    );
};