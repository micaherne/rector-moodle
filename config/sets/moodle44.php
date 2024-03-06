<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Renaming\Rector\Name\RenameClassRector;
use Rector\Transform\Rector\FuncCall\FuncCallToStaticCallRector;
use Rector\Transform\ValueObject\FuncCallToStaticCall;

return static function (RectorConfig $rectorConfig): void {

    $moodle44renames = require __DIR__ . '/../extracted/renamed-classes/v4.4.0.php';
    $moodle43renames = require __DIR__ . '/../extracted/renamed-classes/v4.3.0.php';

    $newrenames = array_diff_key($moodle44renames, $moodle43renames);

    $rectorConfig->ruleWithConfiguration(
        RenameClassRector::class,
        $newrenames
    );

    $rectorConfig->ruleWithConfiguration(
        FuncCallToStaticCallRector::class,
        [
            new FuncCallToStaticCall(
                'format_string',
                'core\formatting',
                'format_string'
            ),
            new FuncCallToStaticCall(
                'format_text',
                'core\formatting',
                'format_text'
            ),
        ]
    );
};
