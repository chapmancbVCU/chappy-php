<?php
namespace Console\App\Helpers;
use Console\App\Helpers\Tools;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Command\Command;
class Test {
    public static function makeTest(string $testName): string {
        return '<?php
namespace Tests;
use PHPUnit\Framework\TestCase;

/**
 * Undocumented class
 */
class '.$testName.' extends TestCase {
}
';
    }

    public static function runTest(InputInterface $input, OutputInterface $output) {
        $testName = $input->getArgument('testname');
        $command = 'php vendor/bin/phpunit tests'.DS.$testName.'.php';
        $output->writeln(Tools::border());
        $output->writeln(sprintf('Running command: '.$command));
        $output->writeln(Tools::border());
        $output->writeln(shell_exec($command));
        $output->writeln(Tools::border());
        return Command::SUCCESS;
    }
}