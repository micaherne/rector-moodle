<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use RectorMoodle\Set\MoodleSetList;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->sets([MoodleSetList::MOODLE_45, MoodleSetList::MOODLE_44, MoodleSetList::MOODLE_43, MoodleSetList::MOODLE_42]);
};
