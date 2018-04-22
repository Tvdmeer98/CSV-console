<?php
/**
 * Created by PhpStorm.
 * User: Thomas
 * Date: 21/04/2018
 * Time: 10:48
 */

namespace App\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use App\Service\FileReader;


class ReadFileCommand extends Command
{
    protected function configure(){
        $this
            ->setName('app:read-file')
            ->setDescription('Reads file with corresponding filename')
            ->setHelp('This command reads the file with the corresponding filename. This file must have a .csv extension and must be stored in the src\\Files directory.')
            ->addArgument('filename', InputArgument::REQUIRED, 'Name of the file');
    }

    protected function execute(InputInterface $input, OutputInterface $output){
        $fileReader = new FileReader($input->getArgument('filename'));

        if ($fileReader->CheckExistence()){
            $output->writeln('<info>File found</info>');
            $fileReader->Read($output);
        }
        else{
            $output->writeln(array(
                '<error>File was not found, please check the following:',
                '* The file must be stored in the src\\Files directory',
                '* The file must have a .csv file extension which must be excluded from the command</error>'));
        }
    }
}