<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Renaming\Rector\Name\RenameClassRector;
use Rector\Transform\Rector\FuncCall\FuncCallToStaticCallRector;
use Rector\Transform\ValueObject\FuncCallToStaticCall;

return static function (RectorConfig $rectorConfig): void {

    // Parts of external API moved.
    // See https://github.com/moodle/moodle/blob/v4.2.0/lib/upgrade.txt#L42
    $rectorConfig->ruleWithConfiguration(
        RenameClassRector::class,
        [
            'external_api' => 'core_external\external_api',
            'external_description' => 'core_external\external_description',
            'external_files' => 'core_external\files',
            'external_format_value' => 'core_external\external_format_value',
            'external_function_parameters' => 'core_external\external_function_parameters',
            'external_multiple_structure' => 'core_external\external_multiple_structure',
            'external_settings' => 'core_external\external_settings',
            'external_single_structure' => 'core_external\external_single_structure',
            'external_util' => 'core_external\util',
            'external_value' => 'core_external\external_value',
            'external_warnings' => 'core_external\external_warnings',
            'restricted_context_exception' => 'core_external\restricted_context_exception',
        ]
    );

    $rectorConfig->ruleWithConfiguration(
        FuncCallToStaticCallRector::class,
        [
            new FuncCallToStaticCall(
                'external_format_string',
                'core_external\util',
                'format_string'
            )
        ]
    );
};