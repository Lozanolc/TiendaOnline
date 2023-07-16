<?php
include './library/configServer.php';
include './library/consulSQL.php';
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <title>Productos</title>
    <?php include './inc/link.php'; ?>
</head>
<body id="container-page-product">
    <?php include './inc/navbar.php'; ?>
    <section id="infoproduct">
        <div class="container">
            <div class="row">
                <div class="page-header">
                    <h1 style="text-align: center"><b><i>Detalle de producto</b></i></h1>
                </div>
                <?php 
                    $CodigoProducto=consultasSQL::clean_string($_GET['CodigoProd']);
                    $productoinfo=  ejecutarSQL::consultar("SELECT producto.CodigoProd,producto.NombreProd,producto.CodigoCat,categoria.Nombre,producto.Precio,producto.Descuento,producto.Stock,producto.Imagen FROM categoria INNER JOIN producto ON producto.CodigoCat=categoria.CodigoCat  WHERE CodigoProd='".$CodigoProducto."'");
                    while($fila=mysqli_fetch_array($productoinfo, MYSQLI_ASSOC)){
                        echo '
                            <div class="col-xs-12 col-sm-6">
                                <br><br>
                                <br>
                                <br>
                                <br>
                                <h4><strong>Nombre: </strong>'.$fila['NombreProd'].'</h4><br>
                                <h4><strong>Precio: </strong>$'.number_format(($fila['Precio']), 2, '.', '').'</h4>
                                <br>
                                <h4><strong>Costo de Instalación: </strong>'.$fila['Descuento'].'$</h4><br>
                                <h4><strong>Cantidad disponible: </strong>'.$fila['Stock'].' unidades</h4><br>
                                <h4><strong></strong></h4>';
                                if($fila['Stock']>=1){
                                    if($_SESSION['nombreAdmin']!="" || $_SESSION['nombreUser']!=""){
                                        echo '<form action="process/carrito.php" method="POST" class="FormCatElec" data-form="">
                                            <input type="hidden" value="'.$fila['CodigoProd'].'" name="codigo">
                                            <br>
                                            <div class="form-group">
                                                <input type="number" class="form-control" value="01" min="1" max="'.$fila['Stock'].'" name="cantidad">
                                            </div>
                                            <button class="btn btn-lg btn-raised btn-success btn-block"><i class="fa fa-shopping-cart"></i>&nbsp;&nbsp; Añadir al carrito</button>
                                        </form>
                                        <div class="ResForm"></div>';
                                    }else{
                                        echo '<p class="text-center"><small>Para agregar productos al carrito de compras debes iniciar sesion</small></p><br>';
                                        echo '<button class="btn btn-lg btn-raised btn-info btn-block" data-toggle="modal" data-target=".modal-login"><i class="fa fa-user"></i>&nbsp;&nbsp; Iniciar sesion</button>';
                                    }
                                }else{
                                    echo '<p class="text-center text-danger lead">No hay existencias de este producto</p><br>';
                                }
                                if($fila['Imagen']!="" && is_file("./assets/img-products/".$fila['Imagen'])){ 
                                    $imagenFile="./assets/img-products/".$fila['Imagen']; 
                                }else{ 
                                    $imagenFile="./assets/img-products/default.png"; 
                                }
                                echo '
                                <a href="product.php?categ=002" class="btn btn-lg btn-primary btn-raised btn-block"><i class="fa fa-mail-reply"></i>&nbsp;&nbsp;Ver Otro Producto</a>
                            </div>


                            <div class="col-xs-12 col-sm-6">
                                <br><br><br>
                                <img class="img-responsive" src="'.$imagenFile.'">
                            </div>';
                    }
                ?>
            </div>
        </div>
    </section>

    <?php include './inc/footer.php'; ?>

</body>

</html>