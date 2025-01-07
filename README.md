# Rector rules for Moodle
This package provides basic rule sets for upgrading Moodle plugins for compatibility with new versions, using [Rector](https://getrector.com/).

Note that this is a work in progress and does not provide a comprehensive migration. Manual checking is still necessary.

## Install

Rector is installed using Composer, and this package should be installed similarly. Add a development dependency:

    composer require --dev micaherne/rector-moodle

## Configuration

This library provides a configuration helper class that must be used to configure Rector correctly to understand
Moodle classes. This is *essential* for many Rector rules as they can break your code if they are not aware of
the Moodle class hierarchy.

Rule sets can be added to your rector.php config file. For example:

    use RectorMoodle\Config\MoodleRectorConfig;
    use RectorMoodle\Set\MoodleLevelSetList;
    
    return MoodleRectorConfig::configure('/path/to/your/moodle/root')
        ->withSets([
            MoodleLevelSetList::UP_TO_MOODLE_45
        ])
        ->withImportNames();


The following rule sets are available:

* **MoodleSetList::MOODLE_42** - Update features introduced in Moodle 4.2
* **MoodleSetList::MOODLE_43** - Update features introduced in Moodle 4.3
* **MoodleSetList::MOODLE_44** - Update features introduced in Moodle 4.4
* **MoodleSetList::MOODLE_45** - Update features introduced in Moodle 4.5
* **MoodleSetList::RENAME_CONTEXT_CLASSES** - Rename context classes to the new namespaced names introduced in Moodle 4.2, and convert level constants like CONTEXT_COURSE to the corresponding new LEVEL class constant. This is separate from the Moodle 4.2 set as the documentation strongly implies that there is no requirement to update from the old \context_* class names, and that the class aliases for backward compatibility will be retained indefinitely.
* **MoodleLevelSetList::UP_TO_MOODLE_43** - Apply both the Moodle 4.2 and 4.3 updates.
* **MoodleLevelSetList::UP_TO_MOODLE_44** - Apply Moodle 4.2, 4.3 and 4.4 updates.
* **MoodleLevelSetList::UP_TO_MOODLE_45** - Apply Moodle 4.2, 4.3, 4.4 and 4.5 updates.

## A note on symbol discovery

Some rules in Rector require knowledge of the class hierarchy or other symbols (e.g. [CompleteDynamicPropertiesRector](https://github.com/rectorphp/rector/blob/main/rules/CodeQuality/Rector/Class_/CompleteDynamicPropertiesRector.php)). 

For these rules to work correctly, the whole Moodle codebase must be scanned.
This appears as if it should be possible by using the `autoloadPaths()` method on the RectorConfig object, but this does not seem to work as expected. 

In addition to this, Rector must be aware of class aliases and the classes they point to. There is no way to do this 
in PHPStan (which Rector uses for symbol discovery) through configuration, so the aliased classes must be loaded
and the aliases created. This means that the `MoodleRectorConfig` class *actually runs some of your Moodle code*, 
so please ensure that you are running this in a safe environment.

### Class aliases

Note that the above method of symbol discovery only deals with class aliases in the core Moodle codebase,
and if you have any in your own codebase, you will need to ensure that they are available to Rector.

## Coverage

The rule sets mainly concentrate on updating class names where these are moved (e.g. as defined in the renamedclasses.php files), or where functions are moved to static methods on classes but retain the same signature.

There are various other changes between Moodle versions but some of these are not possible to implement an automated refactoring for, so this is not a replacement for following the guidance in the Moodle upgrade.txt files.
