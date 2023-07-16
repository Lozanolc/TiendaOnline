<?php
include '../library/configServer.php';
include '../library/consulSQL.php';

$nitOldProveUp=consultasSQL::clean_string($_POST['nit-prove-old']);
$nameProveUp=consultasSQL::clean_string($_POST['prove-name']);
$dirProveUp=consultasSQL::clean_string($_POST['prove-dir']);
$telProveUp=consultasSQL::clean_string($_POST['prove-tel']);
$webProveUp=consultasSQL::clean_string($_POST['prove-web']);

if(consultasSQL::UpdateSQL("proveedor", "NombreProveedor='$nameProveUp',Direccion='$dirProveUp',Telefono='$telProveUp',PaginaWeb='$webProveUp'", "NITProveedor='$nitOldProveUp'")){
    echo '<script>
        swal({
          title: "Los datos del proveedor se actualizaron correctamente",
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