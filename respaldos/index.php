<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Restaurar Base de Datos</title>
</head>
<body>
	<form action="../respaldos/restore.php" method="POST">
		<br>
		<select name="restorePoint">
			<label>Seleccione una opcion</label>
			<option value="" disabled="" selected="">Selecciona uno de los archivos "Store"</option>
			<?php
				include_once '../respaldos/connect.php';
				$ruta=BACKUP_PATH;
				if(is_dir($ruta)){
				    if($aux=opendir($ruta)){
				        while(($archivo = readdir($aux)) !== false){
				            if($archivo!="."&&$archivo!=".."){
				                $nombrearchivo=str_replace(".sql", "", $archivo);
				                $nombrearchivo=str_replace("-", ":", $nombrearchivo);
				                $ruta_completa=$ruta.$archivo;
				                if(is_dir($ruta_completa)){
				                }else{
				                    echo '<h1 id=h1><option value="'.$ruta_completa.'">'.$nombrearchivo.'</option></h1>';
				                }
				            }
				        }
				        closedir($aux);
				    }
				}else{
				    echo $ruta." No es ruta válida";
				}
			?>
		</select>
		<button class="btn btn-primary btn-sm btn-raised" type="submit" >Restaurar</button>
	</form>	
</body>
</html>
