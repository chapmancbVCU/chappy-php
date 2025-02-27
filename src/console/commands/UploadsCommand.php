<?php
namespace Console\Commands;

use Console\Helpers\Tools;
use Console\Helpers\Uploads;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

/**
 * Supports ability to create a class that extends the Uploads class.
 */
class UploadsCommand extends Command {
    /**
     * Configures the command.
     *
     * @return void
     */
    protected function configure(): void
    {
        $this->setName('make:upload')
            ->setDescription('Generates a class that extends the Uploads class')
            ->setHelp('php console make:upload <name_of_upload_type>')
            ->addArgument('upload-type-name', InputArgument::REQUIRED, 'Pass the name of the type of upload you want to create.');
    }

    /**
     * Executes the command
     *
     * @param InputInterface $input The input.
     * @param OutputInterface $output The output.
     * @return int A value that indicates success, invalid, or failure.
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $uploadName = $input->getArgument('upload-type-name');
        if (php_sapi_name() != 'cli') die('Restricted');
        
        // Generate Uploads class.
        return Tools::writeFile(
            ROOT.DS.'app'.DS.'lib'.DS.'utilities'.DS.'Upload'.$uploadName.'.php',
            Uploads::makeUpload($uploadName),
            'Upload'
        );
    }
}
