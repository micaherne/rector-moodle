<?php

declare(strict_types=1);

namespace RectorMoodle\Set;

use Rector\Set\Contract\SetListInterface;

final class MoodleLevelSetList implements SetListInterface
{

    final public const UP_TO_MOODLE_43 = __DIR__ . '/../../config/sets/level/up-to-moodle43.php';
}