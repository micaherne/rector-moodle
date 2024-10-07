<?php

declare(strict_types=1);

namespace RectorMoodle\Set;

use Rector\Set\Contract\SetListInterface;

final class MoodleSetList implements SetListInterface
{

    final public const MOODLE_42 = __DIR__ . "/../../config/sets/moodle42.php";
    final public const MOODLE_43 = __DIR__ . "/../../config/sets/moodle43.php";
    final public const MOODLE_44 = __DIR__ . "/../../config/sets/moodle44.php";

    final public const RENAME_CONTEXT_CLASSES = __DIR__ . '/../../config/sets/rename-context-classes.php';

}
