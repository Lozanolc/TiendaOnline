<!DOCTYPE html>
<html lang="es">
<head>
    <title>Inicio</title>
    <style>
        h1{
            color: blue;
            text-align: center; 
            font-family:  Garamond;
        }
        #slider2{
                padding-left: 20%;
               }
        #slider1{
                padding-left: 20%;
               }
    </style>
    <?php include './inc/link.php'; ?>
</head>
<body id="container-page-index">
    <?php include './inc/navbar.php'; ?>
    <section id="slider-store" class="carousel slide" data-ride="carousel" style="padding: 0;">
<!-- Indicators -->
<div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>

<!-- Wrapper for slides -->
<div class="carousel-inner" role="listbox">
    <div class="item active" id="slider1">
        <img src="./assets/img-products/slyde1.jpg" alt="slider1">
        <div class="carousel-caption">
            <h3> </h3>
        </div>
    </div>
    <div class="item" id="slider2">
        <img src="./assets/img-products/slyde 2.jpg" alt="slider2">
        <div class="carousel-caption">
             
        </div>
    </div>
    <div class="item" id="slider2">
        <img src="./assets/img-products/slyde 3.jpg" alt="slider3">
        <div class="carousel-caption">
             
        </div>
    </div>
</div>
<!-- Controls -->
<a class="left carousel-control" href="#slider-store" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Anterior</span>
</a>
<a class="right carousel-control" href="#slider-store" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Siguiente</span>
</a>
</section>
<!--Ultimos productos agregados-->
    <section id="new-prod-index">    
         <div class="container">
            <div class="page-header">
                <h1><b><i>Últimos Productos Agregados</b></i></h1>
            </div>
            <div class="row">
              	<?php
                  include 'library/configServer.php';
                  include 'library/consulSQL.php';
                  $consulta= ejecutarSQL::consultar("SELECT * FROM producto WHERE Stock > 0 AND Estado='Activo' ORDER BY id DESC LIMIT 12");
                  $totalproductos = mysqli_num_rows($consulta);
                  if($totalproductos>0){
                      while($fila=mysqli_fetch_array($consulta, MYSQLI_ASSOC)){
                ?>
                <div class="col-xs-12 col-sm-6 col-md-4">
                     <div class="thumbnail">
                       <img class="img-product" src="assets/img-products/<?php if($fila['Imagen']!="" && is_file("./assets/img-products/".$fila['Imagen'])){ echo $fila['Imagen']; }else{ echo "default.png"; } ?>">
                       <div class="caption">
                             <!--Nombre del producto-->
                       		<h3><b><?php echo $fila['Marca']; ?></b></h3><!--Marca del Producto-->
                            <p><?php echo $fila['NombreProd']; ?></p>
                            <?php if($fila['Descuento']>0): ?>
                             <p>
                             <p>$<?php echo $fila['Precio']; ?></p><!--Linea de Costo de Producto-->
                             <?php
                             $pref=number_format($fila['Precio']+($fila['Precio']*($fila['Descuento']/100)), 2, '.', '');
                             //echo $fila['Descuento']."% Costo de Instalación: $".$pref; //aqui esta la linea del "Costo de Instalación" 
                             ?>
                             </p>
                             <?php else: ?>
                              <p>$<?php echo $fila['Precio']; ?></p>
                             <?php endif; ?>
                        <p class="text-center">
                            <a href="infoProd.php?CodigoProd=<?php echo $fila['CodigoProd']; ?>" class="btn btn-primary btn-sm btn-raised btn-block">&nbsp; Ver Producto</a>
                        </p>
                       </div>
                     </div>
                </div>     
                <?php
                     }   
                  }else{
                      echo '<h2>No hay productos registrados en la tienda</h2>';
                  }  
              	?>  
            </div>
         </div>
    </section>

    <?php include './inc/footer.php'; ?>
</body>
</html>