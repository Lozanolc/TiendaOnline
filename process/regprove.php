<?php
session_start();
include '../library/configServer.php';
include '../library/consulSQL.php';

$nitProve=consultasSQL::clean_string($_POST['prove-nit']);
$nameProve=consultasSQL::clean_string($_POST['prove-name']);
$dirProve=consultasSQL::clean_string($_POST['prove-dir']);
$telProve=consultasSQL::clean_string($_POST['prove-tel']);
$webProve=consultasSQL::clean_string($_POST['prove-web']);

$verificar=  ejecutarSQL::consultar("SELECT * FROM proveedor WHERE NITProveedor='".$nitProve."'");
if(mysqli_num_rows($verificar)<=0){
    if(consultasSQL::InsertSQL("proveedor", "NITProveedor, NombreProveedor, Direccion, Telefono, PaginaWeb", "'$nitProve','$nameProve','$dirProve','$telProve','$webProve'")){
        echo '<script>
            swal({
              title: "Los datos del proveedor se agregaron con éxito",
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
}else{
    echo '<script>swal("ERROR", "El número de CEDULA o ya se encuentra registrado, por favor ingrese otro", "error");</script>';
}
mysqli_free_result($verificar);