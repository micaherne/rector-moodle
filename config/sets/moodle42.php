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
            // For external_format_*, the new methods don't support id being passed for the context
            // parameter. There's not much we can do about this apart from hope it is picked up in 
            // unit tests.
            new FuncCallToStaticCall(
                'external_format_string',
                'core_external\util',
                'format_string'
            ),
            new FuncCallToStaticCall(
                'external_format_text',
                'core_external\util',
                'format_text'
            ),

            // external_create_service_token and external_generate_token now
            // map to core_external\util::generate_token() but with different
            // parameters, so we can't easily rewrite them.

            new FuncCallToStaticCall(
                'external_generate_token_for_current_user',
                'core_external\util',
                'generate_token_for_current_user'
            ),

            new FuncCallToStaticCall(
                'external_log_token_request',
                'core_external\util',
                'log_token_request'
            ),
        ]
    );

    // Cron functions moved to class.
    // See https://github.com/moodle/moodle/blob/v4.2.0/lib/upgrade.txt#L99
    $rectorConfig->ruleWithConfiguration(
        FuncCallToStaticCallRector::class,
        [
            new FuncCallToStaticCall(
                'cron_setup_user',
                '\core\cron',
                'setup_user'
            ),

            new FuncCallToStaticCall(
                'cron_run',
                '\core\cron',
                'run_main_process'
            ),

            new FuncCallToStaticCall(
                'cron_run_scheduled_tasks',
                '\core\cron',
                'run_scheduled_tasks'
            ),

            new FuncCallToStaticCall(
                'cron_run_adhoc_task',
                '\core\cron',
                'run_adhoc_tasks'
            ),

            new FuncCallToStaticCall(
                'cron_run_inner_scheduled_task',
                '\core\cron',
                'run_inner_scheduled_task'
            ),

            new FuncCallToStaticCall(
                'cron_run_inner_adhoc_task',
                '\core\cron',
                'run_inner_adhoc_task'
            ),

            new FuncCallToStaticCall(
                'cron_set_process_title',
                '\core\cron',
                'set_process_title'
            ),

            new FuncCallToStaticCall(
                'cron_trace_time_and_memory',
                '\core\cron',
                'trace_time_and_memory'
            ),

            new FuncCallToStaticCall(
                'cron_prepare_core_renderer',
                '\core\cron',
                'prepare_core_renderer'
            ),

        ]
    );

    // Moved behat functions.
    // See https://github.com/moodle/moodle/blob/v4.2.0/grade/report/upgrade.txt#L20
    $rectorConfig->ruleWithConfiguration(
        FuncCallToStaticCallRector::class,
        [
            new FuncCallToStaticCall(
                'get_grade_item_id',
                '\behat_grades',
                'get_grade_item_id'
            )

            // grade_report::get_lang_string() calls won't have enough information
            // to refactor automatically.
        ]
    );

    // TODO: Consider adding the context class renames here.
    // See https://github.com/moodle/moodle/blob/v4.2.0/lib/upgrade.txt#L6
    // This should maybe be a separate option somehow.

    // TODO: The move to grade_calculator in the quiz hasn't been done here as it requires
    // constructing the object first so is not an easy function rename or whatever.
    // (e.g. quiz_update_sumgrades)

    // TODO: Write a script to read the renamedclasses.php files and do them automatically.
};