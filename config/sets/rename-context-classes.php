<?php
declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Renaming\Rector\Name\RenameClassRector;

// Rename context classes (e.g. context_module to core\context\module).
// This is separate from the Moodle version sets as there are backward-compatible
// class_aliases that are intended to be kept "for the next few decades", so no
// upgrade of these is necessarily expected.
//
// See https://github.com/moodle/moodle/blob/v4.2.0/lib/accesslib.php#L5022
return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->ruleWithConfiguration(
        RenameClassRector::class,
        [
            'context_helper' => 'core\context_helper',
            'context' => 'core\context',
            'context_block' => 'core\context\block',
            'context_course' => 'core\context\course',
            'context_coursecat' => 'core\context\coursecat',
            'context_module' => 'core\context\module',
            'context_system' => 'core\context\system',
            'context_user' => 'core\context\user',
        ]
    );
};