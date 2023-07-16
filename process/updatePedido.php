<?php
include '../library/configServer.php';
include '../library/consulSQL.php';

$numPediUp=consultasSQL::clean_string($_POST['num-pedido']);
$estadPediUp=consultasSQL::clean_string($_POST['pedido-status']);


if(consultasSQL::UpdateSQL("venta", "Estado='$estadPediUp'", "NumPedido='$numPediUp'")){
    echo '<script>
        swal({
          title: "El pedido se actualizo con éxito",
          type: "success",
          confirmButtonClass: "btn-danger",
          },
          function(isConfirm) {
          if (isConfirm) {
            location.reload();
          } else {
            location.reload();
          }
        });
    </script>';
}else{
    echo '<script>swal("ERROR", "Ocurrió un error inesperado, por favor intente nuevamente", "error");</script>';
}