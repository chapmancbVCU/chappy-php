<?php
namespace Console\App\Commands;
 
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Console\App\Helpers\ProfileImageDir;
 
/**
 * Used during project initialization for the purpose for creating a new 
 * profile images directory.
 */
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
        return ProfileImageDir::mkdirProfileImages();
    }
}