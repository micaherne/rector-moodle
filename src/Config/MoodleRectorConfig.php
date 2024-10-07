<?php

namespace RectorMoodle\Config;

use Composer\InstalledVersions;
use InvalidArgumentException;
use Rector\Config\RectorConfig;
use Rector\Configuration\RectorConfigBuilder;
use RuntimeException;
use Symfony\Component\Filesystem\Filesystem;

class MoodleRectorConfig {
    public static function configure(string $moodlePath): RectorConfigBuilder {

        $moodleRootReal = realpath($moodlePath);
        if ($moodleRootReal === false) {
            throw new RuntimeException("Moodle path $moodlePath not found");
        }

        $moodlePath = $moodleRootReal;

        if (!file_exists($moodlePath . '/lib/components.json')) {
            throw new InvalidArgumentException("Components file not found in $moodlePath/lib/components.json");
        }

        $phpStanMoodlePath = InstalledVersions::getInstallPath('micaherne/phpstan-moodle');

        $phpStanConfig = <<<EOT
        includes:
            - $phpStanMoodlePath/extension.neon
        parameters:
            moodle:
                rootDirectory: $moodlePath
        EOT;

        // We need to use Filesystem here to create a temporary file with the correct extension.
        // This is because PHPStan (reasonably) determines what loader to use based on the extension.
        $fs = new Filesystem();
        $configFile = $fs->tempnam(sys_get_temp_dir(), 'phpstan', '.neon');
        $fs->dumpFile($configFile, $phpStanConfig);

        register_shutdown_function(function() use ($configFile): void {
            unlink($configFile);
        });

        return RectorConfig::configure()
            ->withPHPStanConfigs(
                [
                    $configFile
                ]
            );
    }
}
