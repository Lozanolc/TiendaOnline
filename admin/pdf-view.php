<p class="lead">

</p>
<div class="container">
  <div class="row">
        <div class="col-xs-12">
            <br><br>
            <div class="panel panel-info">
                <div class="panel-heading text-center"><h4><b>Reportes y Respaldo de BD</b></h4></div>
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="">
                            <tr>
                                <th class="text-center">Reporte de Productos</th>
                                <th class="text-center">Reporte de Pedidos</th>
                                <th class="text-center">Reporte de Provedores</th>
                                <th class="text-center">Respaldo de base de datos</th>
                                <th class="text-center">Restaurar BD</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $mysqli = mysqli_connect(SERVER, USER, PASS, BD);
                                mysqli_set_charset($mysqli, "utf8");

                                $pagina = isset($_GET['pag']) ? (int)$_GET['pag'] : 1;
                                $regpagina = 1;
                                $inicio = ($pagina > 1) ? (($pagina * $regpagina) - $regpagina) : 0;

                                $pedidos=mysqli_query($mysqli,"SELECT SQL_CALC_FOUND_ROWS * FROM venta LIMIT $inicio, $regpagina");

                                $totalregistros = mysqli_query($mysqli,"SELECT FOUND_ROWS()");
                                $totalregistros = mysqli_fetch_array($totalregistros, MYSQLI_ASSOC);


                              while($order=mysqli_fetch_array($pedidos, MYSQLI_ASSOC)){
                            ?>
                            <tr>
                                <!--Reporte de Productos-->
                              <td class="text-center"><a href="./report/totalProductos.php" class="btn btn-raised btn-xs btn-primary btn-block" target="_blank" style="height: 30px; font-size: 14px; font-family:'Times New Roman', Times, serif"><b>Imprimir</b></a></td>

                              <!--Reporte de Pedidos-->
                              <td class="text-center"><a href="./report/reportePedido.php" class="btn btn-raised btn-xs btn-primary btn-block" target="_blank" style="height: 30px; font-size: 14px; font-family:'Times New Roman', Times, serif"><b>Imprimir</b></a></td>

                            <!--Reporte de Provedores-->
                            <td class="text-center"><a href="./report/reporteprovedores.php" class="btn btn-raised btn-xs btn-primary btn-block" target="_blank" style="height: 30px; font-size: 16px; font-family:'Times New Roman', Times, serif"><b>Imprimir</b></a></td>
                             <!--Respaldo de Base de Datos-->
                             <td class="text-center">
                                <a href="./respaldos/backup/respaldoBD.php" class="btn btn-raised btn-xs btn-primary btn-block" style="height: 30px; font-size: 12px; font-family:'Times New Roman', Times, serif"><b>Crear respaldo de BD</b></a>
                            </td>
                            <!--reporte de prueba para comprobar varias paginas-->
                            <td class="text-center">
                                <a href="./restaurar.php" class="btn btn-raised btn-xs btn-primary btn-block" target="_blank" style="height: 30px; font-size: 12px; font-family:'Times New Roman', Times, serif"><b>Restaurar</b></a>
                            </td>
                            </tr>
                            <?php
                              }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
  </div>
</div>


