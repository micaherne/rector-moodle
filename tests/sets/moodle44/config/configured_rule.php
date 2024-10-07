<?php

use Rector\Config\RectorConfig;
use RectorMoodle\Set\MoodleSetList;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->sets([MoodleSetList::MOODLE_44]);
};
