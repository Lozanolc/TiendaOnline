<!DOCTYPE html>
<html lang="es">
<head>
    <title>Restaurar</title>
    <?php include './inc/link.php'; ?>
    <?php include './inc/navbar.php'; ?>
</head>
<style>
   #pedido-pendiente{
                    color: black;
                     text-align: center;
                    }
                    th{
                      text-align: center;
                      border-radius: 5%;
                    }
                    #myModalLabel{
                      text-align: center;
                    }
                    #form{
                            margin-left: 30%;
                             text-align: center;
                             width: 200px;
                            }
</style>
<body id="container-page-index">
    <?php include './inc/navbar.php'; ?>
    <section id="container-pedido">
        <div class="container">
            <div class="page-header">
              <h1 style="text-align: center"><b><i>Restaurar Base de Datos</i></b></h1>
            </div>
            <div class="row">
              <div class="col-xs-12 col-sm-8 col-sm-offset-2">
                <?php
                  require_once "library/configServer.php";
                  require_once "library/consulSQL.php";
                ?>
                      <div class="container-fluid">
                        <div class="row">
                          <div class="col-xs-06 col-xs-offset-1">
                            <img class="img-responsive center-all-contens" src="assets/img/images.jpg" style="width: 300px">
                            <!--Aqui empieza el Index-->
                            <form action="./respaldos/restore.php" method="POST" id="form">
	                        	<br>
	                        	<select name="restorePoint">
		                      	<label>Seleccione una opcion</label>
		                      	<option value="" disabled="" selected="">Selecciona uno de los archivos "BD"</option>
		                      	<?php
			                    	include_once './respaldos/connect.php';
			                    	$ruta=BACKUP_PATH;
			                    	if(is_dir($ruta)){
				                     if($aux=opendir($ruta)){
				                     while(($archivo = readdir($aux)) !== false){
				                      if($archivo!="."&&$archivo!=".."){
				                      $nombrearchivo=str_replace(".sql", "", $archivo);
				                       $nombrearchivo=str_replace("-", ":", $nombrearchivo);
				                        $ruta_completa=$ruta.$archivo;
				                      if(is_dir($ruta_completa)){
                                echo 'Error';
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
	                  	<button class="btn btn-primary btn-sm btn-raised" type="submit" style="width: 250px">Restaurar</button>
	                    </form>	
                  </div>
    </section>
    <?php include './inc/footer.php'; ?>
</body>
</html>
