<?php

declare(strict_types=1);

namespace RectorMoodle\Console\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

#[AsCommand(
    name: 'extract-renamed-classes',
    description: 'Extract an array of all renamed classes from Moodle'
)]
final class ExtractRenamedClasses extends Command
{
    protected function configure(): void
    {
        $this->addArgument('moodle-tag', InputArgument::REQUIRED, 'The tag to extract from');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $process = new Process(['git', '--version']);
        try {
            $process->mustRun();
        } catch (ProcessFailedException) {
            $output->writeln('Git not found');
            return Command::FAILURE;
        }

        $moodleTag = $input->getArgument('moodle-tag');

        $fs = new Filesystem();

        $repoLocation = $fs->tempnam(sys_get_temp_dir(), 'mdl');
        unlink($repoLocation);

        try {
            $output->writeln("Cloning Moodle to $repoLocation");

            $process = new Process(
                [
                    'git',
                    'clone',
                    '--depth',
                    '1',
                    '--branch',
                    $moodleTag,
                    'git://git.moodle.org/moodle.git',
                    $repoLocation
                ]
            );
            $process->setTimeout(300);
            $process->mustRun();
        } catch (ProcessFailedException $e) {
            $output->writeln('Unable to clone Moodle: ' . $e->getMessage());
        }

        define('MOODLE_INTERNAL', 1);

        $finder = new Finder();
        $finder->in($repoLocation)->files()->path('/.*\/db\/renamedclasses.php$/');

        $renames = [];
        foreach ($finder as $file) {
            $renamedclasses = [];
            $output->writeln("Getting classes from " . $file->getRelativePathname());
            require_once($file->getRealPath());
            $renames += $renamedclasses;
        }

        $output->writeln(print_r($renames, true));

        $outputFile = __DIR__ . '/../../../config/extracted/renamed-classes/' . $moodleTag . '.php';

        $fs->mkdir(dirname($outputFile));

        file_put_contents($outputFile, '<?php return ' . var_export($renames, true) . ';');

        $output->writeln('Removing Moodle clone');
        $fs->remove($repoLocation);

        return self::SUCCESS;
    }
}
