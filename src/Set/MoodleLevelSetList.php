<?php

declare(strict_types=1);

namespace RectorMoodle\Set;

use Rector\Set\Contract\SetListInterface;

final class MoodleLevelSetList implements SetListInterface
{
    final public const UP_TO_MOODLE_43 = __DIR__ . '/../../config/sets/level/up-to-moodle43.php';
    final public const UP_TO_MOODLE_44 = __DIR__ . '/../../config/sets/level/up-to-moodle44.php';
    final public const UP_TO_MOODLE_45 = __DIR__ . '/../../config/sets/level/up-to-moodle45.php';
}
