<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Renaming\Rector\Name\RenameClassRector;
use Rector\Renaming\ValueObject\MethodCallRename;
use Rector\Transform\Rector\FuncCall\FuncCallToStaticCallRector;
use Rector\Transform\ValueObject\FuncCallToStaticCall;

return static function (RectorConfig $rectorConfig): void {

    $moodle45renames = require __DIR__ . '/../extracted/renamed-classes/v4.5.0.php';
    $moodle44renames = require __DIR__ . '/../extracted/renamed-classes/v4.4.0.php';

    $newrenames = array_diff_key($moodle45renames, $moodle44renames);

    $rectorConfig->ruleWithConfiguration(
        RenameClassRector::class,
        $newrenames
    );

    $rectorConfig->ruleWithConfiguration(
        RenameClassRector::class,
        [
            'core_component' => 'core\component', // MDL-66903
            'core_user' => 'core\user', // MDL-81031

            // MDL-81919
            'coding_exception' => 'core\exception\coding_exception',
            'file_serving_exception' => 'core\exception\file_serving_exception',
            'invalid_dataroot_permissions' => 'core\exception\invalid_dataroot_permissions',
            'invalid_parameter_exception' => 'core\exception\invalid_parameter_exception',
            'invalid_response_exception' => 'core\exception\invalid_response_exception',
            'invalid_state_exception' => 'core\exception\invalid_state_exception',
            'moodle_exception' => 'core\exception\moodle_exception',
            'require_login_exception' => 'core\exception\require_login_exception',
            'require_login_session_timeout_exception' => 'core\exception\require_login_session_timeout_exception',
            'required_capability_exception' => 'core\exception\required_capability_exception',
            'webservice_parameter_exception' => 'core\exception\webservice_parameter_exception',

            'emoticon_manager' => 'core\emoticon_manager', // MDL-81920
            'lang_string' => 'core\lang_string', // MDL-81920

            // MDL-81960
            'moodle_url' => 'core\url',
            'progress_trace' => 'core\output\progress_trace',
            'combined_progress_trace' => 'core\output\progress_trace\combined_progress_trace',
            'error_log_progress_trace' => 'core\output\progress_trace\error_log_progress_trace',
            'html_list_progress_trace' => 'core\output\progress_trace\html_list_progress_trace',
            'html_progress_trace' => 'core\output\progress_trace\html_progress_trace',
            'null_progress_trace' => 'core\output\progress_trace\null_progress_trace',
            'progress_trace_buffer' => 'core\output\progress_trace\progress_trace_buffer',
            'text_progress_trace' => 'core\output\progress_trace\text_progress_trace',

            // MDL-82183
            'action_link' => 'core\output\action_link',
            'action_menu_filler' => 'core\output\action_menu\action_menu_filler',
            'action_menu_link_primary' => 'core\output\action_menu\action_menu_link_primary',
            'action_menu_link_secondary' => 'core\output\action_menu\action_menu_link_secondary',
            'action_menu_link' => 'core\output\action_menu\action_menu_link',
            'action_menu' => 'core\output\action_menu\action_menu',
            'block_contents' => 'core_block\output\block_contents',
            'block_move_target' => 'core_block\output\block_move_target',
            'component_action' => 'core\output\actions\component_action',
            'confirm_action' => 'core\output\actions\confirm_action',
            'context_header' => 'core\output\context_header',
            'core\output\local\action_menu\subpanel' => 'core\output\action_menu\subpanel',
            'core_renderer_ajax' => 'core\output\core_renderer_ajax',
            'core_renderer_cli' => 'core\output\core_renderer_cli',
            'core_renderer_maintenance' => 'core\output\core_renderer_maintenance',
            'core_renderer' => 'core\output\core_renderer',
            'custom_menu_item' => 'core\output\custom_menu_item',
            'custom_menu' => 'core\output\custom_menu',
            'file_picker' => 'core\output\file_picker',
            'flexible_table' => 'core_table\flexible_table',
            'fragment_requirements_manager' => 'core\output\requirements\fragment_requirements_manager',
            'help_icon' => 'core\output\help_icon',
            'html_table_cell' => 'core_table\output\html_table_cell',
            'html_table_row' => 'core_table\output\html_table_row',
            'html_table' => 'core_table\output\html_table',
            'html_writer' => 'core\output\html_writer',
            'image_icon' => 'core\output\image_icon',
            'initials_bar' => 'core\output\initials_bar',
            'js_writer' => 'core\output\js_writer',
            'page_requirements_manager' => 'core\output\requirements\page_requirements_manager',
            'paging_bar' => 'core\output\paging_bar',
            'pix_emoticon' => 'core\output\pix_emoticon',
            'pix_icon_font' => 'core\output\pix_icon_font',
            'pix_icon_fontawesome' => 'core\output\pix_icon_fontawesome',
            'pix_icon' => 'core\output\pix_icon',
            'plugin_renderer_base' => 'core\output\plugin_renderer_base',
            'popup_action' => 'core\output\actions\popup_action',
            'preferences_group' => 'core\output\preferences_group',
            'preferences_groups' => 'core\output\preferences_groups',
            'progress_bar' => 'core\output\progress_bar',
            'renderable' => 'core\output\renderable',
            'renderer_base' => 'core\output\renderer_base',
            'renderer_factory_base' => 'core\output\renderer_factory\renderer_factory_base',
            'renderer_factory' => 'core\output\renderer_factory\renderer_factory_interface',
            'single_button' => 'core\output\single_button',
            'single_select' => 'core\output\single_select',
            'standard_renderer_factory' => 'core\output\renderer_factory\standard_renderer_factory',
            'table_dataformat_export_format' => 'core_table\dataformat_export_format',
            'table_default_export_format_parent' => 'core_table\base_export_format',
            'table_sql' => 'core_table\sql_table',
            'tabobject' => 'core\output\tabobject',
            'tabtree' => 'core\output\tabtree',
            'templatable' => 'core\output\templatable',
            'theme_config' => 'core\output\theme_config',
            'theme_overridden_renderer_factory' => 'core\output\renderer_factory\theme_overridden_renderer_factory',
            'url_select' => 'core\output\url_select',
            'user_picture' => 'core\output\user_picture',
            'xhtml_container_stack' => 'core\output\xhtml_container_stack',
            'YUI_config' => 'core\output\requirements\yui',

            // MDL-82158
            'cache_definition' => 'core_cache\cache_definition',
            'cache_request' => 'core_cache\request_cache',
            'cache_session' => 'core_cache\session_cache',
            'cache_cached_object' => 'core_cache\cached_object',
            'cache_config' => 'core_cache\config',
            'cache_config_writer' => 'core_cache\config_writer',
            'cache_config_disabled' => 'core_cache\disabled_config',
            'cache_disabled' => 'core_cache\disabled_cache',
            'config_writer' => 'core_cache\config_writer',
            'cache_data_source' => 'core_cache\data_source_interface',
            'cache_data_source_versionable' => 'core_cache\versionable_data_source_interface',
            'cache_exception' => 'core_cache\exception\cache_exception',
            'cache_factory' => 'core_cache\factory',
            'cache_factory_disabled' => 'core_cache\disabled_factory',
            'cache_helper' => 'core_cache\helper',
            'cache_is_key_aware' => 'core_cache\key_aware_cache_interface',
            'cache_is_lockable' => 'core_cache\lockable_cache_interface',
            'cache_is_searchable' => 'core_cache\searchable_cache_interface',
            'cache_is_configurable' => 'core_cache\configurable_cache_interface',
            'cache_loader' => 'core_cache\loader_interface',
            'cache_loader_with_locking' => 'core_cache\loader_with_locking_interface',
            'cache_lock_interface' => 'core_cache\cache_lock_interface',
            'cache_store' => 'core_cache\store',
            'cache_store_interface' => 'core_cache\store_interface',
            'cache_ttl_wrapper' => 'core_cache\ttl_wrapper',
            'cacheable_object' => 'core_cache\cacheable_object_interface',
            'cacheable_object_array' => 'core_cache\cacheable_object_array',
            'cache_definition_mappings_form' => 'core_cache\form\cache_definition_mappings_form',
            'cache_definition_sharing_form' => 'core_cache\form\cache_definition_sharing_form',
            'cache_lock_form' => 'core_cache\form\cache_lock_form',
            'cache_mode_mappings_form' => 'core_cache\form\cache_mode_mappings_form',

            // MDL-82133
            'core_reportbuilder\report_access_exception' => 'core_reportbuilder\exception\report_access_exception',
            'core_reportbuilder\source_invalid_exception' => 'core_reportbuilder\exception\source_invalid_exception',
            'core_reportbuilder\source_unavailable_exception' => 'core_reportbuilder\exception\source_unavailable_exception',

        ]
    );

    // MDL-66151.
    $rectorConfig->ruleWithConfiguration(MethodCallRename::class, [
        new MethodCallRename('core\session\manager', 'kill_all_sessions', 'destroy_all'),
        new MethodCallRename('core\session\manager', 'kill_session', 'destroy'),
        new MethodCallRename('core\session\manager', 'kill_sessions_for_auth_plugin', 'destroy_by_auth_plugin'),
        new MethodCallRename('core\session\manager', 'kill_user_sessions', 'destroy_user_sessions'),
    ]);

};
