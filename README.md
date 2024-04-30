# Rector rules for Moodle
This package provides basic rule sets for upgrading Moodle plugins for compatibility with new versions, using [Rector](https://getrector.com/).

Note that this is a work in progress and does not provide a comprehensive migration. Manual checking is still necessary.

## Install

Rector is installed using Composer, and this package should be installed similarly. Add a development dependency:

    composer require --dev micaherne/rector-moodle

## Configuration

Rule sets can be added to your rector.php config file. For example:

    use Rector\Config\RectorConfig;
    use RectorMoodle\Set\MoodleLevelSetList;
    use RectorMoodle\Set\MoodleSetList;

    return RectorConfig::configure()
        ->withSets([
            MoodleLevelSetList::UP_TO_MOODLE_43,
            MoodleSetList::RENAME_CONTEXT_CLASSES
        ])
        ->withImportNames();


The following rule sets are available:

* **MoodleSetList::MOODLE_42** - Update features introduced in Moodle 4.2
* **MoodleSetList::MOODLE_43** - Update features introduced in Moodle 4.3
* **MoodleSetList::RENAME_CONTEXT_CLASSES** - Rename context classes to the new namespaced names introduced in Moodle 4.2, and convert level constants like CONTEXT_COURSE to the corresponding new LEVEL class constant. This is separate from the Moodle 4.2 set as the documentation strongly implies that there is no requirement to update from the old \context_* class names, and that the class aliases for backward compatibility will be retained indefinitely.
* **MoodleLevelSetList::UP_TO_MOODLE_43** - Apply both the Moodle 4.2 and 4.3 updates.

## Symbol discovery

Some rules in Rector require knowledge of the class hierarchy or other symbols (e.g. [CompleteDynamicPropertiesRector](https://github.com/rectorphp/rector/blob/main/rules/CodeQuality/Rector/Class_/CompleteDynamicPropertiesRector.php)). For these rules to work correctly, the whole Moodle codebase must be scanned. This appears as if it should be possible by using the `autoloadPaths()` method on the RectorConfig object, but this does not seem to work. An alternative to this is to use the `phpstanConfig()` method to specify a PHPStan configuration file that includes the Moodle codebase in its scanDirectories parameter. For example:

    return RectorConfig::configure()
        ->withSets([
            MoodleLevelSetList::UP_TO_MOODLE_43,
        ])
        ->phpstanConfig(__DIR__ . '/phpstan.neon');

where the phpstan.neon file contains something like:

    parameters:
        scanDirectories:
            - /path/to/moodle

There is a helper class that can be used to generate a PHPStan configuration file for a Moodle codebase. 

    use Rector\CodeQuality\Rector\Class_\CompleteDynamicPropertiesRector;
    use Rector\Config\RectorConfig;
    use RectorMoodle\Config\ConfigHelper;

    return function (RectorConfig $rectorConfig) {

        $configHelper = new ConfigHelper();
        $rectorConfig->phpstanConfig($configHelper->getPhpStanConfig(__DIR__ . '/../../moodle'));

        $rectorConfig->rule(CompleteDynamicPropertiesRector::class);
    };

### Class aliases

Note that the above method of symbol discovery does not deal with class aliases. Ensure that your code does not contain any classes that are aliases in the Moodle codebase. 

In particular, you should run the UP_TO_MOODLE_* rule set for the version of Moodle you are using, as well as the RENAME_CONTEXT_CLASSES set if you are working with Moodle 4.2 or above.

## Coverage

The rule sets mainly concentrate on updating class names where these are moved (e.g. as defined in the renamedclasses.php files), or where functions are moved to static methods on classes but retain the same signature.

There are various other changes between Moodle versions but some of these are not possible to implement an automated refactoring for, so this is not a replacement for following the guidance in the Moodle upgrade.txt files.
