<?php

namespace RectorMoodle\Config;

use InvalidArgumentException;
use Symfony\Component\Filesystem\Filesystem;

class ConfigHelper
{

    public function getPhpStanConfig(string $moodleRoot): string
    {
        if (!is_dir($moodleRoot) || !file_exists($moodleRoot . '/version.php')) {
            throw new InvalidArgumentException('Moodle root is not a directory is not a valid Moodle codebase');
        }
        $moodleRoot = realpath($moodleRoot);

        $code = <<<PHP
        parameters:
            scanDirectories:
                - $moodleRoot
        PHP;

        $fs = new Filesystem();
        $filename = $fs->tempnam(sys_get_temp_dir(), 'phpstan', '.neon');
        $fs->dumpFile($filename, $code);
        return $filename;
    }

}