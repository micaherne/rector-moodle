<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Renaming\Rector\Name\RenameClassRector;
use Rector\Transform\Rector\FuncCall\FuncCallToStaticCallRector;
use Rector\Transform\ValueObject\FuncCallToStaticCall;

return static function (RectorConfig $rectorConfig): void {

    $moodle45renames = require __DIR__ . '/../extracted/renamed-classes/v4.5.0.php';
    $moodle44renames = require __DIR__ . '/../extracted/renamed-classes/v4.4.0.php';

    $newrenames = array_diff_key($moodle45renames, $moodle45renames);

    $rectorConfig->ruleWithConfiguration(
        RenameClassRector::class,
        $newrenames
    );

    // TODO: Add class renames from UPGRADING.md
    // TODO: Add any other automatable changes.
};
