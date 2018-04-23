<?php
/**
 * Created by PhpStorm.
 * User: Thomas
 * Date: 21/04/2018
 * Time: 17:29
 */

namespace App\Service;

use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Helper\Table;

class FileReader
{
    private $fileLocation;
    private $fileSystem;

    function __construct($fileName){
        $this->fileLocation = '%kernel.root_dir%/../src/Files/'.$fileName.'.csv';
        $this->fileSystem = new Filesystem();
    }

    //Checks if file exists in directory
    function CheckExistence(){
        Return($this->fileSystem->exists($this->fileLocation));
    }

    //Reads content
    function Read(OutputInterface $output){
        $file = file($this->fileLocation);

        foreach ($file as $f){
            $lines[] = explode(',', $f);    // array[line][column]
        }

        $this->ShowTable($output, $lines);
    }

    //Place content in a table and print to the console
    function ShowTable(OutputInterface $output, array $lines){
        $header = $lines[0];
        array_splice($lines, 0, 1);

        $table = new Table($output);
        $table
            ->setHeaders($header)
            ->setRows($lines);
        $table->render();
    }
}