<?php
session_start();
include '../library/configServer.php';
include '../library/consulSQL.php';


$db_host = 'localhost';
$db_name = 'store';
$db_user = 'root';
$db_pass = 'lozanolc8';

$fecha = date("Y-m-d_H-i-s");

$salida_sql = 'Base.de.datos_'.$fecha.'.sql';

//variable para crear las instrucciones

$dump = "mysqldump -h$db_host -u$db_user -p$db_pass --opt $db_name > $salida_sql";

$zip = new ZipArchive();
$salida_zip = $db_name.'_'.$fecha.'.zip';

if($zip->open($salida_zip, ZipArchive::CREATE) === true){
   $zip->addFile($salida_sql);
   $zip->close();
   unlink($salida_zip); //Comando para eliminar el archivo zip
   header("location: $salida_sql");//tipo de archivo que descargara el usuario
} else {
    echo "Error";
}
system($dump, $output);
   
?>