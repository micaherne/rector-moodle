<?php

namespace RectorMoodle\Set\SetProvider;

use Rector\Set\Contract\SetProviderInterface;
use Rector\Set\Enum\SetGroup;
use Rector\Set\ValueObject\Set;

class MoodleSetProvider implements SetProviderInterface {

    final const GROUP_NAME = 'moodle';

    /**
     * @inheritDoc
     */
    public function provide(): array {
        return [
            new Set(self::GROUP_NAME, 'Moodle 42', __DIR__ . '/../../config/sets/moodle42.php'),
            new Set(self::GROUP_NAME, 'Moodle 43', __DIR__ . '/../../config/sets/moodle43.php'),
            new Set(self::GROUP_NAME, 'Moodle 44', __DIR__ . '/../../config/sets/moodle44.php'),
            new Set(self::GROUP_NAME, 'Moodle 45', __DIR__ . '/../../config/sets/moodle45.php'),
        ];
    }
}
