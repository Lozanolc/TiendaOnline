<?php
session_start();
include '../library/configServer.php';
include '../library/consulSQL.php';

$code=consultasSQL::clean_string($_POST['admin-code']);
if(consultasSQL::DeleteSQL('administrador', "id='".$code."'")){
    echo '<script>
	    swal({
	      title: "Administrador eliminado con Exito",
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

