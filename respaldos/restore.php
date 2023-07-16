<?php
include '../respaldos/connect.php';
$restorePoint=SGBD::limpiarCadena($_POST['restorePoint']);
$sql=explode(";",file_get_contents($restorePoint));
$totalErrors=0;
for($i = 0; $i < (count($sql)-1); $i++){
    if(SGBD::sql("$sql[$i];")){  }else{ $totalErrors++; }
}
if($totalErrors<=0){
	echo "<h1>Restauración completada con éxito</h1>";
}else{
	echo "Ocurrio un error inesperado, no se pudo hacer la restauración completamente";
}
?>