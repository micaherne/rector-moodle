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

    $rectorConfig->ruleWithConfiguration(
        RenameClassRector::class,
        [
            // MDL-83968
            'core\tests\route_testcase' => 'core\tests\router\route_testcase',
            'core\router\mocking_route_loader' => 'core\tests\router\mocking_route_loader',

            // MDL-84000
            'core_reportbuilder_testcase' => 'core_reportbuilder\tests\core_reportbuilder_testcase',
        ]
    );

};
