<?php
namespace Console\App\Helpers;
use Core\Helper;
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
        $output->writeln(Helper::printBorder());
        $output->writeln(sprintf('Running command: '.$command));
        $output->writeln(Helper::printBorder());
        $output->writeln(shell_exec($command));
        $output->writeln(Helper::printBorder());
        return Command::SUCCESS;
    }
}