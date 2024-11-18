<?php
namespace Console\App\Commands;
 
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Console\App\Helpers\ProfileImageDir;
 
class RemoveProfileImagesCommand extends Command
{
    protected function configure()
    {
        $this->setName('tools:rm-profile-images')
            ->setDescription('Removes all profile images.')
            ->setHelp('Might need to use sudo on linux/mac -> sudo php console tools:rm-profile-images.');
    }
 
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        return ProfileImageDir::rmdirProfileImageDirectories();
    }
}