<!DOCTYPE html>
<html lang="es">
<head>
    <title>Pedidos</title>
    <?php include './inc/link.php'; ?>
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
                    #BTNpago{
                            margin-left: 35%;
                             text-align: center;
                             width: 200px;
                            }
</style>
<body id="container-page-index">
    <?php include './inc/navbar.php'; ?>
    <section id="container-pedido">
        <div class="container">
            <div class="page-header">
              <h1 style="text-align: center"><b><i>Metodos de Pago</i></b></h1>
            </div>
            <div class="row">
              <div class="col-xs-12 col-sm-8 col-sm-offset-2">
                <?php
                  require_once "library/configServer.php";
                  require_once "library/consulSQL.php";
                  if($_SESSION['UserType']=="Admin" || $_SESSION['UserType']=="User"){
                    if(isset($_SESSION['carro'])){
                ?>
                      <div class="container-fluid">
                        <div class="row">
                          <div class="col-xs-06 col-xs-offset-1">
                            <img class="img-responsive center-all-contens" src="assets/img/credit-card.png" style="width: 160px">
                            <p class="text-center">
                              <button id=BTNpago class="btn btn-lg btn-raised btn-success btn-block" data-toggle="modal" data-target="#PagoModalTran"><b>Pago Movil</b></button>
                            </p>
                          </div>
                        </div>
                      </div>
                <?php
                    }else{
                      echo '<p class="text-center lead">No cargado productos al carrito</p>';
                    }
                  }else{
                    echo '<p class="text-center lead">Inicia sesión para realizar pedidos</p>';
                  }
                ?>
              </div>
            </div>
        </div>
        <?php
            if($_SESSION['UserType']=="User"){
                $consultaC=ejecutarSQL::consultar("SELECT * FROM venta WHERE NIT='".$_SESSION['UserNIT']."'");
        ?>
            <div class="container" style="margin-top: 70px;">
              <div class="page-header">
                <h1 style="text-align: center"><b><i>Mis pedidos por recibir</i></b></h1>
              </div>
            </div>
        <?php
            if(mysqli_num_rows($consultaC)>=1){
        ?> 
                <div class="container" id="pedido-pendiente">
                    <div class="row">
                        <div class="col-xs-12">
                            <table class="table table-hover table-bordered table-striped" >
                                <thead id="texto-centro">
                                    <tr>
                                        <th style="background-color:orange"><b>Fecha</b></th>
                                        <th style="background-color:orange">Total</th>
                                        <th style="background-color:orange">Estado</th>
                                        <th style="background-color:orange">¿Como recibo el producto?</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    while($rw=mysqli_fetch_array($consultaC, MYSQLI_ASSOC)){
                                    ?> 
                                        <tr>
                                            <td><?php echo $rw['Fecha']; ?></td>
                                            <td>$<?php echo $rw['TotalPagar']; ?></td>
                                            <td>
                                            <?php
                                              switch ($rw['Estado']) {
                                                case 'Enviado':
                                                  echo "En camino";
                                                  break;
                                                case 'Pendiente':
                                                  echo "En espera";
                                                  break;
                                                case 'Entregado':
                                                  echo "Entregado";
                                                  break;
                                                default:
                                                  echo "Sin informacion";
                                                  break;
                                              }
                                            ?>
                                            </td>
                                            <td><?php echo $rw['TipoEnvio']; ?></td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                        
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
        <?php
            }else{
              echo '<p class="text-center lead">No tienes ningun pedido realizado</p>';
            }
            mysqli_free_result($consultaC);
        }
        ?>
    </section>
    <!--Datos de pago Movil-->
    <div class="modal fade" id="PagoModalTran" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <form class="modal-content FormCatElec" action="process/confirmcompra.php" method="POST" role="form" data-form="save">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel"><b>Pago Movil</b></h4>
          </div>
          <div class="modal-body">
            <?php
              $consult1=ejecutarSQL::consultar("SELECT * FROM cuentabanco");
              if(mysqli_num_rows($consult1)>=1){
                $datBank=mysqli_fetch_array($consult1, MYSQLI_ASSOC);
            ?>

            <p>
              <strong>Nombre del banco:</strong> <?php echo $datBank['NombreBanco']; ?><br>
              <strong>Numero de cuenta:</strong> <?php echo $datBank['NumeroCuenta']; ?><br>
              <strong>Nombre del beneficiario:</strong> <?php echo $datBank['NombreBeneficiario']; ?><br>
              <strong>Rif:</strong> <?php echo $datBank['TipoCuenta']; ?><br>
            </p>
            <h4>Adjunte los datos</h4>
                <?php if($_SESSION['UserType']=="Admin"): ?>
                <div class="form-group">
                  <span>N° de Referencia</span>
                    <input class="form-control" type="text" name="NumDepo" maxlength="50" required="">
                </div>
                <div class="form-group">
                  <span>¿Como recibir el paquete?</span>
                  <select class="form-control" name="tipo-envio" data-toggle="tooltip" data-placement="top" title="Elige El Tipo De Envio">
                      <option value="" disabled="" selected="">Selecciona una opción</option>
                      <option value="Buscar en Tienda">Buscar en Tienda</option>
                      <option value="Por delivery">Por delivery</option> 
                  </select>
               </div>
                <div class="form-group">
                    <label>Cedula del cliente</label>
                    <input class="form-control" type="text" name="Cedclien" maxlength="15" required="">
                </div>
                <div class="form-group">
                      <input type="file" name="comprobante">
                      <div class="input-group">
                        <input type="text" readonly="" class="form-control" placeholder="Seleccione la imagen del comprobante...">
                          <span class="input-group-btn input-group-sm">
                            <button type="button" class="btn btn-fab btn-fab-mini">
                              <i class="fa fa-file-image-o" aria-hidden="true"></i>
                            </button>
                          </span>
                      </div>
                        <p class="help-block"><small>Tipos de archivos admitidos, imagenes .jpg y .png. Maximo 5 MB</small></p>
                    </div>
                <?php else: ?>
                    <div class="form-group">
                        <label>Numero de Referencia</label>
                        <input class="form-control" type="text" name="NumDepo" maxlength="50" required="">
                    </div>
                    <div class="form-group">
                      <span>¿Como recibirá el Producto?</span>
                      <select class="form-control" name="tipo-envio" data-toggle="tooltip" data-placement="top" title="Elige El Tipo De Envio">
                          <option value="" disabled="" selected="">Selecciona una opción</option>
                          <option value="Recoger en Tienda">Recoger en Tienda</option>
                          <option value="Delivery">Delivery</option> 
                      </select>
                   </div>
                    <input type="hidden" name="Cedclien" value="<?php echo $_SESSION['UserNIT']; ?>">
                    <div class="form-group">
                      <input type="file" name="comprobante">
                      <div class="input-group">
                        <input type="text" readonly="" class="form-control" placeholder="Seleccione la imagen del comprobante...">
                          <span class="input-group-btn input-group-sm">
                            <button type="button" class="btn btn-fab btn-fab-mini">
                              <i class="fa fa-file-image-o" aria-hidden="true"></i>
                            </button>
                          </span>
                      </div>
                        <p class="help-block"><small>Tipos de archivos admitidos, imagenes .jpg y .png. Maximo 5 MB</small></p>
                    </div>
                <?php 
                endif;
              }else{
                echo "Ocurrio un error: Parese ser que no se ha configurado las cuentas de banco";
              }
              mysqli_free_result($consult1);
            ?>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger btn-sm btn-raised" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary btn-sm btn-raised">Comprar</button>
          </div>
        </form>
      </div>
    </div>
    <div class="ResForm"></div>
    <?php include './inc/footer.php'; ?>
</body>
</html>
