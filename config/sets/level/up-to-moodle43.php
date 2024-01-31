<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Set\ValueObject\SetList;
use RectorMoodle\Set\MoodleLevelSetList;
use RectorMoodle\Set\MoodleSetList;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->sets([MoodleSetList::MOODLE_42, MoodleSetList::MOODLE_43]);
};
