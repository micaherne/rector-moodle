<?php

$x = format_string('Hello');
$y = format_text('Hello', FORMAT_HTML);

-----
<?php

$x = \core\formatting::format_string('Hello');
$y = \core\formatting::format_text('Hello', FORMAT_HTML);
