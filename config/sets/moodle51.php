<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Renaming\Rector\Name\RenameClassRector;
use Rector\Transform\Rector\ConstFetch\ConstFetchToClassConstFetchRector;
use Rector\Transform\Rector\FuncCall\FuncCallToStaticCallRector;
use Rector\Transform\ValueObject\ConstFetchToClassConstFetch;
use Rector\Transform\ValueObject\FuncCallToStaticCall;

return static function (RectorConfig $rectorConfig): void {

    $moodle51renames = require __DIR__ . '/../extracted/renamed-classes/v5.1.0.php';
    $moodle50renames = require __DIR__ . '/../extracted/renamed-classes/v5.0.0.php';

    $newrenames = array_diff_key($moodle51renames, $moodle50renames);

    $rectorConfig->ruleWithConfiguration(
        RenameClassRector::class,
        $newrenames
    );

    $rectorConfig->ruleWithConfiguration(
        RenameClassRector::class,
        [
            // MDL-82159
            'breadcrumb_navigation_node' => 'core\navigation\breadcrumb_navigation_node',
            'flat_navigation' => 'core\navigation\flat_navigation',
            'flat_navigation_node' => 'core\navigation\flat_navigation_node',
            'global_navigation' => 'core\navigation\global_navigation',
            'global_navigation_for_ajax' => 'core\navigation\global_navigation_for_ajax',
            'navbar' => 'core\navigation\navbar',
            'navigation_cache' => 'core\navigation\navigation_cache',
            'navigation_json' => 'core\navigation\navigation_json',
            'navigation_node' => 'core\navigation\navigation_node',
            'navigation_node_collection' => 'core\navigation\navigation_node_collection',
            'settings_navigation' => 'core\navigation\settings_navigation',
            'settings_navigation_ajax' => 'core\navigation\settings_navigation_ajax',

            // MDL-86256
            'core_xml_parser' => 'core\xml_parser',
            'xml_format_exception' => 'core\exception\xml_format_exception',

            // MDL-86283
            'externallib_advanced_testcase' => 'core_external\tests\externallib_testcase',

            // MDL-83904
            'core_badges_observer' => 'core_badges\event\observer',

            // MDL-86254
            'comment' => 'core_comment\manager',
            'comment_exception' => 'core_comment\comment_exception',

            // MDL-82322
            'course_request' => 'core_course\course_request',

            // MDL-86155
            'cm_info' => 'core_course\cm_info',
            'cached_cm_info' => 'core_course\cached_cm_info',
            'course_modinfo' => 'core_course\modinfo',
            'section_info' => 'core_course\section_info',

            // MDL-86337
            'core_course\output\activitychooserbutton' => 'core_courseformat\output\local\content\activitychooserbutton',
        ]
    );

    // MDL-82159
    $rectorConfig->ruleWithConfiguration(
        ConstFetchToClassConstFetchRector::class,
        [
            new ConstFetchToClassConstFetch('NAVIGATION_CACHE_NAME', 'core\navigation\navigation_node', 'CACHE_NAME'),
            new ConstFetchToClassConstFetch('NAVIGATION_SITE_ADMIN_CACHE_NAME', 'core\navigation\navigation_node', 'SITE_ADMIN_CACHE_NAME'),
        ]
    );

    // MDL-86168
    $rectorConfig->ruleWithConfiguration(
        FuncCallToStaticCallRector::class,
        [
            new FuncCallToStaticCall('ajax_capture_output', 'core\ajax', 'capture_output'),
            new FuncCallToStaticCall('ajax_check_captured_output', 'core\ajax', 'check_captured_output'),
        ]
    );

};
