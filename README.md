# Rector rules for Moodle
This package provides basic rule sets for upgrading Moodle plugins for compatibility with new versions, using [Rector](https://getrector.com/).

Note that this is a work in progress and does not provide a comprehensive migration. Manual checking is still necessary.

## Install

Rector is installed using Composer, and this package should be installed similarly. It is not yet in Packagist so a repository entry is required:

    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/micaherne/rector-moodle.git"
        }
    ]

Then add a development dependency:

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
* **MoodleSetList::RENAME_CONTEXT_CLASSES** - Rename context classes to the new namespaced names introduced in Moodle 4.2. This is separate from the Moodle 4.2 set as the documentation strongly implies that there is no requirement to update from the old \context_* class names, and that the class aliases for backward compatibility will be retained indefinitely.
* **MoodleLevelSetList::UP_TO_MOODLE_43** - Apply both the Moodle 4.2 and 4.3 updates.

## Coverage

The rule sets mainly concentrate on updating class names where these are moved (e.g. as defined in the renamedclasses.php files), or where functions are moved to static methods on classes but retain the same signature.

There are various other changes between Moodle versions but some of these are not possible to implement an automated refactoring for, so this is not a replacement for following the guidance in the Moodle upgrade.txt files.