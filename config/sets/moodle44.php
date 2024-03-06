<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Transform\Rector\FuncCall\FuncCallToStaticCallRector;
use Rector\Transform\ValueObject\FuncCallToStaticCall;

return static function (RectorConfig $rectorConfig): void {

    // Renames for Moodle 4.4 to be implemented here when finalised.

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
