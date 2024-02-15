<?php

namespace RectorMoodle\Tests\Rule\Transform\Rector\ConstFetchToClassConstFetchRector;

$x = CONTEXT_COURSE;
-----
<?php

namespace RectorMoodle\Tests\Rule\Transform\Rector\ConstFetchToClassConstFetchRector;

$x = \core\context\course::LEVEL;
