<!DOCTYPE html>
<html lang="es">
<head>
    <title>Carrito de compras</title>
    <style>
        h1{
            font-family: Garamond;
            text-align: center;
        }
        #btnIrproductos{
                       margin-left: 03%;
                       }
                       .row{
                        text-align: center;
                       }
                       #titulo{
                        text-align: center;
                       }
    </style>
    <?php include './inc/link.php'; ?>
</head>
<body id="container-page-index">
    <?php include './inc/navbar.php'; ?>
    <section id="container-pedido">
        <div class="container">
            <div class="page-header">
              <h1><b><i>Carrito de Compras</b></i></h1>
            </div>
            <br>
            <div class="row">
                <div class="col-xs-12">
                    <?php
                        require_once "library/configServer.php";
                        require_once "library/consulSQL.php";
                        if(!empty($_SESSION['carro'])){
                            $suma = 0;
                            $sumaA = 0;
                            echo '<table class="table table-bordered table-hover" id="titulo"><thead>
                            <tr class="bg-success">
                              <th>Nombre</th>
                              <th>Precio Unitario</th>
                              <th>Costo de Instalación</th>
                              <th>Cantidad</th>
                              <th>Subtotal</th>
                              <th>Acciones</th>
                            </tr></thead>';
                            foreach($_SESSION['carro'] as $codeProd){
                                $consulta=ejecutarSQL::consultar("SELECT * FROM producto WHERE CodigoProd='".$codeProd['producto']."'");
                                while($fila = mysqli_fetch_array($consulta, MYSQLI_ASSOC)) {
                                    $pref=number_format(($fila['Precio']), 2, '.', '');
                                        echo "<tbody>
                                            <tr>
                                                <td>".$fila['NombreProd']."</td>
                                                <td> ".$pref."$</td>
                                                <td>".$fila['Descuento']."$</td>
                                                <td> ".$codeProd['cantidad']."</td>
                                                <td>".$pref+$fila['Descuento']."</td>
                                                <td>
                                                    <form action='process/quitarproducto.php' method='POST' class='FormCatElec' data-form=''>
                                                        <input type='hidden' value='".$codeProd['producto']."' name='codigo'>
                                                        <button class='btn btn-danger btn-raised btn-xs'>Eliminar</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        </tbody>";
                                $suma += $pref+$fila['Descuento'];
                                $sumaA += $codeProd['cantidad'];
                                //Prueba de suma de productos
                                }
                                mysqli_free_result($consulta);
                            }//aqui se colocan los datos de la tabla
                            echo '<tr class="bg-danger"><td> </td><td> </td><td colspan="2"><b>Total</b></td><td><strong>'.number_format($suma,2).'$</strong></td><td><strong></strong></td></tr></table><div class="ResForm"></div>';
                            echo '
                            <p class="text-center">
                            <a href="index.php" class="btn btn-primary btn-raised btn-lg">Seguir comprando</a>
                            <a href="process/vaciarcarrito.php" class="btn btn-success btn-raised btn-lg">Vaciar el carrito</a>
                            <a href="pedido.php" class="btn btn-danger btn-raised btn-lg">Confirmar el pedido</a>
                            </p>
                            ';
                        }else{
                            echo '<p class="text-center text-danger lead"><b>El carrito esta vacío</b></p>
                            <a href="product.php?categ=002" class="btn btn-primary btn-lg btn-raised" id="btnIrproductos">Ver Productos</a>';
                    
                        }  
                    ?>
                </div>
            </div>
        </div>
        <h2 class="text-center"><img src="./assets/img/MArilexys.png" width="250px">
    </section>
    <?php include './inc/footer.php'; ?>
</body>
</html>