<?php

class log{
     
    private $filelog;
    function __construct($path){
        $this-> filelog = fopen($path, "a");
    }

     function writeLine($type, $message){
        $date = new DateTime();
        fputs($this-> filelog, "[".$type."][".$date->format("d-m-Y H:i:s")."]: ". $message ."\n");
     }


    function close(){
        fclose($this->filelog);
    }
}

$log = new log("log.txt");

$log->writeLine("E", "ha habiado un error");
$log->writeLine("I", "todo bien");
$log->writeLine("W", "hay un warnign");

$log->close();
?>