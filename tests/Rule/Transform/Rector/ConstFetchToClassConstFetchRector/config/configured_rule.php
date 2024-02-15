<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use RectorMoodle\Rule\Transform\Rector\ConstFetchToClassConstFetchRector;
use RectorMoodle\Rule\Transform\ValueObject\ConstFetchToClassConstFetch;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig
        ->ruleWithConfiguration(ConstFetchToClassConstFetchRector::class, [
            new ConstFetchToClassConstFetch('CONTEXT_COURSE', 'core\context\course', 'LEVEL'),
        ]);
};
