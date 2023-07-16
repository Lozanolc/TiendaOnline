<?php
    include './library/configServer.php';
    include './library/consulSQL.php';
    include './process/securityPanel.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Admin HM</title>
    <?php include './inc/link.php'; ?>
</head>
<body id="container-page-configAdmin">
    <?php include './inc/navbar.php'; ?>
    <section id="prove-product-cat-config">
        <div class="container">
          <div class="page-header">
          <h1 style="text-align:center"><b><i>Panel de Administración HM</b></i></h1>
           <!--====  <h1>Panel de administración de la Tienda Tienda HM </h1>====-->
          </div>
          <!--====  Tabs  del panel de administración====-->
          <ul class="nav nav-tabs nav-justified" style="margin-bottom: 12px;">
            <li>
              <a href="configAdmin.php?view=productlist" class="nav-link" active>
                <i class="fa fa-cubes" aria-hidden="true"></i> &nbsp; Productos
              </a>
            </li>
            <li>
              <a href="configAdmin.php?view=providerlist">
                <i class="fa fa-truck" aria-hidden="true"></i> &nbsp; Proveedores
              </a>
            </li>
            <li>
              <a href="configAdmin.php?view=categorylist">
                <i class="fa fa-shopping-basket" aria-hidden="true"></i> &nbsp; Categorías
              </a>
            </li>
            <li>
              <a href="configAdmin.php?view=adminlist">
                <i class="fa fa-users" aria-hidden="true"></i> &nbsp; Administradores
              </a>
            </li>
            <li>
              <a href="configAdmin.php?view=order">
                <i class="fa fa-shopping-cart" aria-hidden="true"></i> &nbsp; Pedidos
              </a>
            </li>
            <li>
              <a href="configAdmin.php?view=bank">
                <i class="fa fa-university" aria-hidden="true"></i> &nbsp; Cuenta HM
              </a>
            </li>
            <li>
              <!--Aqui puedes ingresas a todos los reportes en PDF-->
              <a href="configAdmin.php?view=pdf">
                <i class="fa fa-file-pdf-o" aria-hidden="true"></i> &nbsp; Reportes y más
              </a>
            </li>
          </ul>
          <?php
            $content=$_GET['view'];
            $WhiteList=["product","productlist","productinfo","provider","providerlist","providerinfo","category","categorylist","categoryinfo","admin","adminlist","order","bank","account","pdf","respaldoBD"];
            if(isset($content)){
              if(in_array($content, $WhiteList) && is_file("./admin/".$content."-view.php")){
                include "./admin/".$content."-view.php";
              }else{
                echo '<h2 class="text-center">Lo sentimos, la opción que ha seleccionado no se encuentra disponible</h2>';
              }
            }else{
              echo '<h2 class="text-center">Seleccione una opción <br><br><br><img src="./assets/img/MArilexys.png" width="350px"></h2>';
            }
          ?>
        </div>
    </section>
    <?php include './inc/footer.php'; ?>
</body>
</html>