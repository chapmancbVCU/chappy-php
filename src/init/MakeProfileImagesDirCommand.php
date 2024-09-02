<?php
namespace Console\App\Commands;
 
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
 
class MakeProfileImagesDirCommand extends Command
{
    protected function configure()
    {
        $this->setName('init:mk-profile-images-dir')
            ->setDescription('Builds Profile Image Dir')
            ->setHelp('Builds Profile Image Directory.');
    }
 
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        mkdir(CONSOLE_ROOT.DS.'public'.DS.'images'.DS.'uploads'.DS.'profile_images', 0755);
        return Command::SUCCESS;
    }
}